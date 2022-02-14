<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Vendors extends Seeder
{
    public function run()
    {
        $vendors = $this->db->table('vendors');
        $data = [
            'name'  =>  'CISCO SYSTEMS',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'MikroTik',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);
        
        $data = [
            'name'  =>  'NETGEAR',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);
        
        $data = [
            'name'  =>  'Juniper Networks',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'aruba',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'RUCKUS',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'Ubiquiti',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'TP-LINK',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'TOTOLINK',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'D-LINK',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'Synology',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'HPE',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'DELL',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);

        $data = [
            'name'  =>  'Tenda',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $vendors->insert($data);
    }
}
