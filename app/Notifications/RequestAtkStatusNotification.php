<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestAtkStatusNotification extends Notification
{
    use Queueable;

    protected $requestAtk;
    protected $status;

    public function __construct($requestAtk, $status)
    {
        $this->requestAtk = $requestAtk;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $statusText = $this->status === 'approved' ? 'disetujui' : 'ditolak';

        return (new MailMessage)
            ->subject('Status Permohonan ATK Anda : ' . ucfirst($statusText))
            ->markdown('emails.request_atk_status', [
                'requestAtk' => $this->requestAtk,
                'statusText' => $statusText,
            ]);
    }
}
