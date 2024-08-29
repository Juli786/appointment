<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'appointments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
       
    ];

    protected $fillable = [
        'name',
        'slot',
        'duration',
        'duration_type',
        'service',
        'available_hr',
        'comments',
        'updated_at',
        'deleted_at',
    ];

  

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
