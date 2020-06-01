<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = [0, 1, 2, 3, 4, 5, 100, 101, 102];
        $name = [
            'Menunggu Mitra', 'Menunggu Pembayaran', 'Menunggu Verifikasi Pembayaran', 'Project sedang Berjalan', 'Project telah Selesai',
            'Project sudah direview', 'Project Gagal', 'Project belum dibayar', 'Bukti pembayaran project salah'
        ];
        foreach ($id as $key => $item) {
            \App\Status::create([
                'id' => $item,
                'name' => $name[$key]
            ]);
        }
    }
}
