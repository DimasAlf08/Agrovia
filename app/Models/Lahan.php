<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lahan extends Model {
    protected $table = 'lahan';
    protected $fillable = ['nama_lahan', 'luas', 'user_id'];
    public function user()       { return $this->belongsTo(User::class); }
    public function hasilPanen() { return $this->hasMany(HasilPanen::class); }
    public function kegiatan()   { return $this->hasMany(KegiatanOperasional::class); }
}