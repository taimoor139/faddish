<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('orders.index')); ?>"><?php echo e(__('Orders')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Order')); ?> <?php echo e($order->order_id); ?> </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="row  m-1">
        <div class="col-auto pe-0 ">
            <a href="#" id="<?php echo e(env('APP_URL')  . ''.$store->slug . '/order/' . $order_id); ?>" class="btn btn-sm btn-primary btn-icon mb-1   "  onclick="copyToClipboard(this)" title="Copy link" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Click to copy')); ?>"><i class="ti ti-link text-white"></i></a>
       </div>
        <div class="col-auto pe-0">
             <a href="<?php echo e(route('order.receipt',$order->id)); ?> " class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Receipt')); ?>"  >
                <i class="ti ti-receipt text-white"></i>
            </a>
        </div>

        <div class="col-auto pe-0">
             <a href="# " onclick="saveAsPDF();" class="btn btn-sm btn-primary btn-icon"  id="download-buttons" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Print')); ?>"  >
                <i class="ti ti-printer text-white"></i>
            </a>
        </div>

        <div class="col-auto pe-0">
            <div class="btn-group " id="deliver_btn">
                <button class="btn btn-success dropdown-toggle py-1"  type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><?php echo e(__('Status')); ?> : <?php echo e(__(ucfirst($order->status))); ?></button>
                <div class="dropdown-menu">
                    <h6 class="dropdown-header"><?php echo e(__('Set order status')); ?></h6>
                    <a class="dropdown-item" href="#" id="delivered" data-value="delivered">
                        <?php if($order->status == 'pending' || $order->status == 'Cancel Order'): ?>
                            <i class="fa fa-check text-primary"></i>
                        <?php else: ?>
                            <i class="fa fa-check-double text-primary"></i>
                        <?php endif; ?>
                        <?php echo e(__('Delivered')); ?>

                    </a>
                    <a class="dropdown-item text-danger" href="#" id="delivered" data-value="Cancel Order">
                        <?php if($order->status != 'Cancel Order'): ?>
                            <i class="fa fa-check text-primary"></i>
                        <?php else: ?>
                            <i class="fa fa-check-double text-danger"></i>
                        <?php endif; ?>
                        <?php echo e(__('Cancel Order')); ?>

                    </a>
                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row" id="printableArea">
                <div class="col-xxl-7">

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-lg-6 ">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h5 class=""><?php echo e(__('Shipping Information')); ?></h5>
                                </div>
                                <div class="card-body pt-0">
                                    <address class="mb-0 text-sm">
                                        <dl class="row mt-4 align-items-center">
                                            <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Name')); ?></dt>
                                            <dd class="col-sm-8 text-sm"> <?php echo e($user_details->name); ?></dd>
                                            <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Shipping Address')); ?></dt>
                                            <dd class="col-sm-8 text-sm"> <?php echo e($user_details->shipping_address); ?></dd>
                                            <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Phone')); ?></dt>
                                            <dd class="col-sm-8 text-sm">
                                                <a href="<?php echo e($url = 'https://api.whatsapp.com/send?phone=' . str_replace(' ', '', $user_details->phone) . '&text=Hi'); ?>"
                                                    target="_blank">
                                                    <?php echo e($user_details->phone); ?>

                                                </a>
                                            </dd>
                                            <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Billing Address')); ?></dt>
                                            <dd class="col-sm-8 text-sm"><?php echo e($user_details->billing_address); ?></dd>

                                            <?php if(!empty($location_data && $shipping_data)): ?>
                                            <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Location')); ?></dt>
                                            <dd class="col-sm-8 text-sm"><?php echo e($location_data->name); ?></dd>
                                            <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Shipping Method')); ?></dt>
                                            <dd class="col-sm-8 text-sm"><?php echo e($shipping_data->shipping_name); ?></dd>
                                            <?php endif; ?>
                                        </dl>
                                    </address>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-lg-6 ">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h5 class=""><?php echo e(__('Billing Information')); ?></h5>
                                </div>
                                <div class="card-body pt-0">

                                    <dl class="row mt-4 align-items-center">
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Name')); ?></dt>
                                        <dd class="col-sm-8 text-sm"> <?php echo e($user_details->name); ?></dd>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Shipping Address')); ?></dt>
                                        <dd class="col-sm-8 text-sm"><?php echo e($user_details->shipping_address); ?></dd>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Phone')); ?></dt>
                                        <dd class="col-sm-8 text-sm">
                                            <a href="<?php echo e($url = 'https://api.whatsapp.com/send?phone=' . str_replace(' ','',$user_details->phone) . '&text=Hi'); ?>" target="_blank">
                                                <?php echo e($user_details->phone); ?>

                                            </a>
                                        </dd>
                                        <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Billing Address')); ?></dt>
                                        <dd class="col-sm-8 text-sm"><?php echo e($user_details->billing_address); ?></dd>

                                        <?php if(!empty($location_data && $shipping_data)): ?>
                                            <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Location')); ?></dt>
                                            <dd class="col-sm-8 text-sm"><?php echo e($location_data->name); ?></dd>
                                            <dt class="col-sm-4 h6 text-sm"><?php echo e(__('Shipping Method')); ?></dt>
                                            <dd class="col-sm-8 text-sm"><?php echo e($shipping_data->shipping_name); ?></dd>
                                        <?php endif; ?>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="mb-0"><?php echo e(__('Order')); ?> <?php echo e($order->order_id); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Item')); ?></th>
                                            <th><?php echo e(__('Quantity')); ?></th>
                                            <th><?php echo e(__('Price')); ?></th>
                                            <th><?php echo e(__('Total')); ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                            $sub_tax = 0;
                                            $total = 0;
                                        ?>
                                        <?php $__currentLoopData = $order_products->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($product->variant_id) && $product->variant_id != 0): ?>
                                                <tr>
                                                    <td class="total">
                                                    <span class="h6 text-sm">
                                                        <a href="<?php echo e(route('product.show',$product->id)); ?>"><?php echo e($product->product_name .' - ( '.$product->variant_name.' )'); ?></a>
                                                    </span>
                                                        <?php if(!empty($product->tax)): ?>
                                                            <?php
                                                                $total_tax=0;
                                                            ?>
                                                            <?php $__currentLoopData = $product->tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $sub_tax = ($product->variant_price* $product->quantity * $tax->tax) / 100;
                                                                    $total_tax += $sub_tax;
                                                                ?>
                                                                <?php echo e($tax->tax_name.' '.$tax->tax.'%'.' ('.$sub_tax.')'); ?>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <?php
                                                                $total_tax = 0
                                                            ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo e($product->quantity); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e(App\Models\Utility::priceFormat($product->variant_price)); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e(App\Models\Utility::priceFormat($product->variant_price*$product->quantity+$total_tax)); ?>

                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <tr>
                                                    <td class="total">
                                                    <span class="h6 text-sm">
                                                        <a href="<?php echo e(route('product.show',$product->id)); ?>"><?php echo e($product->product_name); ?></a>
                                                    </span>
                                                        <?php if(!empty($product->tax)): ?>
                                                            <?php
                                                                $total_tax=0;
                                                            ?>
                                                            <?php $__currentLoopData = $product->tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $sub_tax = ($product->price* $product->quantity * $tax->tax) / 100;
                                                                    $total_tax += $sub_tax;
                                                                ?>
                                                                <?php echo e($tax->tax_name.' '.$tax->tax.'%'.' ('.$sub_tax.')'); ?>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <?php
                                                                $total_tax = 0
                                                            ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo e($product->quantity); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e(App\Models\Utility::priceFormat($product->price)); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e(App\Models\Utility::priceFormat($product->price*$product->quantity+$total_tax)); ?>

                                                    </td>

                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"><b>
                                                <?php echo e(__('Order Notes')); ?> :
                                            </b>

                                                <?php if(!empty($user_details->special_instruct)): ?>
                                                    <dd class="p-2 d-inline"> <?php echo e($user_details->special_instruct); ?></dd>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xxl-5">

                    <div class="card card-fluid">
                        <div class="card-header border-0">
                            <h5 class="mb-0"><?php echo e(__('Items from Order '). $order->order_id); ?></h5>
                        </div>
                        <div class="card-body">
                             <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                <tr>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?php echo e(__('Grand Total')); ?> :</td>
                                    <td><?php echo e(App\Models\Utility::priceFormat($sub_total)); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Estimated Tax')); ?> :</td>
                                    <td><?php echo e(App\Models\Utility::priceFormat($total_taxs)); ?></td>
                                </tr>
                                <?php if(!empty($shipping_data) && !empty($discount_value)): ?>
                                    <tr>
                                        <td><?php echo e(__('Coupon Price')); ?> :</td>
                                        <td><?php echo e(App\Models\Utility::priceFormat($discount_value)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('Shipping Price')); ?> :</td>
                                        <td><?php echo e(App\Models\Utility::priceFormat($shipping_data->shipping_price)); ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo e(__('Total')); ?> :</th>
                                        <th><?php echo e(App\Models\Utility::priceFormat(($sub_total+$total_taxs+$shipping_data->shipping_price)-$discount_value)); ?></th>
                                    </tr>
                                <?php elseif(!empty($discount_value)): ?>
                                    <tr>
                                        <td><?php echo e(__('Coupon')); ?> :</td>
                                        <td><?php echo e(App\Models\Utility::priceFormat($discount_value)); ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo e(__('Total')); ?> :</th>
                                        <th><?php echo e(App\Models\Utility::priceFormat(($sub_total+$total_taxs)-$discount_value)); ?></th>
                                    </tr>
                                <?php elseif(!empty($shipping_data)): ?>
                                    <tr>
                                        <td><?php echo e(__('Shipping Price')); ?> :</td>
                                        <td><?php echo e(App\Models\Utility::priceFormat($shipping_data->shipping_price)); ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo e(__('Total')); ?> :</th>
                                        <th><?php echo e(App\Models\Utility::priceFormat($sub_total+$total_taxs+$shipping_data->shipping_price)); ?></th>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <th><?php echo e(__('Total')); ?> :</th>
                                        <th><?php echo e(App\Models\Utility::priceFormat($sub_total+$total_taxs)); ?></th>
                                    </tr>
                                <?php endif; ?>
                                <th><?php echo e(__('Payment Type')); ?> :</th>
                                <th><?php echo e($order['payment_type']); ?></th>
                                </tbody>

                            </table>
                        </div>
                        </div>

                    </div>



                    <?php if(!empty($store_payment_setting['custom_field_title_1']) || !empty($user_details->custom_field_title_1) || !empty($store_payment_setting['custom_field_title_2']) || !empty($user_details->custom_field_title_2) || !empty($store_payment_setting['custom_field_title_3']) || !empty($user_details->custom_field_title_3) || !empty($store_payment_setting['custom_field_title_4']) || !empty($user_details->custom_field_title_4)): ?>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h5 class="mb-4"><?php echo e(__('Extra Information')); ?></h5>
                        </div>
                        <div class="card-body pt-0">
                            <dl class="row mt-4 align-items-center">
                                <?php if(!empty($store_payment_setting['custom_field_title_1']) && !empty($user_details->custom_field_title_1)): ?>
                                    <dt class="col-sm-3 h6 text-sm"><?php echo e($store_payment_setting['custom_field_title_1']); ?></dt>
                                    <dd class="col-sm-9 text-sm"> <?php echo e($user_details->custom_field_title_1); ?></dd>
                                <?php endif; ?>
                                <?php if(!empty($store_payment_setting['custom_field_title_2']) && !empty($user_details->custom_field_title_2)): ?>
                                    <dt class="col-sm-3 h6 text-sm"><?php echo e($store_payment_setting['custom_field_title_2']); ?></dt>
                                    <dd class="col-sm-9 text-sm"> <?php echo e($user_details->custom_field_title_2); ?></dd>
                                <?php endif; ?>
                                <?php if(!empty($store_payment_setting['custom_field_title_3']) && !empty($user_details->custom_field_title_3)): ?>
                                    <dt class="col-sm-3 h6 text-sm"><?php echo e($store_payment_setting['custom_field_title_3']); ?></dt>
                                    <dd class="col-sm-9 text-sm"><?php echo e($user_details->custom_field_title_3); ?></dd>
                                <?php endif; ?>
                                <?php if(!empty($store_payment_setting['custom_field_title_4']) && !empty($user_details->custom_field_title_4)): ?>
                                    <dt class="col-sm-3 h6 text-sm"><?php echo e($store_payment_setting['custom_field_title_4']); ?></dt>
                                    <dd class="col-sm-9 text-sm"> <?php echo e($user_details->custom_field_title_4); ?></dd>
                                <?php endif; ?>
                            </dl>
                        </div>

                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>




<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('custom/js/html2pdf.bundle.min.js')); ?>"></script>

    <script>
        function copyToClipboard(element) {
            var copyText = element.id;
            document.addEventListener('copy', function (e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);
            document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        }
    </script>
    <script>
        var filename = $('#filesname').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();

        }
    </script>
    <script>
        $("#deliver_btn").on('click', '#delivered', function () {
            var status = $(this).attr('data-value');
            var data = {
                delivered: status,
            }
            $.ajax({
                url: '<?php echo e(route('orders.update',$order->id)); ?>',
                method: 'PUT',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {

                    if (data.error == '') {
                        show_toastr('error', data.error, 'error');
                    } else {
                        show_toastr('success', data.success, 'success');

                    }
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            });
        });
    </script>
    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            show_toastr('Success', 'Link copied', 'success');
        }
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/store/public_html/resources/views/orders/view.blade.php ENDPATH**/ ?>