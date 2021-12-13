<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantRegister extends Mailable
{
    use Queueable, SerializesModels;
    public $detail;
    public $email = "";
    public $landlordSurname ="";
    public $first = "";
    public $middle = "";
    public $date = "";
    public $monthly = 0.00;
    public $room_number = 0;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail,$first, $landlordSur, $rent_date, $monthly, $room_num)
    {
        $this->first=$first;
        $this->details = $detail;
        $this->landlordSurname = $landlordSur;
        $this->date= $rent_date;
        $this->monthly= $monthly;
        $this->room_number = $room_num;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $first = $this->first;
        $landlordSurname =   $this->landlordSurname;
        $date = $this->date;
        $monthly = $this->monthly;
        $room_num = $this->room_number;
        return $this->subject('Confirmation Email')->markdown('email.tenant-register')->with( compact('first', 'landlordSurname', 'date', 'monthly', 'room_num'));
    }
}
