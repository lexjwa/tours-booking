<?php
/**
 * Created by PhpStorm.
 * User: arslan
 * Date: 6/16/19
 * Time: 2:14 PM
 */

namespace App\Services\v1;


use App\Contracts\v1\ReminderInterface;
use App\PaymentReminder;

class ReminderService implements ReminderInterface
{
   public function setReminder($data)
   {
       // TODO: Implement setReminder() method.

       $reminder=PaymentReminder::where('event_id',$data['event_id'])->count();
       if(!$reminder){
           $newReminder =new PaymentReminder();
           $newReminder->day_after_day  = $data['day_after_day'];
           $newReminder->weekly  = $data['weekly'];
           $newReminder->monthly  = $data['monthly'];
           $newReminder->event_id  = $data['event_id'];
           $newReminder->save() ? $newReminder : false;

       }else{
          $reminder    =    PaymentReminder::where('event_id',$data['event_id'])->first();
           $reminder->day_after_day =   $data['day_after_day'];
           $reminder->weekly =   $data['weekly'];
           $reminder->monthly =   $data['monthly'];
           return $reminder->save() ? $reminder : false ;
       }


   }
}