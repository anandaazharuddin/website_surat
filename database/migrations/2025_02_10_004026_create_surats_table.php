<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kepada')->constrained('users')->onDelete('cascade');
            $table->foreignId('pengirim')->constrained('users')->onDelete('cascade');
            $table->foreignId('pemeriksa')->constrained('users')->onDelete('cascade');
            $table->json('tembusan')->nullable();
            $table->string('perihal');
            $table->text('isi_surat');
            $table->string('file_attachment')->nullable();
            $table->enum('status', ['draft', 'terkirim'])->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surats');
    }
};

