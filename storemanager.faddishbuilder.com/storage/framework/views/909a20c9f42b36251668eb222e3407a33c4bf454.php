<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('WhatsStore')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Store')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>

    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Stores')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="row  m-1">
        <div class="col-auto pe-0">
            <a href="<?php echo e(route('store.subDomain')); ?>" class="btn btn-sm btn-primary btn-icon">
                <?php echo e(__('Sub Domain')); ?>

            </a>
        </div>
        <div class="col-auto pe-0">
            <a href="<?php echo e(route('store.customDomain')); ?>" class="btn btn-sm btn-primary btn-icon">
                <?php echo e(__('Custom Domain')); ?>

            </a>
        </div>

        <div class="col-auto pe-0">
            <a href="<?php echo e(route('store.grid')); ?>" class="btn btn-sm btn-primary btn-icon">
                <?php echo e(__('Grid View')); ?>

            </a>
        </div>

        <div class="col-auto pe-0">
            <a href="#" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create ')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Create New Store')); ?>" data-url="<?php echo e(route('store-resource.create')); ?>">
                <i class="ti ti-plus text-white"></i>
            </a>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Listing -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('User Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Stores')); ?></th>
                                    <th><?php echo e(__('Plan')); ?></th>
                                    <th><?php echo e(__('Created At')); ?></th>
                                    <th><?php echo e(__('Store Display')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td><?php echo e($usr->name); ?></td>
                                        <td><?php echo e($usr->email); ?></td>
                                        <td><?php echo e($usr->stores->count()); ?></td>
                                        <td><?php echo e(!empty($usr->currentPlan->name)?$usr->currentPlan->name:'-'); ?></td>
                                        <td><?php echo e(\App\Models\Utility::dateFormat($usr->created_at)); ?></td>
                                        <td>
                                            <div class="form-switch disabled-form-switch">


                                                <a href="#" data-size="md" data-url="<?php echo e(route('store-resource.edit.display',$usr->id)); ?>" data-ajax-popup="true" class="action-item" data-title="<?php echo e(__('Are You Sure?')); ?>"  data-title="<?php echo e(($usr->store_display == 1)?'Stores disable':'Store enable'); ?>">
                                                    <input type="checkbox" class="form-check-input" disabled="disabled" name="store_display" id="<?php echo e($usr->id); ?>" <?php echo e(($usr->store_display == 1) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="<?php echo e($usr->id); ?>"></label>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="Action">
                                            <span>
                                                <div class="action-btn btn-info ms-2">
                                                    <a href="#" data-size="lg" data-url="<?php echo e(route('store-resource.edit',$usr->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Store')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit')); ?>" ><i class="ti ti-pencil text-white"></i></a>
                                                </div>

                                                <div class="action-btn btn-primary ms-2">
                                                    <a href="#" data-size="md" data-url="<?php echo e(route('plan.upgrade',$usr->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Upgrade Plan')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Upgrade Plan')); ?>" ><i class="ti ti-trophy text-white"></i></a>
                                                </div>

                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'Delete', 'route' => ['store-resource.destroy', $usr->id]]); ?>

                                                        <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                                           <span class="text-white" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="<?php echo e(__('Delete')); ?>"> <i class="ti ti-trash"></i></span></a>
                                                    <?php echo Form::close(); ?>

                                                </div>


                                                <div class="action-btn btn-warning ms-2">
                                                    <a href="#" data-size="md" data-url="<?php echo e(route('user.reset',$usr->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Reset Password')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Reset Password')); ?>" ><i class="fas fa-key text-white"></i></a>
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
        $(document).on('click', '#billing_data', function () {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        })
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/store/public_html/resources/views/admin_store/index.blade.php ENDPATH**/ ?>