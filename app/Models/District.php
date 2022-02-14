<?php

namespace App\Models;

use CodeIgniter\Model;

class District extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'districts';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = ['name', 'city', 'deleted_at'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'  =>  'required|alpha_space|max_length[255]',
        'city'  =>  'required|integer|numeric'
    ];
    protected $validationMessages   = [
        'name'  =>  [
            'required'  =>  'Kolom name harus diisi',
            'alpha_space'   =>  'Kolom name hanya menggunakan karakter alfabet dan spasi',
            'max_length'    =>  'Maksimal panjang karakter kolom name hanya 255 karakter'
        ],
        'city'  =>  [
            'required'  =>  'Kolom city harus diisi',
            'integer'   =>  'Nilai kolom city harus bilangan bulat',
            'numeric'   =>  'Kolom city hanya menggunakan karakter angka'
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

    public function get_search_district($Paginator,$request)
    {
        return $this->builder()
			->select('districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province'
            )
			->where('districts.deleted_at',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_district')))
            ->like('district.name','%'.$request->getGet('q').'%')
			->join('cities','districts.city = cities.id','inner')
			->join('provinces','cities.province = provinces.id','inner')
			->get()->getResult();
    }

    public function get_index_district($Paginator,$request)
    {
        return $this->builder()
			->select('districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province')
			->where('districts.deleted_at',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_district')))
            ->join('cities','districts.city = cities.id','inner')
			->join('provinces','cities.province = provinces.id','inner')
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
}
