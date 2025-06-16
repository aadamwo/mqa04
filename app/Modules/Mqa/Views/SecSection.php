<?php
// filepath: app/Modules/Mqa/Views/SecSection.php
?>
<main class="page-content">
    <div class="container mt-5">
        <h4>Section <?= esc($sectionChar) ?>: <?= esc($section->mcs_desc) ?></h4>

        <!-- Add Item Form -->
        <form method="post" action="<?= base_url('section/' . $sectionChar . '/add-item') ?>" class="mb-3">
            <?= csrf_field() ?>
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="mci_desc" class="form-control" placeholder="Item description" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="mci_sequence" class="form-control" placeholder="Sequence" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">Add Item</button>
                </div>
            </div>
        </form>

        <!-- Item Table -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Sequence</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item->mci_sequence) ?></td>
                    <td><?= esc($item->mci_desc) ?></td>
                    <td>
                        <a href="<?= base_url('section/' . $sectionChar . '/edit-item/' . $item->mci_id) ?>" class="btn btn-sm btn-primary">Edit</a>
                        <form method="post" action="<?= base_url('section/' . $sectionChar . '/delete-item/' . $item->mci_id) ?>" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($items)): ?>
                <tr>
                    <td colspan="3" class="text-center">No items found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
