<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $users = $this->db->table('users');
        $roles = $this->db->table('roles');
        $user_roles = $this->db->table('user_roles');
        $data = [
            'username'  =>  'root',
            'password'  =>  password_hash(
                'toor',
                PASSWORD_BCRYPT,
                ['cost'=>'10']
            ),
            'email' =>  'root@company.com',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $users->insert($data);

        $data = [
            'username'  =>  'owner',
            'password'  =>  password_hash(
                'renwo',
                PASSWORD_BCRYPT,
                ['cost'=>'10']
            ),
            'email' =>  'owner@company.com',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $users->insert($data);

        $data = [
            'username'  =>  'admin',
            'password'  =>  password_hash(
                'nimda',
                PASSWORD_BCRYPT,
                ['cost'=>'10']
            ),
            'email' =>  'admin@company.com',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $users->insert($data);

        $data = [
            'username'  =>  'support',
            'password'  =>  password_hash(
                'troppus',
                PASSWORD_BCRYPT,
                ['cost'=>'10']
            ),
            'email' =>  'support@company.com',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $users->insert($data);

        // USER ROLES
        $data = [
            'user' => $users->select('id')->where('username','root')->get()->getRow()->id,
            'role' =>   $roles->select('id')->where('url','root')->get()->getRow()->id,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $user_roles->insert($data);

        $data = [
            'user' => $users->select('id')->where('username','root')->get()->getRow()->id,
            'role' =>   $roles->select('id')->where('url','owner')->get()->getRow()->id,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $user_roles->insert($data);

        $data = [
            'user' => $users->select('id')->where('username','root')->get()->getRow()->id,
            'role' =>   $roles->select('id')->where('url','admin')->get()->getRow()->id,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $user_roles->insert($data);

        $data = [
            'user' => $users->select('id')->where('username','root')->get()->getRow()->id,
            'role' =>   $roles->select('id')->where('url','support')->get()->getRow()->id,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $user_roles->insert($data);

        $data = [
            'user' => $users->select('id')->where('username','owner')->get()->getRow()->id,
            'role' =>   $roles->select('id')->where('url','owner')->get()->getRow()->id,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $user_roles->insert($data);

        $data = [
            'user' => $users->select('id')->where('username','admin')->get()->getRow()->id,
            'role' =>   $roles->select('id')->where('url','admin')->get()->getRow()->id,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $user_roles->insert($data);

        $data = [
            'user' => $users->select('id')->where('username','support')->get()->getRow()->id,
            'role' =>   $roles->select('id')->where('url','support')->get()->getRow()->id,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $user_roles->insert($data);
    }
}
