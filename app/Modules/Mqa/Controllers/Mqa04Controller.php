<?php

namespace Modules\Mqa\Controllers;

use App\Controllers\BaseController;
use App\Models\MqaComDocModel;
use App\Models\MqaComSectionModel;
use App\Models\MqaComItemModel;
use App\Models\ProgramModel; // Add this line

class Mqa04Controller extends BaseController
{
    protected $MqaComDocModel;
    protected $MqaComSectionModel;
    protected $MqaComItemModel;

    public function __construct()
    {
        $this->MqaComDocModel = new MqaComDocModel();
        $this->MqaComSectionModel = new MqaComSectionModel(); 
        $this->MqaComItemModel = new MqaComItemModel();
    }

    public function seca()
    {
        // Section A
        $sectionA = $this->MqaComSectionModel
            ->where('mcs_section_char', 'A')
            ->first();

        $itemsA = [];
        if ($sectionA) {
            $itemsA = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, 
                          mqa04_compliance_documents.mcd_id, 
                          mqa04_compliance_documents.mcd_file, 
                          mqa04_compliance_documents.mcd_original_file_name, 
                          mqa04_compliance_documents.mcd_new_file_name, 
                          mqa04_compliance_documents.mcd_programme_code,
                          mqa04_compliance_documents.mcd_message') // <-- add this line
                ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id', 'left')
                ->where('mqa04_compliance_item.mci_mcs_id', $sectionA->mcs_id)
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        // Section B
        $sectionB = $this->MqaComSectionModel
            ->where('mcs_section_char', 'B')
            ->first();

        $itemsB = [];
        if ($sectionB) {
            $itemsB = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, 
                          mqa04_compliance_documents.mcd_id, 
                          mqa04_compliance_documents.mcd_file, 
                          mqa04_compliance_documents.mcd_original_file_name, 
                          mqa04_compliance_documents.mcd_new_file_name, 
                          mqa04_compliance_documents.mcd_programme_code,
                          mqa04_compliance_documents.mcd_message') // <-- add this line
                ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id', 'left')
                ->where('mqa04_compliance_item.mci_mcs_id', $sectionB->mcs_id)
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        $data = [
            'sectionA' => $sectionA,
            'itemsA'   => $itemsA,
            'sectionB' => $sectionB,
            'itemsB'   => $itemsB,
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

    public function adminSec()
    {
        // Section A
        $sectionA = $this->MqaComSectionModel
            ->where('mcs_section_char', 'A')
            ->first();

        $itemsA = [];
        if ($sectionA) {
            $itemsA = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, 
                          mqa04_compliance_documents.mcd_id, 
                          mqa04_compliance_documents.mcd_file, 
                          mqa04_compliance_documents.mcd_original_file_name, 
                          mqa04_compliance_documents.mcd_new_file_name, 
                          mqa04_compliance_documents.mcd_programme_code,
                          mqa04_compliance_documents.mcd_message')
                ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id', 'left')
                ->where('mqa04_compliance_item.mci_mcs_id', $sectionA->mcs_id)
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        // Section B
        $sectionB = $this->MqaComSectionModel
            ->where('mcs_section_char', 'B')
            ->first();

        $itemsB = [];
        if ($sectionB) {
            $itemsB = $this->MqaComItemModel
                ->select('mqa04_compliance_item.*, 
                          mqa04_compliance_documents.mcd_id, 
                          mqa04_compliance_documents.mcd_file, 
                          mqa04_compliance_documents.mcd_original_file_name, 
                          mqa04_compliance_documents.mcd_new_file_name, 
                          mqa04_compliance_documents.mcd_programme_code,
                          mqa04_compliance_documents.mcd_message')
                ->join('mqa04_compliance_documents', 'mqa04_compliance_documents.mcd_mci_id = mqa04_compliance_item.mci_id', 'left')
                ->where('mqa04_compliance_item.mci_mcs_id', $sectionB->mcs_id)
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        $data = [
            'sectionA' => $sectionA,
            'itemsA'   => $itemsA,
            'sectionB' => $sectionB,
            'itemsB'   => $itemsB,
        ];

        return $this->render_admin('AdminSec', $data);
    }

    public function adminProg() // Add this function
    {
        $programModel = new ProgramModel();
        $programs = $programModel->findAll();

        $data = [
            'programs' => $programs
        ];

        return $this->render_admin('AdminProg', $data);
    }

    public function editProgram($id)
    {
        $data = [
            'p_reference_number'    => $this->request->getPost('p_reference_number'),
            'p_qualification_name'  => $this->request->getPost('p_qualification_name'),
            'p_inst_name'           => $this->request->getPost('p_inst_name'),
            'p_mcd_id'              => $this->request->getPost('mcd_programme_code'),
            'p_qualification_level' => $this->request->getPost('p_qualification_level'),
            'p_nec_field'           => $this->request->getPost('p_nec_field'),
            'p_total_credits'       => $this->request->getPost('p_total_credits'),
            'p_delivery_mode'       => $this->request->getPost('p_delivery_mode'),
            // Add other fields as needed
        ];
        $programModel = new \App\Models\ProgramModel();
        $programModel->update($id, $data);
        return redirect()->back()->with('success', 'Program updated successfully.');
    }

    public function adminSection($sectionChar = null)
    {
        $section = $this->MqaComSectionModel
            ->where('mcs_section_char', $sectionChar)
            ->first();

        $items = [];
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
                ->orderBy('mqa04_compliance_item.mci_sequence', 'asc')
                ->findAll();
        }

        $data = [
            'section' => $section,
            'items'   => $items,
            'sectionChar' => $sectionChar,
        ];

        return $this->render_admin('AdminSection', $data);
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

        $section = $sectionModel->where('mcs_section_char', strtoupper($sectionChar))->first();
        if (!$section) {
            return redirect()->back()->with('error', 'Section not found');
        }

        $itemModel->insert([
            'mci_mcs_id' => $section->mcs_id,
            'mci_desc' => $this->request->getPost('mci_desc'),
            'mci_sequence' => $this->request->getPost('mci_sequence'),
        ]);
        return redirect()->back()->with('success', 'Item added');
    }
    public function editItem2($sectionChar, $itemId)
    {
        $itemModel = new \App\Models\MqaComItemModel();
        $itemModel->update($itemId, [
            'mci_desc' => $this->request->getPost('mci_desc'),
            'mci_sequence' => $this->request->getPost('mci_sequence'),
        ]);
        return redirect()->back()->with('success', 'Item updated');
    }

    public function deleteItem2($sectionChar, $itemId)
    {
        $itemModel = new \App\Models\MqaComItemModel();
        $itemModel->delete($itemId);
        return redirect()->back()->with('success', 'Item deleted');
    }

}

