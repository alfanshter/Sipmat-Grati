<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleHydrant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function hydrant()
    {
        return $this->belongsTo(Hydrant::class,'kode_hydrant','kode');
    }
}