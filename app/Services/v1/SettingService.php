<?php
/**
 * Created by PhpStorm.
 * User: arslan
 * Date: 6/20/19
 * Time: 9:23 PM
 */

namespace App\Services\v1;

use App\Contracts\v1\SettingInterface;
use App\Settings;

class SettingService implements SettingInterface
{
    public function updateSetting($data)
    {
        // TODO: Implement updateSetting() method.
        $setting = Settings::where('id', 1)->first();
        if (array_key_exists('header_text', $data)) {
            $setting->header_text = $data['header_text'];
        }
        if (array_key_exists('currency', $data)) {
            $setting->currency = $data['currency'];
        }
        if (array_key_exists('payment_token', $data)) {
            $setting->payment_token = trim($data['payment_token']);
        }
        if (array_key_exists('pound_in_dollar', $data)) {
            $setting->pound_in_dollar = $data['pound_in_dollar'];
        }
        if (array_key_exists('pound_in_euro', $data)) {
            $setting->pound_in_euro = $data['pound_in_euro'];
        }
        if (array_key_exists('pound_in_naira', $data)) {
            $setting->pound_in_naira = $data['pound_in_naira'];
        }

        return $setting->save() ? $setting : false;
    }

    public function setting()
    {
        // TODO: Implement setting() method.
        return Settings::where('id', 1)->first();
    }
}
