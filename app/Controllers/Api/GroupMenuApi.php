<?php

namespace App\Controllers\Api;
use App\Controllers\ApiBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;

class GroupMenuApi extends ApiBaseController
{
	use ResponseTrait;
	public function get_nomor_menu(){
        if ($this->request->isAJAX()) {
            $id_group = service('request')->getGet('id_group');
                $menuModel = new MenuModel;
                $menu = $menuModel->where('id_group',$id_group)->findAll();
		return $this->setResponseFormat('json')->respond($menu);
        }
        return $this->fail("die",500);
	}
}
