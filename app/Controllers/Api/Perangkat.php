<?php

namespace App\Controllers\Api;
use App\Controllers\ApiBaseController;

class Perangkat extends ApiBaseController
{
	public function index()
	{
		return redirect()->to(base_url('web/login')); 
	}
}
