<?php
// filepath: c:\laragon\www\mpquaapp\app\Modules\Mqa\Views\PubB.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Accreditation Compliance Documents (Public)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;     /* Dark Blue */
            --secondary: #34495e;    /* Slightly lighter dark blue */
            --accent: #3498db;      /* Bright blue for accents */
            --light-accent: #ecf0f1; /* Very light gray */
            --success: #27ae60;    /* Green */
            --warning: #f39c12;     /* Orange */
            --danger: #e74c3c;      /* Red */
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #95a5a6;        /* Medium gray */
            --border: #dfe6e9;      /* Light border color */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            min-height: 100vh;
            color: var(--dark);
        }

        .container {
            max-width: 1200px;
            background: white;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .header-card {
            background-color: var(--primary);
            color: white;
            border-radius: 6px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .header-card h4 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .program-code {
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            display: inline-block;
            font-weight: 500;
        }

        .section-card {
            background: white;
            border-radius: 6px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .section-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border);
            padding-bottom: 0.75rem;
        }

        .section-title i {
            margin-right: 10px;
            font-size: 1.2rem;
            color: var(--accent);
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            background-color: var(--secondary);
            color: white;
            border: none;
            font-weight: 500;
            padding: 1rem;
            position: sticky;
            top: 0;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:nth-child(even) {
            background-color: rgba(236, 240, 241, 0.3);
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }

        .table td {
            padding: 1rem;
            border-top: 1px solid var(--border);
            vertical-align: middle;
        }

        .btn-primary {
            background-color: var(--accent);
            border: none;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: var(--gray);
            border: none;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }

        .btn-accent {
            background-color: var(--accent);
            border: none;
            color: white;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .btn-accent:hover {
            background-color: #2980b9;
            color: white;
        }

        .file-link {
            color: var(--accent);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .file-link i {
            margin-right: 5px;
        }

        .file-link:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        .form-control {
            border-radius: 4px;
            padding: 0.5rem 1rem;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 1rem;
        }

        .breadcrumb {
            background-color: rgba(0,0,0,0.03);
            padding: 0.75rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .breadcrumb-item a {
            color: var(--accent);
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .breadcrumb-item a i {
            margin-right: 5px;
        }

        .breadcrumb-item a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: var(--dark);
            font-weight: 500;
        }

        .badge-section {
            background-color: var(--accent);
            color: white;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.35rem 0.75rem;
            border-radius: 4px;
            margin-left: 10px;
        }

        /* Message Modal Styles */
        .message-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1050;
            justify-content: center;
            align-items: center;
        }

        .message-modal-content {
            background-color: white;
            border-radius: 6px;
            width: 90%;
            max-width: 500px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .message-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .message-modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
        }

        .message-modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
        }

        .message-textarea {
            width: 100%;
            min-height: 150px;
            margin-bottom: 1rem;
        }

        @media (max-width: 767px) {
            .container {
                padding: 1rem;
                border-radius: 0;
            }
            
            .header-card {
                padding: 1rem;
            }
            
            .table-responsive {
                font-size: 0.9rem;
            }
            
            .table td, .table th {
                padding: 0.75rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
<main id="js-page-content" role="main" class="page-content">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="fas fa-home"></i> SmartAdmin</a></li>
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-folder"></i> Category</a></li>
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-folder-open"></i> Sub-category</a></li>
                <li class="breadcrumb-item active"><i class="fas fa-file-alt"></i> Accreditation Docs</li>
                <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
            </ol>
        </nav>

        <div class="header-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h4><i class="fas fa-clipboard-check"></i> ACCREDITATION COMPLIANCE DOCUMENTS</h4>
                    <h5 class="mb-0 mt-2">Programme Code: <span class="program-code"><?= esc($programme_code) ?></span></h5>
                </div>
                <div class="d-flex gap-2 mt-2 mt-md-0">
                    <a href="<?= base_url('listprog/' . esc($program_slug)) ?>" class="btn btn-light">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <a href="<?= base_url('PubA.php?programme_code=' . urlencode($programme_code) . '&section=A') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Section A
                    </a>
                    <a href="<?= base_url('PubC.php?programme_code=' . urlencode($programme_code) . '&section=C') ?>" class="btn btn-accent">
                        <i class="fas fa-arrow-right"></i> Section C
                    </a>
                </div>
            </div>
        </div>

        <?php foreach ($sections as $section): ?>
            <div class="section-card">
                <h5 class="section-title">
                    <i class="fas fa-file-contract"></i> 
                    SECTION <?= esc($section->mcs_section_char) ?>: <?= esc($section->mcs_desc) ?>
                    <span class="badge-section"><?= count($itemsBySection[$section->mcs_section_char] ?? []) ?> Items</span>
                </h5>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                        <tr>
                            <th style="width: 5%;">NO.</th>
                            <th style="width: 30%;">ITEM</th>
                            <th style="width: 20%;">RESPONSIBILITY</th>
                            <th style="width: 35%;">EVIDENCE FILE</th>
                            <th style="width: 10%;">MESSAGE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $items = $itemsBySection[$section->mcs_section_char] ?? [];
                        foreach ($items as $index => $item): ?>
                            <tr>
                                <td class="fw-bold"><?= $index + 1 ?>.</td>
                                <td><?= esc($item->mci_desc) ?></td>
                                <td><?= esc($item->mci_responsibility) ?></td>
                                <td>
                                    <?php if (empty($item->mcd_id)): ?>
                                        <form method="post" enctype="multipart/form-data" action="<?= base_url('public/upload') ?>">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="mci_id" value="<?= esc($item->mci_id) ?>">
                                            <input type="hidden" name="programme_code" value="<?= esc($programme_code) ?>">
                                            <div class="d-flex gap-2 align-items-center">
                                                <input type="file" name="mcd_file" class="form-control form-control-sm" required>
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-upload"></i> Upload
                                                </button>
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <div class="mb-2">
                                            <a href="<?= base_url($item->mcd_file) ?>" target="_blank" class="file-link">
                                                <i class="fas fa-file-pdf"></i> <?= esc($item->mcd_original_file_name) ?>
                                            </a>
                                        </div>
                                        <form method="post" enctype="multipart/form-data" action="<?= base_url('public/upload') ?>">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="mci_id" value="<?= esc($item->mci_id) ?>">
                                            <input type="hidden" name="programme_code" value="<?= esc($programme_code) ?>">
                                            <div class="d-flex gap-2 align-items-center">
                                                <input type="file" name="mcd_file" class="form-control form-control-sm" required>
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-sync-alt"></i> Replace
                                                </button>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary message-btn" 
                                            onclick="openMessageModal('<?= esc($item->mci_id) ?>', '<?= esc($programme_code) ?>', '<?= esc($item->mcd_message ?? '') ?>')">
                                        <i class="fas fa-comment"></i> Message
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<!-- Message Modal -->
<div class="message-modal" id="messageModal">
    <div class="message-modal-content">
        <div class="message-modal-header">
            <div class="message-modal-title">Send Message</div>
            <button class="message-modal-close" onclick="closeMessageModal()">&times;</button>
        </div>
        <form id="messageForm" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="mci_id" id="modalMciId">
            <input type="hidden" name="programme_code" id="modalProgrammeCode">
            <textarea name="mcd_message" class="form-control message-textarea" id="messageTextarea" placeholder="Type your message here..."></textarea>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Simple date display for the header
    document.addEventListener('DOMContentLoaded', function() {
        const dateElements = document.querySelectorAll('.js-get-date');
        if (dateElements.length > 0) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date();
            dateElements.forEach(el => {
                el.textContent = today.toLocaleDateString('en-US', options);
            });
        }
    });

    // Message Modal Functions
    function openMessageModal(mciId, programmeCode, currentMessage) {
        const modal = document.getElementById('messageModal');
        document.getElementById('modalMciId').value = mciId;
        document.getElementById('modalProgrammeCode').value = programmeCode;
        document.getElementById('messageTextarea').value = currentMessage || '';
        modal.style.display = 'flex';
    }

    function closeMessageModal() {
        document.getElementById('messageModal').style.display = 'none';
    }

    // Handle form submission
    document.getElementById('messageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('/public/edit-message', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Message sent successfully!');
                closeMessageModal();
                // You might want to refresh the page or update the UI here
            } else {
                alert('Error sending message: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while sending the message.');
        });
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('messageModal');
        if (event.target === modal) {
            closeMessageModal();
        }
    });
</script>
</body>
</html>