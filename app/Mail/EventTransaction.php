<?php

namespace App\Mail;

use App\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventTransaction extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public $booking;

    public $event;

    public function __construct($data, $booking, $event)
    {
        $this->data = $data;
        $this->booking = $booking;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = 'payment-invoice';
        $email_patterns = [
            'first_name' => $this->data['first_name'],
            'last_name' => $this->data['last_name'],
            'tour_name' => $this->event['title'],
            'event_description' => $this->event['description'],
            'due_amount' => $this->booking['remaining_amount'],
            'total_payable' => $this->booking['total_payment_of_event'],
            'payed_amount' => $this->booking['payed_amount'],
            'booking_reference' => $this->booking['booking_code'],
        ];

        $finilizedEmail = EmailTemplates::replaceEmailVariables($template, $email_patterns);

        return $this->from(env('MAIL_USERNAME'))
            ->subject($finilizedEmail['subject'])
            ->view('mail.transaction')
            ->with('content', $finilizedEmail['content']);
    }
}
