<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Roles extends Seeder
{
    public function run()
    {
        $roles = $this->db->table('roles');
        $data = [
            'name'  =>  'Root',
            'url'   =>  'root',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $roles->insert($data);

        $data = [
            'name'  =>  'Owner',
            'url'   =>  'owner',
			'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];

        $roles->insert($data);
        
        $data = [
            'name'  =>  'Admin',
            'url'   =>  'admin',
			'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $roles->insert($data);
        
        $data = [
            'name'  =>  'Support',
            'url'   =>  'support',
			'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $roles->insert($data);
    }
}
