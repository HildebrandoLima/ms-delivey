<?php

namespace App\Jobs;

use App\Mail\EmailForRegister;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class EmailForRegisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $email;
    private int $id;
    private string $entity;

    public function __construct(string $email, int $id, string $entity)
    {
        $this->email = $email;
        $this->id = $id;
        $this->entity = $entity;
    }

    public function handle(): void
    {
        try {
            Mail::to($this->email)->send(new EmailForRegister($this->id, $this->entity));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
