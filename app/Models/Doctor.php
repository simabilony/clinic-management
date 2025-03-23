<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Doctor extends Model
{
    protected $fillable = [
        'user_id', 'specialization_id', 'bio', 'cost', 'experience',
        'work_days', 'start_time', 'end_time', 'instagram', 'whatsapp', 'facebook',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
