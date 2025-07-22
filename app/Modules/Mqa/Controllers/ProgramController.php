<?php

namespace Modules\Mqa\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgramModel;
use App\Models\MqaComDocModel;
use App\Models\MqaComSectionModel;
use App\Models\MqaComItemModel;
use App\Models\StudyModeModel;


class ProgramController extends BaseController
{
    protected $MqaComDocModel;
    protected $MqaComSectionModel;
    protected $MqaComItemModel;
    protected $programModel;
    protected $studyModeModel;

    public function __construct()
    {
        $this->MqaComDocModel = new MqaComDocModel();
        $this->MqaComSectionModel = new MqaComSectionModel(); 
        $this->MqaComItemModel = new MqaComItemModel();
        $this->programModel = new ProgramModel();
        $this->studyModeModel = new StudyModeModel();
    }

    public function index()
    {
        $programs = $this->programModel
            ->select('program.*, mqa04_compliance_documents.mcd_programme_code')
            ->join(
                'mqa04_compliance_documents',
                'mqa04_compliance_documents.mcd_id = program.p_mcd_id',
                'left'
            )
            ->findAll();

        // Fetch ALL study modes for each program using sm_p_id
        $studyModes = [];
        foreach ($programs as $program) {
            $studyModes[$program->p_id] = $this->studyModeModel
                ->where('sm_p_id', $program->p_id)
                ->findAll();
        }

        $data = [
            'programs' => $programs,
            'studyModes' => $studyModes
        ];
        return $this->render_public('ProgramSec', $data);
    }

