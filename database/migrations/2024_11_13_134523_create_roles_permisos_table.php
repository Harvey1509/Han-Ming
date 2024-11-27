<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('roles_permisos', function (Blueprint $table) {
            $table->foreignId('id_rol')->constrained('roles')->onDelete('cascade');
            $table->foreignId('id_permiso')->constrained('permisos')->onDelete('cascade');
            $table->primary(['id_rol', 'id_permiso']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles_permisos');
    }

};