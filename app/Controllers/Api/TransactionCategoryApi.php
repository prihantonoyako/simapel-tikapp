<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TransactionCategory;

class TransactionCategoryApi extends ApiBaseController
{
    use ResponseTrait;

	public function get_categories()
	{
        $request = service('request');

        $TransactionCategory = new TransactionCategory();

        if($request->isAJAX()) {
            if(intval($request->getGet('is_income')) == 1) {
                $categories = $TransactionCategory->where('is_income', 1)->findAll();
            } else {
                $categories = $TransactionCategory->where('is_income', 0)->findAll();
            }
            return $this->setResponseFormat('json')->respond($categories);
        }
	}
			
}
