<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusModel;

class StatusTableSeeder extends Seeder
{
    public function run()
    {
        StatusModel::create([
            'status_kode' => 'ST001',
            'status_nama' => 'Diproses'
        ]);
        StatusModel::create([
            'status_kode' => 'ST002',
            'status_nama' => 'Diterima'
        ]);
        StatusModel::create([
            'status_kode' => 'ST003',
            'status_nama' => 'Ditolak'
        ]);
    }
}