<!DOCTYPE html>
<html>
<head>
    <title>MQA System UI</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Enhanced Table Styles */
        .enhanced-table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: none !important;
            background: white;
            margin: 20px 0;
        }

        .enhanced-table thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .enhanced-table thead th {
            color: white !important;
            border: none !important;
            padding: 18px 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            text-align: center;
        }

        .enhanced-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0 !important;
        }

        .enhanced-table tbody tr:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .enhanced-table tbody tr:last-child {
            border-bottom: none !important;
        }

        .enhanced-table tbody td {
            padding: 20px 15px;
            vertical-align: middle;
            border: none !important;
        }

        .bil-number {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto;
            box-shadow: 0 3px 8px rgba(102, 126, 234, 0.3);
            font-size: 0.9rem;
        }

        .perkara-text {
            font-weight: 500;
            color: #333;
            line-height: 1.5;
        }

        .upload-section {
            padding: 1rem;
            border: 1px solid #eee;
            border-radius: 8px;
            background: #fafbfc;
        }

        .file-upload-area label,
        .message-area label {
            font-weight: 500;
            margin-bottom: 0.3rem;
        }

        /* Panel styling */
        .panel {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .panel-hdr {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 20px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .panel-tag {
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-weight: 500;
            color: #333;
        }
        
        .panel-content {
            padding: 20px;
        }

        .subheader {
            margin-bottom: 20px;
        }

        .subheader-title {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .subheader-title small {
            display: block;
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
        }

        /* Navigation buttons */
        .section-nav-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        @media (max-width: 768px) {
            .enhanced-table {
                font-size: 0.85rem;
            }
            
            .enhanced-table thead th,
            .enhanced-table tbody td {
                padding: 12px 8px;
            }
            
            .bil-number {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }
            
            .section-nav-buttons {
                flex-direction: column;
                gap: 10px;
            }
            
            .section-nav-buttons .btn {
                width: 100%;
            }
        }
        
        /* Enhanced Table Styles */
        .enhanced-table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: none !important;
            background: white;
            margin: 20px 0;
        }
        .enhanced-table thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .enhanced-table thead th {
            color: white !important;
            border: none !important;
            padding: 18px 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            text-align: center;
        }
        .enhanced-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0 !important;
        }
        .enhanced-table tbody tr:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .enhanced-table tbody tr:last-child {
            border-bottom: none !important;
        }
        .enhanced-table tbody td {
            padding: 20px 15px;
            vertical-align: middle;
            border: none !important;
        }
        .bil-number {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto;
            box-shadow: 0 3px 8px rgba(102, 126, 234, 0.3);
            font-size: 0.9rem;
        }
        .perkara-text {
            font-weight: 500;
            color: #333;
            line-height: 1.5;
        }
        .upload-section {
            padding: 1rem;
            border: 1px solid #eee;
            border-radius: 8px;
            background: #fafbfc;
        }
        .file-upload-area label,
        .message-area label {
            font-weight: 500;
            margin-bottom: 0.3rem;
        }

    </style>
</head>
<body class="bg-light">

<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">MQA System</a></li>
        <li class="breadcrumb-item">Compliance</li>
        <li class="breadcrumb-item active">Status Pematuhan</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fas fa-check-circle'></i> BAHAGIAN C <span class='fw-300'>Status Pematuhan Syarat-syarat Khusus Akreditasi Penuh Program</span>
            <small>
                Sila lengkapkan maklumat dan muat naik dokumen yang diperlukan
            </small>
        </h1>
    </div>

   

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <span class="fw-300">BAHAGIAN C: STATUS PEMATUHAN SYARAT-SYARAT KHUSUS AKREDITASI PENUH PROGRAM</span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            Sila muat naik dokumen yang diperlukan untuk setiap perkara
                        </div>

                        <form method="post" enctype="multipart/form-data" action="<?= base_url('mqa/section-c/save') ?>">
                            <?= csrf_field() ?>
                            <table class="table enhanced-table">
                                <thead>
                                    <tr>
                                        <th>BIL.</th>
                                        <th>PERKARA</th>
                                        <th>LAMPIRAN BUKTI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $index => $item): ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-primary rounded-circle p-2"><?= $index + 1 ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="document-title">
                                                <h6 class="mb-0"><?= esc($item['sc_items']) ?></h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="upload-section p-3 border rounded">
                                                <div class="file-upload-area mb-3">
                                                    <label>Upload <?= esc($item['sc_items']) ?></label>
                                                    <input type="file" class="form-control mb-2" name="sc_file[<?= $item['sc_id'] ?>]">
                                                    <?php if (!empty($item['sc_file'])): ?>
                                                        <div class="mt-2">
                                                            <a href="<?= base_url($item['sc_file']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">View File</a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="message-area">
                                                    <label>Message</label>
                                                    <textarea class="form-control mb-2" name="sc_message[<?= $item['sc_id'] ?>]" rows="2"><?= isset($item['sc_message']) ? esc($item['sc_message']) : '' ?></textarea>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Save All Documents
                                </button>
                            </div>
                        </form>

                        <div class="d-flex justify-content-between mt-4 section-nav-buttons">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= site_url('mqa/section-b') ?>'">
                                <i class="fas fa-arrow-left"></i> Back to Section B
                            </button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='<?= site_url('mqa/section-d') ?>'">
                                Go to Section D <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript to show selected file name -->
<script>
function showFileName(input, labelId) {
    const fileName = input.files[0]?.name || "No file selected";
    const labelElement = document.getElementById(labelId);
    
    if (fileName === "No file selected") {
        labelElement.textContent = fileName;
        labelElement.className = "file-status no-file";
    } else {
        labelElement.textContent = fileName;
        labelElement.className = "file-status file-selected";
    }
}

// Upload a single file using AJAX
function uploadSingleFile(inputName) {
    const formData = new FormData();
    const input = document.getElementById(inputName);
    
    if (!input.files.length) {
        alert("Sila pilih fail terlebih dahulu.");
        return;
    }
    
    formData.append(inputName, input.files[0]);

    fetch('upload_section_c.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert("Fail berjaya dimuat naik!");
        console.log('Success:', result);
    })
    .catch(error => {
        alert("Muat naik fail gagal.");
        console.error('Error:', error);
    });
}

// Navigation functions
function goToSectionB() {
    // Replace with your actual navigation logic
    window.location.href = 'section_b.html';
    // Or if using a framework:
    // window.location.href = '<?= site_url('mqa/section-b') ?>';
}

function goToSectionD() {
    // Replace with your actual navigation logic
    window.location.href = 'section_d.html';
    // Or if using a framework:
    // window.location.href = '<?= site_url('mqa/section-d') ?>';
}

// Get current date for the breadcrumb
document.querySelector('.js-get-date').textContent = new Date().toLocaleDateString();
</script>

</body>
</html>