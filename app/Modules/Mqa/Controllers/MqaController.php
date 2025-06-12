<?php

namespace Modules\Mqa\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgramModel;
use App\Models\SectionAModel;
use App\Models\SectionBModel;
use App\Models\SectionCModel; 


class MqaController extends BaseController
{
    protected $programModel;
    protected $sectionAModel;
    protected $sectionBModel;
    protected $sectionCModel;

    public function __construct()
    
    {
        $this->programModel = new ProgramModel();
        $this->sectionAModel = new SectionAModel();
        $this->sectionBModel = new SectionBModel(); 
        $this->sectionCModel = new SectionCModel();
    }

    public function index()
    {
        $data = ['title' => 'MQA Page'];
        return $this->render_mqa('mqa', $data);
    }
    public function render_mqa($view, $data)
    {
        $view_path = 'Modules\\Mqa\\Views\\' . $view;

        $array = [
            'data' => $data,
            'view' => $view_path
        ];

        echo view('layout/main', $array);
    }
   public function public($segment = null)
{
    // Get existing data or create empty array
    $existingData = $this->sectionAModel->first() ?? [];

    $items = $this->sectionAModel->findAll();
    
    // Define documents structure
    // $documents = [
    //     [
    //         'sa_items' => 'Surat penubuhan [IPTA/IPTS]',
    //         'field_name' => 'sa_file_1',
    //         'notes' => 'Required document for establishment'
    //     },
    //     [
    //         'sa_items' => 'Carta Organisasi',
    //         'field_name' => 'sa_file_2',
    //         'notes' => ''
    //     ]
    // ];
    
    $data = [
        'title' => 'MQA Section A',
        'items' => $items,
        'existingData' => $existingData,
        'segment' => $segment // Pass the URL segment if needed
    ];
    
    return $this->render_admin('section_a', $data);
}

 public function saveSectionA()
{
    helper(['form', 'url']);

    $files = $this->request->getFiles(); // 'sa_file' => [id => file]
    $messages = $this->request->getPost('sa_message'); // array: [id => message]
    $uploadPath = FCPATH . 'uploads/';

    if (isset($files['sa_file']) && is_array($files['sa_file'])) {
        foreach ($files['sa_file'] as $id => $file) {
            $data = [];
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $data['sa_file'] = 'uploads/' . $newName;
            }
            if (isset($messages[$id])) {
                $data['sa_message'] = $messages[$id];
            }
            if (!empty($data)) {
                $this->sectionAModel->update($id, $data);
            }
        }
    }

    // Also update messages for items even if no file is uploaded
    if (is_array($messages)) {
        foreach ($messages as $id => $msg) {
            if ($msg !== '') {
                $this->sectionAModel->update($id, ['sa_message' => $msg]);
            }
        }
    }

    return redirect()->back()->with('success', 'Documents and messages uploaded successfully!');
}

public function sectionA()
{
    $items = $this->sectionAModel->findAll();
    $data = [
        'items' => $items
    ];
    return $this->render_admin('section_a', $data);
}

// For public page
public function sectionB()
{
    $sectionBModel = new \App\Models\SectionBModel();
    $items = $sectionBModel->findAll();
    $data = [
        'items' => $items
    ];
    return $this->render_admin('section_b', $data);
}

    // Show Section C public page
    public function sectionC()
    {
        $items = $this->sectionCModel->findAll();
        $data = [
            'items' => $items
        ];
        return $this->render_admin('section_c', $data);
    }

    // Handle Section C uploads/messages
    public function saveSectionC()
    {
        helper(['form', 'url']);
        $files = $this->request->getFiles(); // 'sc_file' => [id => file]
        $messages = $this->request->getPost('sc_message'); // array: [id => message]
        $uploadPath = FCPATH . 'uploads/sectionc/';

        if (isset($files['sc_file']) && is_array($files['sc_file'])) {
            foreach ($files['sc_file'] as $id => $file) {
                $data = [];
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move($uploadPath, $newName);
                    $data['sc_file'] = 'uploads/sectionc/' . $newName;
                }
                if (isset($messages[$id])) {
                    $data['sc_message'] = $messages[$id];
                }
                if (!empty($data)) {
                    $this->sectionCModel->update($id, $data);
                }
            }
        }

        // Also update messages for items even if no file is uploaded
        if (is_array($messages)) {
            foreach ($messages as $id => $msg) {
                if ($msg !== '') {
                    $this->sectionCModel->update($id, ['sc_message' => $msg]);
                }
            }
        }

        return redirect()->back()->with('success', 'Documents and messages uploaded successfully!');
    }

    // Add Section C
    public function addSectionC()
    {
        $data = [
            'sc_items'   => $this->request->getPost('sc_items'),
            'sc_message' => $this->request->getPost('sc_message'), // can be empty
        ];

        $file = $this->request->getFile('sc_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/sectionc/', $newName);
            $data['sc_file'] = 'uploads/sectionc/' . $newName;
        }

        $this->sectionCModel->insert($data);
        return redirect()->back()->with('success', 'Item added successfully!');
    }

    // Edit Section C
    public function editSectionC($id)
    {
        $data = [
            'sc_items'   => $this->request->getPost('sc_items'),
            'sc_message' => $this->request->getPost('sc_message'), // can be empty or unchanged
        ];

        $file = $this->request->getFile('sc_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/sectionc/', $newName);
            $data['sc_file'] = 'uploads/sectionc/' . $newName;
        }

        $this->sectionCModel->update($id, $data);
        return redirect()->back()->with('success', 'Item updated successfully!');
    }
}
