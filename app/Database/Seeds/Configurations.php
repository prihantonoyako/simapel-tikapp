<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Configurations extends Seeder
{
    public function run()
    {
        $Configuration = $this->db->table('configurations');

        $data = [
            'key'   =>  'COMPANY_NAME',
            'value' =>  'NODELABYR',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Configuration->insert($data);

        $data = [
            'key'   =>  'COMPANY_FULL_BRAND_LOGO',
            'value' =>  'images/full-brand.png',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Configuration->insert($data);

        $data = [
            'key'   =>  'COMPANY_BRAND',
            'value' =>  'images/company-brand.png',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Configuration->insert($data);

        $data = [
            'key'   =>  'COMPANY_LOGO',
            'value' =>  'images/brand-logo.png',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Configuration->insert($data);

        $data = [
            'key'   =>  'DEFAULT_AVATAR',
            'value' =>  'images/avatar-default.png',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Configuration->insert($data);

        $data = [
            'key'   =>  'MIKROTIK_VENDOR_ID',
            'value' =>  $this->db->table('vendors')->select('id')->where('name','MikroTik')->get()->getRow()->id,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Configuration->insert($data);

        $transaction_categories = $this->db->table('transaction_categories');

        $data = [
            'name' => 'Tagihan Pelanggan',
            'is_income' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $transaction_categories->insert($data);
    }
}
