<?php

namespace Modules\Mqa\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgramModel;
use App\Models\MqaComDocModel;
use App\Models\MqaComSectionModel;
use App\Models\MqaComItemModel;


class ProgramController extends BaseController
{
    protected $MqaComDocModel;
    protected $MqaComSectionModel;
    protected $MqaComItemModel;
    protected $programModel;

    public function __construct()
    {
        $this->MqaComDocModel = new MqaComDocModel();
        $this->MqaComSectionModel = new MqaComSectionModel(); 
        $this->MqaComItemModel = new MqaComItemModel();
        $this->programModel = new ProgramModel();
    }

    public function index()
    {
        $programs = $this->programModel
            ->select('program.*, mqa04_compliance_documents.mcd_programme_code')
            ->join(
                'mqa04_compliance_documents',
                'mqa04_compliance_documents.mcd_programme_code = CAST(program.p_mcd_id AS TEXT)',
                'left'
            )
            ->findAll();
        $data = ['programs' => $programs];
        return $this->render_admin('ProgramSec', $data);
    }

    public function Pub04()
    {
        $programme_code = $this->request->getGet('programme_code');

        // Section A
        $sectionA = $this->MqaComSectionModel
            ->where('mcs_section_char', 'A')
            ->first();

        $itemsA = [];
        if ($sectionA) {
            $itemsA = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, mqa04_compliance_documents.mcd_id, mqa04_compliance_documents.mcd_file, mqa04_compliance_documents.mcd_original_file_name, mqa04_compliance_documents.mcd_new_file_name, mqa04_compliance_documents.mcd_programme_code, mqa04_compliance_documents.mcd_message')
                ->join('mqa04_compliance_documents', "mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id AND mqa04_compliance_documents.mcd_programme_code = " . $this->MqaComItemModel->db->escape($programme_code), 'left')
                ->where('mqa04_compliance_item.mci_mcs_id', $sectionA->mcs_id)
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        // Attach related program object to each item
        $program = $this->programModel
            ->where('p_mcd_id', $programme_code)
            ->first();

        foreach ($itemsA as $item) {
            $item->program = $program;
        }

        // Section B
        $sectionB = $this->MqaComSectionModel
            ->where('mcs_section_char', 'B')
            ->first();

        $itemsB = [];
        if ($sectionB) {
            $itemsB = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, mqa04_compliance_documents.mcd_id, mqa04_compliance_documents.mcd_file, mqa04_compliance_documents.mcd_original_file_name, mqa04_compliance_documents.mcd_new_file_name, mqa04_compliance_documents.mcd_programme_code, mqa04_compliance_documents.mcd_message')
                ->join('mqa04_compliance_documents', "mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id AND mqa04_compliance_documents.mcd_programme_code = " . $this->MqaComItemModel->db->escape($programme_code), 'left')
                ->where('mqa04_compliance_item.mci_mcs_id', $sectionB->mcs_id)
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        $data = [
            'sectionA' => $sectionA,
            'itemsA'   => $itemsA,
            'sectionB' => $sectionB,
            'itemsB'   => $itemsB,
            'programme_code' => $programme_code,
        ];

        return $this->render_admin('PubA', $data);
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

    public function editMessage($id)
    {
        $programme_code = $this->request->getPost('programme_code');
        $message = $this->request->getPost('mcd_message');
        // Find the document by item id and programme code
        $doc = $this->MqaComDocModel
            ->where('mcd_mci_id', $id)
            ->where('mcd_programme_code', $programme_code)
            ->first();
        if ($doc) {
            $this->MqaComDocModel->update($doc['mcd_id'], ['mcd_message' => $message]);
        }
        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}

