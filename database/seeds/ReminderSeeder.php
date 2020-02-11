<?php

use Illuminate\Database\Seeder;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('payment_reminders')->insert([
            'day_after_day' => 0,
            'weekly' => 0,
            'monthly' => 0,
            'event_id' => 1,

        ]);
    }
}
