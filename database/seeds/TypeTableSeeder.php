<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['Pemrograman', 'Fotografi'];
        $subtitle = ['Project tentang Pemrograman', 'Project tentang Fotografi'];
        $icon = ['programming.svg', 'photography.svg'];
        foreach ($title as $key => $item) {
            \App\Type::create([
                'title' => $item,
                'subtitle' => $subtitle[$key],
                'icon' => 'img/icon/' . $icon[$key],
            ]);
        }
    }
}
