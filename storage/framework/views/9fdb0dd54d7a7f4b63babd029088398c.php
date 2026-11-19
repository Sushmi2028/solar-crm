
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Product Management</h4>
</div>

<!-- SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="summary-card gradient-blue">
            <h6>Total Products</h6>
            <h2><?php echo e(count($products)); ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="summary-card gradient-green">
            <h6>Active Products</h6>
            <h2><?php echo e($products->where('status','Active')->count()); ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="summary-card gradient-orange">
            <h6>Categories</h6>
            <h2><?php echo e($products->pluck('category')->unique()->count()); ?></h2>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- ADD PRODUCT -->
    <div class="col-lg-4">
        <div class="card-box p-4">
            <h5 class="fw-bold mb-3">Add Product</h5>

            <form method="POST" action="/admin/products/store">
                <?php echo csrf_field(); ?>
                <input type="text"name="name"class="form-control mb-3"placeholder="Product Name"required>

                <select name="category"class="form-control mb-3"required>
                    <option value="">Select Category</option>
                    <option value="Panel">Panel</option>
                    <option value="Inverter">Inverter</option>
                    <option value="Battery">Battery</option>
                    <option value="Structure">Structure</option>
                </select>

                <input type="number"name="price"class="form-control mb-3"placeholder="Price"required>

                <input type="text"name="capacity"class="form-control mb-3"placeholder="Capacity (e.g. 5kW)">

                <input type="number"name="subsidy"class="form-control mb-3"placeholder="Subsidy %">

                <select name="status"class="form-control mb-3">
                    <option>Active</option>
                    <option>Inactive</option>
                </select>

                <textarea name="description"rows="4"class="form-control mb-4"placeholder="Description"></textarea>

                <div class="d-grid">
                    <button class="btn btn-success">
                        <i class="fa fa-plus-circle me-1"></i>Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- PRODUCT LIST -->
    <div class="col-lg-8">
        <div class="card-box p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">All Products</h5>
                <span class="badge bg-primary"><?php echo e(count($products)); ?> Products</span>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Capacity</th>
                            <th>Price</th>
                            <th>Subsidy</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="fw-semibold">
                            <?php echo e($p->name); ?>

                        </td>

                        <td>
                            <?php echo e($p->category); ?>

                        </td>

                        <td>
                            <?php echo e($p->capacity); ?>

                        </td>

                        <td class="fw-bold text-success">
                            ₹<?php echo e(number_format($p->price,2)); ?>

                        </td>

                        <td>
                            <?php echo e($p->subsidy); ?>%
                        </td>

                        <td>
                            <span class="badge <?php echo e($p->status=='Active' ? 'bg-success' : 'bg-danger'); ?>">
                                <?php echo e($p->status); ?>

                            </span>
                        </td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            No products found
                        </td>
                    </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\solar-crm\resources\views/admin/products.blade.php ENDPATH**/ ?>