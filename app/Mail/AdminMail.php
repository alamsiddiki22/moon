<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $info = "";
    public function __construct($information)
    {
        $this->info = $information;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->subject('tadang tadand')->view('email.Contactmessage', [
            return $this->subject('tadang tadand')->markdown('email.Contactmessage', [
                'info' => $this->info

            ]);
    }
}
