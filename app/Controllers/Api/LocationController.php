<?php

namespace App\Controllers\API;

use App\Controllers\APIBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Subdistrict;
use App\Models\Location;
use App\Models\TypeofLocations;
use App\Models\Configuration;

class LocationController extends APIBaseController
{
	use ResponseTrait;
	
    public function index()
    {
        return redirect()->back();
    }
	
	public function get_city_by_province_id ()
	{
		$City = new City;
		if($this->request->isAJAX()) {
			$data = $City->where('province',service('request')->getGet('id'))->findAll();
			if($data){
				return $this->setResponseFormat('json')->respond($data);
			}
		}
		return $this->fail('die',500);
	}
}