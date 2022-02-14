<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Province;
use App\Models\City;

class CityAPI extends ApiBaseController
{
	use ResponseTrait;
	
    public function index()
    {
        return redirect()->back();
    }

	public function get_cities_by_province_id ()
	{
		$Province = new Province;
		$City = new City;
		if($this->request->isAJAX()) {
				$cities = $City->where('province',$this->request->getGet('id'))->findAll();
				if($cities) {
					return $this->setResponseFormat('json')->respond($cities);
				}
			return $this->fail('PROVINCE RECORD NOT FOUND',404);
		}
		return $this->fail('DEAD',403);	
	}
	
	public function get_cities_by_province_name ()
	{
		$Province = new Province;
		$City = new City;
		if($this->request->isAJAX()) {
			$province = $Province->where('name',$this->request->getGet('name'))->first()->id;
			if($province){
				$cities = $City->where('province',$province)->findAll();
				return $this->setResponseFormat('json')->respond($cities);
			}
			return $this->fail('PROVINCE RECORD NOT FOUND',404);
		}
		return $this->fail('DEAD',403);
	}
}