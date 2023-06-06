<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    private array $data;
    private string $url;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this
            ->from('delivery@gmail.com', 'Delivey')
            ->subject('DELIVERY')
            ->view('mails.forgotPassword', [
                'codigo' => $this->data['codigo'],
                'url' => $this->url = env('URL_FRONT_FORGOT_PASSWORD') . '/' . $this->data['token']
            ]);
    }
}
