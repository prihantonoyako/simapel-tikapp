<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomSeeder extends Seeder
{
    public function run()
    {
        $mikrotik_id = $this->db->table('vendors')->select('id')->like('name','Mikrotik')->get()->getRow()->id;
        $tenda_id = $this->db->table('vendors')->select('id')->like('name','Tenda')->get()->getRow()->id;
        $Item = $this->db->table('items');
        $Password = $this->db->table('passwords');

        $data = [
            'name' => 'Backhaul',
            'username' => 'admin',
            'password' => 'kokon',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $Password->insert($data);

        $data = [
            'name' => 'RB450Gx4',
            'quantity' => 1,
            'used' => 0,
            'is_bts' => 0,
            'vendor' => $mikrotik_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $Item->insert($data);

        $data = [
            'name' => 'RBLHG-5nD',
            'quantity' => 4,
            'used' => 0,
            'is_bts' => 1,
            'vendor' => $mikrotik_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $Item->insert($data);

        $data = [
            'name' => 'RB912UAG-2HPnD',
            'quantity' => 1,
            'used' => 0,
            'is_bts' => 1,
            'vendor' => $mikrotik_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $Item->insert($data);

        $data = [
            'name' => 'RBSXT5HacD2nr2',
            'quantity' => 1,
            'used' => 0,
            'is_bts' => 1,
            'vendor' => $mikrotik_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $Item->insert($data);

        $data = [
            'name' => 'SXT 5nD r2',
            'quantity' => 2,
            'used' => 0,
            'is_bts' => 1,
            'vendor' => $mikrotik_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $Item->insert($data);
        
        $data = [
            'name' => 'O3',
            'quantity' => 1,
            'used' => 0,
            'is_bts' => 1,
            'vendor' => $tenda_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $Item->insert($data);

        $data = [
            'name' => 'O1',
            'quantity' => 1,
            'used' => 0,
            'is_bts' => 1,
            'vendor' => $tenda_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $Item->insert($data);
    }
}
