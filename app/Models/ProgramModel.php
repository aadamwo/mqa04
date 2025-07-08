<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table            = 'program';
    protected $primaryKey       = 'p_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = 
    [
        'p_reference_number',
        'p_certificate_number',
        'p_qualification_name',
        'p_accreditation_date',
        'p_inst_name',
        'p_inst_address',
        'p_mcd_id',
        'p_phone_number',
        'p_fax_number',
        'p_email_address',
        'p_website',
        'p_compliance_audit',
        'p_qualification_level',
        'p_mqf_level',
        'p_nec_field',
        'p_total_credits',
        'p_delivery_mode',
        'p_created_at',
        'p_updated_at',
        'p_deleted_at',
        'p_slug'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'p_created_at';
    protected $updatedField  = 'p_updated_at';
    protected $deletedField  = 'p_deleted_at';

    // Get program by slug
    public function getProgramBySlug($slug)
    {
        return $this->select('program.*, mqa04_compliance_documents.mcd_programme_code')
            ->join(
                'mqa04_compliance_documents',
                'mqa04_compliance_documents.mcd_id = program.p_mcd_id',
                'left'
            )
            ->where('program.p_slug', $slug)
            ->first();
    }

}