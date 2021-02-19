<?php

use App\Models\Business;
use App\Models\Procedure;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProceduresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            $business = Business::whereUserId($user->id)->first();

            if (!$business) {
                continue;
            }

            factory(Procedure::class, 3)->create([
                'business_id' => $business->id,
                'worker_id' => $user->id,
            ]);
        }
    }
}
