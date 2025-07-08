<?php
// filepath: c:\laragon\www\mpquaapp\app\Modules\Mqa\Views\AdminProg.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accreditation Compliance Documents (Admin)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        .custom-dt-search {
            max-width: 350px;
            margin-bottom: 1rem;
        }
        div.dataTables_filter {
            display: none !important;
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
        <!-- Back Button -->
        <a href="<?= base_url('AdminSec.php') ?>" class="btn btn-secondary mb-3">&larr; Back to Admin Section</a>
        <h4 class="text-center mb-4">ACCREDITATION COMPLIANCE DOCUMENTS (Admin)</h4>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- Add Program Button -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProgramModal">Add Program</button>
       
        <div class="container mt-3">
            <h4 class="mb-4">All Programs</h4>
            <!-- Custom Search Bar -->
            <!-- The custom search bar below has been removed -->
            <table class="table table-bordered" id="adminProgTable">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Reference Number</th>
                        <th>Qualification Name</th>
                        <th>Programme Code</th>
                        <th>Qualification Level</th>
                        <th>NEC Field</th>
                        <th>Total Credits</th>
                        <th>Delivery Mode</th>
                        <th>More Info</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($programs as $program): ?>
                        <tr>
                            <td><?= esc($program->p_id) ?></td>
                            <td><?= esc($program->p_reference_number) ?></td>
                            <td><?= esc($program->p_qualification_name) ?></td>
                            <td><?= esc($program->mcd_programme_code ?? '') ?></td>
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
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#editProgramModal<?= $program->p_id ?>">
                                    Edit
                                </button>
                                <!-- Delete Button -->
                                <form method="post" action="<?= base_url('program/delete/' . $program->p_id) ?>" style="display:inline;" onsubmit="return confirm('Delete this program?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Render all modals after the table -->
            <?php foreach ($programs as $program): ?>
                <!-- More Info Modal -->
                <div class="modal fade" id="moreInfoModal<?= $program->p_id ?>" tabindex="-1" aria-labelledby="moreInfoLabel<?= $program->p_id ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="moreInfoLabel<?= $program->p_id ?>">More Info for <?= esc($program->p_qualification_name) ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <tr><th>Certificate Number</th><td><?= esc($program->p_certificate_number ?? 'N/A') ?></td></tr>
                                    <tr><th>Accreditation Date</th><td><?= esc($program->p_accreditation_date ?? 'N/A') ?></td></tr>
                                    <tr><th>Programme Code</th><td><?= esc($program->mcd_programme_code ?? 'N/A') ?></td></tr>
                                    <tr><th>Institution Name</th><td><?= esc($program->p_inst_name ?? 'N/A') ?></td></tr>
                                    <tr><th>Institution Address</th><td><?= esc($program->p_inst_address ?? 'N/A') ?></td></tr>
                                    <tr><th>Phone Number</th><td><?= esc($program->p_phone_number ?? 'N/A') ?></td></tr>
                                    <tr><th>Fax Number</th><td><?= esc($program->p_fax_number ?? 'N/A') ?></td></tr>
                                    <tr><th>Email Address</th><td><?= esc($program->p_email_address ?? 'N/A') ?></td></tr>
                                    <tr><th>Website</th><td><?= esc($program->p_website ?? 'N/A') ?></td></tr>
                                    <tr><th>Compliance Audit</th><td><?= esc($program->p_compliance_audit ?? 'N/A') ?></td></tr>
                                    <tr><th>MQF Level</th><td><?= esc($program->p_mqf_level ?? 'N/A') ?></td></tr>
                                    <tr>
                                        <th>Study Mode</th>
                                        <td>
                                            <?php $modes = $studyModes[$program->p_id] ?? []; ?>
                                            <?php $modes = array_slice($modes, 0, 2); // Limit to 2 study modes ?>
                                            <?php foreach ($modes as $mode): ?>
                                                <div class="mb-2">
                                                    <strong><?= esc($mode->sm_type) ?></strong>
                                                    <table class="table table-bordered table-sm mb-2">
                                                        <tr><th>Long Sem (Bil.Semester)</th><td><?= esc($mode->sm_long_sem ?? '-') ?></td></tr>
                                                        <tr><th>Short Sem (Bil.Semester)</th><td><?= esc($mode->sm_short_sem ?? '-') ?></td></tr>
                                                        <tr><th>Long Sem Week (Bil.Minggu)</th><td><?= esc($mode->sm_long_sem_week ?? '-') ?></td></tr>
                                                        <tr><th>Short Sem Week (Bil.Minggu)</th><td><?= esc($mode->sm_short_sem_week ?? '-') ?></td></tr>
                                                        <tr><th>Long Sem Total</th><td><?= esc($mode->sm_long_sem_total ?? '-') ?></td></tr>
                                                        <tr><th>Short Sem Total</th><td><?= esc($mode->sm_short_sem_total ?? '-') ?></td></tr>
                                                        <tr><th>Duration (Tempoh)</th><td><?= esc($mode->sm_duration ?? '-') ?></td></tr>
                                                    </table>
                                                </div>
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Program Modal -->
                <div class="modal fade" id="editProgramModal<?= $program->p_id ?>" tabindex="-1" aria-labelledby="editProgramLabel<?= $program->p_id ?>" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form method="post" action="<?= base_url('program/edit/' . $program->p_id) ?>">
                                <?= csrf_field() ?>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProgramLabel<?= $program->p_id ?>">Edit Program</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>Reference Number</label>
                                            <input type="text" name="p_reference_number" class="form-control" value="<?= esc($program->p_reference_number) ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Qualification Name</label>
                                            <input type="text" name="p_qualification_name" class="form-control" value="<?= esc($program->p_qualification_name) ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>Institution Name</label>
                                            <input type="text" name="p_inst_name" class="form-control" value="<?= esc($program->p_inst_name) ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Programme Code</label>
                                            <input type="text" name="mcd_programme_code" class="form-control" value="<?= esc($program->mcd_programme_code ?? '') ?>" required>
                                            <input type="hidden" name="p_mcd_id" value="<?= esc($program->p_mcd_id ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>Qualification Level</label>
                                            <select name="p_qualification_level" class="form-control" required>
                                                <option value="">Select Level</option>
                                                <option value="Diploma" <?= ($program->p_qualification_level === 'Diploma') ? 'selected' : '' ?>>Diploma</option>
                                                <option value="Degree" <?= ($program->p_qualification_level === 'Degree') ? 'selected' : '' ?>>Degree</option>
                                                <option value="Master" <?= ($program->p_qualification_level === 'Master') ? 'selected' : '' ?>>Master</option>
                                                <option value="PhD" <?= ($program->p_qualification_level === 'PhD') ? 'selected' : '' ?>>PhD</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>NEC Field</label>
                                            <input type="text" name="p_nec_field" class="form-control" value="<?= esc($program->p_nec_field) ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>Total Credits</label>
                                            <input type="number" name="p_total_credits" class="form-control" value="<?= esc($program->p_total_credits) ?>">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Delivery Mode</label>
                                            <input type="text" name="p_delivery_mode" class="form-control" value="<?= esc($program->p_delivery_mode) ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>Certificate Number</label>
                                            <input type="text" name="p_certificate_number" class="form-control" value="<?= esc($program->p_certificate_number ?? '') ?>">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Accreditation Date</label>
                                            <input type="date" name="p_accreditation_date" class="form-control" value="<?= esc($program->p_accreditation_date ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>Institution Address</label>
                                            <input type="text" name="p_inst_address" class="form-control" value="<?= esc($program->p_inst_address ?? '') ?>">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Phone Number</label>
                                            <input type="text" name="p_phone_number" class="form-control" value="<?= esc($program->p_phone_number ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>Fax Number</label>
                                            <input type="text" name="p_fax_number" class="form-control" value="<?= esc($program->p_fax_number ?? '') ?>">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Email Address</label>
                                            <input type="email" name="p_email_address" class="form-control" value="<?= esc($program->p_email_address ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>Website</label>
                                            <input type="text" name="p_website" class="form-control" value="<?= esc($program->p_website ?? '') ?>">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Compliance Audit</label>
                                            <input type="text" name="p_compliance_audit" class="form-control" value="<?= esc($program->p_compliance_audit ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>MQF Level</label>
                                            <input type="text" name="p_mqf_level" class="form-control" value="<?= esc($program->p_mqf_level ?? '') ?>">
                                        </div>
                                    </div>
                                    
                                    <!-- Study Mode Section -->
                                    <hr>
                                    <h6 class="mb-3">Study Mode Information</h6>
                                    <?php
                                    $modes = $studyModes[$program->p_id] ?? [];
                                    $types = ['Sepenuh Masa', 'Separuh Masa'];
                                    $existingTypes = array_column($modes, 'sm_type');

                                    // Show existing study modes for editing
                                    foreach ($modes as $mode): ?>
                                        <div class="border rounded p-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label>Study Mode Type</label>
                                                    <select name="sm_type_<?= esc($mode->sm_id) ?>" class="form-control" required>
                                                        <option value="">Select Study Mode</option>
                                                        <option value="Sepenuh Masa" <?= ($mode->sm_type == 'Sepenuh Masa') ? 'selected' : '' ?>>Sepenuh Masa</option>
                                                        <option value="Separuh Masa" <?= ($mode->sm_type == 'Separuh Masa') ? 'selected' : '' ?>>Separuh Masa</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Long Sem (Bil.Semester)</label>
                                                    <input type="number" name="sm_long_sem_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_long_sem ?? '') ?>">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Short Sem (Bil.Semester)</label>
                                                    <input type="number" name="sm_short_sem_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_short_sem ?? '') ?>">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Long Sem Week (Bil.Minggu)</label>
                                                    <input type="number" name="sm_long_sem_week_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_long_sem_week ?? '') ?>">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Short Sem Week (Bil.Minggu)</label>
                                                    <input type="number" name="sm_short_sem_week_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_short_sem_week ?? '') ?>">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Long Sem Total</label>
                                                    <input type="number" name="sm_long_sem_total_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_long_sem_total ?? '') ?>">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Short Sem Total</label>
                                                    <input type="number" name="sm_short_sem_total_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_short_sem_total ?? '') ?>">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Duration (Tempoh)</label>
                                                    <input type="text" name="sm_duration_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_duration ?? '') ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <?php
                                    // Show empty fields for missing types (so admin can add them)
                                    foreach ($types as $type):
                                        if (!in_array($type, $existingTypes)):
                                            $key = strtolower(str_replace(' ', '_', $type));
                                    ?>
                                        <div class="border rounded p-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label>Study Mode Type</label>
                                                    <select name="sm_type_new_<?= $key ?>" class="form-control" required>
                                                        <option value="">Select Study Mode</option>
                                                        <option value="Sepenuh Masa" <?= $type == 'Sepenuh Masa' ? 'selected' : '' ?>>Sepenuh Masa</option>
                                                        <option value="Separuh Masa" <?= $type == 'Separuh Masa' ? 'selected' : '' ?>>Separuh Masa</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Long Sem (Bil.Semester)</label>
                                                    <input type="number" name="sm_long_sem_new_<?= $key ?>" class="form-control">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Short Sem (Bil.Semester)</label>
                                                    <input type="number" name="sm_short_sem_new_<?= $key ?>" class="form-control">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Long Sem Week (Bil.Minggu)</label>
                                                    <input type="number" name="sm_long_sem_week_new_<?= $key ?>" class="form-control">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Short Sem Week (Bil.Minggu)</label>
                                                    <input type="number" name="sm_short_sem_week_new_<?= $key ?>" class="form-control">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Long Sem Total</label>
                                                    <input type="number" name="sm_long_sem_total_new_<?= $key ?>" class="form-control">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Short Sem Total</label>
                                                    <input type="number" name="sm_short_sem_total_new_<?= $key ?>" class="form-control">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>Duration (Tempoh)</label>
                                                    <input type="text" name="sm_duration_new_<?= $key ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
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
            
            <!-- Add Program Modal -->
            <div class="modal fade" id="addProgramModal" tabindex="-1" aria-labelledby="addProgramLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form method="post" action="<?= base_url('program/add') ?>">
                            <?= csrf_field() ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProgramLabel">Add Program</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>Reference Number</label>
                                        <input type="text" name="p_reference_number" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Qualification Name</label>
                                        <input type="text" name="p_qualification_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>Institution Name</label>
                                        <input type="text" name="p_inst_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Programme Code</label>
                                        <input type="text" name="mcd_programme_code" class="form-control" placeholder="Enter programme code" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>Qualification Level</label>
                                        <select name="p_qualification_level" class="form-control" required>
                                            <option value="">Select Level</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="Degree">Degree</option>
                                            <option value="Master">Master</option>
                                            <option value="PhD">PhD</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>NEC Field</label>
                                        <input type="text" name="p_nec_field" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>Total Credits</label>
                                        <input type="number" name="p_total_credits" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Delivery Mode</label>
                                        <input type="text" name="p_delivery_mode" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>Certificate Number</label>
                                        <input type="text" name="p_certificate_number" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Accreditation Date</label>
                                        <input type="date" name="p_accreditation_date" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>Institution Address</label>
                                        <input type="text" name="p_inst_address" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Phone Number</label>
                                        <input type="text" name="p_phone_number" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>Fax Number</label>
                                        <input type="text" name="p_fax_number" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Email Address</label>
                                        <input type="email" name="p_email_address" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>Website</label>
                                        <input type="text" name="p_website" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Compliance Audit</label>
                                        <input type="text" name="p_compliance_audit" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>MQF Level</label>
                                        <input type="text" name="p_mqf_level" class="form-control">
                                    </div>
                                </div>
                                
                                <!-- Study Mode Section -->
                                <hr>
                                <h6 class="mb-3">Study Mode Information</h6>
                                
                                <!-- Long Semester Fields -->
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <h6 class="text-primary">Sepenuh Masa Panjang (Long Semester)</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label>Long Sem (Bil.Semester)</label>
                                        <input type="number" name="sm_long_sem" class="form-control" placeholder="e.g., 6">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>Long Sem Week (Bil.Minggu)</label>
                                        <input type="number" name="sm_long_sem_week" class="form-control" placeholder="e.g., 17">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>Long Sem Total</label>
                                        <input type="number" name="sm_long_sem_total" class="form-control" placeholder="Total weeks">
                                    </div>
                                </div>
                                
                                <!-- Short Semester Fields -->
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <h6 class="text-success">Pendek (Short Semester)</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label>Short Sem (Bil.Semester)</label>
                                        <input type="number" name="sm_short_sem" class="form-control" placeholder="Number of semesters">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>Short Sem Week (Bil.Minggu)</label>
                                        <input type="number" name="sm_short_sem_week" class="form-control" placeholder="e.g., 9">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>Short Sem Total</label>
                                        <input type="number" name="sm_short_sem_total" class="form-control" placeholder="Total weeks">
                                    </div>
                                </div>
                                
                                <!-- Duration Field -->
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label>Duration (Tempoh)</label>
                                        <input type="text" name="sm_duration" class="form-control" placeholder="e.g., 3 tahun">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add Program</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- JS: jQuery, DataTables, Bootstrap -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#adminProgTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        order: [[0, 'asc']]
    });
});
</script>

</body>
</html>