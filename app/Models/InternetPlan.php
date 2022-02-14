<?php

namespace App\Models;

use CodeIgniter\Model;

class InternetPlan extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'internet_plans';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'name',
        'dedicated',
        'download',
        'upload',
        'download_unit',
        'upload_unit',
        'price',
        'deleted_at'
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'  =>  'required|max_length[255]',
        'dedicated' =>  'in_list[0,1]',
        'download'  =>  'required|integer',
        'upload'    =>  'required|integer',
        'download_unit'=>'max_length[20]',
        'upload_unit'=>'max_length[20]',
        'price' =>  'required|decimal'
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
}
