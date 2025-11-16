<?php

namespace App\Notifications;

use App\Models\Complaint;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ComplaintStatusNotification extends Notification
{
    protected $complaint;

    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Mengirim melalui database dan email
    }

    public function toDatabase($notifiable)
    {
        return [
            'complaint_id' => $this->complaint->id,
            'status' => $this->complaint->status,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Status komplain Anda telah diperbarui.')
                    ->action('Lihat Komplain', route('dashboard.complaints.show', $this->complaint->id));
    }
}
