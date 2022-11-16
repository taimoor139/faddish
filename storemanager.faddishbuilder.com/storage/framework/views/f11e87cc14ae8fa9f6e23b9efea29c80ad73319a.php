<?php
 $settings = Utility::settings();
?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo e($settings == 'on'?'rtl':''); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(env('APP_NAME')); ?> - POS Receipt</title>
    <?php if(isset($settings['SITE_RTL'] ) && $settings['SITE_RTL'] == 'on'): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>" id="main-style-link">
<?php endif; ?>
</head>
<body>
<div id="invoice-POS" style="width:100%">
    <style>
        #invoice-POS ::selection {
            color: #fff;
        }

        #invoice-POS ::moz-selection {
            color: #fff;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
            font-family: 'Trebuchet MS', sans-serif;
        }

        #invoice-POS h2 {
            font-size: 1.2em;
            font-family: 'Trebuchet MS', sans-serif;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: bold;
            line-height: 2em;
            font-family: 'Trebuchet MS', sans-serif;
        }

        #invoice-POS p {
            font-size: 0.9em;
            color: #000;
            font-family: 'Trebuchet MS', sans-serif;
            font-weight: bold;
        }

        #invoice-POS .footer {
            font-size: 0.9em;
            color: #000;
            font-family: 'Trebuchet MS', sans-serif;
        }

        #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {

        }

        #invoice-POS #top {
            min-height: 65px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo img {
            height: auto;
            width: 25%;
            height: auto;
            background-size: 60px 60px;
            filter: gray saturate(0%) brightness(70%) contrast(100%);
        }

        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: 0.7em;
        }

        #invoice-POS .service {
            border-bottom: 2px solid #000;
        }

        #invoice-POS .item {
            width: 24mm;
        }

        #invoice-POS .itemtext {
            font-size: 0.9em;
            color: black;
        }

        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }

        @media  print {
        }
    </style>
    <center id="top">
        <div class="logo">
            <?php

                $logo_url = 'uploads/store_logo/invoice_logo.png';

            ?>
            <center>
                <?php if(isset($store['invoice_logo']) && $store['invoice_logo'] !==''): ?>
                    <img class="mt-2 mb-2" src="<?php echo e(asset(Storage::url('uploads/store_logo/'.$store['invoice_logo']))); ?>" alt="Logo" width="120"/>
                <?php else: ?>
                    <img class="mt-2 mb-2" src="<?php echo e(asset(Storage::url($logo_url))); ?>" alt="Logo" width="120">
            <?php endif; ?>
        </div>
        <div class="info">
            <h2><?php echo e(__('SALE RECEIPT')); ?></h2>
        </div>
        <!--End Info-->
    </center><!--End InvoiceTop-->
    <div id="bot">
        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item"><h2>Item</h2></td>
                    <td class="Hours" style="text-align: center"><h2>Qty</h2></td>
                    <td class="Rate"><h2>Price</h2></td>
                </tr>
                <?php $__currentLoopData = $order_products->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="service">
                        <?php if($product->variant_id != 0): ?>
                            <td class="tableitem"><p class="itemtext"><?php echo e($product->product_name); ?>-<?php echo e($product->variant_name); ?></p>
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
                            <td class="tableitem" style="text-align: center"><p class="itemtext"><?php echo e($product->quantity); ?></p></td>
                            <td class="tableitem"><p class="itemtext"> <?php echo e(App\Models\Utility::priceFormat($product->variant_price*$product->quantity+$total_tax)); ?></p></td>
                        <?php else: ?>
                            <td class="tableitem"><p class="itemtext"> <?php if(isset($product->product_name)): ?><?php echo e($product->product_name); ?><?php else: ?><?php echo e($product->name); ?><?php endif; ?></p>
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
                                        $total_tax = 0;
                                           $total=  $product->price*$product->quantity;
                                    ?>
                                <?php endif; ?>
                            </td>
                            <td class="tableitem" style="text-align: center"><p class="itemtext"><?php echo e($product->quantity); ?></p></td>
                            <td class="tableitem"><p class="itemtext"> <?php echo e(App\Models\Utility::priceFormat($product->price*$product->quantity+$total_tax)); ?></p></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($shipping_data) && $discount_value != 0): ?>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2><?php echo e(__('Coupon')); ?> :</h2></td>
                        <td class="payment"><h2><?php echo e(App\Models\Utility::priceFormat($discount_value)); ?></h2></td>
                    </tr>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2><?php echo e(__('Shipping Price')); ?> :</h2></td>
                        <td class="payment"><h2><?php echo e(App\Models\Utility::priceFormat($shipping_data->shipping_price)); ?></h2></td>
                    </tr>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2><?php echo e(__('Grand Total')); ?></h2></td>
                        <td class="payment"><h2><?php echo e(App\Models\Utility::priceFormat(($sub_total+$total_taxs+$shipping_data->shipping_price)-$discount_value)); ?></h2></td>
                    </tr>
                <?php elseif(!empty($shipping_data)): ?>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2><?php echo e(__('Shipping Price')); ?> :</h2></td>
                        <td class="payment"><h2><?php echo e(App\Models\Utility::priceFormat($shipping_data->shipping_price)); ?></h2></td>
                    </tr>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2><?php echo e(__('Grand Total')); ?></h2></td>
                        <td class="payment"><h2><?php echo e(App\Models\Utility::priceFormat($sub_total+$total_taxs+$shipping_data->shipping_price)); ?></h2></td>
                    </tr>
                <?php elseif($discount_value != 0): ?>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2><?php echo e(__('Coupon')); ?> :</h2></td>
                        <td class="payment"><h2><?php echo e(App\Models\Utility::priceFormat($discount_value)); ?></h2></td>
                    </tr>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2><?php echo e(__('Grand Total')); ?></h2></td>
                        <td class="payment"><h2><?php echo e(App\Models\Utility::priceFormat(($sub_total+$total_taxs)-$discount_value)); ?></h2></td>
                    </tr>
                <?php else: ?>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate"><h2><?php echo e(__('Grand Total')); ?></h2></td>
                        <td class="payment"><h2><?php echo e(App\Models\Utility::priceFormat($sub_total+$total_taxs)); ?></h2></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <!--End Table-->
    </div>
    <!--End InvoiceBot-->
    <div class="footer pt-2">
        <center><p class="text-dark p-2">Merchandise may not be returned for refund at any time. Power bases cannot be exchanged and are non-refundable. For purchases made in a Milo Showroom, no refunds are available and sales c</p></center>
    </div>
</div>
<script>
    window.print();
    window.onafterprint = back;

    function back() {
        window.close();
        window.history.back();
    }
</script>
</body>
</html>
<?php /**PATH /home/store/public_html/resources/views/orders/receipt.blade.php ENDPATH**/ ?>