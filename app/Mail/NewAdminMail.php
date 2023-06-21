<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $created_by = '';
    protected $email = '';
    protected $password = '';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($creator_name, $admin_email, $admin_password)
    {
        $this->created_by = $creator_name;
        $this->email = $admin_email;
        $this->password = $admin_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.newadminmail', [
            'created_by' =>$this->created_by,
            'email' =>$this->email,
            'password' =>$this->password,
        ]);
    }
}
