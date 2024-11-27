<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_subcategoria')->constrained('subcategorias');
            $table->string('nombre_producto')->nullable();
            $table->text('descripcion_producto')->nullable();
            $table->decimal('precio_producto', 10, 2)->nullable();
            $table->string('imagen_url_producto');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }

};
