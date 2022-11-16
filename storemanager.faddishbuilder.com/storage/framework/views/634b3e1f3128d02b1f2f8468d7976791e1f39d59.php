<ul class="nav nav-tabs"  id="myTab" role="tablist">
    
</ul>
<div class="tab-content" id="myTabContent">
<?php $__currentLoopData = $all_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="tab-pane fade show <?php if($order_key == 0): ?> active <?php endif; ?>" id="ordet_tab_<?php echo e($order_key); ?>" role="tabpanel" aria-labelledby="orders-tab">
        <div class="main-content">
            <header class="d-flex align-items-end">
                <div class="container">
                    <div class="row float-left">
                        <div class=" col-auto">
                            <div class="row align-items-center  mt-4">
                                <h4 class=""><?php echo e(__('Your Order Details')); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-right mt-4">
                        <a href="#" onclick="saveAsPDF();" data-toggle="tooltip" data-title="<?php echo e(__('Download')); ?>" id="download-buttons" class="btn btn-sm btn-white btn-icon rounded-pill">
                            <span class="btn-inner--icon text-dark"><i class="fa fa-print"></i></span>
                            <span class="btn-inner--text text-dark"><?php echo e(__('Print')); ?></span>
                        </a>
                        <?php if($order->status == 'pending'): ?>
                        <button class="btn btn-sm btn-success"><?php echo e(__('Pending')); ?></button>
                    <?php elseif($order->status == 'Cancel Order'): ?>
                        <button class="btn btn-sm btn-danger"><?php echo e(__('Order Canceled')); ?></button>
                    <?php else: ?>
                        <button class="btn btn-sm btn-success"><?php echo e(__('Delivered')); ?></button>
                    <?php endif; ?>
                    </div>
                </div>
            </header>
            <div class="container">
                <div class="mt-4">
                    <div id="printableArea">
                        <div class="row">
                            <div class=" col-6 pb-2 invoice_logo"></div>
                            <div class=" col-6 pb-2 delivered_Status text-right">

                            </div>
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h6 class="mb-0"><?php echo e(__('Items from Order')); ?> <?php echo e($order->order_id); ?></h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-light">
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
                                            <?php $__currentLoopData = $order->order_products->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($product->variant_id != 0): ?>
                                                    <tr>
                                                        <td class="total">
                                                        <span class="h6 text-sm">
                                                            <?php echo e($product->product_name .' - ( '.$product->variant_name.' )'); ?>

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
                                                            <?php echo e($product->product_name); ?>

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
                                        </table>
                                    </div>
                                    <?php if($order->status == 'delivered'): ?>
                                        <div class="card card-body mb-0 py-0">
                                            <div class="card my-5 bg-secondary">
                                                <div class="card-body">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6 order-md-2 mb-4 mb-md-0">
                                                            <div class="d-flex align-items-center justify-content-md-end">
                                                                <button data-id="<?php echo e($order->id); ?>" data-value="<?php echo e(asset(Storage::url('uploads/downloadable_prodcut'.'/'.$product->downloadable_prodcut))); ?>" class="btn btn-sm btn-primary downloadable_prodcut"><?php echo e(__('Download')); ?></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 order-md-1">
                                                            <span class="h6 text-muted d-inline-block mr-3 mb-0"></span>
                                                            <span class="h5 mb-0"><?php echo e(__('Get your product from here')); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if(!empty($user_details->special_instruct)): ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card card-fluid">
                                                <div class="card-body">
                                                    <h6 class="mb-4"><?php echo e(__('Order Notes')); ?></h6>
                                                    <dl class="row mt-4 align-items-center">
                                                        <dd class="p-2"> <?php echo e($user_details->special_instruct); ?></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h6 class="mb-0"><?php echo e(__('Items from Order '). $order->order_id); ?></h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-light">

                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><?php echo e(__('Sub Total')); ?> :</td>
                                                <td><?php echo e(App\Models\Utility::priceFormat($order->sub_total)); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e(__('Estimated Tax')); ?> :</td>
                                                <td><?php echo e(App\Models\Utility::priceFormat($order->final_taxs)); ?></td>
                                            </tr>
                                            <?php if(!empty($discount_price)): ?>
                                                <tr>
                                                    <td><?php echo e(__('Apply Coupon')); ?> :</td>
                                                    <td><?php echo e($order->discount_price); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(!empty($shipping_data)): ?>
                                                <?php if(!empty($discount_value)): ?>
                                                    <tr>
                                                        <td><?php echo e(__('Shipping Price')); ?> :</td>
                                                        <td><?php echo e(App\Models\Utility::priceFormat($order->shipping_data->shipping_price)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo e(__('Grand Total')); ?> :</th>

                                                        <th><?php echo e(App\Models\Utility::priceFormat($order->grand_total+$order->shipping_data->shipping_price-$order->discount_value)); ?></th>
                                                    </tr>
                                                <?php else: ?>
                                                    <tr>
                                                        <td><?php echo e(__('Shipping Price')); ?> :</td>
                                                        <td><?php echo e(App\Models\Utility::priceFormat($order->shipping_data->shipping_price)); ?></td>
                                                    </tr>
                                                    <tr>


                                                        <th><?php echo e(__('Grand Total')); ?> :</th>
                                                        <th><?php echo e(App\Models\Utility::priceFormat($order->grand_total+$order->shipping_data->shipping_price)); ?></th>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php elseif(!empty($discount_value)): ?>
                                                <tr>
                                                    <th><?php echo e(__('Grand  Total')); ?> :</th>
                                                    <th><?php echo e(App\Models\Utility::priceFormat($order->grand_total-$order->discount_value)); ?></th>
                                                </tr>
                                            <?php else: ?>
                                                <tr>
                                                    

                                                    <th><?php echo e(__('Grand  Total')); ?> :</th>
                                                    <th><?php echo e(App\Models\Utility::priceFormat($order->price)); ?></th>
                                                </tr>
                                            <?php endif; ?>

                                            <th><?php echo e(__('Payment Type')); ?> :</th>
                                            <th><?php echo e($order['payment_type']); ?></th>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card card-fluid">
                                        <div class="card-body">
                                            <h6 class="mb-4"><?php echo e(__('Shipping Information')); ?></h6>
                                            <address class="mb-0 text-sm">
                                                <dl class="row mt-4 align-items-center">
                                                    <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Name')); ?></dt>
                                                    <dd class="col-sm-9 text-sm"> <?php echo e($order->user_details->name); ?></dd>
                                                    <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Phone')); ?></dt>
                                                    <dd class="col-sm-9 text-sm"><?php echo e($order->user_details->phone); ?></dd>
                                                    <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Billing Address')); ?></dt>
                                                    <dd class="col-sm-9 text-sm"><?php echo e($order->user_details->billing_address); ?></dd>
                                                    <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Shipping Address')); ?></dt>
                                                    <dd class="col-sm-9 text-sm"><?php echo e($order->user_details->shipping_address); ?></dd>
                                                    <?php if(!empty($order->location_data && $order->shipping_data)): ?>
                                                        <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Location')); ?></dt>
                                                        <dd class="col-sm-9 text-sm"><?php echo e($order->location_data->name); ?></dd>
                                                        <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Shipping Method')); ?></dt>
                                                        <dd class="col-sm-9 text-sm"><?php echo e($order->shipping_data->shipping_name); ?></dd>
                                                    <?php endif; ?>
                                                </dl>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card card-fluid">
                                        <div class="card-body">
                                            <h6 class="mb-4"><?php echo e(__('Billing Information')); ?></h6>
                                            <dl class="row mt-4 align-items-center">
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Name')); ?></dt>
                                                <dd class="col-sm-9 text-sm"> <?php echo e($order->user_details->name); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Phone')); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($order->user_details->phone); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Billing Address')); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($order->user_details->billing_address); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Shipping Address')); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($order->user_details->shipping_address); ?></dd>
                                                <?php if(!empty($order->location_data && $order->shipping_data)): ?>
                                                    <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Location')); ?></dt>
                                                    <dd class="col-sm-9 text-sm"><?php echo e($order->location_data->name); ?></dd>
                                                    <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Shipping Method')); ?></dt>
                                                    <dd class="col-sm-9 text-sm"><?php echo e($order->shipping_data->shipping_name); ?></dd>
                                                <?php endif; ?>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card card-fluid">
                                        <div class="card-body">
                                            <h6 class="mb-4"><?php echo e(__('Extra Information')); ?></h6>
                                            <dl class="row mt-4 align-items-center">
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e($store['custom_field_title_1']); ?></dt>
                                                <dd class="col-sm-9 text-sm"> <?php echo e($order->user_details->custom_field_title_1); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e($store['custom_field_title_2']); ?></dt>
                                                <dd class="col-sm-9 text-sm"> <?php echo e($order->user_details->custom_field_title_2); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e($store['custom_field_title_3']); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($order->user_details->custom_field_title_3); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e($store['custom_field_title_4']); ?></dt>
                                                <dd class="col-sm-9 text-sm"> <?php echo e($order->user_details->custom_field_title_4); ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<script type="text/javascript" src="<?php echo e(asset('custom/js/html2pdf.bundle.min.js')); ?>"></script>
