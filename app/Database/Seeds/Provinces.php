<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Provinces extends Seeder
{
    public function run()
    {
        $provinces = [
            [
                "nama" => "Aceh"
            ],
            [
                "nama" => "Bali"
            ],
            [
                "nama" => "Banten"
            ],
            [
                "nama" => "Bengkulu"
            ],
            [
                "nama" => "D.I Yogyakarta"
            ],
            [
                "nama" => "D.K.I Jakarta"
            ],
            [
                "nama" => "Gorontalo"
            ],
            [
                "nama" => "Jambi"
            ],
            [
                "nama" => "Jawa Barat"
            ],
            [
                "nama" => "Jawa Tengah"
            ],
            [
                "nama" => "Jawa Timur"
            ],
            [
                "nama" => "Kalimantan Barat"
            ],
            [
                "nama" => "Kalimantan Selatan"
            ],
            [
                "nama" => "Kalimantan Tengah"
            ],
            [
                "nama" => "Kalimantan Timur"
            ],
            [
                "nama" => "Kalimantan Utara"
            ],
            [
                "nama" => "Kepulauan Bangka Belitung"
            ],
            [
                "nama" => "Kepulauan Riau"
            ],
            [
                "nama" => "Lampung"
            ],
            [
                "nama" => "Maluku"
            ],
            [
                "nama" => "Maluku Utara"
            ],
            [
                "nama" => "Nusa Tenggara Barat"
            ],
            [
                "nama" => "Nusa Tenggara Timur"
            ],
            [
                "nama" => "Papua"
            ],
            [
                "nama" => "Papua Barat"
            ],
            [
                "nama" => "Riau"
            ],
            [
                "nama" => "Sulawesi Barat"
            ],
            [
                "nama" => "Sulawesi Selatan"
            ],
            [
                "nama" => "Sulawesi Tengah"
            ],
            [
                "nama" => "Sulawesi Tenggara"
            ],
            [
                "nama" => "Sulawesi Utara"
            ],
            [
                "nama" => "Sumatera Barat"
            ],
            [
                "nama" => "Sumatera Selatan"
            ],
            [
                "nama" => "Sumatera Utara"
            ]
        ];

        foreach($provinces as $item){
            $data = [
                'name'  =>  $item['nama'],
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            ];
            $this->db->table('provinces')->insert($data);
        }
    }
}
