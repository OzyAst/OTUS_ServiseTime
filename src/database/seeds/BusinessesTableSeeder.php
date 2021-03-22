<?php

use App\Models\BusinessType;
use App\Models\User;
use Illuminate\Database\Seeder;

class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = BusinessType::all();
        $users = User::where(["user_role_id" => 1])->get();

        foreach ($users as $user) {
            $key = rand(0, count($types) - 1);

            factory(\App\Models\Business::class, 1)->create([
                'user_id' => $user->id,
                'type_id' => $types[$key]->id,
            ]);
        }
    }
}
