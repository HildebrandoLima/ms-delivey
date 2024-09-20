<?php

namespace App\Jobs;

use App\Data\Repositories\User\Concretes\ListFindByIdUserRepository;
use App\Mail\EmailCreateOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class EmailCreateOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $order;
    private array $items;
    private ListFindByIdUserRepository $listFindByIdUserRepository;

    public function __construct(array $order, array $items)
    {
        $this->order = $order;
        $this->items = $items;
    }

    public function handle(): void
    {
        try {
            $userEmail = new ListFindByIdUserRepository();
            $email = $userEmail->listFindById($this->order['usuario_id'], true)->first()->email;
            if (!is_null($email)) {
                Mail::to($email)->send(new EmailCreateOrder($this->order, $this->items));
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
