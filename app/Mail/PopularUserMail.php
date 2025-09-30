<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class PopularUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $likesCount;

    public function __construct(User $user, $likesCount)
    {
        $this->user = $user;
        $this->likesCount = $likesCount;
    }

    public function build()
    {
        return $this->subject("Popular user alert: {$this->user->name}")
                    ->markdown('emails.popular_user');
    }
}