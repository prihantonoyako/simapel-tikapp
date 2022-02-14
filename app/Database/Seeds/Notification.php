<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Notification extends Seeder
{
    public function run()
    {
        $data = [
            'message' =>   "Welcome to SIMAPEL-TIKAPP",
            'active'    =>  '1',
            'deleteable' =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $this->db->table('notifications')->insert($data);
    }
}
