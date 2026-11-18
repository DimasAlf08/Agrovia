<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HasilPanen extends Model {
    protected $table = 'hasil_panen';
    protected $fillable = ['tanggal', 'berat', 'lahan_id', 'pekerja_id'];
    protected $casts = ['tanggal' => 'date'];
    public function lahan()   { return $this->belongsTo(Lahan::class); }
    public function pekerja() { return $this->belongsTo(Pekerja::class); }
}