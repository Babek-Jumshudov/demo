<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string("comment");
            $table->string("user_id");
            $table->string("post_id");
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
