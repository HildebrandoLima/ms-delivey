<?php

namespace App\Jobs;

use App\Data\Repositories\User\Concretes\ListFindByIdUserRepository;
use App\Mail\EmailCreateOrder;
use App\Models\User;
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
    private User $user;
    private ListFindByIdUserRepository $listFindByIdUserRepository;
    private array $order = [];
    private array $items = [];

    public function __construct(array $order, array $items)
    {
        $this->order = $order;
        $this->items = $items;
    }

    public function handle(): void
    {
        try {
            $this->instantiate();
            $this->getUser();
            $this->sendEmail();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function instantiate(): void
    {
        $this->listFindByIdUserRepository = new ListFindByIdUserRepository();
    }

    private function getUser(): void
    {
        $this->user = $this->listFindByIdUserRepository->listFindById($this->order['usuario_id'], true)->first();
    }

    private function sendEmail(): void
    {
        if ($this->user) {
            Mail::to($this->user->email)
            ->send(new EmailCreateOrder($this->order, $this->items));
        }
    }
}
