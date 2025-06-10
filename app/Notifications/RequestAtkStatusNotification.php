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
            ->greeting('Halo ' . $notifiable->nama . ',')
            ->line('Permohonan ATK Anda telah ' . $statusText . '.')
            ->line('Berikut detail permohonan Anda:')
            ->line('• Kode ATK : ' . $this->requestAtk->masterAtk->kode_atk)
            ->line('• Nama ATK : ' . $this->requestAtk->masterAtk->nama_atk)
            ->line('• Jumlah : ' . $this->requestAtk->jumlah_request)
            ->line('• Status : ' . ucfirst($this->status))
            ->action('Lihat Status Permohonan ATK Anda', url('/login')) // arahkan ke sistem login
            ->line('Silakan login untuk melihat detail lebih lengkap.');
    }
}
