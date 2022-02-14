<?php

namespace App\Models;

use CodeIgniter\Model;

class InternetSubscription extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'internet_subscriptions';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
		'customer',
		'internet_plan',
		'active',
		'cpe',
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
	
	public function get_search_data($Paginator, $request)
    {
        return $this->builder()
            ->select('internet_subscriptions.id,
                internet_subscriptions.deleted_at,
                internet_subscriptions.active,
				customers.first_name,
				customers.last_name,
				internet_plans.name as packet_name')
            ->where('internet_subscriptions.deleted_at', null)
            ->limit($Paginator->get_limit(), $Paginator->get_offset_record($request->getGet('page_menu')))
            ->like('customers.name',$request->getGet('q'),'both')
			->orLike('internet_plans.name',$request->getGet('q'),'both')
            ->join('customers', 'internet_subscriptions.customer = customers.id')
			->join('internet_plans','internet_subscriptions.internet_plan = internet_plans.id')
            ->get()->getResult();
    }

    public function get_index_data($Paginator, $request)
    {
        return $this->builder()
            ->select('internet_subscriptions.id,
                internet_subscriptions.deleted_at,
                internet_subscriptions.active,
				customers.first_name,
				customers.last_name,
				internet_plans.name as packet_name')
            ->where('internet_subscriptions.deleted_at', null)
            ->limit($Paginator->get_limit(), $Paginator->get_offset_record($request->getGet('page_menu')))
            ->join('customers', 'internet_subscriptions.customer = customers.id')
			->join('internet_plans','internet_subscriptions.internet_plan = internet_plans.id')
            ->get()->getResult();
    }

    public function get_search_recycle_data($Paginator, $request)
    {
        return $this->builder()
            ->select(
                'districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province'
            )
            ->where('districts.deleted_at !=', null)
            ->limit($Paginator->get_limit(), $Paginator->get_offset_record($request->getGet('page_district')))
            ->like('district.name', '%' . $request->getGet('q') . '%')
            ->join('cities', 'districts.city = cities.id', 'inner')
            ->join('provinces', 'cities.province = provinces.id', 'inner')
            ->get()->getResult();
    }

    public function get_recycle_data($Paginator, $request)
    {
        return $this->builder()
            ->select('districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province')
            ->where('districts.deleted_at !=', null)
            ->limit($Paginator->get_limit(), $Paginator->get_offset_record($request->getGet('page_district')))
            ->join('cities', 'districts.city = cities.id', 'inner')
            ->join('provinces', 'cities.province = provinces.id', 'inner')
            ->get()->getResult();
    }
}
