<?php
/**
 * Created by PhpStorm.
 * User: arslan
 * Date: 6/10/19
 * Time: 11:51 PM
 */

namespace App\Services\v1;


use App\Booking;
use App\Contracts\v1\EventInterface;
use App\Event;
use App\Mail\EventTransaction;
use App\PaymentReminder;
use App\ProductImages;
use App\Settings;
use App\TransactionHistory;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use File;

class EventService implements EventInterface
{
    public function createEvent($data)
    {
        // TODO: Implement createEvent() method.

        $event  =   new Event();
        $event->title   = $data['title'];
        $event->cost    = $data['cost'];
        $event->description =   $data['description'];
        $event->start_date  =   $data['start_date'];
        $event->end_date  =   $data['end_date'];
        $event->minimum_amount  =   $data['minimum_amount'];
        $event->number_of_days  =   $data['number_of_days'];
        $event->number_of_days  =   $data['number_of_days'];
        $event->start_time  =   $data['start_time'];
        $event->end_time  =   $data['end_time'];
        $event->payment_type  =   $data['payment_type'];
        $event->save();

        $newReminder =new PaymentReminder();
        $newReminder->day_after_day  = $data['day_after_day'];
        $newReminder->weekly  = $data['weekly'];
        $newReminder->monthly  = $data['monthly'];
        $newReminder->start_date  = $data['start_date_for_day'];
        $newReminder->end_date  = $data['end_date_for_day'];
        $newReminder->event_id  = $event->id;



      return  $newReminder->save() ? [$newReminder,$event] : false;

    }
    public function getEvent()
    {
        // TODO: Implement getEvent() method.
        $event  =   Event::where('start_date','>',Carbon::now())->get();
        return $event ? $event : false;
    }
    public function paidParticipantEvent()
    {
        // TODO: Implement paidParticipantEvent() method.
        $event  =   Event::get();
        return $event ? $event : false;
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function bookEvent($data)
    {
        // TODO: Implement bookEvent() method.
        $response=[];
        $participant    =   User::where('email',$data['email'])->first();

        if(!$participant){
            $create  =   new User();
            $create->email = $data['email'];
            $create->first_name  =   null;
            $create->last_name   = null;
            $create->country   = null;
            $create->address   = null;
            $create->phone_number   = null;
            $create->title   = null;
            $create->unique_number  =   $this->generateRandomString(7);
            $create->authority   = 'participant';
            $create->password   = null;
            $create->save();
            $event   =   Event::where('id',$data['event'])->first();
            $booking =   new Booking();
            $booking->event_id   =   $data['event'];
            $booking->total_payment_of_event = $event->cost;
            $booking->remaining_amount   = $event->cost;
            $booking->payed_amount   =   0;
            $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $res = "";
            for ($i = 0; $i < 6; $i++) {
                $res .= $chars[mt_rand(0, strlen($chars) - 1)];
            }
            $booking->booking_code  =   $res;
            $booking->transaction_type   =   'incomplete';
            $booking->user_id   =   $create->id;
            $booking->save();

            return $response=[
                'user_id'=>$create->id,
                'event_id'=>$data['event'],
                'total_amount'=>$event->cost,
                'event_info'=>$event,
                'payment_type'=>$event->payment_type,
                'booking'=>$booking
            ];

        }else{
            $event   =   Event::where('id',$data['event'])->first();

            $booking    =   Booking::where('event_id',$data['event'])
                                    ->where('user_id',$participant->id)
                                    ->count();
            if($booking>0){
                $booking    =   Booking::where('event_id',$data['event'])
                    ->where('user_id',$participant->id)
                    ->first();

           return $response=[
               'user_id'=>$participant->id,
               'event_id'=>$data['event'],
               'total_amount'=>$event->cost,
               'event_info'=>$event,
               'booking'=>$booking,
               'participant'=>$participant
           ];
            }else{
                $event   =   Event::where('id',$data['event'])->first();
                $newBooking =   new Booking();

                $newBooking->event_id   =   $data['event'];
                $newBooking->total_payment_of_event = $event->cost;
                $newBooking->remaining_amount   = $event->cost;
                $newBooking->payed_amount   =   0;
                $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $res = "";
                for ($i = 0; $i < 6; $i++) {
                    $res .= $chars[mt_rand(0, strlen($chars) - 1)];
                }
                $newBooking->booking_code  =   $res;
                $newBooking->transaction_type   =   'incomplete';
                $newBooking->user_id   =   $participant->id;
                $newBooking->save();
                $newCreatedBooking  =   Booking::where('id',$newBooking->id)->first();

                return $response=[
                    'user_id'=>$participant->id,
                    'event_id'=>$data['event'],
                    'total_amount'=>$event->cost,
                    'event_info'=>$event,
                    'booking'=>$newCreatedBooking,
                    'participant'=>$participant
                ];

            }
        }

    }



    public function incompleteTransaction()
    {
        // TODO: Implement incompleteTransaction() method.
        return $user = DB::table('users')
            ->select('users.id as user_id','bookings.event_id as event_id','bookings.id as booking_id', 'events.title as event_title' ,'bookings.remaining_amount as due_amount','bookings.total_payment_of_event as total_payable','first_name','last_name','country','address','phone_number','email','payed_amount')
            ->join('bookings','bookings.user_id','=','users.id')
            ->join('events','events.id','=','bookings.event_id')
            ->where('bookings.payed_amount', '=',0)
            ->where('users.status', '=',1)
            ->where('bookings.deleted_at', '=',null)
            ->orderBy('bookings.id','desc')->get();
    }

    public function deleteIncompleteTransection($id)
    {
        // TODO: Implement deleteIncompleteTransection() method.
        $delBooking = Booking::where('id', $id)->delete();
        return $delBooking ? $delBooking : false ;

    }




    public function saveTransaction($data)
    {
        // TODO: Implement saveTransaction() method.
        $event=Event::where('id',$data['event'])->first();
        $transactionHistory = new TransactionHistory();
        $transactionHistory->transaction_amount=$data['transaction_amount'];
        $transactionHistory->event_id=$data['event'];
        $transactionHistory->user_id=$data['user_id'];
        $transactionHistory->save();
         $booking    =   Booking::where(['event_id'=>$data['event'],'user_id'=>$data['user_id']])->first();
        $booking->payed_amount=$booking->payed_amount+$data['transaction_amount'];
        $booking->remaining_amount=$booking->total_payment_of_event-$booking->payed_amount;
        $booking->total_payment_of_event = $booking->total_payment_of_event;
        $booking->booking_code = $booking->booking_code;
        if($booking->total_payment_of_event-$booking->payed_amount>0){
            $booking->transaction_type='incomplete';

        }else{
           $booking->transaction_type='complete';

        }
        $booking->save();
        $participant    = User::where('id',$data['user_id'])->first();
        $participant->first_name    =   $data['first_name'];
        $participant->last_name     =   $data['last_name'];
        $participant->country       =   $data['country'];
        $participant->address       =   $data['address'];
        $participant->phone_number  =   $data['phone_number'];
        $participant->title         =   $data['title'];
        $participant->save();
        $newBooking    =   Booking::where(['event_id'=>$data['event'],'user_id'=>$data['user_id']])->first();

        Mail::to($participant->email)
            ->bcc(['sikandarhayatbajwa@gmail.com'])
            ->send(new EventTransaction($data,$booking,$event));
        return $booking->save() ? ['transaction'=>$booking,'event'=>$event] : false;

    }

    public function archived(){
        return $archivedEvents=Event::where('start_date','<',Carbon::now())->get();
    }
    public function payedParticipant($data)
    {
        // TODO: Implement payedParticipant() method.

        $to=$data['end_date'];
        $from=$data['start_date']
        $from_time=$data['start_time'];
        $to_time=$data['end_time'];
        $event=$data['event'];
        $cost=$data['cost'];
        $country=$data['country'];
        return $user = DB::table('users')
            ->select(DB::raw('sum(bookings.payed_amount) as total_received_amount'),
                'events.start_date','events.end_date','events.start_time','events.end_time','bookings.comment as comment','events.id as event_id','users.id as user_id','bookings.id as booking_id', 'events.title as event_title' ,'bookings.remaining_amount as due_amount', 'bookings.created_at as created_at' ,'bookings.total_payment_of_event as total_payable','first_name','last_name','country','address','phone_number','email','payed_amount')
            ->join('bookings','bookings.user_id','=','users.id')
            ->join('events','events.id','=','bookings.event_id')
            ->where('bookings.deleted_at', '=',null)
            ->when($to AND $from, function ($q) use ($to, $from) {
                $q->whereDate('events.start_date', '>=', $from);
                $q->whereDate('events.end_date', '<=', $to);
            })
            ->when($to_time AND $from_time, function ($q) use ($to_time, $from_time) {
                $q->whereTime('events.start_time', '>=', $from_time);
                $q->whereTime('events.end_time', '<=', $to_time);
            })
            ->when($event,function($q) use($event){
                $q->where('event_id',$event);
            })
            ->when($country,function($q) use($country){
                $q->where('country', 'like', '%' . $country . '%');
            })
            ->when($data['cost'],function($q) use($cost){
              $q->where('cost',$cost);
           })
            ->where('bookings.payed_amount','>',0)

            ->orderBy('bookings.id','desc')->groupBy('bookings.id')->get();

    }
    public function searchEvent($data)
    {
        // TODO: Implement searchEvent() method.
        return $user = DB::table('users')
            ->select('bookings.id as booking_id', 'events.title as event_title' ,'bookings.remaining_amount as due_amount','bookings.total_payment_of_event as total_payable','first_name','last_name','country','address','phone_number','email','payed_amount')
            ->join('bookings','bookings.user_id','=','users.id')
            ->join('events','events.id','=','bookings.event_id')
            ->where('bookings.booking_code', '=',$data['booking_code'])->get();

    }
    public function deleteEvent($data)
    {
        // TODO: Implement deleteEvent() method.
         $checkBokking   =   Booking::where('event_id',$data['event'])->count();
         if($checkBokking){
             return false;
         }else{
             $event = Event::where('id',$data['event'])->delete();
             return $event ? $event : false ;
         }

    }
    public function getStats()
    {
        // TODO: Implement getStats() method.
       $result= DB::table('bookings')
           ->select(
               DB::raw("sum(case when  bookings.transaction_type='incomplete' AND bookings.payed_amount>0 then 1 else 0 end ) as partial"),
               DB::raw("sum(case when bookings.payed_amount=0 then 1 else 0 end ) as incomplete"),
               DB::raw("sum(case when bookings.transaction_type='complete' then 1 else 0 end ) as complete")

           )
            ->join('events','events.id','=','bookings.event_id')
            ->where('events.start_date','>',Carbon::now())
            ->first();
         $event=Event::where('start_date','>',Carbon::now())->count();
         $totalamount=DB::table('bookings')->select(DB::raw('sum(payed_amount) as total_cost'))->first();
         $archivedevent=Event::where('start_date','<',Carbon::now())->count();
         $unsaubscribe=User::where('reminder_status',0)->count();
         return array('payments'=>$result,'event'=>$event,'archived_event'=>$archivedevent,'un_subscribed'=>$unsaubscribe,'total'=>$totalamount);

    }
    public function getHistory($data)
    {
        // TODO: Implement getHistory() method.
        $result =   [] ;
         $history    =   DB::table('transaction_histories')
            ->select('transaction_histories.*','events.title as title')
            ->join('events','events.id','=','transaction_histories.event_id')
            ->where('transaction_histories.user_id',$data['user_id'])
            ->where('transaction_histories.event_id',$data['event_id'])->get();
         $booking   =   DB::table('bookings')->where(['event_id'=>$data['event_id'],'user_id'=>$data['user_id']])->first();

         //dd($booking);
         return $result=['history'=>$history,'booking'=>$booking];
    }
    public function showEvent($id)
    {
        // TODO: Implement showEvent() method.
       return $event  =   DB::table('events')
            ->select('events.*','payment_reminders.day_after_day','payment_reminders.weekly','payment_reminders.monthly' , 'payment_reminders.start_date as reminders_s_d' , 'payment_reminders.end_date as reminders_e_d')
            ->join('payment_reminders','payment_reminders.event_id','=','events.id')
            ->where('events.id',$id)
            ->first();
    }
    public function editEvent($id, $data)
    {
        // TODO: Implement editEvent() method.
        $event=Event::where('id',$id)->first();
        $event->title   = $data['title'];
        $event->cost    = $data['cost'];
        $event->description =   $data['description'];
        $event->start_date  =   $data['start_date'];
        $event->end_date  =   $data['end_date'];
        $event->minimum_amount  =   $data['minimum_amount'];
        $event->number_of_days  =   $data['number_of_days'];
        $event->number_of_days  =   $data['number_of_days'];
        $event->start_time  =   $data['start_time'];
        $event->end_time  =   $data['end_time'];
        $event->payment_type  =   $data['payment_type'];
        $event->save();

        $newReminder =PaymentReminder::where('id',$id)->first();
        $newReminder->day_after_day  = $data['day_after_day'];
        $newReminder->weekly  = $data['weekly'];
        $newReminder->monthly  = $data['monthly'];
        $newReminder->start_date  = $data['start_date_for_day'];
        $newReminder->end_date  = $data['end_date_for_day'];
        $newReminder->event_id  = $event->id;

        return  $newReminder->save() ? [$newReminder,$event] : false;
    }
    public function addPayment($data)
    {
        // TODO: Implement addPayment() method.
        $booking    =   Booking::where(['user_id'=>$data['user_id'],'event_id'=>$data['event_id']])->first();
        $booking->remaining_amount=$booking->remaining_amount-$data['amount'];
        $booking->payed_amount=$booking->payed_amount+$data['amount'];
        $booking->transaction_type='complete';
        $paymentHistory =new TransactionHistory();
        $paymentHistory->user_id    = $data['user_id'];
        $paymentHistory->event_id   = $data['event_id'];
        $paymentHistory->transaction_amount =   $data['amount'];
        $paymentHistory->save();
        return $booking->save() ? $booking : false;
    }
    public function activeEvent()
    {
        // TODO: Implement activeEvent() method.
        $event= DB::table('events')
            ->leftJoin('bookings','bookings.event_id','=','events.id')
            ->where('events.start_date','>',Carbon::now())
            ->select('events.*',DB::raw("SUM(bookings.payed_amount) as order_total"))
            ->groupBy('events.id')
            ->get();

        return $event ? $event : false;
    }
    public function activeArchive()
    {
        // TODO: Implement activeArchive() method.
        $event= DB::table('events')
            ->leftJoin('bookings','bookings.event_id','=','events.id')
            ->where('events.start_date','<',Carbon::now())
            ->select('events.*',DB::raw("SUM(bookings.payed_amount) as order_total"))
            ->groupBy('events.id')
            ->get();
        return $event ? $event : false;
    }
    public function saveComment($data)
    {
        // TODO: Implement saveComment() method.
        $booking    =   Booking::where('id',$data['id'])->first();
        $booking->comment=$data['comment'];
        return $booking->save() ? $booking : false;
    }
    public function unSelectedParticipant()
    {
        // TODO: Implement unSelectedParticipant() method.
        return $user=User::where(['reminder_status'=>'0','authority'=>'participant'])->get();
    }
    public function fileUpload($data)
    {
        // TODO: Implement fileUpload() method.
        $file=$data['photo'];
        $image = time() . '_' . str_random(6) . '_' . Auth::user()->id . '.' .$file ->getClientOriginalExtension();
        $destination_path = 'uploads/products';
        if (!File::exists($destination_path . '/' .  Auth::user()->id)) {
            File::makeDirectory($destination_path . '/' .  Auth::user()->id, 0777, true);
        }

        $data['photo']->move($destination_path . '/' .  Auth::user()->id, $image);
        $path = config('app.url')  . $destination_path . '/' . Auth::user()->id . '/' . $image;

        $user   =   User::where('id',Auth::user()->id)->first();
        $user->photo    =   $path;
       return $user->save() ? $user : false;

    }
    public function uploadLogo($data)
    {
        // TODO: Implement uploadLogo() method.
        $file=$data['photo'];
        $image = time() . '_' . str_random(6) . '_' . Auth::user()->id . '.' .$file ->getClientOriginalExtension();
        $destination_path = 'uploads/products';
        if (!File::exists($destination_path . '/' .  Auth::user()->id)) {
            File::makeDirectory($destination_path . '/' .  Auth::user()->id, 0777, true);
        }

        $data['photo']->move($destination_path . '/' .  Auth::user()->id, $image);
        $path = config('app.url')  . $destination_path . '/' . Auth::user()->id . '/' . $image;
        $setting=Settings::where('id',1)->first();
        $setting->logo  = $path;
        return $setting->save() ? $setting : false;

    }
    public function setting()
    {
        // TODO: Implement setting() method.
        return $setting=Settings::where('id',1)->first();
    }
    public function getunpaidParticipant()
    {
        // TODO: Implement getunpaidParticipant() method.
        return  DB::table('users')->select('users.id as user_id','users.*')
                    ->leftJoin('bookings','users.id','bookings.user_id')
                    ->where('bookings.id','=',null)->get();
    }
    public function deleteParticipant($id)
    {
        // TODO: Implement deleteParticipant() method.
        $user= User::where('id',$id)->delete();
        return true;
    }


}
