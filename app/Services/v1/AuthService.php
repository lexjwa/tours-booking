<?php
/**
 * Created by PhpStorm.
 * User: arslan
 * Date: 6/10/19
 * Time: 8:52 PM
 */

namespace App\Services\v1;


use App\Booking;
use App\Contracts\v1\AuthInterface;
use App\Mail\EventTransaction;
use App\Mail\ForgetMail;
use App\Mail\InvitationMail;
use App\User;
use function GuzzleHttp\Psr7\str;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthService implements AuthInterface
{
    public function authentcateUser($data)
    {
        // TODO: Implement authentcateUser() method.
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
            $user = Auth::user();
            $token = $user->createToken('API')->accessToken;
            return $token;

        } else {
            return false;
        }
    }
    public function createUser($data)
    {
        // TODO: Implement createUser() method.
        $user   = new User();
        $user->title    = $data['title'];
        $user->first_name   =   $data['first_name'];
        $user->last_name   =   $data['last_name'];
        $user->address  =   null;
        $user->phone_number  =   $data['phone_number'];
        $user->email  =   $data['email'];
        $user->password  =  bcrypt($data['password']);
        $user->authority  =   'admin';
        $user->country  =   $data['country'];
        $user->save();
        return $user->save() ? [$user, $data['password'] ] : false;
    }

    public function allUser()
    {
        // TODO: Implement getParticipant() method.
        return $user    =   User::where('status', 1)
                                  ->where('reminder_status', 1)
                                    ->get();
    }

    public function allDetails($email)
    {
        // TODO: Implement getParticipant() method.
        return $user    =   User::where('authority', 'participant')
                                  ->where('status', 1)
                                   ->where('email', $email)
                                    ->first();
    }

    public function eventPatricipents($id)
    {
        // TODO: Implement getParticipant() method.

        return $bookins = Booking::withoutTrashed()
                        ->join('users', 'users.id', 'bookings.user_id')
                        ->select('users.email', 'bookings.user_id', 'bookings.event_id')
                        ->where('bookings.event_id', '=', $id)
                        ->get();
    }


    public function suspendAdmin($data)
    {
        $id = $data['id'];
        $putFavourite = DB::table('users')
            ->where('id', $id)
            ->update(['status' => 0]);
        if ($putFavourite) {
            return $putFavourite;
        } else {
            return false;
        }

    }
    public function restoreAdmin($data)
    {
        $id = $data['id'];
        $putFavourite = DB::table('users')
            ->where('id', $id)
            ->update(['status' => 1]);
        if ($putFavourite) {
            return $putFavourite;
        } else {
            return false;
        }

    }
    public function deleteAdmin($data)
    {
        $id = $data['id'];
        $putFavourite = DB::table('users')
            ->where('id', $id)
            ->delete();
        if ($putFavourite) {
            return $putFavourite;
        } else {
            return false;
        }

    }
    public function editProfile($data)
    {
        // TODO: Implement editProfile() method.
        $user   =   User::where('id',$data['id'])->first();
        $user->title   = $data['title'];
        $user->first_name   = $data['first_name'];
        $user->last_name   = $data['last_name'];
        $user->email   = $data['email'];
        $user->phone_number=$data['phone_number'];
        if($data['new_password']){

        $user->password   = bcrypt($data['new_password']);
        }
        $user->country  =   $data['country'];
        return $user->save() ? $user : false;
    }
    public function forgetPassword($data)
    {
        // TODO: Implement forgetPassword() method.
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";
        for ($i = 0; $i < 20; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        $forgetLink=DB::table('password_resets')->insert(['email'=>$data['email'],'token'=>$res]);

         $user    =   User::where('email',$data['email'])->first();
        Mail::to($data['email'])->send(new ForgetMail($user,$res));
        return true;
    }
    public function resetPassword($data)
    {
        // TODO: Implement resetPassword() method.
        $reset  =   DB::table('password_resets')->where('token',$data['token'])->first();
        $user=User::where('email',$reset->email)->first();
        $user->password =bcrypt($data['password']);
        $user->save();
        DB::table('password_resets')->where('token',$data['token'])->delete();

        return $user ;
    }


}
