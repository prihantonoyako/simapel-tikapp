<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use App\Models\BaseTransceiverStation;
use App\Models\City;
use App\Models\District;
use App\Models\Subdistrict;
use CodeIgniter\API\ResponseTrait;

class BTSApi extends ApiBaseController
{
    use ResponseTrait;

	public function nearest_base_transceiver_stations_by_city_id()
	{
        $request = service('request');

		$BaseTransceiverStation = new BaseTransceiverStation();
        $City = new City();
        $District = new District();
        $Subdistrict = new Subdistrict();

        $nearestBTS = array();

		if($request->isAJAX()) {
            $districts = $City->where('city',$request->getPost('id'))->findAll();
            foreach($districts as $district) {
                $subdistricts = $Subdistrict->where('district',$district->id)->findAll();
                foreach($subdistricts as $subdistrict) {
                    $bts = $BaseTransceiverStation->where('subdistrict',$subdistrict->id)->where('root',null)->findAll();
                    array_push($nearestBTS,$bts);
                }
            }
            return $this->setResponseFormat('json')->respond($nearestBTS);
        }
		// if($request->isAJAX()) {
		// 	$nearestBTSID = $BaseTransceiverStation
        //         ->id_nearest_bts_by_city($request->getGet('id'));
		// 	if($nearestBTSID) {
		// 		foreach($nearestBTSID as $bts) {
		// 			$item = $BaseTransceiverStation->find($bts->id);
		// 			array_push($nearestBTS,$item);
		// 		}
		// 		return $this->setResponseFormat('json')->respond($nearestBTS);
		// 	}
		// 	return $this->fail('RECORD NOT FOUND',404);
		// }
        // nearest-base-transceiver-stations-by-city-id
	}
			
}
