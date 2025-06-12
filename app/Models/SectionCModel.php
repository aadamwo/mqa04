<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionCModel extends Model
{
    protected $table            = 'sectionc';
    protected $primaryKey       = 'sc_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'sc_file',
        'sc_items',
        'sc_message',
        'sc_created_at',
        'sc_updated_at',
        'sc_deleted_at',
        
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'sc_created_at';
    protected $updatedField  = 'sc_updated_at';
    protected $deletedField  = 'sc_deleted_at';

}
