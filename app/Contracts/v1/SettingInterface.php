<?php
/**
 * Created by PhpStorm.
 * User: arslan
 * Date: 6/20/19
 * Time: 9:22 PM
 */

namespace App\Contracts\v1;


interface SettingInterface
{
    public function updateSetting($data);
    public function setting();
}