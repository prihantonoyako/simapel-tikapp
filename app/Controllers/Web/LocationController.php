<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\Location;
use App\Models\Subdistrict;
use App\Models\Province;
use App\Models\BaseTransceiverStation;
use App\Models\City;
use App\Models\District;

class LocationController extends DashboardController
{
    public function index()
    {
        helper('pagination_record_number');
        $request = service('request');
        $view = \Config\Services::renderer();

        $Province = new Province();
        $City = new City();
        $District = new District();
        $Subdistrict = new Subdistrict();
		$Location = new Location();

        $provinces = array();
        $cities = array();
        $districts = array();
        $subdistricts = array();
		$analyzeButton = 0;
        $location_type = 0;

        switch (current_url(true)->getSegment(3)) {
            case "bts":
                $analyzeButton = 1;
                $location_type = 1;
				break;
            case "customer":
                break;
            default:
                return redirect()->back();
        }

        $locations = $Location->where('location_type',$location_type)->paginate(10,'location');

        foreach($locations as $location) {
            if(array_key_exists($location->subdistrict,$subdistricts)) {
                $subdistrict = $subdistricts[$location->subdistrict];
                $district = $districts[$subdistrict['district']];
                $city = $cities[$district['city']];
                $location->subdistrict = $subdistrict['name'];
                $location->district = $district['name'];
                $location->city = $city['name'];
                $location->province = $provinces[$city['province']];
            } else {
                $subdistrict = $Subdistrict->find($location->subdistrict);
                $subdistricts[$subdistrict->id] = [
                    'name' => $subdistrict->name,
                    'district' => $subdistrict->district
                ];
                $location->subdistrict = $subdistrict->name;
                if(array_key_exists($subdistrict->district,$districts)) {
                    $district = $districts[$subdistrict->district];
                    $city = $cities[$district['city']];
                    $location->district = $district['name'];
                    $location->city = $city['name'];
                    $location->province = $provinces[$city['province']];
                } else {
                    $district = $District->find($subdistrict->district);
                    $districts[$district->id] = [
                        'name' => $district->name,
                        'city' => $district->city
                    ];
                    $location->district = $district->name;
                    if(array_key_exists($district->city,$cities)) {
                        $city = $cities[$district->city];
                        $location->city = $city['name'];
                        $location->province = $provinces[$city['province']];
                    } else {
                        $city = $City->find($district->city);
                        $cities[$city->id] = [
                            'name' => $city->name,
                            'province' => $city->province
                        ];
                        $location->city = $city->name;
                        if(array_key_exists($city->province,$provinces)) {
                            $location->province = $provinces[$city->province];
                        } else {
                            $province = $Province->find($city->province);
                            $provinces[$province->id] = $province->name;
                            $location->province = $province->name;
                        }
                    }
                }
            }
        }

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'locations'=>$locations,
            'pager' => $Location->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_location'),10),
			'analyzeButton' => $analyzeButton,
            'rendering_time' => $rendering_time,
			'newRecord' => base_url(
                current_url(true)->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url(
                current_url(true)->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url(
                current_url(true)->setSegment(5, 'show')->getPath()),
			'analyzeBTS' => base_url(
                current_url(true)
                    ->setSegment(5, 'analyze-bts-by-location')->getPath()),
			'recycleRecord' => base_url(
                current_url(true)->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url(
                current_url(true)->setSegment(5, 'delete')->getPath())
		];

		return $view->setData($data)->render('Location/index');
    }

    public function new()
    {
        $view = \Config\Services::renderer();

        $Province = new Province();

        timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

        $data = [
            'provinces' => $Province->findAll(),
            'ajax_city' => base_url(
                'api/get/administrative-division/cities-by-province-id'),
			'ajax_district' => base_url(
                'api/get/administrative-division/districts-by-city-id'),
            'ajax_subdistrict' => base_url(
                'api/get/administrative-division/subdistricts-by-district-id'),
			'rendering_time' => $rendering_time,
            'url_action' => base_url(
                current_url(true)->setSegment(5,'create')->getPath()),
			'url_back' => base_url(
                current_url(true)->setSegment(5,'')->getPath())
        ];

        return $view->setData($data)->render('Location/new');
    }

    public function create()
    {
        $request = service('request');
        $session = session();

        $Location = new Location();

        // default to customer
        $location_type = 0;

        switch (current_url(true)->getSegment(3)) {
            case "bts":
                $location_type = 1;
                break;
            case "customer":
                break;
            default:
                return redirect()->back();
        }
        $data = [
            'name' => $request->getPost('name'),
            'street' => $request->getPost('street'),
            'neighborhood' => $request->getPost('neighborhood'),
            'hamlet' => $request->getPost('hamlet'),
            'subdistrict' => $request->getPost('subdistrict'),
            'latitude' => $request->getPost('latitude'),
            'longitude' => $request->getPost('longitude'),
            'location_type' => $location_type
        ];

        if ($Location->insert($data) == false) {
            $session->setFlashdata('errors',$Location->errors());
            return redirect()->back()->withInput();
        }
        return redirect()->to(current_url(true)->setSegment(5, ''));
    }

    public function show()
    {

    }

    public function edit()
    {
        $view = \Config\Services::renderer();

		$Province = new Province();
		$City = new City();
		$District = new District();
		$Subdistrict = new Subdistrict();
		$Location = new Location();
		

		$location = $Location->find(current_url(true)->getSegment(6));
		$subdistrict = $Subdistrict->find($location->subdistrict);
		$district = $District->find($subdistrict->district);
		$city = $City->find($district->city);
		$province = $Province->find($city->province);

		$locationInfo = [
			'locationProvince' => $province,
			'locationCity' => $city,
			'locationDistrict' => $district,
			'locationSubdistrict' => $subdistrict,
			'locationInfo' => $location
		];

		$data = [
			'provinces' => $Province->findAll(),
            'ajax_city' => base_url('api/get/administrative-division/cities-by-province-name'),
			'ajax_district' => base_url('api/get/administrative-division/districts-by-city-name'),
            'ajax_subdistrict' => base_url('api/get/administrative-division/subdistricts-by-district-name'),
			'url_action' => base_url(current_url(true)->setSegment(5,'update')->getPath()),
			'url_back' => base_url(current_url(true)->setSegment(5,'')->getPath())
		];

		return $view->setData($data)->setData($locationInfo)
            ->render('Location/edit');
    }

	public function update()
	{

	}

    public function delete()
    {
        $request = service('request');
        $response = service('response');

		$Location = new Location();
        
        if ($request->isAJAX()) {
			$location = $Location->find($request->getPost('id'));
			$flag = false;
			if($request->getPost('permanent')=="true"){
				$flag=true;
			}
            if ($Location->delete($location->id,$flag)) {
                return $response->setStatusCode(200)->setJSON(['status' => 'DATA LOKASI BERHASIL DIHAPUS']);
            }
            return $response->setStatusCode(500)->setJSON(['status' => 'DATA LOKASI TIDAK DITEMUKAN']);
        }
        return $response->setStatusCode(403);
    }

	public function recycle()
	{
		
	}

    public function analyze_bts_by_location()
	{
        $view = \Config\Services::renderer();
    
		$Location = new Location();
		$BaseTransceiverStation = new BaseTransceiverStation();

        $bts24 = $BaseTransceiverStation->get_all_bts_by_location_id(current_url(true)->getSegment(6),'2');
        $bts5 = $BaseTransceiverStation->get_all_bts_by_location_id(current_url(true)->getSegment(6),'5');
		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');
        $data = [
			'baseTransceiverStations24'=>json_encode($bts24),
            'baseTransceiverStations5'=>json_encode($bts5),
            'rendering_time' => $rendering_time,
			'url_back'=>base_url(current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath())
		];
		return $view->setData($data)->render('Location/graph-bts');
	}
}