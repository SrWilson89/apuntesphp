<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para crear la tabla de fincas
 * 
 * Esta tabla almacena la información de las fincas y su relación
 * con los propietarios a través de una clave foránea.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fincas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200);
            $table->text('direccion');
            $table->string('codigo_postal', 10);
            $table->string('ciudad', 100);
            $table->string('provincia', 100);
            $table->foreignId('propietario_id')
                  ->nullable()
                  ->constrained('propietarios')
                  ->onDelete('set null');
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index('propietario_id');
            $table->index(['ciudad', 'provincia']);
            $table->index('codigo_postal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fincas');
    }
};
