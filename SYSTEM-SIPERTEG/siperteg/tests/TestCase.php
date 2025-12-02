<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // 🔥 DESACTIVA EL MIDDLEWARE 'verified' DURANTE LOS TESTS
        Route::middlewareGroup('verified', []);
    }
}
