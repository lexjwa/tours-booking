<?php
/**
 * Created by PhpStorm.
 * User: arslan
 * Date: 6/10/19
 * Time: 11:39 PM
 */

namespace App\Contracts\v1;


interface AdminInterface
{
    public function getUsers();
    public function createParticipant($data);
}