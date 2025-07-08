<?php

namespace App\Models;

use CodeIgniter\Model;

class StudyModeModel extends Model
{
    protected $table            = 'study_mode';
    protected $primaryKey       = 'sm_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false; // Enable if you plan to use soft deletes
    protected $protectFields    = true;

    protected $allowedFields    = [
        'sm_p_id',
        'sm_type',
        'sm_long_sem',
        'sm_short_sem',
        'sm_long_sem_week',
        'sm_short_sem_week',
        'sm_long_sem_total',
        'sm_short_sem_total',
        'sm_duration',
    ];

    // Dates
    protected $useTimestamps = false; // Set to true if your table has created_at, updated_at
}
