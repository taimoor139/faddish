<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product Coupons')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Product Coupons')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>

    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Product Coupons')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

    <div class="row  m-1">



        <div class="col-auto pe-0">
             <a href="<?php echo e(route('coupon.export')); ?> " class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Export')); ?>"  >
                <i class="ti ti-file-export text-white"></i>
            </a>
        </div>

         <div class="col-auto pe-0">
               <a href="#" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Import')); ?>" data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Import Coupon CSV file')); ?>" data-url="<?php echo e(route('coupon.file.import')); ?>">
                <i class="ti ti-file-import text-white"></i>
            </a>
        </div>

        <div class="col-auto pe-0">
               <a href="#" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create Product Category')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Add Coupon')); ?>" data-url="<?php echo e(route('product-coupon.create')); ?>">
                <i class="ti ti-plus text-white"></i>
            </a>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#code-generate', function () {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple ">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Name')); ?></th>
                                    <th> <?php echo e(__('Code')); ?></th>
                                    <th> <?php echo e(__('Discount (%)')); ?></th>
                                    <th> <?php echo e(__('Limit')); ?></th>
                                    <th> <?php echo e(__('Used')); ?></th>
                                    <th width="200px"> <?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $productcoupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($coupon->name); ?></td>
                                        <td><?php echo e($coupon->code); ?></td>
                                        <?php if($coupon->enable_flat == 'off'): ?>
                                            <td><?php echo e($coupon->discount . '%'); ?></td>
                                        <?php endif; ?>
                                        <?php if($coupon->enable_flat == 'on'): ?>
                                            <td><?php echo e($coupon->flat_discount . ' ' . '(Flat)'); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e($coupon->limit); ?></td>
                                        <td><?php echo e($coupon->product_coupon()); ?></td>
                                        <td class="Action">
                                            <span>
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="<?php echo e(route('product-coupon.show', $coupon->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip" data-original-title="<?php echo e(__('View')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('View')); ?>"><i class="ti ti-eye text-white"></i></a>
                                                </div>
                                                <div class="action-btn btn-info ms-2">
                                                    <a href="#" data-size="lg" data-url="<?php echo e(route('product-coupon.edit', [$coupon->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit')); ?>" ><i class="ti ti-pencil text-white"></i></a>
                                                </div>


                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['product-coupon.destroy', $coupon->id]]); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/store/public_html/resources/views/product-coupon/index.blade.php ENDPATH**/ ?>