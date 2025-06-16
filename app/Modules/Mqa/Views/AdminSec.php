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
    <title>Admin Evidence & Message Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h4 class="text-center mb-4">ADMIN: EVIDENCE FILE & MESSAGE</h4>

    <!-- SECTION A -->
    <h5 class="mb-4">SECTION A: <?= esc($sectionA->mcs_desc ?? '') ?></h5>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addItemModalA">Add Item</button>
    <table class="table table-bordered">
        <thead class="table-secondary">
        <tr>
            <th style="width: 5%;">NO.</th>
            <th style="width: 15%;">PROGRAMME CODE</th> <!-- Added column -->
            <th style="width: 20%;">PERKARA</th>
            <th style="width: 25%;">EVIDENCE FILE</th>
            <th style="width: 25%;">MESSAGE</th>
            <th style="width: 25%;">ACTION</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($itemsA as $index => $item): ?>
            <tr>
                <td><?= $index + 1 ?>.</td>
                <td><?= esc($item->mcd_programme_code ?? '-') ?></td> <!-- Programme Code -->
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
                    <form method="post" action="<?= base_url('seca/delete-item/' . $item->mci_id) ?>" style="display:inline;" onsubmit="return confirm('Padam item ini?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    <button type="button" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#editModalA<?= $item->mci_id ?>">
                        Edit
                    </button>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModalA<?= $item->mci_id ?>" tabindex="-1" aria-labelledby="editModalLabelA<?= $item->mci_id ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" action="<?= base_url('seca/edit-item/' . $item->mci_id) ?>" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabelA<?= $item->mci_id ?>">Edit Evidence & Message</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
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
    <div class="modal fade" id="addItemModalA" tabindex="-1" aria-labelledby="addItemModalLabelA" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="<?= base_url('seca/add-item') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="addItemModalLabelA">Add Item to Section A</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Programme Code -->
                        <div class="mb-3">
                            <label class="form-label">Programme Code</label>
                            <input type="text" name="mcd_programme_code" class="form-control" required>
                        </div>
                        <!-- Perkara -->
                        <div class="mb-3">
                            <label class="form-label">Perkara</label>
                            <input type="text" name="mci_desc" class="form-control" required>
                        </div>
                        <!-- Evidence File (upload) -->
                        <div class="mb-3">
                            <label class="form-label">Evidence File</label>
                            <input type="file" name="mcd_file" class="form-control" required>
                        </div>
                        <!-- Message -->
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <input type="text" name="mcd_message" class="form-control" required>
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

    <!-- SECTION B -->
    <?php if (!empty($sectionB)): ?>
        <h5 class="mt-5 mb-4">SECTION B: <?= esc($sectionB->mcs_desc ?? '') ?></h5>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addItemModalB">Add Item</button>
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
            <?php foreach ($itemsB as $index => $item): ?>
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
                        <form method="post" action="<?= base_url('seca/delete-item/' . $item->mci_id) ?>" style="display:inline;" onsubmit="return confirm('Padam item ini?');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        <button type="button" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#editModalB<?= $item->mci_id ?>">
                            Edit
                        </button>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModalB<?= $item->mci_id ?>" tabindex="-1" aria-labelledby="editModalLabelB<?= $item->mci_id ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="<?= base_url('seca/edit-item/' . $item->mci_id) ?>" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabelB<?= $item->mci_id ?>">Edit Evidence & Message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
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
        <div class="modal fade" id="addItemModalB" tabindex="-1" aria-labelledby="addItemModalLabelB" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="<?= base_url('seca/add-item') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="addItemModalLabelB">Add Item to Section B</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Programme Code -->
                            <div class="mb-3">
                                <label class="form-label">Programme Code</label>
                                <input type="text" name="mcd_programme_code" class="form-control" required>
                            </div>
                            <!-- Perkara -->
                            <div class="mb-3">
                                <label class="form-label">Perkara</label>
                                <input type="text" name="mci_desc" class="form-control" required>
                            </div>
                            <!-- Evidence File (upload) -->
                            <div class="mb-3">
                                <label class="form-label">Evidence File</label>
                                <input type="file" name="mcd_file" class="form-control" required>
                            </div>
                            <!-- Message -->
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <input type="text" name="mcd_message" class="form-control" required>
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
    <?php endif; ?>

    <div class="text-center my-4">
        <a href="<?= base_url('SecA.php') ?>" class="btn btn-secondary">Back</a>
    </div>
    <!-- Add this section for the button -->
    <div class="mb-4 text-end">
        <a href="<?= base_url('adminprog') ?>" class="btn btn-primary">Go to Admin Program</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>