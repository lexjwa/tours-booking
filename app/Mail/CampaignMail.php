<?php

namespace App\Mail;

use App\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $uniqueNumber;
    public function __construct($data, $uniqueNumber)
    {
        $this->data=$data;
        $this->uniqueNumber=$uniqueNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = 'run-campaign';
        $email_patterns = array(
            'content' =>$this->data['detail'],
            'unsubscribe' => $this->uniqueNumber,
        );
        $finilizedEmail = EmailTemplates::replaceEmailVariables($template, $email_patterns);
        return $this->from(env('MAIL_USERNAME'))
            ->subject($finilizedEmail['subject'])
            ->view('mail.campaign')
            ->with('content', $finilizedEmail['content']);
    }
}
