<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pekerja', function (Blueprint $t) {
            $t->id();
            $t->string('nama', 100);
            $t->string('jabatan', 50)->nullable();
            $t->string('telp', 15)->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pekerja'); }
};