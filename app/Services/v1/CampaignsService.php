<?php


namespace App\Services\v1;


use App\Booking;
use App\Contracts\v1\CampaignsInterface;
use App\Mail\CampaignMail;
use App\Mail\EventTransaction;
use App\User;
use Illuminate\Support\Facades\Mail;

class CampaignsService implements CampaignsInterface
{
    public function runCampaign($data)
    {
        // TODO: Implement runCampaign() method.
        if (array_key_exists('email', $data)) {
            $this->singleEmail($data);
        } elseif (array_key_exists('event', $data)) {
            $this->eventEmail($data);
        } elseif (array_key_exists('all', $data)) {
            $this->allEmail($data);
        }
        return true;

    }

    public function singleEmail($data)
    {
       // dd($data['email']);
        $participant=User::where('id',$data['email'])
            ->where('reminder_status', 1)
            ->where('status', 1)
            ->first();
       if(Mail::to($participant->email)->send(new CampaignMail($data, $participant->unique_number))){
           return true;
       }else{
           return false;
       }

    }

    public function eventEmail($data)
    {
         $event=Booking::where('event_id',$data['event'])->get();
        //dd($event);
         foreach ($event as $item){
             $participant=User::where('id',$item->user_id)
                                ->where('reminder_status', 1)
                                ->where('status', 1)
                                ->first();
             if($participant)
             {
                 Mail::to($participant->email)->send(new CampaignMail($data, $participant->unique_number));
             }
         }
         return true;
    }

    public function allEmail($data)
    {
        $participant=User::where('authority','participant')->where('reminder_status',1)->get();
        foreach ($participant as $value){

            Mail::to($value->email)->send(new CampaignMail($data, $value->unique_number));

        }
        return true;

    }
}
