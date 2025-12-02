<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * A dónde redirigir tras el login completo.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Sobrescribimos el método de login para hacer validación previa,
     * generar captcha y retrasar el login definitivo hasta que el captcha
     * sea resuelto.
     */
    public function login(Request $request)
    {
        // 1) Validar entrada
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // 2) Si aún no pasó el captcha, hacemos validación de credenciales
        if (! $request->session()->get('captcha.passed', false)) {

            $credentials = $request->only('email', 'password');

            // Validamos sin loguear
            if (Auth::validate($credentials)) {
                // Credenciales correctas: guardamos el usuario en sesión
                $user = User::where('email', $request->email)->first();
                $request->session()->put('captcha.user_id', $user->id);

                // Y redirigimos al formulario de captcha
                return redirect()->route('captcha.form');
            }

            // Credenciales inválidas
            return back()
                ->withErrors(['email' => 'Credenciales incorrectas.'])
                ->withInput($request->only('email'));
        }

        // 3) Si ya pasó el captcha, procedemos al login real
        $credentials = $request->only('email', 'password');
        $remember    = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Limpio sesión de captcha
            $request->session()->forget(['captcha.passed', 'captcha.user_id', 'captcha.text']);
            return redirect()->intended($this->redirectPath());
        }

        // Nunca debería llegar aquí, pero por precaución:
        return back()
            ->withErrors(['email' => 'Error al iniciar sesión.'])
            ->withInput($request->only('email'));
    }
}
