<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'App\Home::index');
// Routes for Web Application Only
$routes->group('web', function ($routes) {
	$routes->get('/', 'App\Home::index');
	$routes->get('login', 'App\LoginController::index');
	$routes->post('login', 'App\LoginController::login');
	$routes->get('lock', 'App\LoginController::lock');
	$routes->get('logout', 'App\LoginController::logout');
	$routes->get('forgot-password', 'App\LoginController::forgot_password');
	$routes->group('register', function ($routes) {
		$routes->get('/', 'App\RegisterController::new');
		$routes->post('create', 'App\RegisterController::create');
	});
	$routes->resource('register', ['controller' => 'App\RegisterController']);
	$routes->get('dashboard/(:any)', 'Web\DashboardController::index', ['filter' => 'auth', 'filter' => 'role']);

	$routes->group('report', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
		$routes->presenter('problems', ['controller' => 'Web\ProblemHistoryController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('problems', function ($routes) {
			$routes->get('follow-up/(:num)', 'Web\ProblemHistoryController::follow_up');
			$routes->post('create-follow-up/(:num)', 'Web\ProblemHistoryController::create_follow_up');
			$routes->get('detail-log/(:num)', 'Web\ProblemHistoryController::detail_log');
			$routes->get('edit-log/(:num)', 'Web\ProblemHistoryController::edit_log');
			$routes->post('update-log/(:num)', 'Web\ProblemHistoryController::update_log');
			$routes->get('recycle', 'Web\ProblemHistoryController::recycle');
		});
		$routes->presenter('transaction-histories', ['controller' => 'Web\TransactionHistoryController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('transaction-histories', function ($routes) {
			$routes->get('recycle', 'Web\TransactionHistoryController::recycle');
		});
		$routes->presenter('vendor', ['controller' => 'Web\VendorController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('vendor', function ($routes) {
			$routes->get('recycle', 'Web\VendorController::recycle');
			$routes->get('purge', 'Web\VendorController::purge');
			$routes->post('restore/(:num)', 'Web\VendorController::restore');
		});
	});

	$routes->group('customer', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
		$routes->presenter('customers', ['controller' => 'Web\CustomerController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('customers', function ($routes) {
			$routes->get('recycle', 'Web\CustomerController::recycle');
			$routes->get('purge', 'Web\CustomerController::purge');
			$routes->post('restore/(:num)', 'Web\CustomerController::restore');
			$routes->get('subscription/(:num)', 'Web\CustomerController::list_subscription');
		});
		$routes->presenter('internet-subscription', ['controller' => 'Web\InternetSubscriptionController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('internet-subscription', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
			$routes->get('subscribe/(:num)', 'Web\InternetSubscriptionController::subscribe');
		});
		$routes->group('billing', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
			$routes->get('/', 'Web\BillController::index');
			$routes->post('update/(:num)', 'Web\BillController::update');
			$routes->get('print-invoice/(:num)', 'Web\BillController::print_invoice');
			$routes->get('edit/(:num)', 'Web\BillController::edit');
			$routes->get('detail-bill/(:num)', 'Web\BillController::detail_bill');
		});
		$routes->presenter('location', ['controller' => 'Web\LocationController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('location', function ($routes) {
			$routes->get('recycle', 'Web\LocationController::recycle');
			$routes->get('purge', 'Web\LocationController::purge');
			$routes->post('restore/(:num)', 'Web\Locationcontroller::restore');
		});
	});

	$routes->group('bts', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
		$routes->presenter('device', ['controller' => 'Web\BTSController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('device', function ($routes) {
			$routes->get('recycle', 'Web\BTSController::recycle');
			$routes->get('purge', 'Web\BTSController::purge');
			$routes->post('restore/(:num)', 'Web\BTSController::restore');
		});
		$routes->presenter('location', ['controller' => 'Web\LocationController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('location', function ($routes) {
			$routes->get('recycle', 'Web\LocationController::recycle');
			$routes->get('purge', 'Web\LocationController::purge');
			$routes->post('restore/(:num)', 'Web\Locationcontroller::restore');
			$routes->get('analyze-bts-by-location/(:num)', 'Web\LocationController::analyze_bts_by_location');
		});
		// $routes->get('monitor-frekuensi','Web\BTSController::analyze_bts_frequency');
		$routes->get('monitor-link', 'Web\BTSController::monitoring_link');
	});

	$routes->group('device', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
		$routes->group('devices', function ($routes) {
			$routes->get('/', 'Web\DeviceController::index');
			$routes->get('edit/(:num)', 'Web\DeviceController::edit');
		});
	});
	$routes->group('(:any)/lokasi', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
		$routes->get('/', 'Web\LokasiController::index');
		$routes->get('new', 'Web\LokasiController::new');
		$routes->post('create', 'Web\LokasiController::create');
		$routes->get('show/(:num)', 'Web\LokasiController::show');
		$routes->get('edit/(:num)', 'Web\LokasiController::edit');
		$routes->post('update/(:num)', 'Web\LokasiController::update');
		$routes->post('delete/(:num)', 'Web\LokasiController::delete');
	});

	$routes->group('location/(:any)', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
		$routes->get('new', 'Web\LocationController::new');
		$routes->post('create', 'Web\LocationController::create');
		$routes->get('analyze-bts-by-location/(:num)', 'Web\LocationController::analyze_bts_by_location');
		$routes->get('show/(:num)', 'Web\LocationController::show');
		$routes->get('edit/(:num)', 'Web\LocationController::edit');
		$routes->post('update/(:num)', 'Web\LocationController::update');
		$routes->post('delete/(:num)', 'Web\LocationController::delete');
		$routes->get('/', 'Web\LocationController::index');
	});

	$routes->group('item', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
		$routes->presenter('vendor', ['controller' => 'Web\VendorController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('vendor', function ($routes) {
			$routes->get('recycle', 'Web\VendorController::recycle');
			$routes->get('purge', 'Web\VendorController::purge');
			$routes->post('restore/(:num)', 'Web\VendorController::restore');
		});
		$routes->presenter('stock', ['controller' => 'Web\ItemController', 'placeholder' => '(:num)', 'except' => 'remove,show']);
		$routes->group('stock', function ($routes) {
			$routes->get('recycle', 'Web\ItemController::recycle');
			$routes->get('purge', 'Web\ItemController::purge');
			$routes->post('restore/(:num)', 'Web\ItemController::restore');
		});
	});

	$routes->group('setting', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
		$routes->presenter('password', ['controller' => 'Web\PasswordController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('password', function ($routes) {
			$routes->get('recycle', 'Web\PasswordController::recycle');
			$routes->get('purge', 'Web\PasswordController::purge');
			$routes->post('restore/(:num)', 'Web\PasswordController::restore');
		});
		$routes->presenter('group-menu', ['controller' => 'Web\GroupMenuController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('group-menu', function ($routes) {
			$routes->get('recycle', 'Web\GroupMenuController::recycle');
			$routes->get('purge', 'Web\GroupMenuController::purge');
			$routes->post('restore/(:num)', 'Web\GroupMenuController::restore');
		});
		$routes->presenter('menu', ['controller' => 'Web\MenuController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('menu', function ($routes) {
			$routes->get('recycle', 'Web\MenuController::recycle');
			$routes->get('purge', 'Web\MenuController::purge');
			$routes->post('restore/(:num)', 'Web\MenuController::restore');
		});
		$routes->presenter('role', ['controller' => 'Web\RoleController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('role', function ($routes) {
			$routes->get('recycle', 'Web\RoleController::recycle');
			$routes->get('purge', 'Web\RoleController::purge');
			$routes->post('restore/(:num)', 'Web\RoleController::restore');
		});
		$routes->presenter('user', ['controller' => 'Web\PenggunaController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('user', function ($routes) {
			$routes->get('recycle', 'Web\PenggunaController::recycle');
			$routes->get('purge', 'Web\PenggunaController::purge');
			$routes->post('restore/(:num)', 'Web\PenggunaController::restore');
		});
		$routes->presenter('access', ['controller' => 'Web\AksesController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->presenter('user-role', ['controller' => 'Web\RolePenggunaController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->presenter('internet-plans', ['controller' => 'Web\InternetPlanController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('internet-plans', function ($routes) {
			$routes->get('recycle', 'Web\InternetPlanController::recycle');
			$routes->get('purge', 'Web\InternetPlanController::purge');
			$routes->post('restore/(:num)', 'Web\InternetPlanController::restore');
		});
		$routes->presenter('transaction-categories', ['controller' => 'Web\TransactionCategoryController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('transaction-categories', function ($routes) {
			$routes->get('recycle', 'Web\TransactionCategoryController::recycle');
			$routes->get('purge', 'Web\TransactionCategoryController::purge');
			$routes->post('restore/(:num)', 'Web\TransactionCategoryController::restore');
		});
	});

	$routes->group('administrative-division', ['filter' => 'auth', 'filter' => 'role'], function ($routes) {
		$routes->presenter('province', ['controller' => 'Web\ProvinceController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('province', function ($routes) {
			$routes->get('recycle', 'Web\ProvinceController::recycle');
			$routes->get('purge', 'Web\ProvinceController::purge');
			$routes->post('restore/(:num)', 'Web\ProvinceController::restore');
		});
		$routes->presenter('city', ['controller' => 'Web\CityController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('city', function ($routes) {
			$routes->get('recycle', 'Web\CityController::recycle');
			$routes->get('purge', 'Web\CityController::purge');
			$routes->post('restore/(:num)', 'Web\CityController::restore');
		});
		$routes->presenter('district', ['controller' => 'Web\DistrictController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('district', function ($routes) {
			$routes->get('recycle', 'Web\DistrictController::recycle');
			$routes->get('purge', 'Web\DistrictController::purge');
			$routes->post('restore/(:num)', 'Web\DistrictController::restore');
		});
		$routes->presenter('sub-district', ['controller' => 'Web\SubDistrictController', 'placeholder' => '(:num)', 'except' => 'remove']);
		$routes->group('sub-district', function ($routes) {
			$routes->get('recycle', 'Web\SubDistrictController::recycle');
			$routes->get('purge', 'Web\SubDistrictController::purge');
			$routes->post('restore/(:num)', 'Web\SubDistrictController::restore');
		});
	});
});

