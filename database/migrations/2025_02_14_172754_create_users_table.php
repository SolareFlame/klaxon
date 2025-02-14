<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('pp')->nullable();
            $table->string('pass');
            $table->integer('perm_level')->default(0);
            $table->string('icetoken')->unique();
            $table->boolean('is_listening')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
