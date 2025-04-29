<?= $this->extend('admin-lte-3/layouts/main') ?>

<?= $this->section('styles') ?>
<!-- Additional styles specific to this page -->
<style>
    .custom-card {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Main content goes here -->
<div class="row">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header">
                <h3 class="card-title">Sample Page</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p>This is a sample page that demonstrates the use of the modular layout system.</p>
                <p>You can add your content here and it will be rendered within the main layout.</p>
                
                <!-- Example Data Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>User <?= $i ?></td>
                                <td>user<?= $i ?>@example.com</td>
                                <td>
                                    <span class="badge badge-<?= $i % 2 ? 'success' : 'warning' ?>">
                                        <?= $i % 2 ? 'Active' : 'Pending' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination example -->
                <div class="mt-3">
                    <?php if (isset($pager)): ?>
                        <?= $pager->links('default', 'admin_lte3_pager') ?>
                    <?php else: ?>
                        <!-- Dummy pagination for example -->
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Additional scripts specific to this page -->
<script>
$(function() {
    console.log('Sample page loaded!');
    
    // Example of how to use AJAX with the layout
    $('.btn-info').on('click', function(e) {
        e.preventDefault();
        alert('View button clicked!');
    });
});
</script>
<?= $this->endSection() ?> 