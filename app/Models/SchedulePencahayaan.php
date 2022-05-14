<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulePencahayaan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pencahayaan()
    {
        return $this->belongsTo(Pencahayaan::class, 'kode_pencahayaan', 'kode');
    }
}
