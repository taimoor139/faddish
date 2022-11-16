<?php
    if(!empty(session()->get('lang')))
    {
        $currantLang = session()->get('lang');
    }else{
        $currantLang = $store->lang;
    }
    $languages=\App\Models\Utility::languages();
    $SITE_RTL = Cookie::get('SITE_RTL');
    $s_logo=\App\Models\Utility::get_file('uploads/store_logo/');
?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo e($SITE_RTL == 'on'?'rtl':''); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=  ">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="<?php echo e(env('APP_NAME')); ?> - Online Whatsapp Store Builder">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title> <?php echo e((\App\Models\Utility::getValByName('header_text')) ? \App\Models\Utility::getValByName('header_text') : config('app.name', 'WhatsStore')); ?>  <?php echo $__env->yieldContent('page-title'); ?></title>
    <link rel="icon" href="<?php echo e(asset(Storage::url('uploads/logo/')).'/favicon.png'); ?>" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/bootstrap-switch-button.min.css')); ?>">
     <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/flatpickr.min.css')); ?>">
     <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dragula.min.css')); ?>">
     <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/style.css')); ?>">
     <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/main.css')); ?>">
     <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/datepicker-bs5.min.css')); ?>">
    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/animate.css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>">

    <!-- vendor css -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/custom.css')); ?>">

    <?php if($SITE_RTL =='on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('css-page'); ?>
</head>
<body class="theme-3">
  <!-- [ Pre-loader ] start -->


  <!-- Modal -->

  <!-- [ Header ] end -->
<body id="printableArea">
<div class="dash-container downOrder">
    <div class="dash-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
              <div class="page-block">
                  <div class="row align-items-center">
                      <div class="col-md-12">
                          <div class="d-block d-sm-flex align-items-center justify-content-between">
                              <div>
                                  <div class="page-header-title">
                                    <?php if(!empty($store->logo)): ?>
                                    
                                    <img src="<?php echo e($s_logo.(isset($store->logo) && !empty($store->logo)? $store->logo:'logo.png')); ?>" id="navbar-logo" style="height: 40px;">
                                <?php else: ?>
                                    <img src="<?php echo e($s_logo.(isset($store->logo) && !empty($store->logo)? $store->logo:'logo.png')); ?>" id="navbar-logo" style="height: 40px;">
                                <?php endif; ?>
                                  </div>
                              </div>
                              <div>
                                <div class="row  m-1">
                                    <div class="col-auto pe-0">
                                        <a href="#" onclick="saveAsPDF();"  class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Download')); ?>">
                                            <i class="fa fa-print text-white"></i>
                                        </a>

                                    </div>
                                </div>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>

        <!-- <div class="row"> -->
        <div class="mt-4">
                    <div id="">
                        <div class="row">
                            <div class=" col-6 pb-2 invoice_logo"></div>
                            <div class=" col-6 pb-2 delivered_Status text-end">

                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                               <div class="card">
                                   <div class="card-header border-0 d-flex justify-content-between align-items-center">
                                       <h6 class="mb-0"><?php echo e(__('Items from Order')); ?> <?php echo e($order->order_id); ?></h6>

                                               <?php if($order->status == 'pending'): ?>
                                               <button class="btn btn-sm btn-success"><?php echo e(__('Pending')); ?></button>
                                           <?php elseif($order->status == 'Cancel Order'): ?>
                                               <button class="btn btn-sm btn-danger"><?php echo e(__('Order Canceled')); ?></button>
                                           <?php else: ?>
                                               <button class="btn btn-sm btn-success"><?php echo e(__('Delivered')); ?></button>
                                           <?php endif; ?>
                                   </div>

                                   <div class="card-body">
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
                                           <?php $__currentLoopData = $order_products->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                           </div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header border-0 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0"><?php echo e(__('Items from Order')); ?> <?php echo e($order->order_id); ?></h6>
                                    </div>
                                    <div class="card-header">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="thead-light">

                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><?php echo e(__('Sub Total')); ?> :</td>
                                                    <td><?php echo e(App\Models\Utility::priceFormat($sub_total)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo e(__('Estimated Tax')); ?> :</td>
                                                    <td><?php echo e(App\Models\Utility::priceFormat($final_taxs)); ?></td>
                                                </tr>
                                                <?php if(!empty($discount_price)): ?>
                                                    <tr>
                                                        <td><?php echo e(__('Apply Coupon')); ?> :</td>
                                                        <td><?php echo e($discount_price); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if(!empty($shipping_data)): ?>
                                                    <?php if(!empty($discount_value)): ?>
                                                        <tr>
                                                            <td><?php echo e(__('Shipping Price')); ?> :</td>
                                                            <td><?php echo e(App\Models\Utility::priceFormat($shipping_data->shipping_price)); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo e(__('Grand Total')); ?> :</th>
                                                            <th><?php echo e(App\Models\Utility::priceFormat($grand_total+$shipping_data->shipping_price-$discount_value)); ?></th>
                                                        </tr>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td><?php echo e(__('Shipping Price')); ?> :</td>
                                                            <td><?php echo e(App\Models\Utility::priceFormat($shipping_data->shipping_price)); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo e(__('Grand Total')); ?> :</th>
                                                            <th><?php echo e(App\Models\Utility::priceFormat($grand_total+$shipping_data->shipping_price)); ?></th>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php elseif(!empty($discount_value)): ?>
                                                    <tr>
                                                        <th><?php echo e(__('Grand  Total')); ?> :</th>
                                                        <th><?php echo e(App\Models\Utility::priceFormat($grand_total-$discount_value)); ?></th>
                                                    </tr>
                                                <?php else: ?>
                                                    <tr>
                                                        <th><?php echo e(__('Grand  Total')); ?> :</th>
                                                        <th><?php echo e(App\Models\Utility::priceFormat($grand_total)); ?></th>
                                                    </tr>
                                                <?php endif; ?>

                                                <th><?php echo e(__('Payment Type')); ?> :</th>
                                                <th><?php echo e($order['payment_type']); ?></th>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card card-fluid">
                                    <div class="card-header">
                                        <h5 class="mb-4"><?php echo e(__('Billing Information')); ?></h5>
                                    </div>
                                    <div class="card-body">

                                        <dl class="row mt-4 align-items-center">
                                            <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Name')); ?></dt>
                                            <dd class="col-sm-9 text-sm"> <?php echo e($user_details->name); ?></dd>
                                            <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Phone')); ?></dt>
                                            <dd class="col-sm-9 text-sm"><?php echo e($user_details->phone); ?></dd>
                                            <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Billing Address')); ?></dt>
                                            <dd class="col-sm-9 text-sm"><?php echo e($user_details->billing_address); ?></dd>
                                            <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Shipping Address')); ?></dt>
                                            <dd class="col-sm-9 text-sm"><?php echo e($user_details->shipping_address); ?></dd>
                                            <?php if(!empty($location_data && $shipping_data)): ?>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Location')); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($location_data->name); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Shipping Method')); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($shipping_data->shipping_name); ?></dd>
                                            <?php endif; ?>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-fluid">
                                    <div class="card-header">
                                        <h5 class="mb-4"><?php echo e(__('Shipping Information')); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <address class="mb-0 text-sm">
                                            <dl class="row mt-4 align-items-center">
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Name')); ?></dt>
                                                <dd class="col-sm-9 text-sm"> <?php echo e($user_details->name); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Phone')); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($user_details->phone); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Billing Address')); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($user_details->billing_address); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Shipping Address')); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($user_details->shipping_address); ?></dd>
                                                <?php if(!empty($location_data && $shipping_data)): ?>
                                                    <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Location')); ?></dt>
                                                    <dd class="col-sm-9 text-sm"><?php echo e($location_data->name); ?></dd>
                                                    <dt class="col-sm-3 h6 text-sm"><?php echo e(__('Shipping Method')); ?></dt>
                                                    <dd class="col-sm-9 text-sm"><?php echo e($shipping_data->shipping_name); ?></dd>
                                                <?php endif; ?>
                                            </dl>
                                        </address>
                                    </div>
                                </div>
                            </div>
                                <div class="col-lg-4">
                                    <div class="card card-fluid">
                                        <div class="card-header">
                                            <h5 class="mb-4"><?php echo e(__('Extra Information')); ?></h5>
                                        </div>
                                        <div class="card-body">

                                            <dl class="row mt-4 align-items-center">
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e($store['custom_field_title_1']); ?></dt>
                                                <dd class="col-sm-9 text-sm"> <?php echo e($user_details->custom_field_title_1); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e($store['custom_field_title_2']); ?></dt>
                                                <dd class="col-sm-9 text-sm"> <?php echo e($user_details->custom_field_title_2); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e($store['custom_field_title_3']); ?></dt>
                                                <dd class="col-sm-9 text-sm"><?php echo e($user_details->custom_field_title_3); ?></dd>
                                                <dt class="col-sm-3 h6 text-sm"><?php echo e($store['custom_field_title_4']); ?></dt>
                                                <dd class="col-sm-9 text-sm"> <?php echo e($user_details->custom_field_title_4); ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <!-- </div> -->

    </div>
