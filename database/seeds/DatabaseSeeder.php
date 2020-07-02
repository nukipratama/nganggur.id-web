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
        $this->call(BankTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(TypeTableSeeder::class);
        $this->call(SubtypeTableSeeder::class);
    }
}
