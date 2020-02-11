<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('settings')->insert([
            'currency' => 'USD',
            'pound_in_dollar' => 1.20,
            'pound_in_naira' => 420,
            'pound_in_euro' => 1.40,
            'header_text' => 'Tours Booking',
            'logo' => 'test.png',
            'payment_token' => 'add your paypal token here',

        ]);
    }
}
