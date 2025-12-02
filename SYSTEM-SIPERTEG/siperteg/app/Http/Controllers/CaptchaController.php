<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CaptchaController extends Controller
{
    /**
     * Mostrar el formulario de captcha tras validar credenciales.
     */
    public function showCaptchaForm(Request $request)
    {
        if (! $request->session()->has('captcha.user_id')) {
            return redirect()->route('login');
        }

        return view('auth.captcha');
    }

    /**
     * Generar y devolver la imagen PNG del captcha.
     */
    public function captchaImage(Request $request)
    {
        // 1) Generar texto aleatorio
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $text  = '';
        for ($i = 0; $i < 5; $i++) {
            $text .= $chars[random_int(0, strlen($chars) - 1)];
        }

        // Guardar en sesión
        $request->session()->put('captcha.text', $text);

        // 2) Crear imagen en memoria
        $width  = 120;
        $height = 40;
        $img    = \imagecreate($width, $height);

        // Colores
        $bgColor   = \imagecolorallocate($img, 255, 255, 255);
        $textColor = \imagecolorallocate($img, 0, 0, 0);

        // Fondo con ruido de líneas
        for ($i = 0; $i < 3; $i++) {
            \imageline(
                $img,
                0,
                random_int(0, $height),
                $width,
                random_int(0, $height),
                $textColor
            );
        }

        // Ruido de puntos
        for ($i = 0; $i < 100; $i++) {
            \imagesetpixel(
                $img,
                random_int(0, $width),
                random_int(0, $height),
                $textColor
            );
        }

        // Escribir texto
        $fontSize = 5;    // font built-in
        $x        = 10;
        $y        = 10;
        \imagestring($img, $fontSize, $x, $y, $text, $textColor);

        // Capturar PNG en buffer
        \ob_start();
        \imagepng($img);
        $pngData = \ob_get_clean();
        \imagedestroy($img);

        // Devolver respuesta
        return response($pngData, 200)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'no-cache, must-revalidate');
    }

    /**
     * Validar el captcha ingresado y completar el login.
     */
    public function validateCaptcha(Request $request)
    {
        $request->validate([
            'captcha' => 'required|string',
        ]);

        $entered = strtoupper($request->input('captcha'));
        $stored  = $request->session()->get('captcha.text');

        if ($entered === $stored) {
            // Marcar captcha como pasado
            $request->session()->put('captcha.passed', true);

            // Loguear por ID (evita pasar Collection)
            $userId = $request->session()->get('captcha.user_id');
            Auth::loginUsingId($userId);

            // Limpiar datos de captcha
            $request->session()->forget(['captcha.user_id', 'captcha.text']);

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors(['captcha' => 'Código incorrecto, intente nuevamente.']);
    }
}
