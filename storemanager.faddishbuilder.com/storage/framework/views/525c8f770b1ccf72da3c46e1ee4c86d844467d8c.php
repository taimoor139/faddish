<div class="modal-body">
    <div class="row align-items-center pb-2">
        <input type="hidden" id="product_id" value="<?php echo e($products->id); ?>">
        <input type="hidden" id="variant_id" value="">
        <input type="hidden" id="variant_qty" value="">
        <?php $__currentLoopData = $product_variant_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 mb-4 mb-sm-0">
                <span class="d-block h6 mb-0">
                    <th><label class="control-label"><?php echo e(ucfirst($variant->variant_name)); ?></label></th>
                    <select name="product[<?php echo e($key); ?>]" id="pro_variants_name" class="form-control custom-select variant-selection  pro_variants_name<?php echo e($key); ?>">
                        <option value=""><?php echo e(__('Select')); ?></option>
                        <?php $__currentLoopData = $variant->variant_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($values); ?>"><?php echo e($values); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row align-items-center">
        <div class="col-sm-6 mb-4 mb-sm-0">
            <span class="d-block h3 mb-0 variation_price">
                 <?php if($products->enable_product_variant =='on'): ?>
                    <?php echo e(\App\Models\Utility::priceFormat(0)); ?>

                <?php else: ?>
                    <?php echo e(\App\Models\Utility::priceFormat($products->price)); ?>

                <?php endif; ?>
            </span>
        </div>
        <div class="col-sm-6 text-sm-right product-detail">
            <a class="action-item add_to_cart_variant" data-toggle="tooltip" data-id="<?php echo e($products->id); ?>">
                <button type="button" class="btn btn-addcart btn-icon">
                    <span class="btn-inner--icon grey-text">
                        <i class="fas fa-shopping-cart"></i>
                    </span>
                    <span class="btn-inner--text grey-text"><?php echo e(__('Add to cart')); ?></span>
                </button>
            </a>
        </div>
    </div>
</div>

<?php /**PATH /home/store/public_html/resources/views/storefront/store_variant.blade.php ENDPATH**/ ?>