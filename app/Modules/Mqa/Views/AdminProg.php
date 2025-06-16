<?php
// filepath: c:\laragon\www\mpquaapp\app\Modules\Mqa\Views\AdminProg.php
?>
<main id="js-page-content" role="main" class="page-content">
    <div class="container mt-5">
        <h4 class="text-center mb-4">ACCREDITATION COMPLIANCE DOCUMENTS (Admin)</h4>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Add Program Button -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProgramModal">Add Program</button>

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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($programs as $program): ?>
                    <tr>
                        <td><?= esc($program->p_id) ?></td>
                        <td><?= esc($program->p_reference_number) ?></td>
                        <td><?= esc($program->p_qualification_name) ?></td>
                        <td><?= esc($program->p_inst_name) ?></td>
                        <td><?= esc($program->p_mcd_id) ?></td>
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
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProgramModal<?= $program->p_id ?>">
                                Edit
                            </button>
                            <!-- Delete Button -->
                            <form method="post" action="<?= base_url('program/delete/' . $program->p_id) ?>" style="display:inline;" onsubmit="return confirm('Delete this program?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

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

                    <!-- Edit Program Modal -->
                    <div class="modal fade" id="editProgramModal<?= $program->p_id ?>" tabindex="-1" aria-labelledby="editProgramLabel<?= $program->p_id ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="post" action="<?= base_url('program/edit/' . $program->p_id) ?>">
                                    <?= csrf_field() ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProgramLabel<?= $program->p_id ?>">Edit Program</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label>Reference Number</label>
                                            <input type="text" name="p_reference_number" class="form-control" value="<?= esc($program->p_reference_number) ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Qualification Name</label>
                                            <input type="text" name="p_qualification_name" class="form-control" value="<?= esc($program->p_qualification_name) ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Institution Name</label>
                                            <input type="text" name="p_inst_name" class="form-control" value="<?= esc($program->p_inst_name) ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Programme Code</label>
                                            <input type="text" name="mcd_programme_code" class="form-control" value="<?= esc($program->p_mcd_id) ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Qualification Level</label>
                                            <input type="text" name="p_qualification_level" class="form-control" value="<?= esc($program->p_qualification_level) ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label>NEC Field</label>
                                            <input type="text" name="p_nec_field" class="form-control" value="<?= esc($program->p_nec_field) ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label>Total Credits</label>
                                            <input type="number" name="p_total_credits" class="form-control" value="<?= esc($program->p_total_credits) ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label>Delivery Mode</label>
                                            <input type="text" name="p_delivery_mode" class="form-control" value="<?= esc($program->p_delivery_mode) ?>">
                                        </div>
                                        <!-- Add more fields as needed -->
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

        <!-- Add Program Modal -->
        <div class="modal fade" id="addProgramModal" tabindex="-1" aria-labelledby="addProgramLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="<?= base_url('program/add') ?>">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProgramLabel">Add Program</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add your input fields here -->
                            <div class="mb-2">
                                <label>Reference Number</label>
                                <input type="text" name="p_reference_number" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Qualification Name</label>
                                <input type="text" name="p_qualification_name" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Institution Name</label>
                                <input type="text" name="p_inst_name" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Programme Code</label>
                                <input type="text" name="mcd_programme_code" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Qualification Level</label>
                                <input type="text" name="p_qualification_level" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>NEC Field</label>
                                <input type="text" name="p_nec_field" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>Total Credits</label>
                                <input type="number" name="p_total_credits" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>Delivery Mode</label>
                                <input type="text" name="p_delivery_mode" class="form-control">
                            </div>
                            <!-- Add more fields as needed -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</main>