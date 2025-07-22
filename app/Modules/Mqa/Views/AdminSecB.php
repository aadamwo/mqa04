<head>
    <title>Admin Evidence & Message Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            background-color: #f8f9fc;
            color: var(--text-primary);
        }

        .container {
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

        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin: 2rem 0 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            border: none;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .btn-icon i {
            font-size: 14px;
        }

        .btn-add {
            background-color: var(--success-color);
            color: white;
        }

        .btn-add:hover {
            background-color: #17a673;
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-edit {
            background-color: var(--warning-color);
            color: #2c3e50;
        }

        .btn-edit:hover {
            background-color: #f4b619;
            color: #2c3e50;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-delete {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-delete:hover {
            background-color: #d62c1a;
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
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

        .table {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            background-color: white;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none;
            padding: 1rem;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-color);
        }

        .file-link {
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .file-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .modal-content {
            border-radius: 0.75rem;
            border: none;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            border-radius: 0.75rem 0.75rem 0 0;
            padding: 1.25rem;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-title i {
            margin-right: 0.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid var(--border-color);
            border-radius: 0 0 0.75rem 0.75rem;
            padding: 1.25rem;
        }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin: 2rem 0;
            gap: 1rem;
        }

        .nav-btn {
            flex: 1;
            max-width: 300px;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            text-align: center;
        }

        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary {
            background-color: var(--text-secondary);
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .nav-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .nav-btn {
                max-width: 100%;
                width: 100%;
            }
            
            .table thead th, .table tbody td {
                padding: 0.75rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
<main id="js-page-content" role="main" class="page-content">
    <div class="container">
        <h4 class="header-title">ADMIN: SECTION B</h4>

        <?php foreach ($sections as $section): ?>
            <h5 class="section-title">
                <i class="fas fa-folder-open me-2"></i>SECTION <?= esc($section->mcs_section_char) ?>: <?= esc($section->mcs_desc) ?>
            </h5>
            
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-icon btn-add" data-bs-toggle="modal" data-bs-target="#addItemModal<?= esc($section->mcs_section_char) ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Item">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <!-- Programme Code Dropdown -->
            <form method="get" class="mb-4">
                <input type="hidden" name="section" value="<?= esc($section->mcs_section_char) ?>">
                <label for="programme_code" class="form-label">Select Programme Code:</label>
                <select name="programme_code" id="programme_code" class="form-select" onchange="this.form.submit()">
                    <?php foreach ($programmeCodes as $code): ?>
                        <option value="<?= esc($code) ?>" <?= $selectedProgrammeCode == $code ? 'selected' : '' ?>>
                            <?= esc($code) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">NO.</th>
                            <th style="width: 15%;">PROGRAMME CODE</th>
                            <th style="width: 20%;">PERKARA</th>
                            <th style="width: 25%;">EVIDENCE FILE</th>
                            <th style="width: 25%;">MESSAGE</th>
                            <th style="width: 10%;">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rowNum = 1;
                        foreach ($section->items as $item):
                            if ($item->mcd_programme_code !== $selectedProgrammeCode) continue;
                        ?>
                            <tr>
                                <td><?= $rowNum++ ?>.</td>
                                <td><?= esc($item->mcd_programme_code ?? '-') ?></td>
                                <td><?= esc($item->mci_desc) ?></td>
                                <td>
                                    <?php if (!empty($item->mcd_file)): ?>
                                        <a href="<?= base_url($item->mcd_file) ?>" target="_blank" class="file-link">
                                            <i class="fas fa-file me-2"></i><?= esc($item->mcd_original_file_name) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">No file</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($item->mcd_message ?? '') ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-icon btn-edit" data-bs-toggle="modal" data-bs-target="#editModal<?= esc($section->mcs_section_char) ?><?= $item->mci_id ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Item">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/clear-file-message/' . $item->mci_id . '/' . $item->mcd_programme_code) ?>" style="display:inline;" onsubmit="return confirm('Remove evidence file and message for this item?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-icon btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove File & Message">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?= esc($section->mcs_section_char) ?><?= $item->mci_id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= esc($section->mcs_section_char) ?><?= $item->mci_id ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/edit-item/' . $item->mci_id) ?>" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?= esc($section->mcs_section_char) ?><?= $item->mci_id ?>">
                                                    <i class="fas fa-edit me-2"></i>Edit Evidence & Message
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Perkara</label>
                                                            <input type="text" name="mci_desc" class="form-control" value="<?= esc($item->mci_desc) ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Responsibility</label>
                                                            <select name="mci_responsibility" class="form-select" required>
                                                                <option value="Penyelaras Program" <?= ($item->mci_responsibility === 'Penyelaras Program') ? 'selected' : '' ?>>Penyelaras Program</option>
                                                                <option value="BPQ" <?= ($item->mci_responsibility === 'BPQ') ? 'selected' : '' ?>>BPQ</option>
                                                                <option value="Fakulti" <?= ($item->mci_responsibility === 'Fakulti') ? 'selected' : '' ?>>Fakulti</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Replace Evidence File</label>
                                                    <input type="file" name="mcd_file" class="form-control">
                                                    <?php if (!empty($item->mcd_id)): ?>
                                                        <small class="text-muted">Current file: <?= esc($item->mcd_original_file_name) ?></small>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Message</label>
                                                    <textarea name="mcd_message" class="form-control" rows="3"><?= esc($item->mcd_message ?? '') ?></textarea>
                                                </div>
                                                <input type="hidden" name="mcd_programme_code" value="<?= esc($item->mcd_programme_code) ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i>Save Changes
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i>Close
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Add Item Modal -->
            <div class="modal fade" id="addItemModal<?= esc($section->mcs_section_char) ?>" tabindex="-1" aria-labelledby="addItemModalLabel<?= esc($section->mcs_section_char) ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/add-item') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="addItemModalLabel<?= esc($section->mcs_section_char) ?>">
                                    <i class="fas fa-plus-circle me-2"></i>Add Item to Section <?= esc($section->mcs_section_char) ?>
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Perkara</label>
                                            <input type="text" name="mci_desc" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Responsibility</label>
                                            <select name="mci_responsibility" class="form-select" required>
                                                <option value="Penyelaras Program">Penyelaras Program</option>
                                                <option value="BPQ">BPQ</option>
                                                <option value="Fakulti">Fakulti</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Sequence</label>
                                            <input type="number" name="mci_sequence" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Evidence File</label>
                                            <input type="file" name="mcd_file" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea name="mcd_message" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add Item
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Navigation Buttons -->
        <div class="nav-buttons">
            <a href="<?= base_url('SecA.php') ?>" class="btn btn-secondary nav-btn">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
            <a href="<?= base_url('AdminSec.php?section=A') ?>" class="btn btn-primary nav-btn">
                <i class="fas fa-arrow-right me-2"></i>Go to Section A
            </a>
            <a href="<?= base_url('AdminSecC.php?section=C') ?>" class="btn btn-primary nav-btn">
                <i class="fas fa-arrow-right me-2"></i>Go to Section C
            </a>
            <a href="<?= base_url('adminprog') ?>" class="btn btn-primary nav-btn">
                <i class="fas fa-tasks me-2"></i>Go to Admin Program
            </a>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Add smooth transitions for modal opening
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(function(modal) {
            modal.addEventListener('show.bs.modal', function() {
                this.style.opacity = '0';
                setTimeout(() => {
                    this.style.opacity = '1';
                }, 100);
            });
        });
    });
</script>
</body>
</html>
<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>