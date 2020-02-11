<?php
/**
 * Created by PhpStorm.
 * User: arslan
 * Date: 6/10/19
 * Time: 11:34 PM
 */

namespace App\Services\v1;


use App\Contracts\v1\AdminInterface;
use App\User;

class AdminService implements AdminInterface
{
    public function getUsers()
    {
        // TODO: Implement getUsers() method.
        $user   =   User::where('authority','admin')->get();
        return $user ? $user : false;
    }
    public function createParticipant($data)
    {
        // TODO: Implement createParticipant() method.
        $participant    =   new User();
        $participant->first_name    =   $data['first_name'];
        $participant->last_name    =   $data['last_name'];
        $participant->email    =   $data['email'];
        $participant->title    =   $data['title'];
        $participant->country    =   $data['country'];
        $participant->phone_number    =   $data['phone_number'];
        $participant->authority    =   'participant';
        return $participant->save() ? $participant : false;
    }

}