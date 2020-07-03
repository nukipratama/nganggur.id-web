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
        $color = ['#31A2CC', '#e75480'];
        foreach ($title as $key => $item) {
            \App\Type::create([
                'title' => $item,
                'subtitle' => $subtitle[$key],
                'icon' => config('app.url') . '/img/icon/' . $item . '/default.svg',
                'color' => $color[$key],
            ]);
        }
    }
}