//ROUTES FOR AJAX CALL AND DATA INTERCHANGE
$routes->group('api', function ($routes) {
	$routes->group('get', function ($routes) {
		$routes->group('administrative-division', function ($routes) {
			$routes->get('provinces-by-name', 'Api\ProvinceAPI::get_provinces_by_name');
			$routes->get('provinces-by-id', 'Api\ProvinceAPI::get_provinces_by_id');
			$routes->get('cities-by-province-name', 'Api\CityAPI::get_cities_by_province_name');
			$routes->get('cities-by-province-id', 'Api\CityAPI::get_cities_by_province_id');
			$routes->get('districts-by-city-name', 'Api\DistrictAPI::get_districts_by_city_name');
			$routes->get('districts-by-city-id', 'Api\DistrictAPI::get_districts_by_city_id');
			$routes->get('subdistricts-by-district-name', 'Api\SubdistrictAPI::get_subdistricts_by_district_name');
			$routes->get('subdistricts-by-district-id', 'Api\SubdistrictAPI::get_subdistricts_by_district_id');
		});
		$routes->group('mikrotik', function ($routes) {
			$routes->get('/', 'Api\MikrotikAPI::index');
			$routes->get('get-origin-data', 'Api\MikrotikAPI::get_bts_info');
		});
		$routes->group('item', function ($routes) {
			$routes->get('by-vendor-and-type-id', 'Api\ItemAPI::get_items_by_vendor_and_type_id');
		});
		$routes->get('mode-configuration-by-vendor', 'Api\ConfigurationAPI::get_mode_configuration');
		$routes->get('all-band-configuration', 'Api\ConfigurationAPI::get_all_band_configuration');
		$routes->get('wireless-channel-width-configuration', 'Api\ConfigurationAPI::get_wireless_channel_width_configuration');
		$routes->get('wireless-frequency-configuration', 'Api\ConfigurationAPI::get_frequency_configuration');
		$routes->get('all-wireless-protocol', 'Api\ConfigurationAPI::get_all_wireless_protocol_configuration');
		$routes->get('nearest-base-transceiver-stations-by-city-id', 'Api\BTSAPI::nearest_base_transceiver_stations_by_city_id');
		$routes->get('locations-by-subdistrict-id-type', 'Api\LocationAPI::locations_by_subdistrict_id_type');
		$routes->get('locations-by-subdistrict-name-type', 'Api\LocationAPI::locations_by_subdistrict_name_type');
		$routes->get('bts/other/(:any)', 'Api\BTSApi::get_other_frequency');
		$routes->get('perangkat', 'PerangkatController::index');
		$routes->get('barang/(:num)', 'Api\Barang::all');
		$routes->get('kota/(:num)', 'Api\LokasiApi::kota');
		$routes->get('transaction-categories', 'Api\TransactionCategoryApi::get_categories');
		$routes->get('expense-categories', 'Api\TransactionCategoryApi::expense_category');
		$routes->group('group', function ($routes) {
			$routes->get('all_nomor_menu/(:num)', 'Api\GroupMenuApi::get_nomor_menu');
		});
	});
});

//ROUTES FOR CRONJOB
$routes->group('cron', function ($routes) {
	$routes->get('synchronize-bts', 'Cron\BTSCron::synchronize_bts');
	$routes->get('connectivity-test', 'Cron\DeviceCron::connectivity_test');
	$routes->get('create-bill', 'Cron\BillCron::create_bill');
});

$routes->environment('development', function ($routes) {
	$routes->get('/test', 'TestController::index');
});
// Routes for Testing Purpose Only
// $routes->environment('development', function($routes)
// {
$routes->get('/test', 'Web\TestingController::index');
// });

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/ApiRoutes.php')) {
	require APPPATH . 'Config/ApiRoutes.php';
}
if (file_exists(APPPATH . 'Config/CronRoutes.php')) {
	require APPPATH . 'Config/CronRoutes.php';
}
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
