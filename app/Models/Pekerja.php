<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model {
    protected $table = 'pekerja';
    protected $fillable = ['nama', 'jabatan', 'telp'];
    public function hasilPanen() { return $this->hasMany(HasilPanen::class); }
}