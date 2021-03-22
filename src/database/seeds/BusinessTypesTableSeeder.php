<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            "Салон красоты" => ['key' => 'beauty_saloon'],
            "Парикмахерская" => ['key' => 'barbershop'],
            "Барбершоп" => ['key' => 'barbershop_men'],
        ];

        foreach ($types as $Key => $type) {
            factory(\App\Models\BusinessType::class, 1)->create([
                'name' => $Key,
                'key' => $type['key'],
            ]);
        }
    }
}
