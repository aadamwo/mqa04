<?php

namespace App\Modules\Assessor\Controllers;

use App\Models\AssessorModel;
use App\Controllers\BaseController;
use App\Models\ExpertiseFieldModel;
use App\Models\AssessorExpertiseFieldModel;

class AssessorProfileController extends BaseController
{
    // Assessor
    protected $assessor_model;
    protected $assessor_expertise_model;
    protected $expertise_model;

    public function __construct()
    {
        $this->session = service('session');
        // Assessor model
        $this->assessor_model                 = new AssessorModel();
        $this->assessor_expertise_model       = new AssessorExpertiseFieldModel();
        $this->expertise_model                = new ExpertiseFieldModel();
    }

    public function profile()
    {
        $asr_id = session()->get('user_id');

        // Fecth user data
        $assessor_info = $this->assessor_model->where('asr_id', $asr_id)->first();
        $assessor_expertise = $this->assessor_expertise_model
            ->select('assessor_expertise_field.aef_id, expertise_field.ef_desc')
            ->join('qvc_upsi.expertise_field', 'expertise_field.ef_id = assessor_expertise_field.aef_ef_id', 'left')
            ->where('aef_asr_id', $asr_id)
            ->findAll();

        // Fetch Expertise list from expertise table
        $expertise_list = $this->expertise_model->findAll();

        // Get provider details from the session
        $data = [
            'assessor_info'         => $assessor_info,
            'assessor_expertise'    => $assessor_expertise,
            'expertise_list'        => $expertise_list,
        ];

        $this->render_assessor('profile/view_profile', $data);
    }

    public function update_profile()
    {
        $asr_id = session()->get('user_id');

        $asr_phone            = $this->request->getPost('asr_phone');
        $asr_email            = $this->request->getPost('asr_email');
        $asr_service_address  = $this->request->getPost('asr_service_address');
        $expertise            = $this->request->getPost('expertise'); // Retrieves an array

        // Update main profile info
        $assessor_info = [
            'asr_phone'           => $asr_phone,
            'asr_email'           => $asr_email,
            'asr_service_address' => $asr_service_address,
        ];

        $this->assessor_model->update($asr_id, $assessor_info);

        // Filter out empty expertise values
        $expertise = array_filter($expertise, function ($value) {
            return trim($value) !== "";
        });

        // Insert new expertise records if available
        if (!empty($expertise) && is_array($expertise)) {
            $expertise_data = [];
            foreach ($expertise as $exp_id) {
                $expertise_data[] = [
                    'aef_asr_id' => $asr_id,
                    'aef_ef_id'  => $exp_id
                ];
            }

            if (!empty($expertise_data)) {
                $this->assessor_expertise_model->insertBatch($expertise_data);
            }
        }

        // Return a JSON response
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Profile updated successfully.'
        ]);
    }


    public function delete_expertise()
    {
        if ($this->request->isAJAX()) {
            $expertiseId = $this->request->getPost('id');

            if ($expertiseId) {
                $deleted = $this->assessor_expertise_model->delete($expertiseId, true); // Force hard delete

                return $this->response->setJSON([
                    'success' => $deleted ? true : false,
                    'csrf_token' => csrf_hash()
                ]);
            }
        }

        return $this->response->setJSON([
            'success' => false,
            'csrf_token' => csrf_hash()
        ]);
    }
}
