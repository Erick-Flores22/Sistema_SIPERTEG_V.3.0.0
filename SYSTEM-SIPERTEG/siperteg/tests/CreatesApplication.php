<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Create the application.
     *
     * This method boots the Laravel application for testing.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        // Carga la instancia base de Laravel
        $app = require __DIR__ . '/../bootstrap/app.php';

        // Inicializa el kernel para ejecutar pruebas
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
