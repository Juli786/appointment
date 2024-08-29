<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSlot extends Model
{
    use HasFactory;
    
    public $table = 'appointment_slots';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
       
    ];

    protected $fillable = [
        'appointment_id',
        'start_time',
        'is_book',
        'updated_at',
        'deleted_at',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
