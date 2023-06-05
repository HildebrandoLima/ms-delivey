<?php

namespace App\Jobs;

use App\Mail\EmailForgotPassword;
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
    private string $codigo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $email, string $codigo)
    {
        $this->email = $email;
        $this->codigo = $codigo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $url = env('URL_FRONT_FORGOT_PASSWORD');
            Mail::to($this->email)->send(new EmailForgotPassword($this->codigo, $url));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
