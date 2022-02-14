<?php

namespace App\Controllers;

use App\Models\Access;
use App\Models\GroupMenu;
use App\Models\Notification;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Config\Services;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Menu;
use App\Models\Configuration;
use App\Models\BaseTransceiverStation;

class DashboardController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;
	protected $avatar;
	protected $title;
	protected $uri;
	protected $company_information = [];

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	//Property for all controllers
	// protected $session;
	// protected $view;
	// protected $validation;
	// protected $uri;
	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
        timer('app benchmark');
		$this->session = session();
		$this->view = Services::renderer();
		$this->validation = Services::validation();
		$this->uri = current_url(true);

		$User = new User;
		$Role = new Role;
		$UserRole = new UserRole;
		$Access = new Access;
		$GroupMenu = new GroupMenu;
		$Menu = new Menu;
		$Notification = new Notification;
		$Configuration = new Configuration();

		$company = $Configuration->whereIn('key',[
			'COMPANY_NAME',
			'COMPANY_FULL_BRAND_LOGO',
			'COMPANY_BRAND',
			'COMPANY_LOGO'
		])->findAll();
		foreach($company as $info) {
			$this->company_information[$info->key] = $info->value;
		}
		
		$currentPages = $this->uri->getSegments();
		array_shift($currentPages);
		array_shift($currentPages);

		$currentNavigation = array();
		foreach($currentPages as $item){
			$temp = ucwords(str_replace("-"," ",$item));
			array_push($currentNavigation,$temp);
		}

		$user = $User->find($this->session->get('id_user'));
		$role = $Role->find($this->session->get('id_role'));
		$this->avatar = $user->avatar;
		if(is_null($user->avatar)){
			$this->avatar = "images/avatar-default.png";
		}else{
			$this->avatar = "uploads".$user->avatar;
		}
		$this->avatar = base_url($this->avatar);

		$userRole = $UserRole->where('user', $user->id)
			->builder()
			->join('roles', 'user_roles.role = roles.id')
			->get()->getResult();

		$access = $Access
			->select(
				'accesses.menu as id_menu,
				menu.group as id_group,
				menu.url as url_menu,
				menu.icon as icon_menu,
				menu.name as name_menu'
			)
			->where('role', $role->id)
			->builder()
			->join('menu', 'accesses.menu = menu.id')
			->where('active', (int) 1)
			->orderBy('ordinal')
			->get()->getResult();

		//get group have child menu
		$groupMenuId = array();
		foreach ($access as $item) {
			$temp = $item->id_group;
			if (!in_array($temp, $groupMenuId)) {
				array_push($groupMenuId, $temp);
			}
		}

		$groupMenu = $GroupMenu->builder()
			->havingIn('id', $groupMenuId)
			->orderBy('ordinal')
			->get()->getResult();

		$linkSearch = service('uri',base_url($this->uri->getPath()));
		// dd($linkSearch);

		$data = [
			'title'	=>	strtoupper(
				$Menu
				->where('url',$this->uri->getSegment(4))
				->first()->name
			),
			'searchRecord'=> base_url($linkSearch->setSegment(5,'search')->getPath()),
			'avatar'	=>	$this->avatar,
			'active_role'	=>	$role,
			'role'	=>	$userRole,
			'group_menu'	=>	$groupMenu,
			'menu'	=>	$access,
			'username'	=>	$user->username,
			'uri'	=>	$this->uri,
			'currentNavigation'	=>	$currentNavigation,
			'notifications'	=>	$Notification
				->where('user',null)
				->where('active',(int) 1)
				->orWhere('user',$user->id)
				->findAll()
		];

        $this->view->setData($data);
	}

}
