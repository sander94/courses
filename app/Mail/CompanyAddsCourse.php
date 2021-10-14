<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Request;

class CompanyAddsCourse extends Mailable
{
    use Queueable, SerializesModels;

    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company)
    {
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $r)
    {

        $title = request()->title;
        return $this->from('info@koolitused.ee')->subject('Uus koolitus - '.$title)
            ->view('emails.companyAddsCourse');
    }
}
