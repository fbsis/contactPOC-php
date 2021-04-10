<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Configs;

class DeleteEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Storage contact details
     *
     * @return contacts store the contacts itself
     */

    private $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->details = $contact;
        $email = Configs::getByKey("onDeletecontacts")->value;
        $this->to($email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.DeleteEmail', $this->details->attributesToArray());
    }
}
