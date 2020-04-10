<?php

use Illuminate\Database\Seeder;

class SubtypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['Pemrograman Android', 'Pemrograman Website'];
        $subtitle = ['Pembuatan Aplikasi terkait Android', 'Pembuatan Aplikasi terkait Website'];
        $icon = ['android-programming.svg', 'website-programming.svg'];
        foreach ($title as $key => $item) {
            \App\SubTypes::create([
                'type_id' => 1,
                'title' => $item,
                'subtitle' => $subtitle[$key],
                'icon' => 'img/icon/' . $icon[$key],
            ]);
        }
        $title = ['Foto Wisuda', 'Foto Pernikahan'];
        $subtitle = ['Sesi foto dan pengeditan Foto Wisuda', 'Sesi Foto dan pengeditan Foto Pernikahan'];
        $icon = ['wedding-photography.svg', 'wedding-photography.svg'];
        foreach ($title as $key => $item) {
            \App\SubTypes::create([
                'type_id' => 2,
                'title' => $item,
                'subtitle' => $subtitle[$key],
                'icon' => 'img/icon/' . $icon[$key],
            ]);
        }
    }
}
