<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    public $detail;
    public $email = "";
    public $surname = "";
    public $first = "";
    public $middle = "";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail,$first, $middle, $sur)
    {
        $this->details = $detail;
        $this->first = $first;
        $this->middle= $middle;
        $this->surname = $sur;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $surname = $this->surname;
        $first = $this->first;
        $middle = $this->middle;
        return $this->subject('Confirmation email from APT')->view('mail.mail')->with('surname', 'first', 'middle');
    }
}
