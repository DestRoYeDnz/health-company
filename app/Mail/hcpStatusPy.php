<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class hcpStatusPy extends Mailable
{
    use Queueable, SerializesModels;
    public function build()
    {
        return $this->view('mail.newpy')
            ->from('hello@health-company.com', 'Health Company')
            ->subject('Hello & Welcome!')
            ->replyTo('no-reply@health-company.com', 'Health Company');
    }
}
