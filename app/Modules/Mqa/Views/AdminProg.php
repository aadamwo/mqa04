<title>Accreditation Compliance Documents (Admin)</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-color: #4e73df;
        --primary-dark: #2e59d9;
        --secondary-color: #f8f9fc;
        --accent-color: #36b9cc;
        --success-color: #1cc88a;
        --warning-color: #f6c23e;
        --danger-color: #e74a3b;
        --text-primary: #5a5c69;
        --text-secondary: #858796;
        --border-color: #e3e6f0;
        --bg-light: #f8f9fc;
        --shadow-sm: 0 0.15rem 0.35rem rgba(0, 0, 0, 0.08);
        --shadow-md: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
    }
    
    * {
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    body {
        background-color: var(--bg-light);
        color: var(--text-primary);
    }
    
    .container-main {
        max-width: 1400px;
        margin: 2rem auto;
        padding: 0 15px;
    }
    
    .header-title {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 2rem;
        text-align: center;
        position: relative;
        padding-bottom: 0.75rem;
    }
    
    .header-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: var(--primary-color);
        border-radius: 3px;
    }
    
    .card {
        border: none;
        border-radius: 0.5rem;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
    }
    
    .card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }
    
    .card-header {
        background-color: var(--secondary-color);
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: var(--primary-color);
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }
    
    .btn-danger {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
    }
    
    .btn-danger:hover {
        background-color: #d62c1a;
        border-color: #d62c1a;
    }
    
    .btn-info {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
    }
    
    .btn-info:hover {
        background-color: #2aa1b3;
        border-color: #2aa1b3;
    }
    
    .btn-secondary {
        background-color: var(--text-secondary);
        border-color: var(--text-secondary);
    }
    
    .btn-secondary:hover {
        background-color: #72757e;
        border-color: #72757e;
    }
    
    .btn-warning {
        background-color: var(--warning-color);
        border-color: var(--warning-color);
        color: #2c3e50;
    }
    
    .btn-warning:hover {
        background-color: #f4b619;
        border-color: #f4b619;
        color: #2c3e50;
    }
    
    .btn-success {
        background-color: var(--success-color);
        border-color: var(--success-color);
    }
    
    .btn-success:hover {
        background-color: #17a673;
        border-color: #17a673;
    }
    
    .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
    
    .table {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .table thead th {
        background-color: var(--primary-color);
        color: white;
        border-bottom: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }
    
    .table tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        border-radius: 0.25rem;
    }
    
    .badge-primary {
        background-color: var(--primary-color);
    }
    
    .badge-info {
        background-color: var(--accent-color);
    }
    
    .badge-success {
        background-color: var(--success-color);
    }
    
    .badge-warning {
        background-color: var(--warning-color);
        color: #2c3e50;
    }
    
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    
    .info-badge {
        background-color: var(--secondary-color);
        color: var(--text-primary);
        padding: 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.9rem;
        border: 1px solid var(--border-color);
        margin-bottom: 0.5rem;
    }
    
    .study-mode-card {
        border-left: 4px solid var(--primary-color);
        margin-bottom: 1rem;
        padding: 1rem;
        background-color: var(--secondary-color);
        border-radius: 0.25rem;
    }
    
    .study-mode-card h6 {
        color: var(--primary-color);
        font-weight: 600;
    }
    
    .form-control, .form-select {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .nav-tabs .nav-link.active {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
    
    .nav-tabs .nav-link:hover:not(.active) {
        border-color: var(--border-color) var(--border-color) var(--primary-color);
    }
    
    .modal-content {
        border-radius: 0.75rem;
        border: none;
        box-shadow: var(--shadow-lg);
    }
    
    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .action-buttons .btn {
            width: 100%;
        }
    }
</style>

<main id="js-page-content" role="main" class="page-content">
    <div class="container container-main">
        <!-- Back Button -->
        <a href="<?= base_url('AdminSec.php') ?>" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left me-2"></i> Back to Admin Section
        </a>
        
        <h4 class="header-title">
            <i class="fas fa-file-certificate me-2"></i>ACCREDITATION COMPLIANCE DOCUMENTS (Admin)
        </h4>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <!-- Programs Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-graduation-cap me-2"></i>Program Management
                </h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProgramModal">
                    <i class="fas fa-plus me-2"></i> Add Program
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="adminProgTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Reference No.</th>
                                <th>Qualification Name</th>
                                <th>Program Code</th>
                                <th>Level</th>
                                <th>NEC Field</th>
                                <th>Credits</th>
                                <th>Delivery</th>
                                <th>Details</th>
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
                                    <td><span class="badge badge-primary"><?= esc($program->p_qualification_level) ?></span></td>
                                    <td><?= esc($program->p_nec_field) ?></td>
                                    <td><?= esc($program->p_total_credits) ?></td>
                                    <td><?= esc($program->p_delivery_mode) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#moreInfoModal<?= $program->p_id ?>">
                                            <i class="fas fa-info-circle"></i> View
                                        </button>
                                    </td>
                                    <td class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProgramModal<?= $program->p_id ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="post" action="<?= base_url('program/delete/' . $program->p_id) ?>" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this program?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Render all modals after the table -->
        <?php foreach ($programs as $program): ?>
            <!-- More Info Modal -->
            <div class="modal fade" id="moreInfoModal<?= $program->p_id ?>" tabindex="-1" aria-labelledby="moreInfoLabel<?= $program->p_id ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="moreInfoLabel<?= $program->p_id ?>">
                                <i class="fas fa-info-circle me-2"></i>
                                Program Details: <?= esc($program->p_qualification_name) ?>
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Basic Info -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="info-badge">
                                        <strong>Reference Number:</strong> <?= esc($program->p_reference_number) ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Programme Code:</strong> <?= esc($program->mcd_programme_code ?? 'N/A') ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Qualification Level:</strong> <?= esc($program->p_qualification_level) ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Total Credits:</strong> <?= esc($program->p_total_credits) ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Delivery Mode:</strong> <?= esc($program->p_delivery_mode) ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Certificate Number:</strong> <?= esc($program->p_certificate_number ?? 'N/A') ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Accreditation Date:</strong> <?= esc($program->p_accreditation_date ?? 'N/A') ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>MQF Level:</strong> <?= esc($program->p_mqf_level ?? 'N/A') ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-badge">
                                        <strong>Institution Name:</strong> <?= esc($program->p_inst_name ?? 'N/A') ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Institution Address:</strong> <?= esc($program->p_inst_address ?? 'N/A') ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Phone Number:</strong> <?= esc($program->p_phone_number ?? 'N/A') ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Fax Number:</strong> <?= esc($program->p_fax_number ?? 'N/A') ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Email Address:</strong> <?= esc($program->p_email_address ?? 'N/A') ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Website:</strong> <?= esc($program->p_website ?? 'N/A') ?>
                                    </div>
                                    <div class="info-badge">
                                        <strong>Compliance Audit:</strong> <?= esc($program->p_compliance_audit ?? 'N/A') ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Study Modes -->
                            <h6 class="mb-3" style="color: var(--primary-color); font-weight: 600;">
                                <i class="fas fa-book-open me-2"></i>Study Modes
                            </h6>
                            <?php $modes = $studyModes[$program->p_id] ?? []; ?>
                            <?php foreach ($modes as $mode): ?>
                                <div class="study-mode-card mb-3">
                                    <h6><i class="fas fa-clock me-2"></i><?= esc($mode->sm_type) ?></h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-badge">
                                                <strong>Long Sem (Semesters):</strong> <?= esc($mode->sm_long_sem ?? '-') ?>
                                            </div>
                                            <div class="info-badge">
                                                <strong>Long Sem Weeks:</strong> <?= esc($mode->sm_long_sem_week ?? '-') ?>
                                            </div>
                                            <div class="info-badge">
                                                <strong>Long Sem Total:</strong> <?= esc($mode->sm_long_sem_total ?? '-') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-badge">
                                                <strong>Short Sem (Semesters):</strong> <?= esc($mode->sm_short_sem ?? '-') ?>
                                            </div>
                                            <div class="info-badge">
                                                <strong>Short Sem Weeks:</strong> <?= esc($mode->sm_short_sem_week ?? '-') ?>
                                            </div>
                                            <div class="info-badge">
                                                <strong>Short Sem Total:</strong> <?= esc($mode->sm_short_sem_total ?? '-') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-badge">
                                                <strong>Duration:</strong> <?= esc($mode->sm_duration ?? '-') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i> Close
                            </button>
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
                                <h5 class="modal-title" id="editProgramLabel<?= $program->p_id ?>">
                                    <i class="fas fa-edit me-2"></i>
                                    Edit Program: <?= esc($program->p_qualification_name) ?>
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs mb-4" id="editProgramTab<?= $program->p_id ?>" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic-info<?= $program->p_id ?>" type="button" role="tab" aria-controls="basic-info" aria-selected="true">
                                            Basic Information
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="institution-tab" data-bs-toggle="tab" data-bs-target="#institution-info<?= $program->p_id ?>" type="button" role="tab" aria-controls="institution-info" aria-selected="false">
                                            Institution Details
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="study-tab" data-bs-toggle="tab" data-bs-target="#study-modes<?= $program->p_id ?>" type="button" role="tab" aria-controls="study-modes" aria-selected="false">
                                            Study Modes
                                        </button>
                                    </li>
                                </ul>
                                
                                <div class="tab-content" id="editProgramTabContent<?= $program->p_id ?>">
                                    <!-- Basic Info Tab -->
                                    <div class="tab-pane fade show active" id="basic-info<?= $program->p_id ?>" role="tabpanel" aria-labelledby="basic-tab">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Reference Number</label>
                                                <input type="text" name="p_reference_number" class="form-control" value="<?= esc($program->p_reference_number) ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Qualification Name</label>
                                                <input type="text" name="p_qualification_name" class="form-control" value="<?= esc($program->p_qualification_name) ?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Programme Code</label>
                                                <input type="text" name="mcd_programme_code" class="form-control" value="<?= esc($program->mcd_programme_code ?? '') ?>" required>
                                                <input type="hidden" name="p_mcd_id" value="<?= esc($program->p_mcd_id ?? '') ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Qualification Level</label>
                                                <select name="p_qualification_level" class="form-select" required>
                                                    <option value="">Select Level</option>
                                                    <option value="Diploma" <?= ($program->p_qualification_level === 'Diploma') ? 'selected' : '' ?>>Diploma</option>
                                                    <option value="Degree" <?= ($program->p_qualification_level === 'Degree') ? 'selected' : '' ?>>Degree</option>
                                                    <option value="Master" <?= ($program->p_qualification_level === 'Master') ? 'selected' : '' ?>>Master</option>
                                                    <option value="PhD" <?= ($program->p_qualification_level === 'PhD') ? 'selected' : '' ?>>PhD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">NEC Field</label>
                                                <input type="text" name="p_nec_field" class="form-control" value="<?= esc($program->p_nec_field) ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Total Credits</label>
                                                <input type="number" name="p_total_credits" class="form-control" value="<?= esc($program->p_total_credits) ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Delivery Mode</label>
                                                <input type="text" name="p_delivery_mode" class="form-control" value="<?= esc($program->p_delivery_mode) ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Certificate Number</label>
                                                <input type="text" name="p_certificate_number" class="form-control" value="<?= esc($program->p_certificate_number ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Accreditation Date</label>
                                                <input type="date" name="p_accreditation_date" class="form-control" value="<?= esc($program->p_accreditation_date ?? '') ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">MQF Level</label>
                                                <input type="text" name="p_mqf_level" class="form-control" value="<?= esc($program->p_mqf_level ?? '') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Institution Info Tab -->
                                    <div class="tab-pane fade" id="institution-info<?= $program->p_id ?>" role="tabpanel" aria-labelledby="institution-tab">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Institution Name</label>
                                                <input type="text" name="p_inst_name" class="form-control" value="<?= esc($program->p_inst_name) ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Institution Address</label>
                                                <input type="text" name="p_inst_address" class="form-control" value="<?= esc($program->p_inst_address ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" name="p_phone_number" class="form-control" value="<?= esc($program->p_phone_number ?? '') ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Fax Number</label>
                                                <input type="text" name="p_fax_number" class="form-control" value="<?= esc($program->p_fax_number ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Email Address</label>
                                                <input type="email" name="p_email_address" class="form-control" value="<?= esc($program->p_email_address ?? '') ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Website</label>
                                                <input type="text" name="p_website" class="form-control" value="<?= esc($program->p_website ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Compliance Audit</label>
                                                <input type="text" name="p_compliance_audit" class="form-control" value="<?= esc($program->p_compliance_audit ?? '') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Study Modes Tab -->
                                    <div class="tab-pane fade" id="study-modes<?= $program->p_id ?>" role="tabpanel" aria-labelledby="study-tab">
                                        <?php
                                        $modes = $studyModes[$program->p_id] ?? [];
                                        $types = ['Sepenuh Masa', 'Separuh Masa'];
                                        $existingTypes = array_column($modes, 'sm_type');

                                        // Show existing study modes for editing
                                        foreach ($modes as $mode): ?>
                                            <div class="study-mode-card mb-4">
                                                <h6><i class="fas fa-clock me-2"></i><?= esc($mode->sm_type) ?></h6>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Study Mode Type</label>
                                                        <select name="sm_type_<?= esc($mode->sm_id) ?>" class="form-select" required>
                                                            <option value="">Select Study Mode</option>
                                                            <option value="Sepenuh Masa" <?= ($mode->sm_type == 'Sepenuh Masa') ? 'selected' : '' ?>>Sepenuh Masa</option>
                                                            <option value="Separuh Masa" <?= ($mode->sm_type == 'Separuh Masa') ? 'selected' : '' ?>>Separuh Masa</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Long Sem (Bil.Semester)</label>
                                                        <input type="number" name="sm_long_sem_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_long_sem ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Short Sem (Bil.Semester)</label>
                                                        <input type="number" name="sm_short_sem_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_short_sem ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Long Sem Week (Bil.Minggu)</label>
                                                        <input type="number" name="sm_long_sem_week_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_long_sem_week ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Short Sem Week (Bil.Minggu)</label>
                                                        <input type="number" name="sm_short_sem_week_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_short_sem_week ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Long Sem Total</label>
                                                        <input type="number" name="sm_long_sem_total_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_long_sem_total ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Short Sem Total</label>
                                                        <input type="number" name="sm_short_sem_total_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_short_sem_total ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Duration:</label>
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
                                            <div class="study-mode-card mb-4">
                                                <h6><i class="fas fa-plus-circle me-2"></i>Add New Study Mode</h6>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Study Mode Type</label>
                                                        <select name="sm_type_new_<?= $key ?>" class="form-select" required>
                                                            <option value="">Select Study Mode</option>
                                                            <option value="Sepenuh Masa" <?= $type == 'Sepenuh Masa' ? 'selected' : '' ?>>Sepenuh Masa</option>
                                                            <option value="Separuh Masa" <?= $type == 'Separuh Masa' ? 'selected' : '' ?>>Separuh Masa</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Long Sem (Bil.Semester)</label>
                                                        <input type="number" name="sm_long_sem_new_<?= $key ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Short Sem (Bil.Semester)</label>
                                                        <input type="number" name="sm_short_sem_new_<?= $key ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Long Sem Week (Bil.Minggu)</label>
                                                        <input type="number" name="sm_long_sem_week_new_<?= $key ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Short Sem Week (Bil.Minggu)</label>
                                                        <input type="number" name="sm_short_sem_week_new_<?= $key ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Long Sem Total</label>
                                                        <input type="number" name="sm_long_sem_total_new_<?= $key ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Short Sem Total</label>
                                                        <input type="number" name="sm_short_sem_total_new_<?= $key ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Duration (Tempoh)</label>
                                                        <input type="text" name="sm_duration_new_<?= $key ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Save Changes
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </button>
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
                            <h5 class="modal-title" id="addProgramLabel">
                                <i class="fas fa-plus-circle me-2"></i>Add New Program
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs mb-4" id="addProgramTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="add-basic-tab" data-bs-toggle="tab" data-bs-target="#add-basic-info" type="button" role="tab" aria-controls="add-basic-info" aria-selected="true">
                                        Basic Information
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="add-institution-tab" data-bs-toggle="tab" data-bs-target="#add-institution-info" type="button" role="tab" aria-controls="add-institution-info" aria-selected="false">
                                        Institution Details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="add-study-tab" data-bs-toggle="tab" data-bs-target="#add-study-modes" type="button" role="tab" aria-controls="add-study-modes" aria-selected="false">
                                        Study Modes
                                    </button>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="addProgramTabContent">
                                <!-- Basic Info Tab -->
                                <div class="tab-pane fade show active" id="add-basic-info" role="tabpanel" aria-labelledby="add-basic-tab">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Reference Number</label>
                                            <input type="text" name="p_reference_number" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Qualification Name</label>
                                            <input type="text" name="p_qualification_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Programme Code</label>
                                            <input type="text" name="mcd_programme_code" class="form-control" placeholder="Enter programme code" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Qualification Level</label>
                                            <select name="p_qualification_level" class="form-select" required>
                                                <option value="">Select Level</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Degree">Degree</option>
                                                <option value="Master">Master</option>
                                                <option value="PhD">PhD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">NEC Field</label>
                                            <input type="text" name="p_nec_field" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Total Credits</label>
                                            <input type="number" name="p_total_credits" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Delivery Mode</label>
                                            <input type="text" name="p_delivery_mode" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Certificate Number</label>
                                            <input type="text" name="p_certificate_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Accreditation Date</label>
                                            <input type="date" name="p_accreditation_date" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">MQF Level</label>
                                            <input type="text" name="p_mqf_level" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Institution Info Tab -->
                                <div class="tab-pane fade" id="add-institution-info" role="tabpanel" aria-labelledby="add-institution-tab">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Institution Name</label>
                                            <input type="text" name="p_inst_name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Institution Address</label>
                                            <input type="text" name="p_inst_address" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" name="p_phone_number" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Fax Number</label>
                                            <input type="text" name="p_fax_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" name="p_email_address" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Website</label>
                                            <input type="text" name="p_website" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Compliance Audit</label>
                                            <input type="text" name="p_compliance_audit" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Study Modes Tab -->
                                <div class="tab-pane fade" id="add-study-modes" role="tabpanel" aria-labelledby="add-study-tab">
                                    <?php
                                    $types = ['Sepenuh Masa', 'Separuh Masa'];
                                    foreach ($types as $type):
                                        $key = strtolower(str_replace(' ', '_', $type));
                                    ?>
                                    <div class="study-mode-card mb-4">
                                        <h6><i class="fas fa-clock me-2"></i><?= $type ?></h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Study Mode Type</label>
                                                <select name="sm_type_new_<?= $key ?>" class="form-select" required>
                                                    <option value="">Select Study Mode</option>
                                                    <option value="Sepenuh Masa" <?= $type == 'Sepenuh Masa' ? 'selected' : '' ?>>Sepenuh Masa</option>
                                                    <option value="Separuh Masa" <?= $type == 'Separuh Masa' ? 'selected' : '' ?>>Separuh Masa</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Long Sem (Bil.Semester)</label>
                                                <input type="number" name="sm_long_sem_new_<?= $key ?>" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Short Sem (Bil.Semester)</label>
                                                <input type="number" name="sm_short_sem_new_<?= $key ?>" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Long Sem Week (Bil.Minggu)</label>
                                                <input type="number" name="sm_long_sem_week_new_<?= $key ?>" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Short Sem Week (Bil.Minggu)</label>
                                                <input type="number" name="sm_short_sem_week_new_<?= $key ?>" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Long Sem Total</label>
                                                <input type="number" name="sm_long_sem_total_new_<?= $key ?>" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Short Sem Total</label>
                                                <input type="number" name="sm_short_sem_total_new_<?= $key ?>" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Duration (Tempoh)</label>
                                                <input type="text" name="sm_duration_new_<?= $key ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Add Program
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i> Close
                            </button>
                        </div>
                    </form>
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
        order: [[0, 'asc']],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search programs...",
            lengthMenu: "Show _MENU_ programs per page",
            zeroRecords: "No matching programs found",
            info: "Showing _START_ to _END_ of _TOTAL_ programs",
            infoEmpty: "No programs available",
            infoFiltered: "(filtered from _MAX_ total programs)"
        }
    });
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>