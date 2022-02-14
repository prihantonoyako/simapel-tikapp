<?php

namespace App\Controllers\App;
use App\Controllers\BaseController;

class Home extends BaseController
{
	public function index()
	{
		return redirect()
			->to($this->uri->setSegment(2,'web')->setSegment(3,'login'));
	}

	public function direct_group()
	{
		dd();
	}
}
