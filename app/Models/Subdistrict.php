<?php

namespace App\Models;

use CodeIgniter\Model;

class Subdistrict extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'subdistricts';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = ['name', 'district'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'  =>  'required|alpha_space|max_length[255]',
        'district'  =>  'required|integer'
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

    public function get_search_data($Paginator, $request)
    {
        return $this->builder()
            ->select('subdistricts.id,
                subdistricts.name,
                districts.name as district,
                cities.name as city,
                provinces.name as province'
            )
            ->where('subdistricts.deleted_at', null)
            ->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_subdistrict')))
            ->like('subdistricts.name','%'.$request->getGet('q').'%')
            ->join('districts', 'subdistricts.district = districts.id', 'inner')            
            ->join('cities', 'districts.city = cities.id', 'inner')
            ->join('provinces', 'cities.province = provinces.id', 'inner')
            ->get()->getResult();
    }

    public function get_index_data($Paginator, $request)
    {
        return $this->builder()
            ->select('subdistricts.id,
                subdistricts.name,
                districts.name as district,
                cities.name as city,
                provinces.name as province'
            )
            ->where('subdistricts.deleted_at', null)
            ->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_subdistrict')))
            ->join('districts', 'subdistricts.district = districts.id', 'inner')            
            ->join('cities', 'districts.city = cities.id', 'inner')
            ->join('provinces', 'cities.province = provinces.id', 'inner')
            ->get()->getResult();
    }

    public function get_search_recycle_data($Paginator,$request)
    {
        return $this->builder()
            ->select('subdistricts.id,
                subdistricts.name,
                districts.name as district,
                cities.name as city,
                provinces.name as province'
            )
            ->where('subdistricts.deleted_at !=', null)
            ->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_subdistrict')))
            ->like('subdistricts.name','%'.$request->getGet('q').'%')
            ->join('districts', 'subdistricts.district = districts.id', 'inner')            
            ->join('cities', 'districts.city = cities.id', 'inner')
            ->join('provinces', 'cities.province = provinces.id', 'inner')
            ->get()->getResult();
    }

    public function get_recycle_data($Paginator,$request)
    {
        return $this->builder()
            ->select('subdistricts.id,
                subdistricts.name,
                districts.name as district,
                cities.name as city,
                provinces.name as province'
            )
            ->where('subdistricts.deleted_at !=', null)
            ->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_subdistrict')))
            ->join('districts', 'subdistricts.district = districts.id', 'inner')            
            ->join('cities', 'districts.city = cities.id', 'inner')
            ->join('provinces', 'cities.province = provinces.id', 'inner')
            ->get()->getResult();
    }
}
