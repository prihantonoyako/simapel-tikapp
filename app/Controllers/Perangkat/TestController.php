<?php

namespace App\Controllers\Perangkat;
use App\Controllers\BaseController;
use PEAR2\Net\RouterOS;

class TestController extends BaseController
{
	public function index()
	{
		try {
			$client = new RouterOS\Client('10.222.2.1', 'admin', 'kokoantok');
			echo 'OK';
		} catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}
}