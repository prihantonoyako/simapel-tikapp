<?php

namespace App\Models;

use CodeIgniter\Model;

class Bill extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'bills';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
		'month',
		'year',
		'active',
		'paid',
		'internet_subscription',
		'paid_time',
		'deleted_at'
	];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
	
	public function get_search_data($Paginator,$request)
    {
        return $this->builder()
			->select('bills.id,
				bills.month,
				bills,year,
				bills.paid,
				bills.paid_time,
				bills.active,
				customers.first_name,
				customers.last_name,
				internet_plans.name as packet_name,
				internet_plans.price'
            )
			->where('bills.deleted_at',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_bill')))
            ->like('customers.name','%'.$request->getGet('q').'%')
			->join('internet_subscriptions','bills.internet_subscription = internet_subscriptions.id','inner')
			->join('internet_plans','internet_subscriptions.internet_plan = internet_plans.id','inner')
			->join('customers','internet_subscriptions.customer = customers.id','inner')
			->get()->getResult();
    }

    public function get_index_data($Paginator,$request)
    {
        return $this->builder()
			->select('bills.id,
				bills.month,
				bills.year,
				bills.paid,
				bills.paid_time,
				bills.active,
				customers.first_name,
				customers.last_name,
				internet_plans.name as packet_name,
				internet_plans.price'
            )
			->where('bills.deleted_at',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_bill')))
			->join('internet_subscriptions','bills.internet_subscription = internet_subscriptions.id','inner')
			->join('internet_plans','internet_subscriptions.internet_plan = internet_plans.id','inner')
			->join('customers','internet_subscriptions.customer = customers.id','inner')
			->get()->getResult();
    }

    public function get_search_recycle_city($Paginator,$request)
    {
        return $this->builder()
			->select('districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province'
            )
			->where('districts.deleted_at !=',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_district')))
            ->like('district.name','%'.$request->getGet('q').'%')
			->join('cities','districts.city = cities.id','inner')
			->join('provinces','cities.province = provinces.id','inner')
			->get()->getResult();
    }

    public function get_recycle_city($Paginator,$request)
    {
        return $this->builder()
			->select('districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province')
			->where('districts.deleted_at !=',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_district')))
            ->join('cities','districts.city = cities.id','inner')
			->join('provinces','cities.province = provinces.id','inner')
			->get()->getResult();
    }

	public function get_bill_information($id)
	{
		$InternetSubscription = new InternetSubscription;
		
		$bill = $this->find($id);
		$internet_subscription = $InternetSubscription->find($bill->internet_subscription);
	}
	
}
