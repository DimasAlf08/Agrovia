<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hasil_panen', function (Blueprint $t) {
            $t->id();
            $t->date('tanggal');
            $t->double('berat');
            $t->foreignId('lahan_id')->constrained('lahan')->cascadeOnDelete();
            $t->foreignId('pekerja_id')->nullable()->constrained('pekerja')->nullOnDelete();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('hasil_panen'); }
};