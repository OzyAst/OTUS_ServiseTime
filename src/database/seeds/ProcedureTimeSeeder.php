<?php

use Illuminate\Database\Seeder;
use App\Services\Week\Week;

class ProcedureTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = Week::getWeeks();

        foreach (\App\Models\Business::all() as $business) {
            foreach ($days as $key => $day) {
                factory(\App\Models\ProcedureTime::class, 1)->create([
                    'business_id' => $business->id,
                    'day' => $key
                ]);
            }
        }
    }
}
