<?php

namespace App\Models;

use CodeIgniter\Model;

class MqaComItemModel extends Model
{
    protected $table = 'mqa04_compliance_item';
    protected $primaryKey = 'mci_id';

    protected $allowedFields = [
        'mci_desc',
        'mci_sequence',
        'mci_responsibility',
        'mci_mcs_id',
        'mci_created_at',
        'mci_updated_at',
        'mci_deleted_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'mci_created_at';
    protected $updatedField  = 'mci_updated_at';
    protected $deletedField  = 'mci_deleted_at';
    protected $useSoftDeletes = true;

    protected $returnType = 'object'; 

    // // If you need to specify any validation rules
    // protected $validationRules = [];
    // protected $validationMessages = [];
    // protected $skipValidation = false;
}