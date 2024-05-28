<?php

namespace App\Jobs;

use App\Mail\AcceptRegisterMail;
use App\Services\AllServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pesan;
    protected $email;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $pesan)
    {
        $this->pesan = $pesan;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new AcceptRegisterMail($this->pesan));

    }
}
