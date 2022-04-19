<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleApat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function apar()
    {
        return $this->belongsTo(Apat::class,'kode_apat','kode');
    }

    public function apat()
    {
        return $this->belongsTo(Apat::class,'kode_apat','kode');
    }
}