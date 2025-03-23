<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AppointmentReminder extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // يمكنك إضافة قنوات أخرى مثل SMS
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Appointment Reminder')
            ->line('You have an appointment with Dr. ' . $this->appointment->doctor->user->name)
            ->line('Date: ' . $this->appointment->date)
            ->line('Time: ' . $this->appointment->time)
            ->action('View Appointment', url('/appointments/' . $this->appointment->id))
            ->line('Thank you for using our system!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'You have an appointment with Dr. ' . $this->appointment->doctor->user->name . ' on ' . $this->appointment->date . ' at ' . $this->appointment->time,
            'appointment_id' => $this->appointment->id,
        ];
    }

}
