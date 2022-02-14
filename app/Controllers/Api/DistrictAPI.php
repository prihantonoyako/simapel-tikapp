<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\City;
use App\Models\District;

class DistrictAPI extends ApiBaseController
{
	use ResponseTrait;
	
    public function index()
    {
        return redirect()->back();
    }
	
	public function get_districts_by_city_name ()
	{
		$City = new City;
		$District = new District;

		if($this->request->isAJAX()) {
			$city = $City->where('name',$this->request->getGet('name'))->first()->id;
			if($city){
				$districts = $District->where('city',$city)->findAll();
				return $this->setResponseFormat('json')->respond($districts);
			}
			return $this->fail('PROVINCE RECORD NOT FOUND',404);
		}
		return $this->fail('DEAD',403);
	}

	public function get_districts_by_city_id ()
	{
		$City = new City;
		$District = new District;

		if($this->request->isAJAX()) {
			$districts = $District->where('city',$this->request->getGet('id'))->findAll();
			if ($districts) {
				return $this->setResponseFormat('json')->respond($districts);
			}			
			return $this->fail('PROVINCE RECORD NOT FOUND',404);
		}
		return $this->fail('DEAD',403);
	}
}