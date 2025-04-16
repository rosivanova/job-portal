<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;

class FactorEmail extends Mailable

{

    use Queueable, SerializesModels;

    /**
     * The verification URL.
     *
     * @var string
     */
    protected $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @param string $verificationUrl
     * @return void
     */
    public function __construct($verificationUrl)
    {
        $this->verificationUrl = $verificationUrl;
    }

    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->view('emails.mfa', ['url' => $this->verificationUrl]);

    }

}