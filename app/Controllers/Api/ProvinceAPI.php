<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Province;

class ProvinceAPI extends ApiBaseController
{
	use ResponseTrait;
	
    public function index()
    {
        return redirect()->back();
    }
	
	public function get_provinces_by_name ()
	{
		$Province = new Province;
		if($this->request->isAJAX()) {
			$data = $Province->builder()->like('name','%'.service('request')->getPost('name').'%')->get()->getResult();
			if($data){
				return $this->setResponseFormat('json')->respond($data);
			}
		}
		return $this->fail('dead',500);
	}
}