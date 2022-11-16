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
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>

    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Product')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="row  m-1">
        <div class="col-auto pe-0">
             <a href="<?php echo e(route('product.export',$store_id->id)); ?> " class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Export')); ?>"  >
                <i class="ti ti-file-export text-white"></i>
            </a>
        </div>

         <div class="col-auto pe-0">
               <a href="#" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Import')); ?>" data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Import Product CSV file')); ?>" data-url="<?php echo e(route('product.file.import')); ?>">
                <i class="ti ti-file-import text-white"></i>
            </a>
        </div>

        <div class="col-auto pe-0">
             <a href="<?php echo e(route('product.grid')); ?>" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Grid View')); ?>">
                <i class="ti ti-grid-dots text-white"></i>
            </a>
        </div>


        <div class="col-auto pe-0">
            <a href="<?php echo e(route('product.create')); ?>" class="btn btn-sm btn-primary btn-icon" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create')); ?>" ><i class="ti ti-plus text-white"></i></a>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Product')); ?></th>
                                    <th><?php echo e(__('Category')); ?></th>
                                    <th><?php echo e(__('Price')); ?></th>
                                    <th><?php echo e(__('Quantity')); ?></th>
                                    <th><?php echo e(__('Stock')); ?></th>
                                    <th><?php echo e(__('Created at')); ?></th>
                                    <th class="text-right" width="200px"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                    <?php if(!empty($product->is_cover)): ?>
                                                    
                                                    <a href="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>" target="_blank">
                                                        <img alt="Image placeholder" alt="your image" src="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>" class="rounded-circle" alt="images">
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>" target="_blank">
                                                        <img alt="Image placeholder" alt="your image" src="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>"
                                                        class="rounded-circle" alt="images">
                                                    </a>
                                                <?php endif; ?>
                                                <div class="ms-3">
                                                    <a href="<?php echo e(route('product.show', $product->id)); ?>"
                                                        class="name h6 mb-0 text-sm">
                                                        <?php echo e($product->name); ?>

                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td> <?php echo e(!empty($product->product_category()) ? $product->product_category() : '-'); ?>

                                        </td>
                                        <td>
                                            <?php if($product->enable_product_variant == 'on'): ?>
                                                <?php echo e(__('In Variant')); ?>

                                            <?php else: ?>
                                                <?php echo e(\App\Models\Utility::priceFormat($product->price)); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($product->enable_product_variant == 'on'): ?>
                                                <?php echo e(__('In Variant')); ?>

                                            <?php else: ?>
                                                <?php echo e($product->quantity); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($product->enable_product_variant == 'on'): ?>
                                                <span class="status_badge badge bg-info p-2 px-3 rounded">
                                                    <?php echo e(__('In Variant')); ?>

                                                </span>
                                            <?php else: ?>
                                                <?php if($product->quantity == 0): ?>
                                                    <span class="status_badge badge bg-danger p-2 px-3 rounded">
                                                        <?php echo e(__('Out of stock')); ?>

                                                    </span>
                                                <?php else: ?>
                                                    <span class="status_badge    badge bg-primary p-2 px-3 rounded">
                                                        <?php echo e(__('In stock')); ?>

                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e(\App\Models\Utility::dateFormat($product->created_at)); ?>

                                        </td>
                                        <td class="Action">
                                            <span>
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="<?php echo e(route('product.show', $product->id)); ?>"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-toggle="tooltip" data-original-title="<?php echo e(__('View')); ?>"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="<?php echo e(__('View')); ?>"><i
                                                            class="ti ti-eye text-white"></i></a>
                                                </div>

                                                <div class="action-btn btn-info ms-2">
                                                    <a href="<?php echo e(route('product.edit', $product->id)); ?>"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="<?php echo e(__('Edit')); ?>"><i
                                                            class="ti ti-pencil text-white"></i></a>
                                                </div>
                                                <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id],'id'=>'delete-form-'.$product->id]); ?>

                                                            <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Delete')); ?>">
                                                               <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/faddishbuilder/public_html/storemanager.faddishbuilder.com/resources/views/product/index.blade.php ENDPATH**/ ?>