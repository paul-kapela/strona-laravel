<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            [
                'price' => 10,
                'number_of_days' => 7
            ],
            [
                'price' => 20,
                'number_of_days' => 31
            ],
            [
                'price' => 50,
                'number_of_days' => 93
            ]
        ]);
    }
}
