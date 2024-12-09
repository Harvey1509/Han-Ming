<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('id_carrito')->constrained('carritos')->onDelete('cascade');
            $table->decimal('total', 10, 2); // Total del pedido
            $table->string('estado', 20)->default('pendiente'); // pendiente, completado, cancelado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
};
