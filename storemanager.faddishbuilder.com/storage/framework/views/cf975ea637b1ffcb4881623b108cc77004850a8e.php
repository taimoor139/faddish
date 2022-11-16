<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php
    $logo=\App\Models\Utility::get_file('uploads/is_cover_image/');
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="row  m-1">

        <div class="col-auto pe-0">
             <a href="<?php echo e(route('product.index')); ?>" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('List View')); ?>">
                <i class="ti ti-list text-white"></i>
            </a>
        </div>


        <div class="col-auto pe-0">
            <a href="<?php echo e(route('product.create')); ?>" class="btn btn-sm btn-primary btn-icon" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create Product')); ?>" ><i class="ti ti-plus text-white"></i></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>

    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Product')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="card text-white text-center">
                    <div class="card-header border-0 pb-0">
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a href="<?php echo e(route('product.show', $product->id)); ?>" class="dropdown-item"><i
                                            class="ti ti-eye"></i>
                                        <span><?php echo e(__('View')); ?></span></a>
                                    <a href="<?php echo e(route('product.edit', $product->id)); ?>" class="dropdown-item"><i
                                            class="ti ti-edit"></i>
                                        <span><?php echo e(__('Edit')); ?></span></a>

                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id],'id'=>'delete-form-'.$product->id]); ?>

                                        <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                            <i class="ti ti-trash"></i><span><?php echo e(__('Delete')); ?> </span>

                                    </a>

                                    <?php echo Form::close(); ?>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(!empty($product->is_cover)): ?>
                        <a href="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>" target="_blank">
                            <img alt="Image placeholder"
                            src="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>"
                                class="img-fluid rounded-circle card-avatar" alt="images">
                        </a>
                        
                        <?php else: ?>
                        <a href="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>"  target="_blank">
                            <img alt="Image placeholder"
                            src="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>"
                            class="img-fluid rounded-circle card-avatar" alt="images">
                        </a>
                        <?php endif; ?>
                        <h4 class="text-primary mt-2"> <a
                                href="<?php echo e(route('product.show', $product->id)); ?>"><?php echo e($product->name); ?></a></h4>
                        <h4 class="text-muted">
                            <small><?php echo e(\App\Models\Utility::priceFormat($product->price)); ?></small>
                        </h4>
                        <?php if($product->quantity == 0): ?>
                            <span class="badge bg-danger p-2 px-3 rounded">
                                <?php echo e(__('Out of stock')); ?>

                            </span>
                        <?php else: ?>
                            <span class="badge bg-primary p-2 px-3 rounded">
                                <?php echo e(__('In stock')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="col-md-3">
            <a href="<?php echo e(route('product.create')); ?>" class="btn-addnew-project" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create Product')); ?>"><i class="ti ti-plus text-white"></i>
                <div class="bg-primary proj-add-icon">
                    <i class="ti ti-plus"></i>
                </div>
                <h6 class="mt-4 mb-2">New Product</h6>
                <p class="text-muted text-center">Click here to add New Product</p>
            </a>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/faddishbuilder/public_html/storemanager.faddishbuilder.com/resources/views/product/grid.blade.php ENDPATH**/ ?>