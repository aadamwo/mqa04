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

    <!-- Add Item to Section A -->
    <form method="post" action="<?= base_url('seca/add-item-a') ?>" class="row g-2 mb-4">
        <?= csrf_field() ?>
        <div class="col-md-5">
            <input type="text" name="mci_desc" class="form-control" placeholder="Perkara baru untuk Seksyen A" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="mci_sequence" class="form-control" placeholder="Susunan" required>
        </div>
        <div class="col-md-3">
            <select name="mci_responsibility" class="form-control">
                <option value="">Pilih Tanggungjawab (Pilihan)</option>
                <option value="Penyelaras Program">Penyelaras Program</option>
                <option value="BPQ">BPQ</option>
                <option value="Fakulti">Fakulti</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Tambah Item A</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th style="width: 5%;">BIL.</th>
                <th style="width: 25%;">PERKARA</th>
                <th style="width: 20%;">TANGGUNGJAWAB</th>
                <th style="width: 15%;">TINDAKAN</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($itemsA as $item): ?>
        <tr>
            <td><?= esc($item->mci_sequence) ?>.</td>
            <td><?= esc($item->mci_desc) ?></td>
            <td><?= esc($item->mci_responsibility) ?></td>
            <td>
                <!-- Edit/Delete buttons and modal as before -->
                <form method="post" action="<?= base_url('seca/delete-item/' . $item->mci_id) ?>" style="display:inline;" onsubmit="return confirm('Padam item ini?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-danger">Padam</button>
                </form>
                <button type="button" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $item->mci_id ?>">
                    Edit
                </button>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?= $item->mci_id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $item->mci_id ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form method="post" action="<?= base_url('seca/edit-item/' . $item->mci_id) ?>">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel<?= $item->mci_id ?>">Edit Item</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="mci_desc<?= $item->mci_id ?>" class="form-label">Perkara</label>
                            <input type="text" id="mci_desc<?= $item->mci_id ?>" name="mci_desc" class="form-control" value="<?= esc($item->mci_desc) ?>" required>
                          </div>
                          <div class="mb-3">
                            <label for="mci_responsibility<?= $item->mci_id ?>" class="form-label">Tanggungjawab</label>
                            <select id="mci_responsibility<?= $item->mci_id ?>" name="mci_responsibility" class="form-control">
                                <option value="">Pilih Tanggungjawab (Pilihan)</option>
                                <option value="Penyelaras Program" <?= ($item->mci_responsibility == 'Penyelaras Program') ? 'selected' : '' ?>>Penyelaras Program</option>
                                <option value="BPQ" <?= ($item->mci_responsibility == 'BPQ') ? 'selected' : '' ?>>BPQ</option>
                                <option value="Fakulti" <?= ($item->mci_responsibility == 'Fakulti') ? 'selected' : '' ?>>Fakulti</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

    <!-- Section B -->
    <?php if ($sectionB): ?>
        <h5 class="mt-5 mb-4">BAHAGIAN B: <?= esc($sectionB->mcs_desc ?? '') ?></h5>
        <!-- Add Item to Section B -->
        <form method="post" action="<?= base_url('seca/add-item-b') ?>" class="row g-2 mb-4">
            <?= csrf_field() ?>
            <div class="col-md-5">
                <input type="text" name="mci_desc" class="form-control" placeholder="Perkara baru untuk Seksyen B" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="mci_sequence" class="form-control" placeholder="Susunan" required>
            </div>
            <div class="col-md-3">
                <select name="mci_responsibility" class="form-control">
                    <option value="">Pilih Tanggungjawab (Pilihan)</option>
                    <option value="Penyelaras Program">Penyelaras Program</option>
                    <option value="BPQ">BPQ</option>
                    <option value="Fakulti">Fakulti</option>
                </select>
                
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Tambah Item B</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th style="width: 5%;">BIL.</th>
                    <th style="width: 25%;">PERKARA</th>
                    <th style="width: 20%;">TANGGUNGJAWAB</th>
                    <th style="width: 15%;">TINDAKAN</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($itemsB as $item): ?>
            <tr>
                <td><?= esc($item->mci_sequence) ?>.</td>
                <td><?= esc($item->mci_desc) ?></td>
                <td><?= esc($item->mci_responsibility) ?></td>
                <td>
                    <!-- Edit/Delete buttons and modal as before -->
                    <form method="post" action="<?= base_url('seca/delete-item/' . $item->mci_id) ?>" style="display:inline;" onsubmit="return confirm('Padam item ini?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-sm btn-danger">Padam</button>
                    </form>
                    <button type="button" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $item->mci_id ?>">
                        Edit
                    </button>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?= $item->mci_id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $item->mci_id ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="post" action="<?= base_url('seca/edit-item/' . $item->mci_id) ?>">
                            <?= csrf_field() ?>
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel<?= $item->mci_id ?>">Edit Item</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="mb-3">
                                <label for="mci_desc<?= $item->mci_id ?>" class="form-label">Perkara</label>
                                <input type="text" id="mci_desc<?= $item->mci_id ?>" name="mci_desc" class="form-control" value="<?= esc($item->mci_desc) ?>" required>
                              </div>
                              <div class="mb-3">
                                <label for="mci_responsibility<?= $item->mci_id ?>" class="form-label">Tanggungjawab</label>
                                <select id="mci_responsibility<?= $item->mci_id ?>" name="mci_responsibility" class="form-control">
                                    <option value="">Pilih Tanggungjawab (Pilihan)</option>
                                    <option value="Penyelaras Program" <?= ($item->mci_responsibility == 'Penyelaras Program') ? 'selected' : '' ?>>Penyelaras Program</option>
                                    <option value="BPQ" <?= ($item->mci_responsibility == 'BPQ') ? 'selected' : '' ?>>BPQ</option>
                                    <option value="Fakulti" <?= ($item->mci_responsibility == 'Fakulti') ? 'selected' : '' ?>>Fakulti</option>
                                </select>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Simpan</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
    <?php endif; ?>
</div>

<div class="text-center my-4">
    <a href="<?= base_url('AdminSec.php') ?>" class="btn btn-primary">AdminB</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>