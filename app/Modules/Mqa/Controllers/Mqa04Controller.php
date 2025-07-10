<?php

namespace Modules\Mqa\Controllers;

use App\Controllers\BaseController;
use App\Models\MqaComDocModel;
use App\Models\MqaComSectionModel;
use App\Models\MqaComItemModel;
use App\Models\ProgramModel; // 
use App\Models\StudyModeModel; // Import the StudyModeModel


class Mqa04Controller extends BaseController
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
public function seca() //main 
{
    // Get all sections dynamically
    $allSections = $this->MqaComSectionModel->orderBy('mcs_section_char')->findAll();

    $sections = [];

    foreach ($allSections as $section) {
        $items = $this->MqaComItemModel
            ->select('mqa04_compliance_item.*, 
                      mqa04_compliance_documents.mcd_id, 
                      mqa04_compliance_documents.mcd_file, 
                      mqa04_compliance_documents.mcd_original_file_name, 
                      mqa04_compliance_documents.mcd_new_file_name, 
                      mqa04_compliance_documents.mcd_programme_code,
                      mqa04_compliance_documents.mcd_message')
            ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id', 'left')
            ->where('mqa04_compliance_item.mci_mcs_id', $section->mcs_id)
            ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
            ->findAll();

        $section->items = $items; // Attach items to the section object
        $sections[] = $section;
    }

    $data = [
        'sections' => $sections,
    ];

    return $this->render_admin('SecA', $data);
}
    public function upload()
    {
        $mci_id = $this->request->getPost('mci_id');
        $file = $this->request->getFile('mcd_file');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);

            $this->MqaComDocModel->save([
                'mcd_mci_id' => $mci_id,
                'mcd_file' => 'uploads/' . $newName,
                'mcd_original_file_name' => $file->getClientName(),
                'mcd_new_file_name' => $newName,
                'mcd_uploader' => session('user_id') ?? 'guest',
                'mcd_programme_code' => 'A'
            ]);
            return redirect()->back()->with('success', 'Fail berjaya dimuat naik.');
        }
        return redirect()->back()->with('error', 'Gagal memuat naik fail.');
    }

    public function editUpload($mcd_id)
    {
        $file = $this->request->getFile('mcd_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);

            // Update the document record
            $this->MqaComDocModel->update($mcd_id, [
                'mcd_file' => 'uploads/' . $newName,
                'mcd_original_file_name' => $file->getClientName(),
                'mcd_new_file_name' => $newName,
                'mcd_updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with('success', 'Fail berjaya dikemaskini.');
        }
        return redirect()->back()->with('error', 'Gagal mengemaskini fail.');
    }

    public function addItemA()
    {
        $sectionA = $this->MqaComSectionModel->where('mcs_section_char', 'A')->first();
        if ($sectionA) {
            $desc = $this->request->getPost('mci_desc');
            $sequence = $this->request->getPost('mci_sequence');
            $responsibility = $this->request->getPost('mci_responsibility');

            // Check if the sequence already exists
            $existing = $this->MqaComItemModel
                ->where('mci_mcs_id', $sectionA->mcs_id)
                ->where('mci_sequence', $sequence)
                ->first();

            if ($existing) {
                // Always increment all items with sequence >= $sequence
                $this->MqaComItemModel
                    ->where('mci_mcs_id', $sectionA->mcs_id)
                    ->where('mci_sequence >=', $sequence)
                    ->set('mci_sequence', 'mci_sequence + 1', false)
                    ->update();
            }

            // Now insert the new item
            $this->MqaComItemModel->save([
                'mci_mcs_id' => $sectionA->mcs_id,
                'mci_desc' => $desc,
                'mci_sequence' => $sequence,
                'mci_responsibility' => $responsibility,
            ]);
        }
        return redirect()->back()->with('success', 'Item Section A berjaya ditambah.');
    }

    public function addItemB()
    {
        $sectionB = $this->MqaComSectionModel->where('mcs_section_char', 'B')->first();
        if ($sectionB) {
            $desc = $this->request->getPost('mci_desc');
            $sequence = $this->request->getPost('mci_sequence');
            $responsibility = $this->request->getPost('mci_responsibility');

            // Always increment all items with sequence >= $sequence
            $this->MqaComItemModel
                ->where('mci_mcs_id', $sectionB->mcs_id)
                ->where('mci_sequence >=', $sequence)
                ->set('mci_sequence', 'mci_sequence + 1', false)
                ->update();

            // Now insert the new item
            $this->MqaComItemModel->save([
                'mci_mcs_id' => $sectionB->mcs_id,
                'mci_desc' => $desc,
                'mci_sequence' => $sequence,
                'mci_responsibility' => $responsibility,
            ]);
        }
        return redirect()->back()->with('success', 'Item Section B berjaya ditambah.');
    }

    public function deleteItem1($id)
    {
        // Delete related documents
        $this->MqaComDocModel->where('mcd_mci_id', $id)->delete();

        // Delete the item itself
        $this->MqaComItemModel->delete($id);

        return redirect()->back()->with('success', 'Item dan semua data berkaitan berjaya dipadam.');
    }

    public function editItem1($id)
    {
        // Only update fields that are present in the POST data
        $itemData = [];
        if ($this->request->getPost('mci_desc') !== null) {
            $itemData['mci_desc'] = $this->request->getPost('mci_desc');
        }
        if ($this->request->getPost('mci_sequence') !== null) {
            $itemData['mci_sequence'] = $this->request->getPost('mci_sequence');
        }
        if ($this->request->getPost('mci_responsibility') !== null) {
            $itemData['mci_responsibility'] = $this->request->getPost('mci_responsibility');
        }
        if (!empty($itemData)) {
            $this->MqaComItemModel->update($id, $itemData);
        }

        // Update document fields if document exists and only update provided fields
        $doc = $this->MqaComDocModel->where('mcd_mci_id', $id)->first();
        if ($doc) {
            $docData = [];
            if ($this->request->getPost('mcd_original_file_name') !== null) {
                $docData['mcd_original_file_name'] = $this->request->getPost('mcd_original_file_name');
            }
            if ($this->request->getPost('mcd_new_file_name') !== null) {
                $docData['mcd_new_file_name'] = $this->request->getPost('mcd_new_file_name');
            }
            if ($this->request->getPost('mcd_programme_code') !== null) {
                $docData['mcd_programme_code'] = $this->request->getPost('mcd_programme_code');
            }
            if ($this->request->getPost('mcd_message') !== null) {
                $docData['mcd_message'] = $this->request->getPost('mcd_message');
            }
            if (!empty($docData)) {
                $this->MqaComDocModel->update($doc['mcd_id'], $docData);
            }
        }

        return redirect()->to(base_url('seca'))->with('success', 'Item berjaya dikemaskini.');
    }
    public function editMessage($id)
    {
        $message = $this->request->getPost('mcd_message');
        $doc = $this->MqaComDocModel->where('mcd_mci_id', $id)->first();
        if ($doc) {
            $this->MqaComDocModel->update($doc['mcd_id'], ['mcd_message' => $message]);
        }
        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    public function adminSec() //main
    {
        $sectionChar = $this->request->getGet('section') ?? 'A'; // Default to 'A', or get from URL

        $section = $this->MqaComSectionModel
            ->where('mcs_section_char', strtoupper($sectionChar))
            ->first();

        $sections = [];
        $programmeCodes = [];

        // 1. Get all programme codes from the main program table (AdminProg)
        $programModel = new \App\Models\ProgramModel();
        $allProgrammes = $programModel
            ->join('mqa04_compliance_documents', 'program.p_mcd_id = mqa04_compliance_documents.mcd_id', 'left')
            ->select('mqa04_compliance_documents.mcd_programme_code')
            ->where('mqa04_compliance_documents.mcd_programme_code IS NOT NULL')
            ->groupBy('mqa04_compliance_documents.mcd_programme_code')
            ->findAll();
        foreach ($allProgrammes as $prog) {
            if (!empty($prog->mcd_programme_code)) {
                $programmeCodes[] = $prog->mcd_programme_code;
            }
        }

        // 2. Get all programme codes from evidence/documents (as before)
        if ($section) {
            $items = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, 
                          mqa04_compliance_documents.mcd_id, 
                          mqa04_compliance_documents.mcd_file, 
                          mqa04_compliance_documents.mcd_original_file_name, 
                          mqa04_compliance_documents.mcd_new_file_name, 
                          mqa04_compliance_documents.mcd_programme_code,
                          mqa04_compliance_documents.mcd_message')
                ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id', 'left')
                ->where('mqa04_compliance_item.mci_mcs_id', $section->mcs_id)
                ->orderBy('mqa04_compliance_documents.mcd_programme_code', 'asc')
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();

            foreach ($items as $item) {
                if (!empty($item->mcd_programme_code)) {
                    $programmeCodes[] = $item->mcd_programme_code;
                }
            }

            $section->items = $items;
            $sections[] = $section;
        }

        // 3. Remove duplicates and sort
        $programmeCodes = array_unique($programmeCodes);
        sort($programmeCodes);

        $selectedProgrammeCode = $this->request->getGet('programme_code') ?? ($programmeCodes[0] ?? '');

        $data = [
            'sections' => $sections,
            'programmeCodes' => $programmeCodes,
            'selectedProgrammeCode' => $selectedProgrammeCode,
        ];

        return $this->render_admin('AdminSec', $data);
    }

    public function adminSecB()
    {
        $sectionChar = $this->request->getGet('section') ?? 'B';

        $section = $this->MqaComSectionModel
            ->where('mcs_section_char', strtoupper($sectionChar))
            ->first();

        $sections = [];
        $programmeCodes = [];

        // 1. Get all programme codes from the main program table (AdminProg)
        $programModel = new \App\Models\ProgramModel();
        $allProgrammes = $programModel
            ->join('mqa04_compliance_documents', 'program.p_mcd_id = mqa04_compliance_documents.mcd_id', 'left')
            ->select('mqa04_compliance_documents.mcd_programme_code')
            ->where('mqa04_compliance_documents.mcd_programme_code IS NOT NULL')
            ->groupBy('mqa04_compliance_documents.mcd_programme_code')
            ->findAll();
        foreach ($allProgrammes as $prog) {
            if (!empty($prog->mcd_programme_code)) {
                $programmeCodes[] = $prog->mcd_programme_code;
            }
        }

        // 2. Get all programme codes from evidence/documents (as before)
        if ($section) {
            $items = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, 
                          mqa04_compliance_documents.mcd_id, 
                          mqa04_compliance_documents.mcd_file, 
                          mqa04_compliance_documents.mcd_original_file_name, 
                          mqa04_compliance_documents.mcd_new_file_name, 
                          mqa04_compliance_documents.mcd_programme_code,
                          mqa04_compliance_documents.mcd_message')
                ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id', 'left')
                ->where('mqa04_compliance_item.mci_mcs_id', $section->mcs_id)
                ->orderBy('mqa04_compliance_documents.mcd_programme_code', 'asc')
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();

            foreach ($items as $item) {
                if (!empty($item->mcd_programme_code)) {
                    $programmeCodes[] = $item->mcd_programme_code;
                }
            }

            $section->items = $items;
            $sections[] = $section;
        }

        // 3. Remove duplicates and sort
        $programmeCodes = array_unique($programmeCodes);
        sort($programmeCodes);

        $selectedProgrammeCode = $this->request->getGet('programme_code') ?? ($programmeCodes[0] ?? '');

        $data = [
            'sections' => $sections,
            'programmeCodes' => $programmeCodes,
            'selectedProgrammeCode' => $selectedProgrammeCode,
        ];

        return $this->render_admin('AdminSecB', $data);
    }

    public function adminSecC()
    {
        $sectionChar = $this->request->getGet('section') ?? 'C';

        $section = $this->MqaComSectionModel
            ->where('mcs_section_char', strtoupper($sectionChar))
            ->first();

        $sections = [];
        $programmeCodes = [];

        // 1. Get all programme codes from the main program table (AdminProg)
        $programModel = new \App\Models\ProgramModel();
        $allProgrammes = $programModel
            ->join('mqa04_compliance_documents', 'program.p_mcd_id = mqa04_compliance_documents.mcd_id', 'left')
            ->select('mqa04_compliance_documents.mcd_programme_code')
            ->where('mqa04_compliance_documents.mcd_programme_code IS NOT NULL')
            ->groupBy('mqa04_compliance_documents.mcd_programme_code')
            ->findAll();
        foreach ($allProgrammes as $prog) {
            if (!empty($prog->mcd_programme_code)) {
                $programmeCodes[] = $prog->mcd_programme_code;
            }
        }

        // 2. Get all programme codes from evidence/documents (as before)
        if ($section) {
            $items = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, 
                          mqa04_compliance_documents.mcd_id, 
                          mqa04_compliance_documents.mcd_file, 
                          mqa04_compliance_documents.mcd_original_file_name, 
                          mqa04_compliance_documents.mcd_new_file_name, 
                          mqa04_compliance_documents.mcd_programme_code,
                          mqa04_compliance_documents.mcd_message')
                ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id', 'left')
                ->where('mqa04_compliance_item.mci_mcs_id', $section->mcs_id)
                ->orderBy('mqa04_compliance_documents.mcd_programme_code', 'asc')
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();

            foreach ($items as $item) {
                if (!empty($item->mcd_programme_code)) {
                    $programmeCodes[] = $item->mcd_programme_code;
                }
            }

            $section->items = $items;
            $sections[] = $section;
        }

        // 3. Remove duplicates and sort
        $programmeCodes = array_unique($programmeCodes);
        sort($programmeCodes);

        $selectedProgrammeCode = $this->request->getGet('programme_code') ?? ($programmeCodes[0] ?? '');

        $data = [
            'sections' => $sections,
            'programmeCodes' => $programmeCodes,
            'selectedProgrammeCode' => $selectedProgrammeCode,
        ];

        return $this->render_admin('AdminSecC', $data);
    }

    public function addSection()
    {
        $sectionModel = new MqaComSectionModel();

        $data = [
            'mcs_section_char' => strtoupper($this->request->getPost('mcs_section_char')),
            'mcs_desc'         => $this->request->getPost('mcs_desc'),
        ];

        $sectionModel->insert($data);

        return redirect()->back()->with('success', 'Section added successfully!');
    }

    public function section($sectionChar)
    {
        $sectionModel = new \App\Models\MqaComSectionModel();
        $itemModel = new \App\Models\MqaComItemModel();

        $section = $sectionModel->where('mcs_section_char', strtoupper($sectionChar))->first();
        if (!$section) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Section not found");
        }

        $items = $itemModel->where('mci_mcs_id', $section->mcs_id)->orderBy('mci_sequence')->findAll();

        return view('Modules\Mqa\Views\SecSection', [
            'section' => $section,
            'items' => $items,
            'sectionChar' => strtoupper($sectionChar),
        ]);
    }
    public function addItem($sectionChar)
    {
        $sectionModel = new MqaComSectionModel();
        $itemModel = new MqaComItemModel();
        $docModel = new MqaComDocModel();

        $section = $sectionModel->where('mcs_section_char', strtoupper($sectionChar))->first();
        if (!$section) {
            return redirect()->back()->with('error', 'Section not found');
        }

        // Insert item
        $itemModel->insert([
            'mci_mcs_id' => $section->mcs_id,
            'mci_desc' => $this->request->getPost('mci_desc'),
            'mci_sequence' => $this->request->getPost('mci_sequence'),
            'mci_responsibility' => $this->request->getPost('mci_responsibility'),
        ]);
        $itemId = $itemModel->getInsertID();

        // Handle file and message if provided
        $file = $this->request->getFile('mcd_file');
        $message = $this->request->getPost('mcd_message');
        $programme_code = $this->request->getPost('mcd_programme_code'); // If you want to support this

        if (($file && $file->isValid() && !$file->hasMoved()) || $message) {
            $docData = [
                'mcd_mci_id' => $itemId,
                'mcd_message' => $message,
                'mcd_programme_code' => $programme_code ?? null,
                'mcd_uploader' => session('user_id') ?? 'admin',
            ];
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads', $newName);
                $docData['mcd_file'] = 'uploads/' . $newName;
                $docData['mcd_original_file_name'] = $file->getClientName();
                $docData['mcd_new_file_name'] = $newName;
            }
            $docModel->insert($docData);
        }

        return redirect()->back()->with('success', 'Item added');
    }
    public function editItem2($sectionChar, $itemId)
    {
        $itemModel = new \App\Models\MqaComItemModel();
        $docModel = new \App\Models\MqaComDocModel();

        // Update item fields
        $itemModel->update($itemId, [
            'mci_desc' => $this->request->getPost('mci_desc'),
            'mci_sequence' => $this->request->getPost('mci_sequence'),
            'mci_responsibility' => $this->request->getPost('mci_responsibility'),
        ]);

        // Handle file upload if present
        $file = $this->request->getFile('mcd_file');
        $message = $this->request->getPost('mcd_message');
        $programme_code = $this->request->getPost('mcd_programme_code'); // If you want to support this

        // Find the related document (if any) for this item and programme code
        $doc = $docModel
            ->where('mcd_mci_id', $itemId)
            ->where('mcd_programme_code', $programme_code)
            ->first();

        $docData = [
            'mcd_message' => $message,
            'mcd_programme_code' => $programme_code,
        ];
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            $docData['mcd_file'] = 'uploads/' . $newName;
            $docData['mcd_original_file_name'] = $file->getClientName();
            $docData['mcd_new_file_name'] = $newName;
            $docData['mcd_updated_at'] = date('Y-m-d H:i:s');
        }

        if (!empty($docData['mcd_message']) || !empty($docData['mcd_file'])) {
            if ($doc) {
                $docModel->update($doc['mcd_id'], $docData);
            } else {
                $docData['mcd_mci_id'] = $itemId;
                $docData['mcd_uploader'] = session('user_id') ?? 'admin';
                $docModel->insert($docData);
            }
        }

        return redirect()->back()->with('success', 'Item updated');
    }

    public function deleteItem2($sectionChar, $itemId)
    {
        $itemModel = new \App\Models\MqaComItemModel();
        $itemModel->delete($itemId);
        return redirect()->back()->with('success', 'Item deleted');
    }

    // Helper function in your controller:
    protected function nullIfEmpty($value)
    {
        return ($value === '' || $value === null) ? null : $value;
    }








    
    public function adminProg() 
{
    $programModel = new \App\Models\ProgramModel();
    $programs = $programModel
        ->select('program.*, mqa04_compliance_documents.mcd_programme_code')
        ->join(
            'mqa04_compliance_documents',
            'program.p_mcd_id = mqa04_compliance_documents.mcd_id',
            'left'
        )
        ->findAll();

    // Fetch all programme codes for the dropdown
    $docModel = new \App\Models\MqaComDocModel();
    $allProgrammeCodes = $docModel
        ->select('mcd_programme_code')
        ->groupBy('mcd_programme_code')
        ->findAll();

    // Fetch study modes for each program
    $studyModes = [];
    $studyModeModel = new \App\Models\StudyModeModel();
    foreach ($programs as $program) {
        $studyModes[$program->p_id] = $studyModeModel
            ->where('sm_p_id', $program->p_id)
            ->findAll();
    }

    $data = [
        'programs' => $programs,
        'allProgrammeCodes' => $allProgrammeCodes,
        'studyModes' => $studyModes
    ];
    return $this->render_admin('AdminProg', $data);
}

    public function editProgram($id)
{
    $programModel = new \App\Models\ProgramModel();
    $studyModeModel = new \App\Models\StudyModeModel();

    // Generate slug from qualification name
    $slug = $this->generateSlug($this->request->getPost('p_qualification_name'));

    $data = [
        'p_reference_number'    => $this->request->getPost('p_reference_number'),
        'p_qualification_name'  => $this->request->getPost('p_qualification_name'),
        'p_inst_name'           => $this->request->getPost('p_inst_name'),
        'p_qualification_level' => $this->request->getPost('p_qualification_level'),
        'p_nec_field'           => $this->request->getPost('p_nec_field'),
        'p_total_credits'       => $this->nullIfEmpty($this->request->getPost('p_total_credits')),
        'p_delivery_mode'       => $this->request->getPost('p_delivery_mode'),
        'p_certificate_number'  => $this->request->getPost('p_certificate_number'),
        'p_accreditation_date'  => $this->nullIfEmpty($this->request->getPost('p_accreditation_date')),
        'p_inst_address'        => $this->request->getPost('p_inst_address'),
        'p_phone_number'        => $this->request->getPost('p_phone_number'),
        'p_fax_number'          => $this->request->getPost('p_fax_number'),
        'p_email_address'       => $this->request->getPost('p_email_address'),
        'p_website'             => $this->request->getPost('p_website'),
        'p_compliance_audit'    => $this->request->getPost('p_compliance_audit'),
        'p_mqf_level'           => $this->request->getPost('p_mqf_level'),
        'p_slug'                => $slug, // <-- update slug here
    ];
    $programModel->update($id, $data);

    // 2. Programme code logic (same as your code)
    $mcd_programme_code = $this->request->getPost('mcd_programme_code');
    $p_mcd_id = $this->request->getPost('p_mcd_id');
    if ($mcd_programme_code) {
        $this->MqaComDocModel->insert([
            'mcd_programme_code' => $mcd_programme_code,
            'mcd_uploader' => session('user_id') ?? 'admin',
        ]);
        $new_mcd_id = $this->MqaComDocModel->getInsertID();
        $programModel->update($id, ['p_mcd_id' => $new_mcd_id]);
    }

    // 3. Update existing study modes (limit to 2 and allowed types)
    $allowedTypes = ['Sepenuh Masa', 'Separuh Masa'];
    $modes = $studyModeModel->where('sm_p_id', $id)->findAll();
    $updatedTypes = [];
    $count = 0;
    foreach ($modes as $mode) {
        if ($count >= 2) break; // Only update first two
        if (in_array($mode->sm_type, $allowedTypes)) {
            $studyModeModel->update($mode->sm_id, [
                'sm_long_sem' => $this->request->getPost('sm_long_sem_' . $mode->sm_id),
                'sm_short_sem' => $this->request->getPost('sm_short_sem_' . $mode->sm_id),
                'sm_long_sem_week' => $this->request->getPost('sm_long_sem_week_' . $mode->sm_id),
                'sm_short_sem_week' => $this->request->getPost('sm_short_sem_week_' . $mode->sm_id),
                'sm_long_sem_total' => $this->request->getPost('sm_long_sem_total_' . $mode->sm_id),
                'sm_short_sem_total' => $this->request->getPost('sm_short_sem_total_' . $mode->sm_id),
                'sm_duration' => $this->request->getPost('sm_duration_' . $mode->sm_id),
                'sm_type' => $this->request->getPost('sm_type_' . $mode->sm_id),
            ]);
            $updatedTypes[] = $mode->sm_type;
            $count++;
        }
    }

    // 4. Add new study modes if present, but only if less than 2 and not duplicate
    foreach ($allowedTypes as $type) {
        $key = strtolower(str_replace(' ', '_', $type));
        if (
            $this->request->getPost('sm_type_new_' . $key) &&
            !in_array($type, $updatedTypes) &&
            $count < 2
        ) {
            $studyModeModel->insert([
                'sm_p_id' => $id,
                'sm_type' => $type,
                'sm_long_sem' => $this->request->getPost('sm_long_sem_new_' . $key),
                'sm_short_sem' => $this->request->getPost('sm_short_sem_new_' . $key),
                'sm_long_sem_week' => $this->request->getPost('sm_long_sem_week_new_' . $key),
                'sm_short_sem_week' => $this->request->getPost('sm_short_sem_week_new_' . $key),
                'sm_long_sem_total' => $this->request->getPost('sm_long_sem_total_new_' . $key),
                'sm_short_sem_total' => $this->request->getPost('sm_short_sem_total_new_' . $key),
                'sm_duration' => $this->request->getPost('sm_duration_new_' . $key),
            ]);
            $count++;
        }
    }

    return redirect()->back()->with('success', 'Program updated successfully!');
}
   public function addProgram()
{
    $programModel = new \App\Models\ProgramModel();

    // Generate slug from qualification name
    $slug = $this->generateSlug($this->request->getPost('p_qualification_name'));

    $data = [
        'p_reference_number'    => $this->request->getPost('p_reference_number'),
        'p_qualification_name'  => $this->request->getPost('p_qualification_name'),
        'p_inst_name'           => $this->request->getPost('p_inst_name'),
        'p_qualification_level' => $this->request->getPost('p_qualification_level'),
        'p_nec_field'           => $this->request->getPost('p_nec_field'),
        'p_total_credits'       => $this->nullIfEmpty($this->request->getPost('p_total_credits')),
        'p_delivery_mode'       => $this->request->getPost('p_delivery_mode'),
        'p_certificate_number'  => $this->request->getPost('p_certificate_number'),
        'p_accreditation_date'  => $this->nullIfEmpty($this->request->getPost('p_accreditation_date')),
        'p_inst_address'        => $this->request->getPost('p_inst_address'),
        'p_phone_number'        => $this->request->getPost('p_phone_number'),
        'p_fax_number'          => $this->request->getPost('p_fax_number'),
        'p_email_address'       => $this->request->getPost('p_email_address'),
        'p_website'             => $this->request->getPost('p_website'),
        'p_compliance_audit'    => $this->request->getPost('p_compliance_audit'),
        'p_mqf_level'           => $this->request->getPost('p_mqf_level'),
        'p_slug'                => $slug, // <-- insert slug here
    ];
    $programModel->insert($data);
    $p_id = $programModel->getInsertID();

    // 2. Insert the compliance document with the programme code
    $programmeCode = $this->request->getPost('mcd_programme_code');
    $docData = [
        'mcd_programme_code' => $programmeCode,
        'mcd_uploader' => session('user_id') ?? 'admin',
    ];
    $this->MqaComDocModel->insert($docData);
    $mcd_id = $this->MqaComDocModel->getInsertID();

    // 3. Update the program with the mcd_id
    $programModel->update($p_id, ['p_mcd_id' => $mcd_id]);

    // 4. Insert study modes (limit to Sepenuh Masa and Separuh Masa only)
    $studyModeModel = $this->studyModeModel;
    $allowedTypes = ['Sepenuh Masa', 'Separuh Masa'];
    foreach ($allowedTypes as $type) {
        // Only insert if POST data for this type exists
        $key = strtolower(str_replace(' ', '_', $type));
        if ($this->request->getPost('sm_type_new_' . $key)) {
            $studyModeModel->insert([
                'sm_p_id' => $p_id,
                'sm_type' => $type,
                'sm_long_sem' => $this->request->getPost('sm_long_sem_new_' . $key),
                'sm_short_sem' => $this->request->getPost('sm_short_sem_new_' . $key),
                'sm_long_sem_week' => $this->request->getPost('sm_long_sem_week_new_' . $key),
                'sm_short_sem_week' => $this->request->getPost('sm_short_sem_week_new_' . $key),
                'sm_long_sem_total' => $this->request->getPost('sm_long_sem_total_new_' . $key),
                'sm_short_sem_total' => $this->request->getPost('sm_short_sem_total_new_' . $key),
                'sm_duration' => $this->request->getPost('sm_duration_new_' . $key),
            ]);
        }
    }

    return redirect()->back()->with('success', 'Program added successfully!');
}
    public function deleteProgram($id)
    {
        $programModel = new \App\Models\ProgramModel();
        $programModel->delete($id);
        return redirect()->back()->with('success', 'Program deleted successfully!');
    }
    public function deleteProgrammeCodeFile($itemId, $programmeCode)
    {
        // Only delete the document for this item and programme code
        $this->MqaComDocModel
            ->where('mcd_mci_id', $itemId)
            ->where('mcd_programme_code', $programmeCode)
            ->delete();

        return redirect()->back()->with('success', 'File for this programme code deleted successfully!');
    }
    public function deleteSection($sectionChar)
    {
        $sectionModel = new \App\Models\MqaComSectionModel();
        $itemModel = new \App\Models\MqaComItemModel();
        $docModel = new \App\Models\MqaComDocModel();

        // Find the section by char
        $section = $sectionModel->where('mcs_section_char', strtoupper($sectionChar))->first();
        if (!$section) {
            return redirect()->back()->with('error', 'Section not found');
        }

        // Get all items in this section
        $items = $itemModel->where('mci_mcs_id', $section->mcs_id)->findAll();

        // Delete all related documents and items
        foreach ($items as $item) {
            $docModel->where('mcd_mci_id', $item['mci_id'])->delete();
            $itemModel->delete($item['mci_id']);
        }

        // Delete the section itself
        $sectionModel->delete($section->mcs_id);

        return redirect()->back()->with('success', 'Section and all related items deleted successfully!');
    }
    protected function generateSlug($string)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
        // Ensure uniqueness
        $programModel = new \App\Models\ProgramModel();
        $baseSlug = $slug;
        $i = 1;
        while ($programModel->where('p_slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        return $slug;
    }
}


