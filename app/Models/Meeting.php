<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    public $table = 'meetings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
       
    ];

    protected $fillable = [
        'name',
        'email',
        'timezone',
        'duration',
        'start_time',
        'finish_time',
        'appointment_id',
        'comments',
    ];
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
