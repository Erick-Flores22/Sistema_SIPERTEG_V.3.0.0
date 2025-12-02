<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('planes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->decimal('precio_mensual', 8, 2);
        $table->integer('velocidad_megas');

        // Dispositivos permitidos
        $table->integer('dispositivos_tv')->default(0);
        $table->integer('dispositivos_pc')->default(0);
        $table->integer('dispositivos_celular')->default(0);

        // Instalación normal
        $table->decimal('precio_instalacion', 8, 2);

        // Promoción de instalación
        $table->boolean('es_promocion')->default(false);
        $table->decimal('precio_promocion_instalacion', 8, 2)->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};
