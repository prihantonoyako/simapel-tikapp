<?php

namespace App\Controllers\Api;
use App\Controllers\ApiBaseController;
use App\Models\BarangModel;
use App\Models\VendorModel;
use CodeIgniter\API\ResponseTrait;

class Barang extends ApiBaseController
{
	use ResponseTrait;
	public function all(){
		if ($this->request->isAJAX()) {
			$query = service('request')->getGet('query');
			//var_dump($this->request->getPost('query'));
			
			$barangMo = new BarangModel;
			$barang = $barangMo->where('id_vendor',$query)->findAll();
			if(!$barang){
				return $this->fail("die",500);
			}
			return $this->setResponseFormat('json')->respond($barang);
		}
	}
}
