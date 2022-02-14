<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SetupSeeder extends Seeder
{
    public function run()
    {
        $this->call('GroupMenu');
        $this->call('Menu');
        $this->call('Roles');
        $this->call('Users');
        $this->call('Vendors');
        $this->call('Provinces');
        $this->call('Cities');
        $this->call('Access');
        $this->call('Notification');
        $this->call('Passwords');
        $this->call('Configurations');
        // Optional
        $this->call('DistrictsByCitySukoharjo');
        $this->call('SubdistrictsByDistrictBaki');
    }
}
