<?php

namespace App\Console\Commands;

use App\Mail\CronMail;
use App\PaymentReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class weekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'weekly cron';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $user = DB::table('users')
            ->select('payment_reminders.start_date as reminder_start_date','payment_reminders.end_date as reminder_end_date','users.unique_number','bookings.id as booking_id','users.first_name', 'bookings.transaction_type as payment_status','events.start_date as start_date', 'events.title as event_title' ,'bookings.remaining_amount as due_amount','bookings.total_payment_of_event as total_payable','first_name','last_name','country','address','phone_number','email','payed_amount')
            ->join('bookings','bookings.user_id','=','users.id')
            ->join('events','events.id','=','bookings.event_id')
            ->join('payment_reminders','events.id','=','payment_reminders.event_id')
            ->where('bookings.transaction_type', '=','incomplete')
            ->where('events.start_date','>',Carbon::now())
            ->where('bookings.payed_amount','>',0)
            ->where('users.reminder_status','=',1)
            ->where('events.payment_type','=',"partial")
            ->where('payment_reminders.weekly','=',1)

            ->orderBy('bookings.id','desc')->get();
        foreach ($user as $value){
            //   dd($value->reminder_start_date,$value->reminder_end_date,Carbon::now());
            if(Carbon::parse($value->reminder_start_date) >= Carbon::now() && Carbon::now()>=Carbon::parse($value->reminder_end_date) ) {
                Mail::to($value->email)->send(new CronMail($value));
            }

        }


    }
}
