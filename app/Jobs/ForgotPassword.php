<?php

namespace App\Jobs;

use App\Mail\EmailForgotPassword;
use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class ForgotPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function handle(): void
    {
        try {
            $data = PasswordReset::query()->where('email', $this->email)->first();
            Mail::to($this->email)->send(new EmailForgotPassword($data->toArray()));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
