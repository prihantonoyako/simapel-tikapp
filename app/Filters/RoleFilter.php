<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Access;
use App\Models\GroupMenu;
use App\Models\Menu;

class RoleFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$GroupMenu = new GroupMenu();
		$Menu = new Menu();
		$Access = new Access();
		$response = service('response');
		// index.php/web/group_menu/menu/sub/option
		$access_path = explode('/',$request->uri->getPath(),PHP_INT_MAX);
		// dd($access_path);
		$group_menu = $GroupMenu->where('url',$access_path[1])->first();
		
		if(session()->has('id_role')){
			if(is_null($group_menu)){
				return ;
			} else {
				$menu = $Menu->where('url',$access_path[2])->first();
				if(is_null($menu)) {
					return redirect()->back();
				} else {
					$access = $Access->where('role',session('id_role'))->where('menu',$menu->id)->first();
					if(is_null($access)) {
						return redirect()->back();
						// return $response->setStatusCode(403);
					}
					return ;
				}
			}
		} else {
			return redirect()->to(base_url("web/login"));
		}
		exit(1);
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		
	}
}
