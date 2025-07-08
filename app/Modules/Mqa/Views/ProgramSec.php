<?php
// filepath: c:\laragon\www\mpquaapp\app\Modules\Mqa\Views\ProgramSec.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Program Profiling Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

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
            background-color: var(--light-bg);
            color: #4a5568;
            line-height: 1.6;
        }
        
        .breadcrumb {
            background-color: #fff;
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            box-shadow: var(--card-shadow);
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .breadcrumb-item a:hover {
            color: #2980b9;
        }
        
        .breadcrumb-item.active {
            color: var(--secondary-color);
            font-weight: 600;
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-header h2 {
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        
        .page-header p {
            color: #64748b;
            font-size: 1.1rem;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .card-header {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-bottom: none;
        }
        
        .alert {
            border-radius: 8px;
            border: none;
        }
        
        .btn-info {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            padding: 0.375rem 0.75rem;
            transition: all 0.2s;
        }
        
        .btn-info:hover {
            background-color: #2980b9;
            transform: translateY(-1px);
        }
        
        /* DataTables customization */
        #dataTable_wrapper {
            padding: 0 1.5rem;
        }
        
        #dataTable {
            margin: 1rem 0 !important;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        #dataTable thead th {
            background-color: #f1f5f9;
            color: var(--secondary-color);
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
        }
        
        #dataTable tbody td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        
        #dataTable tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }
        
        .dataTables_length select,
        .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.375rem 0.75rem;
        }
        
        .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            margin: 0 0.25rem;
            border: none !important;
        }
        
        .dataTables_paginate .paginate_button.current {
            background: var(--primary-color) !important;
            color: white !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767px) {
            .breadcrumb {
                padding: 0.5rem;
                font-size: 0.9rem;
            }
            
            .page-header h2 {
                font-size: 1.5rem;
            }
            
            .card-header {
                padding: 0.75rem 1rem;
            }
            
            #dataTable_wrapper {
                padding: 0 0.75rem;
            }
            
            .btn-info {
                padding: 0.25rem 0.5rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>

<main id="js-page-content" role="main" class="page-content py-4">
    <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bi bi-house-door-fill"></i> SmartAdmin</a></li>
                <li class="breadcrumb-item">Category</li>
                <li class="breadcrumb-item">Sub-category</li>
                <li class="breadcrumb-item active" aria-current="page">Program Profiling</li>
                <li class="ms-auto d-none d-sm-block"><span class="js-get-date text-muted"></span></li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header text-center">
            <h2>Program Profiling Dashboard</h2>
            <p>Comprehensive overview of all accredited programs</p>
        </div>

        <!-- Flash Success Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Program Table Card -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-table me-2"></i> Program List
                <div class="float-end d-none d-md-block">
                    <span class="badge bg-light text-dark">Total: <?= count($programs) ?></span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Reference No.</th>
                                <th>Qualification Name</th>
                                <th>Program Code</th>
                                <th>Delivery Mode</th>
                                <th>Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programs as $program): ?>
                                <tr>
                                    <td class="text-center"><?= esc($program->p_id) ?></td>
                                    <td><?= esc($program->p_reference_number) ?></td>
                                    <td><?= esc($program->p_qualification_name) ?></td>
                                    <td class="text-center"><?= esc($program->mcd_programme_code) ?></td>
                                    <td class="text-center"><?= esc($program->p_delivery_mode) ?></td>
                                    <td class="text-center"><?= esc($program->p_qualification_level) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('listprog/' . esc($program->p_slug)) ?>" class="btn btn-info btn-sm">
                                            <i class="bi bi-info-circle-fill me-1"></i> Details
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search programs...",
                lengthMenu: "Show _MENU_ programs",
                info: "Showing _START_ to _END_ of _TOTAL_ programs",
                infoEmpty: "No programs available",
                infoFiltered: "(filtered from _MAX_ total programs)"
            },
            initComplete: function() {
                $('.dataTables_filter input').addClass('form-control');
                $('.dataTables_length select').addClass('form-select');
            }
        });
    });
</script>
</body>
</html>