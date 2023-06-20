<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForRegister extends Mailable
{
    use Queueable, SerializesModels;
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function build()
    {
        return $this
        ->from('delivery@gmail.com', 'Delivey')
        ->subject('DELIVERY')
        ->view('mails.welcomeToRegister', ['url' => route('user.email.verified', ['id' => base64_encode($this->id), 'active' => 1])]);
    }
}
