<?php

namespace App\Models;

use CodeIgniter\Model;

class MqaComSectionModel extends Model
{
    protected $table = 'mqa04_compliance_section';
    protected $primaryKey = 'mcs_id';

    protected $allowedFields = [
        'mcs_desc',
        'mcs_section_char',
        'mcs_created_at',
        'mcs_updated_at',
        'mcs_deleted_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'mcs_created_at';
    protected $updatedField  = 'mcs_updated_at';
    protected $deletedField  = 'mcs_deleted_at';
    protected $useSoftDeletes = true;

    protected $returnType = 'object'; // 

    // // If you need to specify any validation rules
    // protected $validationRules = [];
    // protected $validationMessages = [];
    // protected $skipValidation = false;
}