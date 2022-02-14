<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Access extends Seeder
{
    public function run()
    {
        $menu = $this->db->table('menu')->select('id')->get();
        $role = $this->db->table('roles')->select('id')->where('name','root')->get()->getRow()->id;
        foreach($menu->getResult() as $row){
            $data = [
                'role'  =>  $role,
                'menu'  =>  $row->id,
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s')
            ];
            $this->db->table('accesses')->insert($data);
        }
    }
}
