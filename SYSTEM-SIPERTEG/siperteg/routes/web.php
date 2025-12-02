<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController, AbonadoController, NodoController, CajaDistribucionController,
    CobroController, FallaController, DatosTecnicoController, InstalacionController,
    DefectoController, StatisticsController, Auth\LoginController, CaptchaController,
    GestionController, PeriodoController, UserController, PlanController
};

// ==============================
// PÁGINA DE INICIO
// ==============================
Route::get('/', fn() => view('welcome'));

// ==============================
// CAPTCHA (solo invitados)
// ==============================
Route::middleware('guest')->group(function () {
    Route::get('/captcha', [CaptchaController::class, 'showCaptchaForm'])->name('captcha.form');
    Route::get('/captcha-image', [CaptchaController::class, 'captchaImage'])->name('captcha.image');
    Route::post('/captcha', [CaptchaController::class, 'validateCaptcha'])->name('captcha.validate');
});

// ==============================
// LOGIN / LOGOUT PERSONALIZADO
// ==============================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==============================
// RUTAS PRIVADAS (auth + verified)
// ==============================
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // PERFIL DE USUARIO
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==============================
    // ADMIN
    // ==============================
    Route::middleware('role:admin')->group(function () {
        Route::resource('gestiones', GestionController::class)->only(['index', 'create', 'store']);
        Route::get('/gestiones/{gestion}/periodos', [PeriodoController::class, 'index'])->name('periodos.index');
        Route::get('/estadisticas', [StatisticsController::class, 'index'])->name('estadisticas.index');

        Route::resource('abonados', AbonadoController::class);
        Route::get('abonados/{abonado}/historial', [AbonadoController::class, 'historial'])->name('abonados.historial');
        Route::get('abonados/{abonado}/historial/pdf', [AbonadoController::class, 'historialPdf'])->name('abonados.historial.pdf');

        Route::resource('nodos', NodoController::class);
        Route::get('/nodos/{nodo}/mapa', [NodoController::class, 'mapa'])->name('nodos.mapa');

        Route::resource('cajas_distribucion', CajaDistribucionController::class);
        Route::get('/cajas_distribucion/{caja}/mapa', [CajaDistribucionController::class, 'mapa'])->name('cajas_distribucion.mapa');

        Route::resource('users', UserController::class)->only(['index', 'create', 'store']);
    });

    // ==============================
    // COBRADOR
    // ==============================
    Route::middleware('role:admin,cobrador')->group(function () {

        Route::get('/gestiones', [GestionController::class, 'index'])->name('gestiones.index');
        Route::get('/gestiones/{gestion}/periodos', [PeriodoController::class, 'index'])->name('periodos.index');

        Route::get('/periodos/{periodo}/cobros', [CobroController::class, 'index'])->name('cobros.index');
        Route::get('/periodos/{periodo}/cobros/create', [CobroController::class, 'create'])->name('cobros.create');
        Route::post('/periodos/{periodo}/cobros', [CobroController::class, 'store'])->name('cobros.store');

        Route::get('/buscar-abonados', [AbonadoController::class, 'buscar'])->name('abonados.buscar');
        Route::get('/abonado/{id}/plan', function($id) {
    $abonado = \App\Models\Abonado::with('datosTecnico.plan')->find($id);

    if (!$abonado || !$abonado->datosTecnico || !$abonado->datosTecnico->plan) {
        return response()->json(['precio' => 0]);
    }

    return response()->json([
        'precio' => $abonado->datosTecnico->plan->precio_mensual
    ]);
})->name('abonado.plan.precio');

    });

    // ==============================
    // TÉCNICO
    // ==============================
    Route::middleware('role:admin,tecnico')->group(function () {

        Route::resource('abonados', AbonadoController::class)->only(['index','create','store','edit','update']);
        Route::resource('datos_tecnicos', DatosTecnicoController::class);

        Route::get('/cajas-por-nodo/{nodo}', [CajaDistribucionController::class, 'porNodo']);

        Route::resource('fallas', FallaController::class);

        Route::resource('nodos', NodoController::class)->only(['index','create','store','edit','update','show']);
        Route::resource('cajas_distribucion', CajaDistribucionController::class)->only(['index','create','store','edit','update','show']);
    });

    // ==============================
    // ASISTENTE ADMINISTRATIVO (espacio futuro)
    // ==============================
    Route::middleware('role:admin,asistente')->group(function () {});



    // ====================================================
    // PLANES DE INTERNET
    // ====================================================

    // 🔵 TÉCNICO → SOLO INDEX
    Route::middleware('role:tecnico')->group(function () {
        Route::get('/planes', [PlanController::class, 'index'])->name('planes.index');
    });

    // 🟢 ADMIN + ASISTENTE → CRUD COMPLETO (sin delete)
    Route::middleware('role:admin,asistente')->group(function () {
        Route::get('/planes', [PlanController::class, 'index'])->name('planes.index');
        Route::get('/planes/create', [PlanController::class, 'create'])->name('planes.create');
        Route::post('/planes', [PlanController::class, 'store'])->name('planes.store');
        Route::get('/planes/{plan}/edit', [PlanController::class, 'edit'])->name('planes.edit');
        Route::put('/planes/{plan}', [PlanController::class, 'update'])->name('planes.update');
    });

});
// ==============================
// RUTAS INSTALACIONES + DEFECTOS (ROLES)
// ==============================
Route::middleware(['auth'])->group(function () {

    // ---------------------------------------------------------
    // 🔧 TECNICO → index, show, edit (sin create/store/update)
    // ---------------------------------------------------------
    Route::middleware('role:tecnico')->group(function () {
        // Instalaciones
        Route::get('instalaciones', [InstalacionController::class, 'index'])->name('instalaciones.index');
        Route::get('instalaciones/{instalacion}', [InstalacionController::class, 'show'])->name('instalaciones.show');
        Route::get('instalaciones/{instalacion}/edit', [InstalacionController::class, 'edit'])->name('instalaciones.edit');

        // Defectos
        Route::get('defectos', [DefectoController::class, 'index'])->name('defectos.index');
        Route::get('defectos/{defecto}', [DefectoController::class, 'show'])->name('defectos.show');
        Route::get('defectos/{defecto}/edit', [DefectoController::class, 'edit'])->name('defectos.edit');
    });

    // ---------------------------------------------------------
    // 🟢 ADMIN + ASISTENTE → CRUD COMPLETO (sin delete)
    // ---------------------------------------------------------
    Route::middleware('role:admin,asistente')->group(function () {
        // Instalaciones
        Route::get('instalaciones', [InstalacionController::class, 'index'])->name('instalaciones.index');
        Route::get('instalaciones/create', [InstalacionController::class, 'create'])->name('instalaciones.create');
        Route::post('instalaciones', [InstalacionController::class, 'store'])->name('instalaciones.store');
        Route::get('instalaciones/{instalacion}', [InstalacionController::class, 'show'])->name('instalaciones.show');
        Route::get('instalaciones/{instalacion}/edit', [InstalacionController::class, 'edit'])->name('instalaciones.edit');
        Route::put('instalaciones/{instalacion}', [InstalacionController::class, 'update'])->name('instalaciones.update');

        // Defectos
        Route::get('defectos', [DefectoController::class, 'index'])->name('defectos.index');
        Route::get('defectos/create', [DefectoController::class, 'create'])->name('defectos.create');
        Route::post('defectos', [DefectoController::class, 'store'])->name('defectos.store');
        Route::get('defectos/{defecto}', [DefectoController::class, 'show'])->name('defectos.show');
        Route::get('defectos/{defecto}/edit', [DefectoController::class, 'edit'])->name('defectos.edit');
        Route::put('defectos/{defecto}', [DefectoController::class, 'update'])->name('defectos.update');
    });
});


// ==============================
// PLANES DE INTERNET
// ==============================

// 🔵 TECNICO → SOLO INDEX
Route::middleware(['auth', 'role:tecnico'])->group(function () {
    Route::get('/planes', [PlanController::class, 'index'])->name('planes.index');
});

// 🟢 ADMIN + ASISTENTE → CRUD COMPLETO (sin delete)
Route::middleware(['auth', 'role:admin,asistente'])->group(function () {
    Route::get('/planes', [PlanController::class, 'index'])->name('planes.index');
    Route::get('/planes/create', [PlanController::class, 'create'])->name('planes.create');
    Route::post('/planes', [PlanController::class, 'store'])->name('planes.store');
    Route::get('/planes/{plan}/edit', [PlanController::class, 'edit'])->name('planes.edit');
    Route::put('/planes/{plan}', [PlanController::class, 'update'])->name('planes.update');
});
