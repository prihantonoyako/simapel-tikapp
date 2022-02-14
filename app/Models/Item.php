<?php

namespace App\Models;

use CodeIgniter\Model;

class Item extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'items';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = ['name','quantity','used','is_bts','vendor'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
		'name'	=>	'required|max_length[255]',
		'quantity'	=>	'required|integer',
		'is_bts'	=>	'required|integer',
		'vendor'	=>	'required|integer'
	];
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
}
