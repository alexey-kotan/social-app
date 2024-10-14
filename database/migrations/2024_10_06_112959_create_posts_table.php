<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->string('image')->nullable(); // для изображений указываем string, тк они будут хранить его url, nullable - может содердать какое-то значение или же отсутствовать (null)
            $table->unsignedBigInteger('likes')->nullable(); // unsigned - не отриц. числа BigInteger - работа с большими числами
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};