<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DistrictsByCitySukoharjo extends Seeder
{
    public function run()
    {
        $city = $this->db->table('cities')->select('id')->like('name','sukoharjo')->get()->getRow()->id;
        $districts = $this->db->table('districts');
        
        $data = [
            'name' => 'Baki',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Bendosari',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Bulu',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Gatak',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Grogol',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Kartasura',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Mojolaban',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Nguter',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Polokarto',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Sukoharjo',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Tawangsari',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);

        $data = [
            'name' => 'Weru',
            'city' => $city,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $districts->insert($data);
    }
}
