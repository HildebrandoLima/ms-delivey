<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForRegister extends Mailable
{
    use Queueable, SerializesModels;
    private int $id;
    private string $entity;
    private string $url;

    public function __construct(int $id, string $entity)
    {
        $this->id = $id;
        $this->entity = $entity;
    }

    public function build()
    {
        return $this
        ->from('delivery@gmail.com', 'Delivey')
        ->subject('DELIVERY')
        ->view('mails.welcomeToRegister', ['url' => $this->hostMailConfirm()]);
    }

    private function hostMailConfirm()
    {
        if ($this->entity == 'user'):
            $this->url = route('email.verified', ['entity' => 'user', 'id' => base64_encode($this->id), 'active' => 1]);
        else:
            $this->url = route('email.verified', ['entity' => 'povider', 'id' => base64_encode($this->id), 'active' => 1]);
        endif;
        return $this->url;
    }
}
