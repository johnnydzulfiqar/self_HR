<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $fillable = [
        'user_id',
        'time_from',
        'time_to',
        'status',
        // 'bukti',
        // 'slug',

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
