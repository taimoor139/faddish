<style>
    .product_item .product_details_icon {
        visibility: hidden;
    }

    .product_item:hover .product_details_icon {
        visibility: visible;
    }

    .product_details_active {
        color: #ffffff;
        font-size: 18px;
        margin-left: 12px;
    }

    .collection-list .btn-addcart {
        margin-left: 12px;
    }

    .modal-lg {
        max-width: 70% !important;
    }
</style>
<?php
    \App::setLocale(isset($store->lang) ? $store->lang : 'en');
?>
<?php if($flag == 'my_orders' ): ?>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center">
<thead>
    <tr>
        <th scope="col"><?php echo e(__('Order')); ?></th>
        <th scope="col" class="sort"><?php echo e(__('Date')); ?></th>
        <th scope="col" class="sort"><?php echo e(__('Value')); ?></th>
        <th scope="col" class="sort"><?php echo e(__('Payment Type')); ?></th>
        <th scope="col" class="sort text-center"><?php echo e(__('Status')); ?></th>
        <th scope="col" class="text-right"><?php echo e(__("Action")); ?></th>
    </tr>
    </thead>
<tbody>

<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_key => $order_items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>

                <td>
                    <a href="#" data-size="lg" data-url="<?php echo e(route('store.product.product_order_view', [$order_items->id, Auth::guard('customers')->user()->id, $store->slug])); ?>" data-title="<?php echo e($order_items->order_id); ?>" data-ajax-popup="true">
                        
                        <span class="btn-inner--text"><?php echo e($order_items->order_id); ?></span>
                    </a>
                </td>

                <td class="order ml-3">
                    <span class="h6 text-sm font-weight-bold mb-0"><?php echo e(\App\Models\Utility::dateFormat($order_items->created_at)); ?></span>
                </td>
                <td>
                    <span class="value text-sm mb-0"><?php echo e(\App\Models\Utility::priceFormat($order_items->price)); ?></span>
                </td>
                <td>
                    <span class="taxes text-sm mb-0"><?php echo e($order_items->payment_type); ?></span>
                </td>
                <td>
                    <div class="d-flex align-items-center justify-content-end">
                        <?php if($order_items->status != 'Cancel Order'): ?>
                            <button type="button" class="btn btn-sm <?php echo e(($order_items->status == 'pending')?'btn-soft-info':'btn-soft-success'); ?> btn-icon rounded-pill">
                                <span class="btn-inner--icon">
                                <?php if($order_items->status == 'pending'): ?>
                                        <i class="fas fa-check soft-success"></i>
                                    <?php else: ?>
                                        <i class="fa fa-check-double soft-success"></i>
                                    <?php endif; ?>
                                </span>
                                <?php if($order_items->status == 'pending'): ?>
                                    <span class="btn-inner--text">
                                        <?php echo e(__('Pending')); ?>: <?php echo e(\App\Models\Utility::dateFormat($order_items->created_at)); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="btn-inner--text">
                                        <?php echo e(__('Delivered')); ?>: <?php echo e(\App\Models\Utility::dateFormat($order_items->updated_at)); ?>

                                    </span>
                                <?php endif; ?>
                            </button>
                        <?php else: ?>
                            <button type="button" class="btn btn-sm btn-soft-danger btn-icon rounded-pill">
                                <span class="btn-inner--icon">
                                    <?php if($order_items->status == 'pending'): ?>
                                        <i class="fas fa-check soft-success"></i>
                                    <?php else: ?>
                                        <i class="fa fa-check-double soft-success"></i>
                                    <?php endif; ?>
                                </span>
                                <span class="btn-inner--text">
                                    <?php echo e(__('Cancel Order')); ?>: <?php echo e(\App\Models\Utility::dateFormat($order_items->created_at)); ?>

                                </span>
                            </button>
                    <?php endif; ?>

                    </div>
                </td>
                <td>
                     <!-- Actions -->
                     <div class="actions ml-3">
                        <a data-url="<?php echo e(route('store.product.product_order_view', [$order_items->id, Auth::guard('customers')->user()->id, $store->slug])); ?>" class="action-item mr-2"  data-toggle="tooltip" data-title="<?php echo e($order_items->id); ?>" data-ajax-popup="true" data-size="lg">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
        </table>
    </div>
