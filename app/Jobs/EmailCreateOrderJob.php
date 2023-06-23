<?php

namespace App\Jobs;

use App\Mail\EmailCreateOrder;
use App\Repositories\Concretes\UserRepository;
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
    private UserRepository $userRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $order, array $items)
    {
        $this->order = $order;
        $this->items = $items;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $userEmail = new UserRepository();
            $email = $userEmail->getOne($this->order['usuario_id'], '', 1)->toArray()['email'];
            Mail::to($email)->send(new EmailCreateOrder($this->order, $this->items));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
