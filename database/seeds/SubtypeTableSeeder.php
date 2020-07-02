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
        $title = ['Pemrograman Android', 'Pemrograman iOS'];
        $subtitle = ['Pembuatan Aplikasi terkait Android', 'Pembuatan Aplikasi terkait iOS'];
        $icon = ['Pemrograman/Android.svg', 'Pemrograman/ios.svg'];
        foreach ($title as $key => $item) {
            \App\SubTypes::create([
                'type_id' => 1,
                'title' => $item,
                'subtitle' => $subtitle[$key],
                'icon' => config('app.url') . '/img/icon/' . $icon[$key],
            ]);
        }
        $title = ['Foto Wisuda', 'Foto Pernikahan'];
        $subtitle = ['Sesi foto dan pengeditan Foto Wisuda', 'Sesi Foto dan pengeditan Foto Pernikahan'];
        $icon = ['Fotografi/landscape.svg', 'Fotografi/wedding.svg'];
        foreach ($title as $key => $item) {
            \App\SubTypes::create([
                'type_id' => 2,
                'title' => $item,
                'subtitle' => $subtitle[$key],
                'icon' => config('app.url') . '/img/icon/' . $icon[$key],
            ]);
        }
    }
}
