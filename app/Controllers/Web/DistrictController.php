<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\District;
use App\Models\Province;
use App\Models\City;
use App\Libraries\Paginator;

class DistrictController extends DashboardController
{
	public function index()
    {
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$Province = new Province();
		$City = new City();
		$District = new District();

		$provinces = array();
		// {province id => province name}
		$cities = array();
		// {city id => {name => city name, province => province id}}
		$districts = $District->paginate(10,'district');

		foreach($districts as $district) {
			if(array_key_exists($district->city,$cities)) {
				$city = $cities[$district->city];
				$district->city = $city["name"];
				$district->province = $provinces[$city['province']];
			} else {
				$city = $City->find($district->city);
				$cities[$city->id] = [
					"name"=>$city->name,
					"province"=>$city->province
				];
				$district->city = $city->name;
				if(array_key_exists($city->province,$provinces)) {
					$district->province = $provinces[$city->province];
				} else {
					$province = $Province->find($city->province);
					$provinces[$province->id] = $province->name;
					$district->province = $province->name;
				}
				
			}
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'districts'=>$districts,
			'pager'=>$District->pager,
			'recordNumber'=>pagination_record_number(
				$request->getGet('page_item'), 10),
			'rendering_time' => $rendering_time,
			'newRecord' => base_url(
				current_url(true)->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url(
				current_url(true)->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url(
				current_url(true)->setSegment(5, 'show')->getPath()),
			'recycleRecord' => base_url(
				current_url(true)->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath())
		];
		
		return $view->setData($data)
			->render('Administrative-Division/District/index');
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
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5,'create')->getPath()),
			'url_back' => base_url(
				current_url(true)->setSegment(5,'')->getPath())
		];
		
		return $view->setData($data)
			->render('Administrative-Division/District/new');
	}
	
	public function create()
	{
		$request = service('request');
		$session = session();

		$District = new District();
		$City = new City();

		$data = [
			'name' => $request->getPost('name'),
			'city' => $request->getPost('city')
		];
		
		if($District->insert($data) == false) {
			$session->setFlashdata('errors',$District->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(current_url(true)->setSegment(5,''));
	}
	
	public function edit()
	{
		$view = \Config\Services::renderer();
		$Province = new Province();
		$District = new District();
		$City = new City();
		
		$district = $District->find(current_url(true)->getSegment(6));
		$city = $City->find($district->city);
		$province = $Province->find($city->province);

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');
		
		$data = [
			'district' => $district,
			'city' => $city,
			'province' => $province,
			'provinces' => $Province->findAll(),
			'ajax_city' => base_url(
				'api/get/administrative-division/cities-by-province-id'),
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5,'update')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(5,'')->setSegment(5,'')->getPath())
		];

		return $view->setData($data)
			->render('Administrative-Division/District/edit');
	}
	
	public function update()
	{
		$request = service('request');
		$session = session();

		$District = new District();
		
		$data = [
			'name' => $request->getPost('name'),
			'city' => $request->getPost('city')
		];
		
		if($District->update(current_url(true)->getSegment(6),$data) == false) {
			$session->setFlashdata('errors', $District->errors());
			return redirect()->back()->withInput();
		}
		return redirect()
			->to(current_url(true)->setSegment(5,'')->setSegment(5,''));
	}

	public function recycle()
	{
		$District = new District();		
		$Paginator = new Paginator(10, base_url($this->uri->getPath()), 'district');
		$recycleRecord = null;

		if($this->request->getGet('q')) {
			$districts = $District->get_search_district($Paginator,$this->request);
			$Paginator->set_record_count($District->builder()->where('deleted_at !=',null)->like('name','%'.$this->request->getGet('q').'%')->countAllResults());
			$Paginator->set_query_string('q',$this->request->getGet('q'));
			$Paginator->set_page_number($this->request->getGet('page_district'));
		} else {
			$Paginator->set_record_count($District->builder()->where('deleted_at !=',null)->countAllResults());
			$districts = $District->get_index_district($Paginator,$this->request);
			$Paginator->set_page_number($this->request->getGet('page_district'));
		}

		$data = [
			'recycleRecord'=>$districts,
			'Paginator' => $Paginator,
			'recordIndex' => $Paginator->get_first_index(),
			'newRecord' => base_url($this->uri->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url($this->uri->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url($this->uri->setSegment(5, 'show')->getPath()),
			'recycleRecord' => base_url($this->uri->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url($this->uri->setSegment(5, 'delete')->getPath())
		];
		
		return $this->view->setData($data)->render('Administrative-Division/District/recycle');
	}
	
	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$District = new District;
		if($request->isAJAX()) {
			if($District->delete($request->getPost('districtRecord'))) {
				return $response->setStatusCode(200)->setJSON(['message'=>'DISTRICT IS DELETED']);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}
}
