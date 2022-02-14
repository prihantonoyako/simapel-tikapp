<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\District;
use App\Models\Subdistrict;

class SubdistrictAPI extends ApiBaseController
{
	use ResponseTrait;
	
    public function index()
    {
        return redirect()->back();
    }
	
	public function get_subdistricts_by_district_name ()
	{
		$District = new District;
		$Subdistrict = new Subdistrict;

		if($this->request->isAJAX()) {
			$district = $District->where('name',$this->request->getGet('name'))->first()->id;
			if($district){
				$subdistricts = $Subdistrict->where('district',$district)->findAll();
				return $this->setResponseFormat('json')->respond($subdistricts);
			}
			return $this->fail('PROVINCE RECORD NOT FOUND',404);
		}
		return $this->fail('DEAD',403);
	}

	public function get_subdistricts_by_district_id ()
	{
		$District = new District;
		$Subdistrict = new Subdistrict;

		if($this->request->isAJAX()) {
			$subdistricts = $Subdistrict->where('district',$this->request->getGet('id'))->findAll();
			if($subdistricts){				
				return $this->setResponseFormat('json')->respond($subdistricts);
			}
			return $this->fail('PROVINCE RECORD NOT FOUND',404);
		}
		return $this->fail('DEAD',403);
	}
}