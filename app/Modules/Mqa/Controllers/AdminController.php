<?php

namespace Modules\Mqa\Controllers;
use CodeIgniter\HTTP\Files\UploadedFile;


use App\Controllers\BaseController;
use App\Models\ProgramModel;
use App\Models\SectionAModel;
use App\Models\SectionBModel;
use App\Models\SectionCModel;


class AdminController extends BaseController
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
     public function admin()
{
    $sectionAData = $this->sectionAModel->findAll();

    $data = [
        'title' => 'MQA Page',
        'sectionA' => $sectionAData
    ];

    return $this->render_admin('admin\sectiona\AdminA', $data);
}
   public function adminA()
{
    $sectionAData = $this->sectionAModel->findAll();

    $data = [
        'title' => 'MQA Page',
        'sectionA' => $sectionAData
    ];

    return $this->render_admin('admin\sectiona\AdminA', $data);
}

public function adminB()
{
    $sectionBData = $this->sectionBModel->findAll();
    $data = [
        'sectionB' => $sectionBData
    ];
    return $this->render_admin('admin/AdminB', $data);
}

// Show Section C admin page
public function adminC()
{
    $sectionCData = $this->sectionCModel->findAll();
    $data = [
        'sectionC' => $sectionCData
    ];
    return $this->render_admin('admin/AdminC', $data);
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

    public function saveSectionA()
    {
        $model = new SectionAModel();
        $files = $this->request->getFiles();
        $items = $this->request->getPost('sa_items');

        if ($files && isset($files['sa_file']) && is_array($files['sa_file'])) {
            foreach ($files['sa_file'] as $index => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/sectiona/', $newName);

                    $model->save([
                        'sa_file' => 'uploads/sectiona/' . $newName,
                        'sa_items' => $items[$index] ?? 'Unknown'
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Documents uploaded successfully!');
    }
    
    public function addSectionA()
    {
        $itemText = $this->request->getPost('sa_items');
        if ($itemText) {
            $this->sectionAModel->insert([
                'sa_items' => $itemText
            ]);
            return redirect()->back()->with('success', 'Item added successfully!');
        }
        return redirect()->back()->with('error', 'Please enter item text.');
    }
    
    public function editSectionA($id)
    {
        $data = [];
        $sa_items = $this->request->getPost('sa_items');
        $file = $this->request->getFile('sa_file');

        // Update text
        if ($sa_items !== null) {
            $data['sa_items'] = $sa_items;
        }

        // Update file if uploaded
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/sectiona/', $newName);
            $data['sa_file'] = 'uploads/sectiona/' . $newName;
        }

        if (!empty($data)) {
            $this->sectionAModel->update($id, $data);
            return redirect()->back()->with('success', 'Item updated successfully!');
        }
        return redirect()->back()->with('error', 'No changes made.');
    }
    public function deleteSectionA($id)
    {
        $this->sectionAModel->delete($id);
        return redirect()->back()->with('success', 'Item deleted successfully!');
    }
    
    // Add new Section B item
    public function addSectionB()
    {
        $sb_items = $this->request->getPost('sb_items');
        $file = $this->request->getFile('sb_file');
        $data = ['sb_items' => $sb_items];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/sectionb/', $newName);
            $data['sb_file'] = 'uploads/sectionb/' . $newName;
        }

        $this->sectionBModel->insert($data);
        return redirect()->back()->with('success', 'Item added successfully!');
    }

    // Edit Section B item
    public function editSectionB($id)
    {
        $sb_items = $this->request->getPost('sb_items');
        $file = $this->request->getFile('sb_file');
        $data = ['sb_items' => $sb_items];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/sectionb/', $newName);
            $data['sb_file'] = 'uploads/sectionb/' . $newName;
        }

        $this->sectionBModel->update($id, $data);
        return redirect()->back()->with('success', 'Item updated successfully!');
    }

    // Delete Section B item
    public function deleteSectionB($id)
    {
        $this->sectionBModel->delete($id);
        return redirect()->back()->with('success', 'Item deleted successfully!');
    }

    // Add new Section C item
    public function addSectionC()
    {
        $data = [
            'sc_items'   => $this->request->getPost('sc_items'),
            'sc_message' => $this->request->getPost('sc_message'),
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

    // Edit Section C item
    public function editSectionC($id)
    {
        $sc_items = $this->request->getPost('sc_items');
        $sc_message = $this->request->getPost('sc_message'); // <-- add this line
        $file = $this->request->getFile('sc_file');
        $data = [
            'sc_items' => $sc_items,
            'sc_message' => $sc_message // <-- add this line
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/sectionc/', $newName);
            $data['sc_file'] = 'uploads/sectionc/' . $newName;
        }

        $this->sectionCModel->update($id, $data);
        return redirect()->back()->with('success', 'Item updated successfully!');
    }

    // Delete Section C item
    public function deleteSectionC($id)
    {
        $this->sectionCModel->delete($id);
        return redirect()->back()->with('success', 'Item deleted successfully!');
    }
}



