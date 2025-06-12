<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Category</li>
        <li class="breadcrumb-item">Sub-category</li>
        <li class="breadcrumb-item active">Page Title</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-globe'></i> Section A<span class='fw-300'></span> <sup class='badge badge-primary fw-500'>STICKER</sup>
            <small>
                Maklum Umum Pemberi Pendidikan Tinggi(PPT)
            </small>
        </h1>
        <div class="subheader-block">
            Right Subheader Block
        </div>
    </div>
    
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

        .file-upload-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Simplified file input styling */
        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            width: 100%;
            height: 40px;
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
            z-index: 2;
        }

        .file-input-styled {
            display: inline-block;
            padding: 10px 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .file-input-styled:hover {
            background: linear-gradient(135deg, #5a6fd8, #6a4190);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .file-input-styled i {
            margin-right: 6px;
        }

        .file-status {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
        }

        .file-status.no-file {
            background: #f8f9fa;
            color: #6c757d;
            border: 1px dashed #dee2e6;
        }

        .file-status.file-selected {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border: 1px solid #c3e6cb;
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
        }
    </style>
    
    <div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Panel <span class="fw-300"><i>Title</i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="panel-tag">
                        Section A - Important Data Table
                    </div>

                    <form method="post" enctype="multipart/form-data" action="<?= base_url('mqa/section-a/save') ?>">
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
                        <h6 class="mb-0"><?= esc($item['sa_items']) ?></h6>
                    </div>
                </td>
                <td>
                    <div class="upload-section p-3 border rounded">
                        <div class="file-upload-area mb-3">
                            <label>Upload <?= esc($item['sa_items']) ?></label>
                            <input type="file" class="form-control mb-2" name="sa_file[<?= $item['sa_id'] ?>]">
                            <?php if (!empty($item['sa_file'])): ?>
                                <div class="mt-2">
                                    <a href="<?= base_url($item['sa_file']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">View File</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="message-area">
                            <label>Message</label>
                            <textarea class="form-control mb-2" name="sa_message[<?= $item['sa_id'] ?>]" rows="2"></textarea>
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


<script>
    function submitNotes(rowNumber) {
        const notes = document.getElementById(`notes${rowNumber}`).value;
        if (notes.trim() === "") {
            alert("Please enter some notes before submitting.");
            return;
        }
        
        alert(`Notes for row ${rowNumber} submitted successfully!\n\nNotes: ${notes}`);
        
    }
</script>

                         <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-primary mt-3" onclick="goToSectionB()">Go to Section B</button>
</div>
<script>
function goToSectionB() {
    window.location.href = '<?= site_url('mqa/section-b') ?>'; 
}
</script>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
        alert("Please select a file first.");
        return;
    }
    
    formData.append(inputName, input.files[0]);

    fetch('section-a/save', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert("File uploaded successfully!");
        console.log('Success:', result);
    })
    .catch(error => {
        alert("File upload failed.");
        console.error('Error:', error);
    });
}

// Alternative function to trigger file input (backup method)
function triggerFileInput(inputId) {
    document.getElementById(inputId).click();
}
</script>

</main>
<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>