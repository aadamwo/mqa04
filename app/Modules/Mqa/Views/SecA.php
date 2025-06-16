<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Category</li>
        <li class="breadcrumb-item">Sub-category</li>
        <li class="breadcrumb-item active">Page Title</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
<!DOCTYPE html>
<html>
<head>
    <title>Dokumen Pematuhan Akreditasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h4 class="text-center mb-4">DOKUMEN PEMATUHAN AKREDITASI PROGRAM</h4>
    <h5 class="mb-4">BAHAGIAN A: <?= esc($sectionA->mcs_desc ?? '') ?></h5>

    <?php
    use App\Models\MqaComSectionModel;
    use App\Models\MqaComItemModel;

    $sectionModel = new MqaComSectionModel();
    $itemModel = new MqaComItemModel();
    $sections = $sectionModel->orderBy('mcs_section_char', 'asc')->findAll();
    ?>

    <!-- Add Section Form (only one) -->
    <form method="post" action="<?= base_url('section/add') ?>" class="row g-2 mb-4">
        <?= csrf_field() ?>
        <div class="col-md-2">
            <input type="text" name="mcs_section_char" class="form-control" placeholder="Section (A-Z)" maxlength="1" required>
        </div>
        <div class="col-md-8">
            <input type="text" name="mcs_desc" class="form-control" placeholder="Section Description" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Add Section</button>
        </div>
    </form>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Display All Sections and Their Items with CRUD -->
    <?php foreach ($sections as $section): ?>
        <div class="card mb-4">
            <div class="card-header">
                <strong>Section <?= esc($section->mcs_section_char) ?>:</strong> <?= esc($section->mcs_desc) ?>
            </div>
            <div class="card-body">
                <!-- Add Item Form -->
                <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/add-item') ?>" class="row g-2 mb-3">
                    <?= csrf_field() ?>
                    <div class="col-md-6">
                        <input type="text" name="mci_desc" class="form-control" placeholder="Item Description" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="mci_sequence" class="form-control" placeholder="Sequence" required>
                    </div>
                    <div class="col-md-2">
                        <select name="mci_responsibility" class="form-control" required>
                            <option value="">Responsibility</option>
                            <option value="Penyelaras Program">Penyelaras Program</option>
                            <option value="BPQ">BPQ</option>
                            <option value="Fakulti">Fakulti</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Add Item</button>
                    </div>
                </form>
                <!-- List Items -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Seq</th>
                            <th>Description</th>
                            <th>Responsibility</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $items = $itemModel->where('mci_mcs_id', $section->mcs_id)->orderBy('mci_sequence', 'asc')->findAll();
                    foreach ($items as $item): ?>
                        <tr>
                            <td><?= esc($item->mci_sequence) ?></td>
                            <td><?= esc($item->mci_desc) ?></td>
                            <td><?= esc($item->mci_responsibility) ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editItemModal<?= $item->mci_id ?>">
                                    Edit
                                </button>
                                <!-- Delete Button -->
                                <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/delete-item/' . $item->mci_id) ?>" style="display:inline;" onsubmit="return confirm('Delete this item?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Item Modal -->
                        <div class="modal fade" id="editItemModal<?= $item->mci_id ?>" tabindex="-1" aria-labelledby="editItemLabel<?= $item->mci_id ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/edit-item/' . $item->mci_id) ?>">
                                        <?= csrf_field() ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editItemLabel<?= $item->mci_id ?>">Edit Item</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label>Description</label>
                                                <input type="text" name="mci_desc" class="form-control" value="<?= esc($item->mci_desc) ?>" required>
                                            </div>
                                            <div class="mb-2">
                                                <label>Sequence</label>
                                                <input type="number" name="mci_sequence" class="form-control" value="<?= esc($item->mci_sequence) ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
</div>

<div class="text-center my-4">
    <a href="<?= base_url('AdminSec.php') ?>" class="btn btn-primary">Next Page</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>