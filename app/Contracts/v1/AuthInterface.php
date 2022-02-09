<?php
/**
 * Created by PhpStorm.
 * User: arslan
 * Date: 6/10/19
 * Time: 8:50 PM
 */

namespace App\Contracts\v1;

interface AuthInterface
{
    public function authentcateUser($data);

    public function createUser($data);

    public function allUser();

    public function allDetails($email);

    public function eventPatricipents($id);

    public function suspendAdmin($data);

    public function deleteAdmin($data);

    public function editProfile($data);

    public function forgetPassword($data);

    public function resetPassword($data);
}
