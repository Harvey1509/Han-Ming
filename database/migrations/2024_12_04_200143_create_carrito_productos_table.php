<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('carrito_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_carrito')->constrained('carritos')->onDelete('cascade');
            $table->string('id_producto', 6); 
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2);
            $table->timestamps();

            // Agregar la clave foránea manualmente
            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('carrito_productos');
    }
};
