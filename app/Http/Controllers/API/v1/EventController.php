<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\v1\EventInterface;
use App\Http\Requests\addmanualpayment;
use App\Http\Requests\AddPayment;
use App\Http\Requests\BookingComment;
use App\Http\Requests\EventBookingRequest;
use App\Http\Requests\EventRequest;
use App\Mail\CronMail;
use App\PaymentReminder;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,EventInterface $event)
    {
        if($request->wantsJson()){
            $result =   $event->getEvent();
            if($result){
                return response()->json(['error'=>false,'message'=>'Event List','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>"Oops something went wrong"],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EventRequest $request,EventInterface $event)
    {

        if($request->wantsJson()){

            $result =$event->createEvent($request->all());
            if($result){

                return response()->json(['error'=>false,'message'=>'Event Created','data'=>$result],201);
            }else{

                return response()->json(['error'=>true,'message'=>"Oops something went wrong"],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventBookingRequest $request,EventInterface $event)
    {
        if($request->wantsJson()){
            $result =   $event->bookEvent($request->all());
            if($result){
               return response()->json(['error'=>true,'message'=>'event booking','data'=>$result],201);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],403);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id,EventInterface $event)
    {
        if($request->wantsJson()){
            $result =   $event->showEvent($id);
            if($result){
                return response()->json(['error'=>true,'message'=>'Event','data'=>$result],201);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],403);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EventRequest $request,$id,EventInterface $event)
    {
        if($request->wantsJson()){
            $result=    $event->editEvent($id,$request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Event Edit Successfully'],201);
            }else{
                return response()->json(['error'=>true,'message'=>'oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'check header'],406);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function archived(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result=    $event->archived();
            if($result){
                return response()->json(['error'=>false,'message'=>'archived events','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'check header'],406);
        }
    }
    public function saveTransaction(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->saveTransaction($request->all());
            if($result){
                return response()->json(['error'=>false,"message"=>'Transaction completed','data'=>$result],201);
            }else{
                return response()->json(['error'=>true,"message"=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'check header'],406);
        }
    }
    public function incomplete(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->incompleteTransaction();
            if($result){
                return response()->json(['error'=>false,'message'=>'Incomplete transaction','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    public function deleteIncompleteTransection(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->deleteIncompleteTransection($request->id);
            if($result){
                return response()->json(['error'=>false,'message'=>'Incomplete transaction has been deleted','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }


    public function payedParticipant(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result = $event->payedParticipant($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Paid Participant list','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function searchEvent(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->searchEvent($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Event result','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function deleteEvent(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->deleteEvent($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Event Deleted','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>"You can't delete this Event.Event has booking."],422);
            }

        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function test(){


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
    public function unSub(Request $request){
        $user=User::where('unique_number',$request->unique_number)->first();
        $user->reminder_status  =   0;
        $user->save();
        return response()->json(['error'=>false,'message'=>'Unsubscribed successfully'],200);
    }
    public function state(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->getStats();
            if($result){
                return response()->json(['error'=>false,'message'=>'states of Tours Booking','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function getHistory(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->getHistory($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Payment History','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function addPayment(AddPayment $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->addPayment($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Payment Added Successfully','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function activeEvent(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->activeEvent();
            if($result){
                return response()->json(['error'=>false,'message'=>'Active Events','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function activeArchived(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->activeArchive();
            if($result){
                return response()->json(['error'=>false,'message'=>'Archived Events','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function saveBooking(BookingComment $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->saveComment($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Comment Added','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function eventPaidParticipant(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->paidParticipantEvent();
            if($result){
                return response()->json(['error'=>false,'message'=>'All Event','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function unselected(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->unSelectedParticipant();
            if($result){
                return response()->json(['error'=>false,'message'=>'Un subscribed Email notification Participant','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function fileUpload(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->fileUpload($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Un subscribed Email notification Participant','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    public function uploadLogo(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->uploadLogo($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Logo Uploaded','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function setting(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->setting();
            if($result){
                return response()->json(['error'=>false,'message'=>'Settings','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function unpaid(Request $request,EventInterface $event){
        if($request->wantsJson()){
            $result =   $event->getunpaidParticipant();
            if($result){
                return response()->json(['error'=>false,'message'=>'participant list','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function deleteParticipant(Request $request,$id,EventInterface $event){
        if($request->wantsJson()){

            $result =   $event->deleteParticipant($id);
            if($result){
                return response()->json(['error'=>false,'message'=>'Participant deleted'],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }


}
