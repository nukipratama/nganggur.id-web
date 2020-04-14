<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Administrator', 'Pelanggan', 'Mitra'];
        foreach ($name as $key => $item) {
            \App\Role::create([
                'id' => $key,
                'title' => $item
            ]);
        }
    }
}