</div>
<?php else: ?>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="collection-lists collection-items <?php echo e(($loop->iteration != 1) ? 'd-none' : ''); ?> <?php echo e($loop->iteration); ?><?php echo str_replace(' ', '_', ($key)); ?> product_tableese">
    
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="collection-list product_item" data-name="<?php echo e($product->name); ?>">
                <div class="collection-left">
                    <div class="collection-img">
                        <a href="#" data-size="lg" data-url="<?php echo e(route('store.product.product_view',[$store->slug,$product->id])); ?>" data-title="<?php echo e($product->name); ?>" data-ajax-popup="true">
                            <?php if(!empty($product->is_cover)): ?>
                                <img alt="Image placeholder" src="<?php echo e(asset(Storage::url('uploads/is_cover_image/'.$product->is_cover))); ?>" width="70px" height="65px">
                            <?php else: ?>
                                <img alt="Image placeholder" src="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>" width="70px" height="65px">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="collection-title">
                        <a href="#" data-size="lg" data-url="<?php echo e(route('store.product.product_view',[$store->slug,$product->id])); ?>" data-title="<?php echo e($product->name); ?>" data-ajax-popup="true">
                            <h4 class="title"><?php echo e($product->name); ?></h4>
                        </a>
                        <p class="qty-item"><?php echo e((isset($product->categories) && !empty($product->categories)) ? $product->categories->name : ''); ?></p>
                    </div>
                </div>
                <div class="collection-right">
                    <?php if($product->enable_product_variant == 'on'): ?>
                        <div class="item-spin">
                            <div class="font-weight-bold text-dark">
                                <?php echo e(__('In Variant')); ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <div class="item-spin">
                            <p class="price-spin"><?php echo e(\App\Models\Utility::priceFormat($product->price)); ?></p>
                        </div>
                    <?php endif; ?>
                    <a href="#" data-size="lg" data-url="<?php echo e(route('store.product.product_view',[$store->slug,$product->id])); ?>" data-ajax-popup="true" class="product_details_icon float-right mt-1"><i class="fas fa-eye product_details_active text_color"></i></a>
                    <?php if($product->enable_product_variant == 'on'): ?>
                        <a href="#" class="btn btn-addcart" data-size="lg" data-url="<?php echo e(route('store-variant.variant',[$store->slug,$product->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Variant')); ?>"><?php echo e(__('ADD TO CART')); ?>

                            <svg class="cart-icon" width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.70269 4.66667H5.14854H9.14854H11.5944L10.7583 10.1014C10.7082 10.4266 10.4284 10.6667 10.0994 10.6667H4.19771C3.86866 10.6667 3.58883 10.4266 3.5388 10.1014L2.70269 4.66667ZM9.81521 2.66667V3.33333H11.5944H13.1485C13.5167 3.33333 13.8152 3.63181 13.8152 4C13.8152 4.36819 13.5167 4.66667 13.1485 4.66667H12.928C12.9279 4.73342 12.9227 4.80113 12.9122 4.86941L12.0761 10.3041C11.926 11
                                                                                                                        .2798 11.0865 12 10.0994 12H4.19771C3.21057 12 2.37107 11.2798 2.22097 10.3041L1.38486 4.86941C1.37435 4.80113 1.3692 4.73342 1.36907 4.66667H1.14854C0.780349 4.66667 0.481873 4.36819 0.481873 4C0.481873 3.63181 0.780349 3.33333 1.14854 3.33333H2.70269H4.48187V2.66667C4.48187 1.19391 5.67578 0 7.14854 0C8.6213 0 9.81521 1.19391 9.81521 2.66667ZM5.81521 2.66667V3.33333H8.48187V2.66667C8.48187 1.93029 7.88492 1.33333 7.14854 1.33333C6.41216 1.33333 5.81521 1.93029 5.81521 2.66667ZM7.14854 9.33333C6.78035 9.33333 6.48187 9.03486 6.48187 8.66667V6.66667C6.48187 6.29848 6.78035 6 7.14854 6C7.51673 6 7.81521 6.29848 7.81521 6.66667V8.66667C7.81521 9.03486 7.51673 9.33333 7.14854 9.33333ZM4.48187 8.66667C4.48187 9.03486 4.78035 9.33333 5.14854 9.33333C5.51673 9.33333 5.81521 9.03486 5.81521 8.66667V6.66667C5.81521 6.29848 5.51673 6 5.14854 6C4.78035 6 4.48187 6.29848 4.48187 6.66667V8.66667ZM8.48187 8.66667C8.48187 9.03486 8.78035 9.33333 9.14854 9.33333C9.51673 9.33333 9.81521 9.03486 9.81521 8.66667V6.66667C9.81521 6.29848 9.51673 6 9.14854 6C8.78035 6 8.48187 6.29848 8.48187 6.66667V8.66667Z"
                                      fill="white"/>
                            </svg>
                        </a>
                    <?php else: ?>
                        <a href="#" class="btn btn-addcart add_to_cart" data-id="<?php echo e($product->id); ?>"><?php echo e(__('ADD TO CART')); ?>

                            <svg class="cart-icon" width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.70269 4.66667H5.14854H9.14854H11.5944L10.7583 10.1014C10.7082 10.4266 10.4284 10.6667 10.0994 10.6667H4.19771C3.86866 10.6667 3.58883 10.4266 3.5388 10.1014L2.70269 4.66667ZM9.81521 2.66667V3.33333H11.5944H13.1485C13.5167 3.33333 13.8152 3.63181 13.8152 4C13.8152 4.36819 13.5167 4.66667 13.1485 4.66667H12.928C12.9279 4.73342 12.9227 4.80113 12.9122 4.86941L12.0761 10.3041C11.926 11.2798 11.0865 12 10.0994 12H4.19771C3.21057 12 2.37107 11.2798 2.22097 10.3041L1.38486 4.86941C1.37435 4.80113 1.3692 4.73342 1.36907 4.66667H1.14854C0.780349 4.66667 0.481873 4.36819 0.481873 4C0.481873 3.63181 0.780349 3.33333 1.14854 3.33333H2.70269H4.48187V2.66667C4.48187 1.19391 5.67578 0 7.14854 0C8.6213 0 9.81521 1.19391 9.81521 2.66667ZM5.81521 2.66667V3.33333H8.48187V2.66667C8.48187 1.93029 7.88492 1.33333 7.14854 1.33333C6.41216 1.33333 5.81521 1.93029 5.81521 2.66667ZM7.14854 9.33333C6.78035 9.33333 6.48187 9.03486 6.48187 8.66667V6.66667C6.48187 6.29848 6.78035 6 7.14854 6C7.51673 6 7.81521 6.29848 7.81521 6.66667V8.66667C7.81521 9.03486 7.51673 9.33333 7.14854 9.33333ZM4.48187 8.66667C4.48187 9.03486 4.78035 9.33333 5.14854 9.33333C5.51673 9.33333 5.81521 9.03486 5.81521 8.66667V6.66667C5.81521 6.29848 5.51673 6 5.14854 6C4.78035 6 4.48187 6.29848 4.48187 6.66667V8.66667ZM8.48187 8.66667C8.48187 9.03486 8.78035 9.33333 9.14854 9.33333C9.51673 9.33333 9.81521 9.03486 9.81521 8.66667V6.66667C9.81521 6.29848 9.51673 6 9.14854 6C8.78035 6 8.48187 6.29848 8.48187 6.66667V8.66667Z" fill="white"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /home/store/public_html/resources/views/storefront/list.blade.php ENDPATH**/ ?>