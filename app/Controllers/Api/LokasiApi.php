<?php

namespace App\Controllers\Api;
use App\Controllers\ApiBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KotaModel;

class LokasiApi extends ApiBaseController
{
	use ResponseTrait;

    public function kota(){
        if($this->request->isAJAX()){
            $query = service('request')->getGet('provinsi');
            $kotaMo = new KotaModel;
            $kota = $kotaMo->where('provinsi',$query)->findAll();
            if($kota){
                return $this->setResponseFormat('json')->respond($kota);
            }
            return $this->fail('die',500);
        }
    }
}
