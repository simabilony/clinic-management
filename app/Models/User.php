<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $fillable = [
        'name', 'phone_number', 'password', 'age', 'gender', 'address',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
