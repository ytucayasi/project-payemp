<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('n');
            $table->string('tipdoc');
            $table->string('dni');
            $table->string('nCuenta');
            $table->string('aPaterno');
            $table->string('aMaterno');
            $table->string('nombres');
            $table->string('modContratacion');
            $table->float('monto')->nullable();
            $table->char('estado', 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
