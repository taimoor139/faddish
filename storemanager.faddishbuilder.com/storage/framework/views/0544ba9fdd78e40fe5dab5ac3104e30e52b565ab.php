<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product Tax')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Product Tax')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>

    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Product Tax')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="row  m-1">
        <div class="col-auto pe-0">
               <a href="#" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create')); ?>" data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Create New Product Tax')); ?>" data-url="<?php echo e(route('product_tax.create')); ?>">
                <i class="ti ti-plus text-white"></i>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table mb-0 pc-dt-simple ">
                        <thead>
                            <tr>
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Tax Name')); ?></th>
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Rate %')); ?></th>
                                <th  width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $product_taxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr data-name="<?php echo e($product_tax->name); ?>">
                                    <td ><?php echo e($product_tax->name); ?></td>
                                    <td ><?php echo e($product_tax->rate); ?></td>
                                    <td class="Action">
                                        <span>
                                            <div class="action-btn btn-info ms-2">
                                                <a href="#" data-size="md" data-url="<?php echo e(route('product_tax.edit', $product_tax->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit')); ?>" ><i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['product_tax.destroy', $product_tax->id],'id'=>'delete-form-'.$product_tax->id]); ?>

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
        $(document).ready(function () {
            $(document).on('keyup', '.search-user', function () {
                var value = $(this).val();
                $('.employee_tableese tbody>tr').each(function (index) {
                    var name = $(this).attr('data-name').toLowerCase();
                    if (name.includes(value.toLowerCase())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
        $('#search'). keydown(function (e) {
            if (e. keyCode == 13) {
                e. preventDefault();
                return false;
            }
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/store/public_html/resources/views/producttax/index.blade.php ENDPATH**/ ?>