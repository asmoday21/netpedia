<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class PasswordSiswaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $siswa;
    public $password;

    public function __construct(User $siswa, $password)
    {
        $this->siswa = $siswa;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Akun Belajar Anda')
                    ->view('emails.password_siswa');
    }
}

