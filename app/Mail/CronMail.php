<?php

namespace App\Mail;

use App\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CronMail extends Mailable
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

       // dd($this->data);
        $template = 'partial-payments-cron-email';
        $email_patterns = [
            'first_name' => $this->data->first_name,
            'last_name' => $this->data->last_name,
            'event_title' => $this->data->event_title,
            'due_amount' => $this->data->due_amount,
            'total_payable' => $this->data->total_payable,
            'payed_amount' => $this->data->payed_amount,
            'unique_number' => $this->data->email,
        ];
        $finilizedEmail = EmailTemplates::replaceEmailVariables($template, $email_patterns);

        // dd($finilizedEmail);
        return $this->from(env('MAIL_USERNAME'))
            ->subject($finilizedEmail['subject'])
            ->view('mail.cron')
            ->with('content', $finilizedEmail['content']);

        //dd($email_patterns);
       // return $this->from(env('MAIL_USERNAME'))->subject('Payment Reminder Email')->view('mail.cron');
    }
}
