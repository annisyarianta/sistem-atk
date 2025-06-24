@component('mail::message')
# Halo {{ $requestAtk->user->nama }},

Permohonan ATK Anda telah **{{ $statusText }}**.

Berikut detail permohonan Anda:

@component('mail::table')
| Kode ATK | Nama ATK | Jumlah | Status |
|----------|----------|--------|--------|
| {{ $requestAtk->masterAtk->kode_atk }} | {{ $requestAtk->masterAtk->nama_atk }} | {{ $requestAtk->jumlah_request }} | {{ ucfirst($statusText) }} |
@endcomponent

@component('mail::button', ['url' => url('/login')])
Lihat Status Permohonan ATK Anda
@endcomponent

Silakan login untuk melihat detail lebih lengkap.

Salam Hormat,  
ATKPuraTrack
@endcomponent
