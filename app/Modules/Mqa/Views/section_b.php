<!-- Modules/Mqa/Views/section_b.php -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">MQA</li>
        <li class="breadcrumb-item active">BAHAGIAN B: MAKLUMAT PROGRAM</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-file-alt'></i> BAHAGIAN B <span class='fw-300'>MAKLUMAT PROGRAM</span>
            <small>
                Maklumat program pengajian dan pengurusan akademik
            </small>
        </h1>
    </div>

    <style>
        /* Enhanced Table Styles (same as section_a.php) */
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

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Maklumat Program <span class="fw-300"><i>Pengajian</i></span>
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
                            Sila lengkapkan maklumat program dan muat naik dokumen berkaitan
                        </div>

                        <form method="post" enctype="multipart/form-data" action="<?= base_url('mqa/section-b/save') ?>">
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
                                                <h6 class="mb-0"><?= esc($item['sb_items']) ?></h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="upload-section p-3 border rounded">
                                                <div class="file-upload-area mb-3">
                                                    <label>Upload <?= esc($item['sb_items']) ?></label>
                                                    <input type="file" class="form-control mb-2" name="sb_file[<?= $item['sb_id'] ?>]">
                                                    <?php if (!empty($item['sb_file'])): ?>
                                                        <div class="mt-2">
                                                            <a href="<?= base_url($item['sb_file']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">View File</a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="message-area">
                                                    <label>Message</label>
                                                    <textarea class="form-control mb-2" name="sb_message[<?= $item['sb_id'] ?>]" rows="2"><?= isset($item['sb_message']) ? esc($item['sb_message']) : '' ?></textarea>
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

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mt-3" onclick="goToSectionC()">Go to Section C</button>
                        </div>
                        <div class="d-flex justify-content-start">
                            <button type="button" class="btn btn-secondary mt-3" onclick="goToSectionA()">
                                <i class="fas fa-arrow-left mr-2"></i>Back to Section A
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function goToSectionA() {
    window.location.href = '<?= site_url('mqa/section-a') ?>';
}
function goToSectionC() {
    window.location.href = '<?= site_url('mqa/section-c') ?>';
}
</script>