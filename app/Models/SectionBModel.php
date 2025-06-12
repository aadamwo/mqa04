<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionBModel extends Model
{
    protected $table            = 'sectionb';
    protected $primaryKey       = 'sb_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'sb_file',
        'sb_items',
        'sb_message',
        'sb_created_at',
        'sb_updated_at',
        'sb_deleted_at',
        
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'sb_created_at';
    protected $updatedField  = 'sb_updated_at';
    protected $deletedField  = 'sb_deleted_at';
 
}