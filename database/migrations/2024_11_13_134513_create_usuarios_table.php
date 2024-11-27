<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rol')->constrained('roles');
            $table->string('nombre_usuario', 50);
            $table->string('apellido_usuario', 50);
            $table->string('email_usuario', 100)->unique();
            $table->string('password_usuario', 255);
            $table->date('fecha_registro');
            $table->string('estado_usuario', 20)->default('activo');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
