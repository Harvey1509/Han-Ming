<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade');
            $table->string('estado', 20)->default('activo'); // activo, comprado, cancelado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carritos');
    }
};
