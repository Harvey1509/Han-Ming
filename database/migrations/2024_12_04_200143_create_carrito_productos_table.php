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
            $table->foreignId('id_producto')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2); // Precio al momento de agregar al carrito
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrito_productos');
    }
};
