<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Item;

class ItemAPI extends ApiBaseController
{
	use ResponseTrait;

	public function index()
	{
		return redirect()->back();
	}

	public function get_items_by_vendor_and_type_id()
	{
		$Item = new Item;

		$items = array();

		if ($this->request->isAJAX()) {
			$itemsDB = $Item
				->where('vendor', $this->request->getGet('vendor'))
				->where('is_bts', $this->request->getGet('is_bts'))
				->findAll();
			if ($itemsDB) {
				foreach($itemsDB as $item) {
					if($item->quantity > $item->used) {
						array_push($items,$item);
					}
				}
				return $this->setResponseFormat('json')->respond($items);
			}
			return $this->fail('ITEM RECORD NOT FOUND', 404);
		}
		return $this->fail('FORBIDDEN ACCESS', 403);
	}
}
