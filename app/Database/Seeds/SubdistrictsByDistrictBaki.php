<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubdistrictsByDistrictBaki extends Seeder
{
    public function run()
    {
        $district = $this->db->table('districts')->select('id')->like('name','Baki')->get()->getRow()->id;
        $subdistricts = $this->db->table('subdistricts');
        
        $data = [
            'name' => 'Bakipandeyan',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Bentakan',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Duwet',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Gedongan',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Gentan',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Jetis',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Kadilangu',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Kudu',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Mancasan',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Menuran',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Ngrombo',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Purbayan',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Siwal',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);

        $data = [
            'name' => 'Waru',
            'district' => $district,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $subdistricts->insert($data);
    }
}