    public function Pub04()
    {
        $programme_code = $this->request->getGet('programme_code');
        $section_char = $this->request->getGet('section') ?? 'A'; // Default to 'A', or get from URL

        // Get the specific section
        $section = $this->MqaComSectionModel
            ->where('mcs_section_char', strtoupper($section_char))
            ->first();

        $sections = [];
        $itemsBySection = [];

        if ($section) {
            $sections[] = $section;
            $itemsBySection[$section->mcs_section_char] = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, mqa04_compliance_documents.mcd_id, mqa04_compliance_documents.mcd_file, mqa04_compliance_documents.mcd_original_file_name, mqa04_compliance_documents.mcd_new_file_name, mqa04_compliance_documents.mcd_programme_code, mqa04_compliance_documents.mcd_message')
                ->join(
                    'mqa04_compliance_documents',
                    "mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id AND mqa04_compliance_documents.mcd_programme_code = " . $this->MqaComItemModel->db->escape($programme_code),
                    'left'
                )
                ->where('mqa04_compliance_item.mci_mcs_id', $section->mcs_id)
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        // Fetch the program row by programme_code
        $program = $this->programModel
            ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_id = program.p_mcd_id', 'left')
            ->where('mqa04_compliance_documents.mcd_programme_code', $programme_code)
            ->first();

        $program_id = $program ? $program->p_id : '';

        $data = [
            'sections' => $sections,
            'itemsBySection' => $itemsBySection,
            'programme_code' => $programme_code,
            'program_id' => $program_id,
            'program_slug' => $program ? $program->p_slug : '',
        ];

        return $this->render_public('PubA', $data);
    }

    public function upload()
    {
        $mci_id = $this->request->getPost('mci_id');
        $programme_code = $this->request->getPost('programme_code');
        $file = $this->request->getFile('mcd_file');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);

            // Check if a document already exists for this item and programme code
            $doc = $this->MqaComDocModel
                ->where('mcd_mci_id', $mci_id)
                ->where('mcd_programme_code', $programme_code)
                ->first();

            $data = [
                'mcd_mci_id' => $mci_id,
                'mcd_file' => 'uploads/' . $newName,
                'mcd_original_file_name' => $file->getClientName(),
                'mcd_new_file_name' => $newName,
                'mcd_uploader' => session('user_id') ?? 'public',
                'mcd_programme_code' => $programme_code
            ];

            if ($doc) {
                // Update existing row (replace file)
                $this->MqaComDocModel->update($doc['mcd_id'], $data);
            } else {
                // Insert new row
                $this->MqaComDocModel->insert($data);
            }

            return redirect()->back()->with('success', 'Fail berjaya dimuat naik.');
        }
        return redirect()->back()->with('error', 'Gagal memuat naik fail.');
    }

    public function editResponsibility($id)
    {
        $responsibility = $this->request->getPost('mci_responsibility');
        $this->MqaComItemModel->update($id, ['mci_responsibility' => $responsibility]);
        return redirect()->back()->with('success', 'Responsibility updated successfully.');
    }

    public function editMessage()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request.',
                'csrfHash' => csrf_hash()
            ]);
        }

        $mci_id = $this->request->getPost('mci_id');
        $programme_code = $this->request->getPost('programme_code');
        $message = $this->request->getPost('mcd_message');

        if (!$mci_id || !$programme_code) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Missing required data.',
                'csrfHash' => csrf_hash()
            ]);
        }

        // Use correct field names for query!
        $doc = $this->MqaComDocModel
            ->where('mcd_mci_id', $mci_id)
            ->where('mcd_programme_code', $programme_code)
            ->first();

        if ($doc) {
            $this->MqaComDocModel->update($doc['mcd_id'], ['mcd_message' => $message]);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Message updated.',
                'csrfHash' => csrf_hash()
            ]);
        } else {
            $this->MqaComDocModel->insert([
                'mcd_mci_id' => $mci_id,
                'mcd_programme_code' => $programme_code,
                'mcd_message' => $message,
                'mcd_uploader' => session('user_id') ?? 'public'
            ]);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Message created.',
                'csrfHash' => csrf_hash()
            ]);
        }
    }
    public function ListProg($id)
    {
        $program = $this->programModel
            ->select('program.*, mqa04_compliance_documents.mcd_programme_code')
            ->join(
                'mqa04_compliance_documents',
                'mqa04_compliance_documents.mcd_id = program.p_mcd_id',
                'left'
            )
            ->where('program.p_id', $id)
            ->first();

        if (!$program) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Program not found');
        }

        // Fetch ALL study modes for this program
        $studyModes = $this->studyModeModel
            ->where('sm_p_id', $program->p_id)
            ->findAll();

        $data = [
            'program' => $program,
            'studyModes' => $studyModes
        ];

        return $this->render_public('ListProg', $data);
    }
    public function PubB()
    {
        $programme_code = $this->request->getGet('programme_code');
        $section_char = $this->request->getGet('section') ?? 'B'; // Default to 'B', or get from URL

        // Get the specific section
        $section = $this->MqaComSectionModel
            ->where('mcs_section_char', strtoupper($section_char))
            ->first();

        $sections = [];
        $itemsBySection = [];

        if ($section) {
            $sections[] = $section;
            $itemsBySection[$section->mcs_section_char] = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, mqa04_compliance_documents.mcd_id, mqa04_compliance_documents.mcd_file, mqa04_compliance_documents.mcd_original_file_name, mqa04_compliance_documents.mcd_new_file_name, mqa04_compliance_documents.mcd_programme_code, mqa04_compliance_documents.mcd_message')
                ->join(
                    'mqa04_compliance_documents',
                    "mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id AND mqa04_compliance_documents.mcd_programme_code = " . $this->MqaComItemModel->db->escape($programme_code),
                    'left'
                )
                ->where('mqa04_compliance_item.mci_mcs_id', $section->mcs_id)
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        // Fetch the program row by programme_code
        $program = $this->programModel
            ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_id = program.p_mcd_id', 'left')
            ->where('mqa04_compliance_documents.mcd_programme_code', $programme_code)
            ->first();

        $program_id = $program ? $program->p_id : '';

        $data = [
            'sections' => $sections,
            'itemsBySection' => $itemsBySection,
            'programme_code' => $programme_code,
            'program_id' => $program_id,
            'program_slug' => $program ? $program->p_slug : '',
        ];

        return $this->render_public('PubB', $data);
    }
    public function PubC()
    {
        $programme_code = $this->request->getGet('programme_code');
        $section_char = $this->request->getGet('section') ?? 'C';

        // Handle message POST (no AJAX)
        $messageSuccess = null;
        $messageError = null;
        if ($this->request->getMethod() === 'post' && $this->request->getPost('mci_id')) {
            $mci_id = $this->request->getPost('mci_id');
            $programme_code_post = $this->request->getPost('programme_code');
            $message = $this->request->getPost('mcd_message');

            if ($mci_id && $programme_code_post) {
                $doc = $this->MqaComDocModel
                    ->where('mcd_mci_id', $mci_id)
                    ->where('mcd_programme_code', $programme_code_post)
                    ->first();

                if ($doc) {
                    $this->MqaComDocModel->update($doc['mcd_id'], ['mcd_message' => $message]);
                    $messageSuccess = 'Message updated.';
                } else {
                    $this->MqaComDocModel->insert([
                        'mcd_mci_id' => $mci_id,
                        'mcd_programme_code' => $programme_code_post,
                        'mcd_message' => $message,
                        'mcd_uploader' => session('user_id') ?? 'public'
                    ]);
                    $messageSuccess = 'Message created.';
                }
            } else {
                $messageError = 'Missing required data.';
            }
        }

        $sections = [];
        $itemsBySection = [];
        $section = $this->MqaComSectionModel
            ->where('mcs_section_char', strtoupper($section_char))
            ->first();

        if ($section) {
            $sections[] = $section;
            $itemsBySection[$section->mcs_section_char] = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, mqa04_compliance_documents.mcd_id, mqa04_compliance_documents.mcd_file, mqa04_compliance_documents.mcd_original_file_name, mqa04_compliance_documents.mcd_new_file_name, mqa04_compliance_documents.mcd_programme_code, mqa04_compliance_documents.mcd_message')
                ->join(
                    'mqa04_compliance_documents',
                    "mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id AND mqa04_compliance_documents.mcd_programme_code = " . $this->MqaComItemModel->db->escape($programme_code),
                    'left'
                )
                ->where('mqa04_compliance_item.mci_mcs_id', $section->mcs_id)
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        $program = $this->programModel
            ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_id = program.p_mcd_id', 'left')
            ->where('mqa04_compliance_documents.mcd_programme_code', $programme_code)
            ->first();

        $program_id = $program ? $program->p_id : '';

        $data = [
            'sections' => $sections,
            'itemsBySection' => $itemsBySection,
            'programme_code' => $programme_code,
            'program_id' => $program_id,
            'program_slug' => $program ? $program->p_slug : '',
            'messageSuccess' => $messageSuccess,
            'messageError' => $messageError,
        ];

        return $this->render_public('PubC', $data);
    }
    
    public function showProgramList()
    {
        // Fetch data from model
        $programs = $this->programModel->findAll();

        // Pass data to view
        return $this->render_public('ProgramSec', ['programs' => $programs]);
    }
    public function updateProgram($id)
    {
        $data = $this->request->getPost([
            'p_certificate_number',
            'p_accreditation_date',
            'p_inst_name',
            'p_inst_address',
            'p_phone_number',
            'p_fax_number',
            'p_email_address',
            'p_website',
            'p_compliance_audit',
            'p_mqf_level',
            'p_nec_field',
            'p_total_credits',
            'p_study_duration',
            'p_delivery_mode'
        ]);

        $this->programModel->update($id, $data);

        // Update existing study modes
        $studyModeModel = new StudyModeModel();
        if ($this->request->getPost('sm_id')) {
            foreach ($this->request->getPost('sm_id') as $sm_id) {
                $data = [
                    'sm_long_sem' => $this->request->getPost('sm_long_sem_existing_' . $sm_id),
                    'sm_short_sem' => $this->request->getPost('sm_short_sem_existing_' . $sm_id),
                    'sm_long_sem_week' => $this->request->getPost('sm_long_sem_week_existing_' . $sm_id),
                    'sm_short_sem_week' => $this->request->getPost('sm_short_sem_week_existing_' . $sm_id),
                    'sm_long_sem_total' => $this->request->getPost('sm_long_sem_total_existing_' . $sm_id),
                    'sm_short_sem_total' => $this->request->getPost('sm_short_sem_total_existing_' . $sm_id),
                    'sm_duration' => $this->request->getPost('sm_duration_existing_' . $sm_id),
                ];
                $studyModeModel->update($sm_id, $data);
            }
        }

        // Add new study modes (if any)
        $allowedTypes = ['sepenuh_masa', 'separuh_masa'];
        foreach ($allowedTypes as $type) {
            if ($this->request->getPost('sm_type_new_' . $type)) {
                $studyModeModel->insert([
                    'sm_p_id' => $id,
                    'sm_type' => $this->request->getPost('sm_type_new_' . $type),
                    'sm_long_sem' => $this->request->getPost('sm_long_sem_new_' . $type),
                    'sm_short_sem' => $this->request->getPost('sm_short_sem_new_' . $type),
                    'sm_long_sem_week' => $this->request->getPost('sm_long_sem_week_new_' . $type),
                    'sm_short_sem_week' => $this->request->getPost('sm_short_sem_week_new_' . $type),
                    'sm_long_sem_total' => $this->request->getPost('sm_long_sem_total_new_' . $type),
                    'sm_short_sem_total' => $this->request->getPost('sm_short_sem_total_new_' . $type),
                    'sm_duration' => $this->request->getPost('sm_duration_new_' . $type),
                ]);
            }
        }

        return redirect()->to(base_url('listprog/' . $this->programModel->find($id)->p_slug))->with('success', 'Program updated successfully.');
    }
    public function ListProgBySlug($slug)
    {
        $program = $this->programModel->getProgramBySlug($slug);
        if (!$program) {
            echo "Slug searched: " . htmlspecialchars($slug);
            die('Program not found');
        }

        $studyModes = $this->studyModeModel
            ->where('sm_p_id', $program->p_id)
            ->findAll();

        // Check for ?edit=1 in the URL
        $editing = $this->request->getGet('edit') == '1';

        $data = [
            'program' => $program,
            'studyModes' => $studyModes,
            'editing' => $editing, // Pass to view
        ];

        return $this->render_public('ListProg', $data);
    }
}


