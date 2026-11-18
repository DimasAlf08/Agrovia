<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class KegiatanOperasional extends Model {
    protected $table = 'kegiatan_operasional';
    protected $fillable = ['jenis', 'tanggal', 'lahan_id', 'pekerja_id'];
    protected $casts = ['tanggal' => 'date'];
    public function lahan()   { return $this->belongsTo(Lahan::class); }
    public function pekerja() { return $this->belongsTo(Pekerja::class); }
}