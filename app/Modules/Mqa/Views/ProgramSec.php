<?php

// filepath: c:\laragon\www\mpquaapp\app\Modules\Mqa\Views\ProgramSec.php
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

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="container mt-5">
            <h4 class="mb-4">All Programs</h4>
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Reference Number</th>
                        <th>Qualification Name</th>
                        <th>Institution Name</th>
                        <th>Programme Code</th>
                        <th>Qualification Level</th>
                        <th>NEC Field</th>
                        <th>Total Credits</th>
                        <th>Delivery Mode</th>
                        <th>More Info</th>
                        <th>Upload</th> <!-- New column for the upload/go to PubA button -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($programs as $program): ?>
                        <tr>
                            <td><?= esc($program->p_id) ?></td>
                            <td><?= esc($program->p_reference_number) ?></td>
                            <td><?= esc($program->p_qualification_name) ?></td>
                            <td><?= esc($program->p_inst_name) ?></td>
                            <td><?= esc($program->mcd_programme_code) ?></td>
                            <td><?= esc($program->p_qualification_level) ?></td>
                            <td><?= esc($program->p_nec_field) ?></td>
                            <td><?= esc($program->p_total_credits) ?></td>
                            <td><?= esc($program->p_delivery_mode) ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#moreInfoModal<?= $program->p_id ?>">
                                    More Info
                                </button>
                            </td>
                            <td>
                                <!-- Button to go to PubA.php -->
                                <a href="<?= base_url('PubA.php?programme_code=' . urlencode($program->mcd_programme_code)) ?>" class="btn btn-success btn-sm">Upload</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Render all modals after the table -->
            <?php foreach ($programs as $program): ?>
                <div class="modal fade" id="moreInfoModal<?= $program->p_id ?>" tabindex="-1" aria-labelledby="moreInfoLabel<?= $program->p_id ?>" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="moreInfoLabel<?= $program->p_id ?>">More Info for <?= esc($program->p_qualification_name) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <table class="table table-bordered">
                            <tr><th>Certificate Number</th><td><?= esc($program->p_certificate_number) ?></td></tr>
                            <tr><th>Accreditation Date</th><td><?= esc($program->p_accreditation_date) ?></td></tr>
                            <tr><th>Institution Address</th><td><?= esc($program->p_inst_address) ?></td></tr>
                            <tr><th>Phone Number</th><td><?= esc($program->p_phone_number) ?></td></tr>
                            <tr><th>Fax Number</th><td><?= esc($program->p_fax_number) ?></td></tr>
                            <tr><th>Email Address</th><td><?= esc($program->p_email_address) ?></td></tr>
                            <tr><th>Website</th><td><?= esc($program->p_website) ?></td></tr>
                            <tr><th>Compliance Audit</th><td><?= esc($program->p_compliance_audit) ?></td></tr>
                            <tr><th>MQF Level</th><td><?= esc($program->p_mqf_level) ?></td></tr>
                            <tr><th>Study Duration</th><td><?= esc($program->p_study_duration) ?></td></tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
</main>