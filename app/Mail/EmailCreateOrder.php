<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailCreateOrder extends Mailable
{
    use Queueable, SerializesModels;

    private array $order;
    private array $items;

    public function __construct(array $order, array $items)
    {
        $this->order = $order;
        $this->items = $items;
    }

    public function build()
    {
        return $this
            ->from('delivery@gmail.com', 'Delivey')
            ->subject('DELIVERY')
            ->view('mails.createOrder', [
                'order' => $this->order,
                'items' => $this->items
            ]);
    }
}
