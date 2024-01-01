<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Schedule extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'subject_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'kode_absensi',
    ];
}
