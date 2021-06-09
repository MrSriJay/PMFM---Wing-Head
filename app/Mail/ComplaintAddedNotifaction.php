<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;
use App\Helper;

class ComplaintAddedNotifaction extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.complaintNotification')->from($address = 'pmfm.cdrd@gmail.com', $name = 'Center for Defence Research and Development | PMFM')
        ->subject(Lang::get('PMFM | Fault Reported' ));
    }
}
