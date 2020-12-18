<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PlanSeeder::class);
    }
}
