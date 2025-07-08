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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: none;
            transition: all 0.2s ease;
        }
        
        .btn-add {
            background-color: #007bff !important;
            color: white !important;
            border-color: #007bff !important;
        }

        .btn-add:hover {
            background-color: #0056b3 !important;
            color: white !important;
            border-color: #0056b3 !important;
            transform: translateY(-1px);
        }

        .btn-edit {
            background-color: #ffc107 !important;
            color: #212529 !important;
            border-color: #ffc107 !important;
        }

        .btn-edit:hover {
            background-color: #e0a800 !important;
            color: #212529 !important;
            border-color: #e0a800 !important;
            transform: translateY(-1px);
        }

        .btn-delete {
            background-color: #dc3545 !important;
            color: white !important;
            border-color: #dc3545 !important;
        }

        .btn-delete:hover {
            background-color: #c82333 !important;
            color: white !important;
            border-color: #c82333 !important;
            transform: translateY(-1px);
        }
        
        .btn-icon i {
            font-size: 14px;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h4 class="text-center mb-4">DOKUMEN PEMATUHAN AKREDITASI PROGRAM</h4>

    <?php
    use App\Models\MqaComSectionModel;
    use App\Models\MqaComItemModel;

    $sectionModel = new MqaComSectionModel();
    $itemModel = new MqaComItemModel();
    $sections = $sectionModel->orderBy('mcs_section_char', 'asc')->findAll();
    ?>

    <!-- Add Section Form -->
    <form method="post" action="<?= base_url('section/add') ?>" class="row g-2 mb-4">
        <?= csrf_field() ?>
        <div class="col-md-2">
            <input type="text" name="mcs_section_char" class="form-control" placeholder="Section (A-Z)" maxlength="1" required>
        </div>
        <div class="col-md-8">
            <input type="text" name="mcs_desc" class="form-control" placeholder="Section Description" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-icon btn-add w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Section">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </form>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Section Tabs -->
    <ul class="nav nav-tabs justify-content-center mb-4" id="sectionTabs" role="tablist">
        <?php foreach ($sections as $i => $section): ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $i === 0 ? 'active' : '' ?>" id="tab-<?= $section->mcs_section_char ?>" data-bs-toggle="tab" data-bs-target="#section-<?= $section->mcs_section_char ?>" type="button" role="tab" aria-controls="section-<?= $section->mcs_section_char ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>">
                    Section <?= esc($section->mcs_section_char) ?>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content" id="sectionTabsContent">
        <?php foreach ($sections as $i => $section): ?>
            <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="section-<?= $section->mcs_section_char ?>" role="tabpanel" aria-labelledby="tab-<?= $section->mcs_section_char ?>">
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
                                <button type="submit" class="btn btn-icon btn-add w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Item">
                                    <i class="fas fa-plus"></i>
                                </button>
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
                                    <td><?= esc($item->mci_responsibility ?? '-') ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-icon btn-edit" data-bs-toggle="modal" data-bs-target="#editItemModal<?= $item->mci_id ?>" title="Edit Item">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- Delete Button -->
                                            <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/delete-item/' . $item->mci_id) ?>" style="display:inline;" onsubmit="return confirm('Delete this item?');">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-icon btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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
                                                    <div class="mb-2">
                                                        <label>Responsibility</label>
                                                        <select name="mci_responsibility" class="form-control" required>
                                                            <option value="Penyelaras Program" <?= ($item->mci_responsibility === 'Penyelaras Program') ? 'selected' : '' ?>>Penyelaras Program</option>
                                                            <option value="BPQ" <?= ($item->mci_responsibility === 'BPQ') ? 'selected' : '' ?>>BPQ</option>
                                                            <option value="Fakulti" <?= ($item->mci_responsibility === 'Fakulti') ? 'selected' : '' ?>>Fakulti</option>
                                                        </select>
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
                        <!-- Delete Section Form -->
                        <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/delete') ?>" onsubmit="return confirm('Delete this section and all its items?');" style="display:inline;">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-icon btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Section">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center my-4">
        <a href="<?= base_url('AdminSec.php') ?>" class="btn btn-primary">Next Page</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
</body>
</html>