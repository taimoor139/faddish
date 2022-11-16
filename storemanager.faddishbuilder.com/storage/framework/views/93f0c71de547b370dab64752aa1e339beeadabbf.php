<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
  <?php echo e(__('Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Orders')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="row  m-1">
        <div class="col-auto pe-0">
             <a href="<?php echo e(route('order.export', $store->id)); ?> " class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Export')); ?>"  >
                <i class="ti ti-file-export text-white"></i>
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
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Order')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Value')); ?></th>
                                    <th><?php echo e(__('Payment Type')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row">
                                            <a href="<?php echo e(route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id))); ?>"
                                                class="btn btn-sm btn-white btn-icon order-badge btn-outline-primary">
                                                <span class="btn-inner--text"><?php echo e('#' . $order->order_id); ?></span>
                                            </a>
                                        </th>
                                        <td class="order">
                                            <span
                                                class="h6 text-sm font-weight-bold mb-0"><?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?></span>
                                        </td>
                                        <td>
                                            <span class="client"><?php echo e($order->name); ?></span>
                                        </td>
                                        <td>
                                            <span
                                                class="value text-sm mb-0"><?php echo e(\App\Models\Utility::priceFormat($order->price)); ?></span>
                                        </td>
                                        <td>
                                            <span class="taxes text-sm mb-0"><?php echo e($order->payment_type); ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex  justify-content-between">
                                                <div class="col-auto">
                                                    <?php if($order->status != 'Cancel Order'): ?>
                                                    <button type="button"
                                                        class="btn btn-sm <?php echo e($order->status == 'pending' ? 'btn-soft-info' : 'btn-soft-success'); ?> btn-icon rounded-pill">
                                                        <span class="btn-inner--icon">
                                                            <?php if($order->status == 'pending'): ?>
                                                                <i class="fas fa-check soft-success"></i>
                                                            <?php else: ?>
                                                                <i class="fa fa-check-double soft-success"></i>
                                                            <?php endif; ?>
                                                        </span>
                                                        <?php if($order->status == 'pending'): ?>
                                                            <span class="btn-inner--text">
                                                                <?php echo e(__('Pending')); ?>:
                                                                <?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?>

                                                            </span>
                                                        <?php else: ?>
                                                            <span class="btn-inner--text">
                                                                <?php echo e(__('Delivered')); ?>:
                                                                <?php echo e(\App\Models\Utility::dateFormat($order->updated_at)); ?>

                                                            </span>
                                                        <?php endif; ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button"
                                                        class="btn btn-sm btn-soft-danger btn-icon rounded-pill">
                                                        <span class="btn-inner--icon">
                                                            <?php if($order->status == 'pending'): ?>
                                                                <i class="fas fa-check soft-success"></i>
                                                            <?php else: ?>
                                                                <i class="fa fa-check-double soft-success"></i>
                                                            <?php endif; ?>
                                                        </span>
                                                        <span class="btn-inner--text">
                                                            <?php echo e(__('Cancel Order')); ?>:
                                                            <?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?>

                                                        </span>
                                                    </button>
                                                <?php endif; ?>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="">
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="<?php echo e(route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id))); ?>"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="<?php echo e(__('View')); ?>"><i
                                                                    class="ti ti-eye text-white"></i></a>
                                                        </div>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['orders.destroy', $order->id],'id'=>'delete-form-'.$order->id]); ?>

                                                            <a class="show_confirm align-items-center btn btn-sm d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Delete')); ?>">
                                                               <span class="text-white"><i class="ti ti-trash"></i></span>
                                                            </a>
                                                          
                                                               
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    </span>
                                                </div>

                                            </div>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/faddishbuilder/public_html/storemanager.faddishbuilder.com/resources/views/orders/index.blade.php ENDPATH**/ ?>