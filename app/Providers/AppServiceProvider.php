<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Email')
                ->line('Klik tombol di bawah ini untuk melakukan verifikasi email anda')
                ->action('Verifikasi Email', $url);
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Reset Password')
                ->line('Anda menerima email ini karena kami menerima permintaan pengaturan ulang kata sandi untuk akun Anda.')
                ->action('Reset Password', $url)
                ->line('Tautan pengaturan ulang kata sandi ini akan kedaluwarsa dalam 60 menit.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')])
                ->line('Jika Anda tidak meminta pengaturan ulang kata sandi, tidak ada tindakan lebih lanjut yang diperlukan.');
        });
    }
}
