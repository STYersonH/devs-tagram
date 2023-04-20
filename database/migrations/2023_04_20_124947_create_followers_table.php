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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            // aqui laravel sabe que es la tabla users por el foreignId
            $table->foreignId('user_id')->constrained()->onDelete('cascate');
            // como ya tenemos un 'user_id' usamos otro campo 'follower_id' que se debe declarar a que tabla pertenece
            // en constrained
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
