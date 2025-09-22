<?php

namespace App\Jobs;

use App\Mail\VerifyEmailMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendVerificationEmail implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {   
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //Khởi tạo 1 URL tạm thời
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $this->user->id,
                'hash' => sha1($this->user->email),
            ]
        );

        // Gửi mail
        Mail::to($this->user->email)->send(new VerifyEmailMail($verificationUrl));
        // $this->user->sendEmailVerificationNotification();
    }
}
