<?php
$editing = isset($_GET['edit']) && $_GET['edit'] == '1';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Program Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --card-hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            color: #4a5568;
            line-height: 1.6;
        }
        
        .summary-card {
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            background: #fff;
            padding: 2rem;
            margin-bottom: 2rem;
            border: none;
            transition: all 0.3s ease;
        }
        
        .summary-card:hover {
            box-shadow: var(--card-hover-shadow);
            transform: translateY(-2px);
        }
        
        .summary-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        
        .summary-value {
            font-size: 1.1rem;
            color: #64748b;
        }
        
        .icon-box {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-right: 1.5rem;
            flex-shrink: 0;
        }
        
        .btn-custom {
            min-width: 150px;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        
        .btn-warning {
            background-color: #f39c12;
            border-color: #f39c12;
            color: white;
        }
        
        .btn-warning:hover {
            background-color: #e67e22;
            border-color: #e67e22;
            color: white;
        }
        
        .study-mode-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }
        
        .study-mode-content.active {
            display: block;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        
        .card-header {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-bottom: none;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            font-weight: 600;
            color: var(--secondary-color);
            width: 30%;
            background-color: #f8fafc;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(241, 245, 249, 0.5);
        }
        
        .table-bordered {
            border: 1px solid #e2e8f0;
        }
        
        .table-bordered th, 
        .table-bordered td {
            border: 1px solid #e2e8f0;
        }
        
        .study-mode-table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .study-mode-table th {
            background-color: #f1f5f9;
            font-weight: 500;
            padding: 0.75rem 1rem;
        }
        
        .study-mode-table td {
            padding: 0.75rem 1rem;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0.75rem 0;
            font-size: 0.9rem;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: var(--secondary-color);
            font-weight: 500;
        }
        
        @media (max-width: 767px) {
            .summary-card {
                padding: 1.5rem;
                flex-direction: column;
                text-align: center;
            }
            
            .icon-box {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .summary-title {
                font-size: 1.5rem;
            }
            
            .summary-value {
                font-size: 1rem;
            }
            
            .btn-custom {
                min-width: 120px;
                font-size: 0.9rem;
                padding: 0.4rem 1rem;
            }
            
            .table th, 
            .table td {
                padding: 0.75rem;
            }
            
            .table th {
                width: 40%;
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item">Category</li>
        <li class="breadcrumb-item">Sub-category</li>
        <li class="breadcrumb-item active">Program Details</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>

    <div class="container py-4">
        <div class="summary-card d-flex align-items-center mb-4">
            <div class="icon-box me-3">
                <i class="bi bi-mortarboard"></i>
            </div>
            <div>
                <div class="summary-title"><?= esc($program->p_qualification_name) ?></div>
                <div class="summary-value">
                    <strong>Programme Code:</strong> <?= esc($program->mcd_programme_code) ?> &nbsp; | &nbsp;
                    <strong>Level:</strong> <?= esc($program->p_qualification_level) ?> &nbsp; | &nbsp;
                    <strong>Reference:</strong> <?= esc($program->p_reference_number) ?>
                </div>
            </div>
        </div>

        <?php if (!$editing): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    Program Information
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr><th>Certificate Number</th><td><?= esc($program->p_certificate_number) ?></td></tr>
                            <tr><th>Accreditation Date</th><td><?= esc($program->p_accreditation_date) ?></td></tr>
                            <tr><th>Institution Name</th><td><?= esc($program->p_inst_name) ?></td></tr>
                            <tr><th>Institution Address</th><td><?= esc($program->p_inst_address) ?></td></tr>
                            <tr><th>Phone Number</th><td><?= esc($program->p_phone_number) ?></td></tr>
                            <tr><th>Fax Number</th><td><?= esc($program->p_fax_number) ?></td></tr>
                            <tr><th>Email Address</th><td><?= esc($program->p_email_address) ?></td></tr>
                            <tr><th>Website</th><td><?= esc($program->p_website) ?></td></tr>
                            <tr><th>Compliance Audit</th><td><?= esc($program->p_compliance_audit) ?></td></tr>
                            <tr><th>MQF Level</th><td><?= esc($program->p_mqf_level) ?></td></tr>
                            <tr><th>NEC Field</th><td><?= esc($program->p_nec_field) ?></td></tr>
                            <tr><th>Total Credits</th><td><?= esc($program->p_total_credits) ?></td></tr>
                            <tr>
                                <th>Study Duration</th>
                                <td>
                                    <?php if (!empty($studyModes)): ?>
                                        <?php 
                                        $hasFullTime = false;
                                        $hasPartTime = false;
                                        foreach ($studyModes as $mode) {
                                            if ($mode->sm_type === 'Sepenuh Masa') $hasFullTime = true;
                                            if ($mode->sm_type === 'Separuh Masa') $hasPartTime = true;
                                        }
                                        ?>
                                        
                                        <?php if ($hasFullTime && $hasPartTime): ?>
                                            <div class="mb-3">
                                                <select class="form-select study-mode-selector">
                                                    <option value="sepenuh_masa">Sepenuh Masa</option>
                                                    <option value="separuh_masa">Separuh Masa</option>
                                                </select>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="study-mode-container">
                                            <?php foreach ($studyModes as $mode): ?>
                                                <div class="study-mode-content <?= strtolower(str_replace(' ', '_', $mode->sm_type)) ?> <?= ($hasFullTime && $hasPartTime && $mode->sm_type === 'Sepenuh Masa') || !($hasFullTime && $hasPartTime) ? 'active' : '' ?>">
                                                    <div class="mb-3">
                                                        <h5 class="mb-3 text-primary"><?= esc($mode->sm_type) ?></h5>
                                                        <div class="study-mode-table">
                                                            <table class="table table-bordered mb-2">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="2" class="text-center">Study Mode Details</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr><th>Long Sem (Bil.Semester)</th><td><?= esc($mode->sm_long_sem ?? '-') ?></td></tr>
                                                                    <tr><th>Short Sem (Bil.Semester)</th><td><?= esc($mode->sm_short_sem ?? '-') ?></td></tr>
                                                                    <tr><th>Long Sem Week (Bil.Minggu)</th><td><?= esc($mode->sm_long_sem_week ?? '-') ?></td></tr>
                                                                    <tr><th>Short Sem Week (Bil.Minggu)</th><td><?= esc($mode->sm_short_sem_week ?? '-') ?></td></tr>
                                                                    <tr><th>Long Sem Total</th><td><?= esc($mode->sm_long_sem_total ?? '-') ?></td></tr>
                                                                    <tr><th>Short Sem Total</th><td><?= esc($mode->sm_short_sem_total ?? '-') ?></td></tr>
                                                                    <tr><th>Duration (Tempoh)</th><td><?= esc($mode->sm_duration ?? '-') ?></td></tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">No study mode data</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr><th>Delivery Mode</th><td><?= esc($program->p_delivery_mode) ?></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-4">
                <a href="<?= base_url('ProgramSec.php') ?>" class="btn btn-outline-secondary btn-custom">&larr; Back to Program List</a>
                <a href="<?= current_url() . '?edit=1' ?>" class="btn btn-warning btn-custom">Edit</a>
                <a href="<?= base_url('PubA.php?programme_code=' . urlencode($program->mcd_programme_code)) ?>" class="btn btn-primary btn-custom">Upload</a>
            </div>
        <?php else: ?>
            <form method="post" action="<?= base_url('updateProgram/' . $program->p_id) ?>">
                <?= csrf_field() ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        Edit Program Information
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th>Certificate Number</th>
                                    <td><input type="text" name="p_certificate_number" class="form-control" value="<?= esc($program->p_certificate_number) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Accreditation Date</th>
                                    <td><input type="date" name="p_accreditation_date" class="form-control" value="<?= esc($program->p_accreditation_date) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Institution Name</th>
                                    <td><input type="text" name="p_inst_name" class="form-control" value="<?= esc($program->p_inst_name) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Institution Address</th>
                                    <td><input type="text" name="p_inst_address" class="form-control" value="<?= esc($program->p_inst_address) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td><input type="text" name="p_phone_number" class="form-control" value="<?= esc($program->p_phone_number) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Fax Number</th>
                                    <td><input type="text" name="p_fax_number" class="form-control" value="<?= esc($program->p_fax_number) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Email Address</th>
                                    <td><input type="email" name="p_email_address" class="form-control" value="<?= esc($program->p_email_address) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td><input type="text" name="p_website" class="form-control" value="<?= esc($program->p_website) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Compliance Audit</th>
                                    <td><input type="text" name="p_compliance_audit" class="form-control" value="<?= esc($program->p_compliance_audit) ?>"></td>
                                </tr>
                                <tr>
                                    <th>MQF Level</th>
                                    <td><input type="text" name="p_mqf_level" class="form-control" value="<?= esc($program->p_mqf_level) ?>"></td>
                                </tr>
                                <tr>
                                    <th>NEC Field</th>
                                    <td><input type="text" name="p_nec_field" class="form-control" value="<?= esc($program->p_nec_field) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Total Credits</th>
                                    <td><input type="number" name="p_total_credits" class="form-control" value="<?= esc($program->p_total_credits) ?>"></td>
                                </tr>
                                <tr>
                                    <th>Study Duration</th>
                                    <td>
                                        <?php if (!empty($studyModes)): ?>
                                            <?php 
                                            $hasFullTime = false;
                                            $hasPartTime = false;
                                            foreach ($studyModes as $mode) {
                                                if ($mode->sm_type === 'Sepenuh Masa') $hasFullTime = true;
                                                if ($mode->sm_type === 'Separuh Masa') $hasPartTime = true;
                                            }
                                            ?>
                                            
                                            <?php if ($hasFullTime && $hasPartTime): ?>
                                                <div class="mb-3">
                                                    <select class="form-select study-mode-selector">
                                                        <option value="sepenuh_masa">Sepenuh Masa</option>
                                                        <option value="separuh_masa">Separuh Masa</option>
                                                    </select>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="study-mode-container">
                                                <?php foreach ($studyModes as $mode): ?>
                                                    <div class="study-mode-content <?= strtolower(str_replace(' ', '_', $mode->sm_type)) ?> <?= ($hasFullTime && $hasPartTime && $mode->sm_type === 'Sepenuh Masa') || !($hasFullTime && $hasPartTime) ? 'active' : '' ?>">
                                                        <div class="mb-3">
                                                            <h5 class="mb-3 text-primary"><?= esc($mode->sm_type) ?></h5>
                                                            <input type="hidden" name="sm_id[]" value="<?= esc($mode->sm_id) ?>">
                                                            <input type="hidden" name="sm_type_existing_<?= esc($mode->sm_id) ?>" value="<?= esc($mode->sm_type) ?>">
                                                            <div class="row g-3">
                                                                <div class="col-md-6 col-lg-4">
                                                                    <label class="form-label">Long Sem (Bil.Semester)</label>
                                                                    <input type="number" name="sm_long_sem_existing_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_long_sem) ?>">
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <label class="form-label">Short Sem (Bil.Semester)</label>
                                                                    <input type="number" name="sm_short_sem_existing_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_short_sem) ?>">
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <label class="form-label">Long Sem Week (Bil.Minggu)</label>
                                                                    <input type="number" name="sm_long_sem_week_existing_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_long_sem_week) ?>">
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <label class="form-label">Short Sem Week (Bil.Minggu)</label>
                                                                    <input type="number" name="sm_short_sem_week_existing_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_short_sem_week) ?>">
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <label class="form-label">Long Sem Total</label>
                                                                    <input type="number" name="sm_long_sem_total_existing_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_long_sem_total) ?>">
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <label class="form-label">Short Sem Total</label>
                                                                    <input type="number" name="sm_short_sem_total_existing_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_short_sem_total) ?>">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label">Duration (Tempoh)</label>
                                                                    <input type="text" name="sm_duration_existing_<?= esc($mode->sm_id) ?>" class="form-control" value="<?= esc($mode->sm_duration) ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted">No study mode data</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Delivery Mode</th>
                                    <td><input type="text" name="p_delivery_mode" class="form-control" value="<?= esc($program->p_delivery_mode) ?>"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-4">
                    <a href="<?= current_url() ?>" class="btn btn-outline-secondary btn-custom">&larr; Cancel</a>
                    <button type="submit" class="btn btn-success btn-custom">Save Changes</button>
                    <a href="<?= base_url('PubA.php?programme_code=' . urlencode($program->mcd_programme_code)) ?>" class="btn btn-primary btn-custom">Upload</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modeSelectors = document.querySelectorAll('.study-mode-selector');
    
    modeSelectors.forEach(selector => {
        selector.addEventListener('change', function() {
            const container = this.closest('td').querySelector('.study-mode-container');
            const selectedMode = this.value;
            
            // Hide all study mode contents
            container.querySelectorAll('.study-mode-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Show the selected one
            container.querySelector(`.study-mode-content.${selectedMode}`).classList.add('active');
        });
    });
});
</script>
</body>
</html>