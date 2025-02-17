<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('surat_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained()->onDelete('cascade');
            $table->foreignId('pengirim_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('penerima_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('dikirim'); 
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('surat_users');
    }
};
