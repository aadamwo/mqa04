<?php
// filepath: c:\laragon\www\mpquaapp\app\Modules\Mqa\Views\PubA.php
?>
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Category</li>
        <li class="breadcrumb-item">Sub-category</li>
        <li class="breadcrumb-item active">Page Title</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>


    <title>Accreditation Compliance Documents (Public)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container mt-5">
    <h4 class="text-center mb-4">ACCREDITATION COMPLIANCE DOCUMENTS (Public)</h4>

    <!-- Back button to ProgramSec -->
    <div class="mb-4">
        <a href="<?= base_url('program') ?>" class="btn btn-secondary">&larr; Back to Program List</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- SECTION A -->
    <h5 class="mb-4">SECTION A: <?= esc($sectionA->mcs_desc ?? '') ?></h5>
    <table class="table table-bordered">
        <thead class="table-secondary">
        <tr>
            <th style="width: 5%;">NO.</th>
            <th style="width: 25%;">ITEM</th>
            <th style="width: 20%;">RESPONSIBILITY</th>
            <th style="width: 10%;">PROGRAMME CODE</th>
            <th style="width: 35%;">EVIDENCE FILE</th>
            <th style="width: 10%;">MESSAGE</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($itemsA as $index => $item): ?>
            <tr>
                <td><?= $index + 1 ?>.</td>
                <td><?= esc($item->mci_desc) ?></td>
                <td><?= esc($item->mci_responsibility) ?></td>
                <td><?= esc($item->mcd_programme_code ?? '-') ?></td>
                <!-- EVIDENCE FILE -->
                <td>
                    <?php if (empty($item->mcd_id)): ?>
                        <!-- Section A evidence file upload -->
                        <form method="post" enctype="multipart/form-data" action="<?= base_url('public/upload') ?>" class="mt-2">
                            <?= csrf_field() ?>
                            <input type="hidden" name="mci_id" value="<?= esc($item->mci_id) ?>">
                            <input type="hidden" name="programme_code" value="<?= esc($programme_code) ?>">
                            <input type="file" name="mcd_file" class="form-control form-control-sm mb-2" required>
                            <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                        </form>
                    <?php else: ?>
                        <div>
                            <a href="<?= base_url($item->mcd_file) ?>" target="_blank">
                                <?= esc($item->mcd_original_file_name) ?>
                            </a>
                        </div>
                        <!-- Replace File form (fix this line) -->
                        <form method="post" enctype="multipart/form-data" action="<?= base_url('public/upload') ?>" class="mt-2">
                            <?= csrf_field() ?>
                            <input type="hidden" name="mci_id" value="<?= esc($item->mci_id) ?>">
                            <input type="hidden" name="programme_code" value="<?= esc($programme_code) ?>">
                            <input type="file" name="mcd_file" class="form-control form-control-sm mb-2" required>
                            <button type="submit" class="btn btn-sm btn-primary">Replace File</button>
                        </form>
                    <?php endif; ?>
                </td>
                <!-- MESSAGE -->
                <td>
                    <!-- Section A message form -->
                    <form method="post" action="<?= base_url('public/edit-message/' . $item->mci_id) ?>" class="d-flex mb-2">
                        <?= csrf_field() ?>
                        <input type="hidden" name="programme_code" value="<?= esc($programme_code) ?>">
                        <input type="text" name="mcd_message" class="form-control form-control-sm me-2" placeholder="Send a message..." style="width:150px;">
                        <button type="submit" class="btn btn-sm btn-primary">Send</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- SECTION B -->
    <?php if (!empty($sectionB)): ?>
        <h5 class="mt-5 mb-4">SECTION B: <?= esc($sectionB->mcs_desc ?? '') ?></h5>
        <table class="table table-bordered">
            <thead class="table-secondary">
            <tr>
                <th style="width: 5%;">NO.</th>
                <th style="width: 25%;">ITEM</th>
                <th style="width: 20%;">RESPONSIBILITY</th>
                <th style="width: 10%;">PROGRAMME CODE</th>
                <th style="width: 35%;">EVIDENCE FILE</th>
                <th style="width: 10%;">MESSAGE</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($itemsB as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?>.</td>
                    <td><?= esc($item->mci_desc) ?></td>
                    <td><?= esc($item->mci_responsibility) ?></td>
                    <td><?= esc($item->mcd_programme_code ?? '-') ?></td>
                    <!-- EVIDENCE FILE -->
                    <td>
                        <?php if (empty($item->mcd_id)): ?>
                            <form method="post" enctype="multipart/form-data" action="<?= base_url('public/upload') ?>" class="mt-2">
                                <?= csrf_field() ?>
                                <input type="hidden" name="mci_id" value="<?= esc($item->mci_id) ?>">
                                <input type="hidden" name="programme_code" value="<?= esc($programme_code) ?>">
                                <input type="file" name="mcd_file" class="form-control form-control-sm mb-2" required>
                                <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                            </form>
                        <?php else: ?>
                            <div>
                                <a href="<?= base_url($item->mcd_file) ?>" target="_blank">
                                    <?= esc($item->mcd_original_file_name) ?>
                                </a>
                            </div>
                            <form method="post" enctype="multipart/form-data" action="<?= base_url('public/upload') ?>" class="mt-2">
                                <?= csrf_field() ?>
                                <input type="hidden" name="mci_id" value="<?= esc($item->mci_id) ?>">
                                <input type="hidden" name="programme_code" value="B">
                                <input type="file" name="mcd_file" class="form-control form-control-sm mb-2" required>
                                <button type="submit" class="btn btn-sm btn-primary">Replace File</button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <!-- MESSAGE -->
                    <td>
                        <form method="post" action="<?= base_url('public/edit-message/' . $item->mci_id) ?>" class="d-flex mb-2">
                            <?= csrf_field() ?>
                            <input type="text" name="mcd_message" class="form-control form-control-sm me-2" placeholder="Send a message..." style="width:150px;">
                            <button type="submit" class="btn btn-sm btn-primary">Send</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Upload Section -->
    <!-- The following section is removed as requested:
    <div class="mt-5">
        <h5 class="mb-4">Upload for Programme Code: <?= esc($programme_code) ?></h5>
        <form method="post" enctype="multipart/form-data" action="<?= base_url('public/upload') ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="programme_code" value="<?= esc($programme_code) ?>">
            <div class="mb-3">
                <label for="mcd_file" class="form-label">Select file to upload</label>
                <input type="file" name="mcd_file" class="form-control" id="mcd_file" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload File</button>
        </form>
    </div>
    -->
</div>
</body>

<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
