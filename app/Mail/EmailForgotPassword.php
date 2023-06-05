<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    private string $codigo;
    private string $url;

    public function __construct(string $codigo, string $url)
    {
        $this->codigo = $codigo;
        $this->url = $url;
    }

    public function build()
    {
        return $this
            ->from('delivery@gmail.com', 'Delivey')
            ->subject('DELIVERY')
            ->view('mails.forgotPassword',
             ['codigo' => $this->codigo, 'url' => $this->url]);
    }
}
