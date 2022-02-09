<?php

namespace App\Mail;

use App\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = 'new-admin-user';
        $email_patterns = [
            'first_name' => $this->data[0]->first_name,
            'last_name' => $this->data[0]->last_name,
            'email' => $this->data[0]->email,
            'password' => $this->data[1],
        ];

        $finilizedEmail = EmailTemplates::replaceEmailVariables($template, $email_patterns);

        return $this->from(env('MAIL_USERNAME'))
            ->subject($finilizedEmail['subject'])
            ->view('mail.invitation')
            ->with('content', $finilizedEmail['content']);

        //return $this->from(env('MAIL_USERNAME'))->view('mail.invitation');
    }
}
