<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionAModel extends Model
{
    protected $table = 'sectiona';
    protected $primaryKey = 'sa_id';
    protected $allowedFields = [
        'sa_file',
        'sa_items',
        'sa_message',
        'sa_created_at',
        'sa_updated_at',
        'sa_deleted_at',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'sa_created_at';
    protected $updatedField  = 'sa_updated_at';
    protected $deletedField  = 'sa_deleted_at';
    protected $useSoftDeletes = true;
}