</div>



<!-- [ Main Content ] start -->



<!-- [ Main Content ] end -->
<!--
 -->

<footer class="dash-footer" id="footer-main">
  <div class="footer-wrapper">
     <div class="col-md-6">
            <div class="copyright text-sm font-weight-bold text-center text-md-left">
                <?php echo e($store->footer_note); ?>

            </div>
        </div>
        <div class="col-md-6 text-end">
            <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                <?php if(!empty($store->email)): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:<?php echo e($store->email); ?>" target="_blank">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(!empty($store->whatsapp)): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($store->whatsapp); ?>" target=”_blank”>
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(!empty($store->facebook)): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($store->facebook); ?>" target="_blank">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(!empty($store->instagram)): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($store->instagram); ?>" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(!empty($store->twitter)): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($store->twitter); ?>" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(!empty($store->youtube)): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($store->youtube); ?>" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
  </div>
</footer>


<div id="invoice_logo_img" class="d-none">
    <div class="row align-items-center py-2 px-3">
        <?php if(!empty($store->invoice_logo)): ?>
            <img alt="Image placeholder" src="<?php echo e(asset(Storage::url('uploads/store_logo/'.$store->invoice_logo))); ?>" id="navbar-logo" style="height: 40px;">
        <?php else: ?>
            <img alt="Image placeholder" src="<?php echo e(asset(Storage::url('uploads/store_logo/invoice_logo.png'))); ?>" id="navbar-logo" style="height: 40px;">
        <?php endif; ?>
    </div>
</div>


<script src="<?php echo e(asset('custom/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/choices.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/perfect-scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/dash.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/simple-datatables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/tinymce/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/choices.min.js')); ?>"></script>
<script src="<?php echo e(asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/dropzone-amd-module.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap-switch-button.min.js')); ?>"></script>
<!-- Time picker -->
<script src="<?php echo e(asset('assets/js/plugins/flatpickr.min.js')); ?>"></script>
<!-- datepicker -->
<script src="<?php echo e(asset('assets/js/plugins/datepicker-full.min.js')); ?>"></script>
<script src="<?php echo e(asset('custom/js/letter.avatar.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('custom/js/custom.js')); ?>"></script>


    <script type="text/javascript" src="<?php echo e(asset('custom/js/html2pdf.bundle.min.js')); ?>"></script>
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






</body>

</html>
<?php /**PATH /home/faddishbuilder/public_html/storemanager.faddishbuilder.com/resources/views/storefront/userorder.blade.php ENDPATH**/ ?>