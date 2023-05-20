<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForRegister extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build()
    {
        return $this
            ->from('delivery@gmail.com', 'Delivey')
            ->subject('DELIVERY')
            ->view('mails.welcomeToRegister');
    }
}
