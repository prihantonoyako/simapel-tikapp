<?php

namespace App\Controllers\API;
use App\Controllers\APIBaseController;
use PEAR2\Net\RouterOS;
use App\Models\Password;
use CodeIgniter\API\ResponseTrait;

class AppController extends APIBaseController
{
	use ResponseTrait;

	public function icmp()
	{
		$request = service('request');

		if ($request->isAJAX()) {
			$query = $request->getGet('query');
			//var_dump($this->request->getPost('query'));
			exec("ping " . $query, $output, $status);
			//0 : success
			//1 : no response
			//2 : other errors
			if($status==0){
				return $this->setResponseFormat('json')->respond($status);
				// return json_encode(['success'=> 'success', 'csrf' => csrf_hash(), 'query ' => $query ]);
			}
			
		}
	}

	public function routeros_api_connection()
	{
		$request = service('request');

		$passwordMo = new Password();

		if ($request->isAJAX()) {
			$ip_address = $request->getPost('ip_address');
			$id_master_password = $request->getPost('id_master_password');
			$password = $passwordMo->find($id_master_password);
			try {
				$client = new RouterOS\Client(
					$ip_address,
					$password['username'],
					$password['password']
				);
				return $this->setResponseFormat('json')->respond($password);
			} catch (\Exception $e) {
				return $this->fail("die",500);
			}
			//0 : success
			//1 : no response
			//2 : other errors
		}
	}
}
