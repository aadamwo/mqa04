<main id="js-page-content" role="main" class="page-content">
    <title>Dokumen Pematuhan Akreditasi</title>
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

        .container-main {
            max-width: 1200px;
            margin: 2rem auto;
        }

        .header-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .header-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 3px;
        }

        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .card-header {
            background-color: var(--secondary-color);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .nav-tabs {
            border-bottom: none;
            margin-bottom: 1.5rem;
        }

        .nav-tabs .nav-link {
            border: none;
            border-radius: 0.35rem;
            padding: 0.75rem 1.5rem;
            color: var(--text-secondary);
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
            background-color: var(--secondary-color);
        }

        .nav-tabs .nav-link {
            background-color: #f9fafc !important;
            color: #2e59d9 !important;
            border: 1px solid #d1d3e2 !important;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(78, 115, 223, 0.08);
            transition: background 0.2s, color 0.2s;
        }

        .nav-tabs .nav-link:hover {
            color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.1);
        }

        .nav-tabs .nav-link.active {
            background-color: #4e73df !important;
            color: #fff !important;
            border-color: #4e73df #4e73df #fff !important;
            box-shadow: 0 4px 16px rgba(78, 115, 223, 0.15);
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.35rem;
            border: none;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .btn-icon i {
            font-size: 14px;
        }

        .btn-add {
            background-color: #2e59d9 !important;   /* Bright green */
            color: #fff !important;
            border: none;
            box-shadow: 0 2px 8px rgba(56, 9, 242, 0.15);
            font-weight: 700;
        }
        .btn-add:hover, .btn-add:focus {
            background-color: #2e59d9 !important;
            color: #fff !important;
            box-shadow: 0 4px 16px rgba(28, 200, 138, 0.25);
        }


        .btn-edit {
            background-color: #f1b00cff !important;   /* Bright yellow */
            color: #212529 !important;
            border: none;
            box-shadow: 0 2px 8px rgba(246, 194, 62, 0.15);
            font-weight: 700;
        }
        .btn-edit:hover, .btn-edit:focus {
            background-color: #c38e06ff !important;
            color: #fff !important;
            box-shadow: 0 4px 16px rgba(246, 194, 62, 0.25);
        }

        .btn-delete {
            background-color: #e74a3b !important;   /* Bright red */
            color: #fff !important;
            border: none;
            box-shadow: 0 2px 8px rgba(231, 74, 59, 0.15);
            font-weight: 700;
        }
        .btn-delete:hover, .btn-delete:focus {
            background-color: #be2617 !important;
            color: #fff !important;
            box-shadow: 0 4px 16px rgba(231, 74, 59, 0.25);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 0.35rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .alert {
            border-radius: 0.35rem;
            box-shadow: var(--shadow-sm);
        }

        .alert-success {
            background-color: var(--success-color);
            color: white;
            border: none;
        }

        .table {
            border-radius: 0.35rem;
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border: none;
        }

        .table tbody tr {
            transition: all 0.3s ease;
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

        .next-page-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 0.35rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .next-page-btn:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        @media (max-width: 768px) {
            .nav-tabs .nav-link {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
            
            .btn-icon {
                width: 32px;
                height: 32px;
            }
        }
    </style>
    <div class="container container-main">
        <h4 class="header-title">DOKUMEN PEMATUHAN AKREDITASI PROGRAM</h4>

        <?php
        use App\Models\MqaComSectionModel;
        use App\Models\MqaComItemModel;

        $sectionModel = new MqaComSectionModel();
        $itemModel = new MqaComItemModel();
        $sections = $sectionModel->orderBy('mcs_section_char', 'asc')->findAll();
        ?>

   

        <!-- Section Tabs -->
        <ul class="nav nav-tabs justify-content-start" id="sectionTabs" role="tablist">
            <?php foreach ($sections as $i => $section): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $i === 0 ? 'active' : '' ?>" id="tab-<?= $section->mcs_section_char ?>" data-bs-toggle="tab" data-bs-target="#section-<?= $section->mcs_section_char ?>" type="button" role="tab" aria-controls="section-<?= $section->mcs_section_char ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>">
                        <i class="fas fa-folder me-2"></i>Section <?= esc($section->mcs_section_char) ?>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content" id="sectionTabsContent">
            <?php foreach ($sections as $i => $section): ?>
                <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="section-<?= $section->mcs_section_char ?>" role="tabpanel" aria-labelledby="tab-<?= $section->mcs_section_char ?>">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-clipboard-list me-2"></i>
                                <strong>Section <?= esc($section->mcs_section_char) ?>:</strong> <?= esc($section->mcs_desc) ?>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <!-- Trash Icon (Delete Section) -->
                                <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/delete') ?>" onsubmit="return confirm('Padam bahagian ini dan semua itemnya?');" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-icon btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Padam Bahagian">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <!-- Add Section Icon (Modal Trigger) -->
                                <button type="button" class="btn btn-icon btn-add" data-bs-toggle="modal" data-bs-target="#addSectionModal" data-section="<?= esc($section->mcs_section_char) ?>" title="Tambah Bahagian Baru">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Add Item Form -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <i class="fas fa-plus me-2"></i>Tambah Item Baru
                                </div>
                                <div class="card-body">
                                    <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/add-item') ?>" class="row g-3">
                                        <?= csrf_field() ?>
                                        <div class="col-md-6">
                                            <label class="form-label">Penerangan Item</label>
                                            <input type="text" name="mci_desc" class="form-control" placeholder="Masukkan penerangan item" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Urutan</label>
                                            <input type="number" name="mci_sequence" class="form-control" placeholder="No." required>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Tanggungjawab</label>
                                            <select name="mci_responsibility" class="form-select" required>
                                                <option value="">Pilih...</option>
                                                <option value="Penyelaras Program">Penyelaras Program</option>
                                                <option value="BPQ">BPQ</option>
                                                <option value="Fakulti">Fakulti</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="submit" class="btn btn-icon btn-add w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Item">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- List Items -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="80">Urutan</th>
                                            <th>Penerangan</th>
                                            <th width="150">Tanggungjawab</th>
                                            <th width="120">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
$items = $itemModel->where('mci_mcs_id', $section->mcs_id)->orderBy('mci_sequence', 'asc')->findAll();

foreach ($items as $item): ?>
<tr>
    <td><span class="badge badge-primary"><?= esc($item->mci_sequence) ?></span></td>
    <td><?= esc($item->mci_desc) ?></td>
    <td><span class="badge badge-info"><?= esc($item->mci_responsibility ?? '-') ?></span></td>
    <td>
        <div class="action-buttons">
            <!-- Reusable Edit Button -->
            <button 
                type="button"
                class="btn btn-icon btn-edit editItemBtn"
                data-bs-toggle="modal"
                data-bs-target="#editItemModal"
                data-id="<?= $item->mci_id ?>"
                data-desc="<?= esc($item->mci_desc) ?>"
                data-seq="<?= $item->mci_sequence ?>"
                data-resp="<?= $item->mci_responsibility ?>"
                data-action="<?= base_url('section/' . $section->mcs_section_char . '/edit-item/' . $item->mci_id) ?>"
                title="Edit Item"
            >
                <i class="fas fa-edit"></i>
            </button>

            <!-- Delete Form -->
            <form method="post" action="<?= base_url('section/' . $section->mcs_section_char . '/delete-item/' . $item->mci_id) ?>" style="display:inline;" onsubmit="return confirm('Padam item ini?');">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-icon btn-delete" data-bs-toggle="tooltip" title="Padam Item">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
<?php endforeach; ?>
</tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <!-- Reusable Edit Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editItemForm" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Penerangan</label>
                        <input type="text" name="mci_desc" id="modal_mci_desc" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="mci_sequence" id="modal_mci_sequence" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggungjawab</label>
                        <select name="mci_responsibility" id="modal_mci_responsibility" class="form-select" required>
                            <option value="Penyelaras Program">Penyelaras Program</option>
                            <option value="BPQ">BPQ</option>
                            <option value="Fakulti">Fakulti</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- Add Section Modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('section/add') ?>">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addSectionModalLabel"><i class="fas fa-plus-circle me-2"></i>Tambah Bahagian Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Bahagian</label>
                        <input type="text" name="mcs_section_char" class="form-control" placeholder="A-Z" maxlength="1" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Penerangan Bahagian</label>
                        <input type="text" name="mcs_desc" class="form-control" placeholder="Masukkan penerangan bahagian" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Bahagian
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- Next Page Section -->
        <div class="text-center mt-5">
            <a href="<?= base_url('AdminSec.php') ?>" class="next-page-btn">
                <i class="fas fa-arrow-right me-2"></i>Next Page
            </a>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editItemBtn');
    const form = document.getElementById('editItemForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const desc = this.getAttribute('data-desc');
            const seq = this.getAttribute('data-seq');
            const resp = this.getAttribute('data-resp');
            const action = this.getAttribute('data-action');

            // Fill modal inputs
            document.getElementById('modal_mci_desc').value = desc;
            document.getElementById('modal_mci_sequence').value = seq;
            document.getElementById('modal_mci_responsibility').value = resp;

            // Set form action dynamically
            form.setAttribute('action', action);
        });
    });
});
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Add smooth transitions for tab switching
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('#sectionTabs button[data-bs-toggle="tab"]');
            tabLinks.forEach(function(tabLink) {
                tabLink.addEventListener('shown.bs.tab', function(e) {
                    const target = document.querySelector(e.target.getAttribute('data-bs-target'));
                    if (target) {
                        target.style.opacity = '0';
                        setTimeout(() => {
                            target.style.opacity = '1';
                        }, 100);
                    }
                });
            });
        });
    </script>