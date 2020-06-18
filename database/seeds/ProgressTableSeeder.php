<?php

use Illuminate\Database\Seeder;

class ProgressTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      \App\Progress::create([
         'id' => 1,
         'step' => 1,
         'project_id' => 1,
         'title' => 'Membuat Front End',
         'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
         'attachment' => json_encode(['satu.jpg', 'dua.jpg']),
      ]);
      \App\Progress::create([
         'id' => 2,
         'step' => 2,
         'project_id' => 1,
         'title' => 'Membuat Back End',
         'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
         'attachment' => json_encode(['a.jpg', 'b.jpg']),
      ]);
   }
}
