<?php

namespace App\Models;

use CodeIgniter\Model;

class MqaComDocModel extends Model
{
    protected $table = 'mqa04_compliance_documents';
    protected $primaryKey = 'mcd_id';

    protected $allowedFields = [
        'mcd_uploader',
        'mcd_mci_id',
        'mcd_programme_code',
        'mcd_file',
        'mcd_message',
        'mcd_original_file_name',
        'mcd_new_file_name',
        'mcd_created_at',
        'mcd_updated_at',
        'mcd_deleted_at', 
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'mcd_created_at';
    protected $updatedField  = 'mcd_updated_at';
    protected $deletedField  = 'mcd_deleted_at';
    protected $useSoftDeletes = false; // No deleted_at column in this table

    protected $returnType = 'array'; 

}