<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Category</li>
        <li class="breadcrumb-item">Sub-category</li>
        <li class="breadcrumb-item active">Section A</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>

    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-globe'></i> Section B
            <sup class='badge badge-primary fw-500'>STICKER</sup>
            <small>Maklum Umum Pemberi Pendidikan Tinggi (PPT)</small>
        </h1>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <!-- Add New Item Form -->
                        <form method="post" action="<?= base_url('mqa/admin/sectionb/add') ?>" class="mb-4" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="sb_items" class="form-control" placeholder="Enter new item text..." required>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="sb_file" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-plus"></i> Add Item
                                    </button>
                                </div>
                            </div>
                        </form>

                        <?php if (!empty($sectionB)) : ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Perkara</th>
                                        <th>Lampiran Bukti</th>
                                        <th>Message</th>
                                        <th>Uploaded At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sectionB as $index => $item) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($item['sb_items']) ?></td>
                                            <td>
                                                <?php if (!empty($item['sb_file'])) : ?>
                                                    <a href="<?= base_url($item['sb_file']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">View File</a>
                                                <?php else : ?>
                                                    <span class="text-muted">No File</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= esc($item['sb_message'] ?? '') ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($item['sb_created_at'])) : ?>
                                                    <?= date('d-m-Y H:i:s', strtotime($item['sb_created_at'])) ?>
                                                <?php else : ?>
                                                    —
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $item['sb_id'] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $item['sb_id'] ?>">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p class="text-muted">No documents found.</p>
                        <?php endif; ?>
                    </div>
                    <!-- Add this panel-footer for navigation -->
                    <div class="panel-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary mt-3" onclick="goToAdminA()">
                            <i class="fas fa-arrow-left"></i> Go to Section A
                        </button>
                        <button type="button" class="btn btn-primary mt-3" onclick="goToSectionC()">
                            Go to Section C <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function goToSectionC() {
    window.location.href = "<?= base_url('mqa/admin/sectionc') ?>";
}
function goToAdminA() {
    window.location.href = "<?= base_url('mqa/admin/sectiona') ?>";
}
</script>

<!-- Edit and Delete Modals -->
<?php foreach ($sectionB as $item): ?>
<div class="modal fade" id="editModal<?= $item['sb_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $item['sb_id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('mqa/admin/sectionb/edit/' . $item['sb_id']) ?>" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel<?= $item['sb_id'] ?>">Edit Perkara & File</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Perkara</label>
            <input type="text" name="sb_items" class="form-control" value="<?= esc($item['sb_items']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Replace File (optional)</label>
            <input type="file" name="sb_file" class="form-control">
            <?php if (!empty($item['sb_file'])): ?>
              <small>Current: <a href="<?= base_url($item['sb_file']) ?>" target="_blank"><?= basename($item['sb_file']) ?></a></small>
            <?php endif; ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="deleteModal<?= $item['sb_id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $item['sb_id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('mqa/admin/sectionb/delete/' . $item['sb_id']) ?>">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel<?= $item['sb_id'] ?>">Confirm Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete "<strong><?= esc($item['sb_items']) ?></strong>"?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php endforeach; ?>