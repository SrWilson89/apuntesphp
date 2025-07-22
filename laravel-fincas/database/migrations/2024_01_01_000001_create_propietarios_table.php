<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para crear la tabla de propietarios
 * 
 * Esta tabla almacena la información básica de los propietarios
 * que pueden tener una o múltiples fincas asociadas.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('propietarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellidos', 150);
            $table->string('email')->unique();
            $table->string('telefono', 20)->nullable();
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index('email');
            $table->index(['nombre', 'apellidos']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propietarios');
    }
};
