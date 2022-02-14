<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\District;
use App\Models\Province;
use App\Models\City;
use App\Models\Device;
use App\Libraries\Paginator;

class DeviceController extends DashboardController
{
	private $rootViewPath = "Device/Devices/";
    
	public function index()
    {
		helper('pagination_record_number');
		$request = service('request');

        $Device = new Device();

		if($this->request->getGet('q')) {
			$devices = $Device->like('name','%'.$this->request->getGet('q').'%')->paginate(10,'device');
		} else {
			$devices = $Device->paginate(10,'device');
		}

		$data = [
			'devices' => $devices,
			'pager' => $Device->pager,
			'recordIndex' => pagination_record_number($request->getGet('page_device'),10),
			'newRecord' => base_url($this->uri->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url($this->uri->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url($this->uri->setSegment(5, 'show')->getPath()),
			'recycleRecord' => base_url($this->uri->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url($this->uri->setSegment(5, 'delete')->getPath())
		];
		
		return $this->view->setData($data)->render($this->rootViewPath.'index');
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
		
		return $this->view->setData($data)->render($this->rootViewPath.'recycle');
	}
	
	public function new()
	{
		$Province = new Province;
		
		$data = [
			'provinces'=>$Province->findAll(),
			'ajax_city'=>base_url('api/get/administrative-division/cities-by-province-name'),
			'url_action'=>base_url($this->uri->setSegment(5,'create')->getPath()),
			'url_back'=>base_url($this->uri->setSegment(5,'')->getPath())
		];
		
		return $this->view->setData($data)->render($this->rootViewPath.'new');
	}
	
	public function create()
	{
		$District = new District;
		$City = new City;
		$data = [
			'name'=>$this->request->getPost('name'),
			'city'=>$City->where('name',$this->request->getPost('city'))->first()->id
		];
		
		if($District->insert($data)==false){
			$this->session->setFlashdata('errors',$District->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url($this->uri->setSegment(5,'')->getPath()));
	}
	
	public function edit()
	{
		$Device = new Device();
		
		$device = $Device->find($this->uri->getSegment(6));
		$data = [
			'device'=>$device,
			'url_action'=>base_url($this->uri->setSegment(5,'update')->getPath()),
			'url_back'=>base_url($this->uri->setSegment(5,'')->setSegment(5,'')->getPath())
		];
		
		return $this->view->setData($data)->render($this->rootViewPath.'edit');
	}
	
	public function update()
	{
		$District = new District;
		$City = new City;
		
		$data = [
			'name'=>$this->request->getPost('name'),
			'city'=>$City->where('name',$this->request->getPost('city'))->first()->id
		];
		
		if($District->update($this->uri->getSegment(6),$data)==false) {
			$this->session->setFlashdata('errors',$District->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url($this->uri->setSegment(5,'')->setSegment(5,'')->getPath()));
	}
	
	public function delete()
	{
		$District = new District;
		if($this->request->isAJAX()) {
			if($District->delete($this->request->getPost('districtRecord'))) {
				return $this->response->setStatusCode(200)->setJSON(['message'=>'DISTRICT IS DELETED']);
			}
			return $this->response->setStatusCode(500);
		}
		return $this->response->setStatusCode(403);
	}
}
