<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AppointmentResult extends Model
{
    protected $fillable = ['appointment_id', 'drugs', 'medical_tests', 'medical_images'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
