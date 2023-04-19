<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            // crea un foreign key que va a estar asociado con la tabla del id
            // vendria a ser una relacion de muchos a muchos y vendria a ser como una tabla pivote
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // si se elimina el usuario se elimina sus comentarios
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // si se elimina el post se elimina los comentarios
            $table->string('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
