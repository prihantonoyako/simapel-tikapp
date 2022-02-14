<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Location;
use App\Models\BaseTransceiverStation;
use App\Models\Device;

class Customer extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'customers';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
		'first_name',
		'last_name',
		'email',
		'active',
        'address'
	];

    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    protected $validationRules      = [
        'first_name'    =>  'required|alpha_space|max_length[255]',
        'last_name' =>  'required|alpha_space|max_length[255]',
        'email' =>  'required|valid_email|max_length[255]'
    ];
    protected $validationMessages   = [
        'first_name'    =>  [
            'required'  =>  'Kolom first_name harus diisi',
            'alpha_space'   =>  'Kolom first_name hanya menggunakan karakter alfabet dan spasi',
            'max_length'    =>  'Maksimal panjang karakter kolom first_name hanya 255 karakter'
        ],
        'last_name' =>  [
            'required'  =>  'Kolom last_name harus diisi',
            'alpha_space'   =>  'Kolom last_name hanya menggunakan karakter alfabet dan spasi',
            'max_length'    =>  'Maksimal panjang karakter kolom last_name hanya 255 karakter'
        ],
        'email' =>  [
            'required'  =>  'Kolom email harus diisi',
            'valid_email'   =>  'Kolom email harus memiliki format yang valid',
            'max_length'    =>  'Maksimal panjang karakter kolom email hanya 255 karakter'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
	
	public function get_all_customer_monitoring()
	{
		$BaseTransceiverStation = new BaseTransceiverStation;
		$Location = new Location;
		$Device = new Device;

		$data = array();
		$customers = $this->where('active', 1)->findAll();
		
		foreach($customers as $customer)
		{
			$running = 0;
			$bts = $BaseTransceiverStation->find($customer->connection);
			$locationCustomer = $Location->find($customer->location);
			$deviceBts = $Device->find($bts->device);
			$locationBts = $Location->find($deviceBts->location);
			$tempCustomer = array(
				'latitude'=>$locationCustomer->latitude,
				'longitude'=>$locationCustomer->longitude,
				'name'=>$locationCustomer->name
			);
			
			$tempBts = array(
				'latitude' => $locationBts->latitude,
				'longitude' => $locationBts->longitude
			);
			if($deviceBts->active == 1 && $customer->running == 1)
			{
				$running = 1;
			}
			$tempData = array(
				'customer' => $tempCustomer,
				'bts' => $tempBts,
				'running' => $running
			);
			array_push($data,$tempData);
		}
		return $data;
	}
}
