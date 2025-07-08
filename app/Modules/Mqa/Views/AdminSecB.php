<!DOCTYPE html>
<html>
<head>
    <title>Admin Evidence & Message Table</title>
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
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Category</li>
        <li class="breadcrumb-item">Sub-category</li>
        <li class="breadcrumb-item active">Page Title</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="container mt-5">
        <h4 class="text-center mb-4">ADMIN: EVIDENCE FILE & MESSAGE</h4>

        <?php foreach ($sections as $section): ?>
            <h5 class="mb-4">SECTION <?= esc($section->mcs_section_char) ?>: <?= esc($section->mcs_desc) ?></h5>
            <button class="btn btn-icon btn-add mb-3" data-bs-toggle="modal" data-bs-target="#addItemModal<?= esc($section->mcs_section_char) ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Item">
                <i class="fas fa-plus"></i>
            </button>
            <table class="table table-bordered">
                <thead class="table-secondary">
                <tr>
                    <th style="width: 5%;">NO.</th>
                    <th style="width: 15%;">PROGRAMME CODE</th>
                    <th style="width: 20%;">PERKARA</th>
                    <th style="width: 25%;">EVIDENCE FILE</th>
                    <th style="width: 25%;">MESSAGE</th>
                    <th style="width: 25%;">ACTION</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($section->items as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?>.</td>
                        <td><?= esc($item->mcd_programme_code ?? '-') ?></td>
                        <td><?= esc($item->mci_desc) ?></td>
                        <td>
                            <?php if (!empty($item->mcd_id)): ?>
                                <div>
                                    <a href="<?= base_url($item->mcd_file) ?>" target="_blank">
                                        <?= esc($item->mcd_original_file_name) ?>
                                    </a>
                                </div>
                            <?php else: ?>
                                <span class="text-muted">No file</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($item->mcd_message ?? '') ?></td>
                        <td>
                            <div class="action-buttons">
                                <!-- Edit Item Button (icon only, with tooltip) -->
                                <button type="button" class="btn btn-icon btn-edit" data-bs-toggle="modal" data-bs-target="#editModal<?= esc($section->mcs_section_char) ?><?= $item->mci_id ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Item">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Delete Item Button (icon only, with tooltip) -->
                                <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/delete-item/' . $item->mci_id) ?>" style="display:inline;" onsubmit="return confirm('Delete this item and all related files?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-icon btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= esc($section->mcs_section_char) ?><?= $item->mci_id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= esc($section->mcs_section_char) ?><?= $item->mci_id ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/edit-item/' . $item->mci_id) ?>" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?= esc($section->mcs_section_char) ?><?= $item->mci_id ?>">Edit Evidence & Message</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Perkara -->
                                                <div class="mb-3">
                                                    <label class="form-label">Perkara</label>
                                                    <input type="text" name="mci_desc" class="form-control" value="<?= esc($item->mci_desc) ?>" required>
                                                </div>
                                                <!-- Responsibility -->
                                                <div class="mb-3">
                                                    <label class="form-label">Responsibility</label>
                                                    <select name="mci_responsibility" class="form-control" required>
                                                        <option value="Penyelaras Program" <?= ($item->mci_responsibility === 'Penyelaras Program') ? 'selected' : '' ?>>Penyelaras Program</option>
                                                        <option value="BPQ" <?= ($item->mci_responsibility === 'BPQ') ? 'selected' : '' ?>>BPQ</option>
                                                        <option value="Fakulti" <?= ($item->mci_responsibility === 'Fakulti') ? 'selected' : '' ?>>Fakulti</option>
                                                    </select>
                                                </div>
                                                <!-- Evidence File (replace) -->
                                                <div class="mb-3">
                                                    <label class="form-label">Replace Evidence File</label>
                                                    <input type="file" name="mcd_file" class="form-control">
                                                </div>
                                                <!-- Message -->
                                                <div class="mb-3">
                                                    <label class="form-label">Message</label>
                                                    <input type="text" name="mcd_message" class="form-control" value="<?= esc($item->mcd_message ?? '') ?>">
                                                </div>
                                                <input type="hidden" name="mcd_programme_code" value="<?= esc($item->mcd_programme_code) ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Add Item Modal -->
            <div class="modal fade" id="addItemModal<?= esc($section->mcs_section_char) ?>" tabindex="-1" aria-labelledby="addItemModalLabel<?= esc($section->mcs_section_char) ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/add-item') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="addItemModalLabel<?= esc($section->mcs_section_char) ?>">Add Item to Section <?= esc($section->mcs_section_char) ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Perkara -->
                                <div class="mb-3">
                                    <label class="form-label">Perkara</label>
                                    <input type="text" name="mci_desc" class="form-control" required>
                                </div>
                                <!-- Responsibility -->
                                <div class="mb-3">
                                    <label class="form-label">Responsibility</label>
                                    <select name="mci_responsibility" class="form-control" required>
                                        <option value="Penyelaras Program">Penyelaras Program</option>
                                        <option value="BPQ">BPQ</option>
                                        <option value="Fakulti">Fakulti</option>
                                    </select>
                                </div>
                                <!-- Sequence -->
                                <div class="mb-3">
                                    <label class="form-label">Sequence</label>
                                    <input type="number" name="mci_sequence" class="form-control" required>
                                </div>
                                <!-- Evidence File -->
                                <div class="mb-3">
                                    <label class="form-label">Evidence File</label>
                                    <input type="file" name="mcd_file" class="form-control">
                                </div>
                                <!-- Message -->
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <input type="text" name="mcd_message" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add Item</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="d-flex justify-content-between align-items-center mb-4 gap-2">
            <a href="<?= base_url('SecA.php') ?>" class="btn btn-secondary">&larr; Back</a>
            <a href="<?= base_url('AdminSec.php?section=A') ?>" class="btn btn-primary">Go to Section A</a>
            <a href="<?= base_url('AdminSecC.php?section=C') ?>" class="btn btn-primary">Go to Section C</a>
            <a href="<?= base_url('adminprog') ?>" class="btn btn-primary">Go to Admin Program</a>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize tooltips for all buttons with data-bs-toggle="tooltip"
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
</body>
</html>
<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>