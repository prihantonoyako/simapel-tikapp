<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Subdistrict;
use App\Models\Location;

class LocationAPI extends ApiBaseController
{
	use ResponseTrait;
	
    public function index()
    {
        return redirect()->back();
    }
	
	public function get_locations_by_subdistrict_id ()
	{
		$Subdistrict = new Subdistrict;
		$Location = new Location;

		if($this->request->isAJAX()) {
			$json = file_get_contents('php://input');
			$data = json_decode($json);
			$subdistrict = $Subdistrict->find($data->id)->id;
			if($subdistrict){
				$locations = $Location
					->where('subdistrict',$subdistrict)
					->where('type',$data->type)
					->findAll();
				return $this->setResponseFormat('json')->respond($locations);
			}
			return $this->fail('LOCATION RECORD NOT FOUND',404);
		}
		return $this->fail('DEAD',403);
	}

	public function locations_by_subdistrict_name_type()
	{
		$Subdistrict = new Subdistrict;
		$Location = new Location;
		
		if($this->request->isAJAX()) {
			$locations = $Location
				->where(
					'subdistrict',
					$Subdistrict
						->where('name',$this->request->getPost('name'))
						->first()->id
				)->where('location_type',$this->request->getPost('type'))
				->findAll();
			if($locations) {
				return $this->setResponseFormat('json')->respond($locations);
			}
			return $this->fail('LOCATION EMPTY',404);
		}
		return $this->fail('FORBIDDEN MECHANISM',403);
	}

	public function locations_by_subdistrict_id_type()
	{
		$Subdistrict = new Subdistrict;
		$Location = new Location;
		
		if($this->request->isAJAX()) {
			$locations = $Location
				->where('subdistrict',$this->request->getGet('id'))
				->where('location_type',$this->request->getGet('type'))
				->findAll();
			if($locations) {
				return $this->setResponseFormat('json')->respond($locations);
			}
			return $this->fail('LOCATION EMPTY',404);
		}
		return $this->fail('FORBIDDEN MECHANISM',403);
	}
}