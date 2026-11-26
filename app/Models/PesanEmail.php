<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanEmail extends Model
{
    use HasFactory;

    protected $table = 'pesan_emails';

    protected $fillable = [
        'pengirim_id',
        'penerima_id',
        'email_tujuan',
        'subjek',
        'isi',
        'status_smtp',
        'dibaca_pada',
    ];

    protected $casts = [
        'dibaca_pada' => 'datetime',
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
