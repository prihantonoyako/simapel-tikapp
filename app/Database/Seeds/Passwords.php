<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Passwords extends Seeder
{
    public function run()
    {
        $data = [
            'name' =>   "Default Mikrotik",
            'username'  =>  'admin',
            'password'  =>  '',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $this->db->table('passwords')->insert($data);
        
        $data = [
            'name'  =>  'Default Cisco',
            'username'  =>  'Cisco',
            'password'  =>  'Cisco',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $this->db->table('passwords')->insert($data);
    }
}
