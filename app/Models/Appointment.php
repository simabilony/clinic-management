<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Appointment extends Model
{
    protected $fillable = ['user_id', 'doctor_id', 'date', 'time', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function result()
    {
        return $this->hasOne(AppointmentResult::class);
    }
}