<script>
    var filename = $('#filesname').val();

    function saveAsPDF() {
        var element = document.getElementById('printableArea');
        var logo_html = $('#invoice_logo_img').html();
        $('.invoice_logo').empty();
        $('.invoice_logo').html(logo_html);

        var opt = {
            margin: 0.3,
            filename: filename,
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A2'}
        };

        html2pdf().set(opt).from(element).save();
        setTimeout(function () {
            $('.invoice_logo').empty();
        }, 0);
    }

    $(document).on('click', '.downloadable_prodcut', function () {

        var download_product = $(this).attr('data-value');
        var order_id = $(this).attr('data-id');

        var data = {
            download_product: download_product,
            order_id: order_id,
        }

        $.ajax({
            url: '<?php echo e(route('user.downloadable_prodcut',$store->slug)); ?>',
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.status == 'success') {
                    show_toastr("success", data.message+'<br> <b>'+data.msg+'<b>', data["status"]);
                    $('.downloadab_msg').html('<span class="text-success">' + data.msg + '</sapn>');
                } else {
                    show_toastr("Error", data.message+'<br> <b>'+data.msg+'<b>', data["status"]);
                }
            }
        });
    });
</script>
<?php /**PATH /home/faddishbuilder/public_html/storemanager.faddishbuilder.com/resources/views/storefront/orderview.blade.php ENDPATH**/ ?>