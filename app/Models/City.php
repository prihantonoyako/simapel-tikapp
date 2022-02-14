<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Paginator;

class City extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'cities';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = ['name','province'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'  =>  'required|alpha_space|max_length[255]',
        'province'  =>  'required|integer|numeric'
    ];
    protected $validationMessages   = [
        'name'  =>  [
            'required'  =>  'Kolom name harus diisi',
            'alpha_space'   =>  'Kolom name hanya menggunakan karakter alfabet dan spasi',
            'max_length'    =>  'Maksimal panjang karakter kolom name hanya 255 karakter'
        ],
        'province'  =>  [
            'required'  =>  'Kolom name harus diisi',
            'integer'   =>  'Nilai kolom province harus bilangan bulat',
            'numeric'   =>  'Kolom province hanya menggunakan karakter angka'
        ]
    ];
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

    public function get_search_city($Paginator,$request)
    {
        return $this->builder()
			->select(
				'cities.id,
				cities.name,
				provinces.name as province'
			)
			->where('cities.deleted_at',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_city')))
			->like('cities.name','%'.$request->getGet('q').'%')
			->join('provinces','cities.province = provinces.id','inner')
			->get()->getResult();
    }

    public function get_index_city($Paginator,$request)
    {
        return $this->builder()
			->select(
				'cities.id,
				cities.name,
				provinces.name as province'
			)
			->where('cities.deleted_at',null)			
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_city')))
			->join('provinces','cities.province = provinces.id','inner')		
			->get()->getResult();
    }
    
    public function get_search_recycle_city($Paginator,$request)
    {
        return $this->builder()
			->select(
				'cities.id,
				cities.name,
				provinces.name as province'
			)
			->where('cities.deleted_at !=',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_city')))
			->like('cities.name','%'.$request->getGet('q').'%')
			->join('provinces','cities.province = provinces.id','inner')
			->get()->getResult();
    }

    public function get_recycle_city($Paginator,$request)
    {
        return $this->builder()
			->select(
				'cities.id,
				cities.name,
				provinces.name as province'
			)
			->where('cities.deleted_at !=',null)			
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_city')))
			->join('provinces','cities.province = provinces.id','inner')		
			->get()->getResult();
    }
}
