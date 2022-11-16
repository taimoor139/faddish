<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="row  m-1">
        <div class="col-auto pe-0">
            <a href="<?php echo e(route('product.edit',$product->id)); ?>" class="btn btn-sm btn-primary btn-icon" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit Product')); ?>" ><i class="ti ti-pencil text-white"></i></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>

    <li class="breadcrumb-item"><a href="<?php echo e(route('product.index')); ?>"><?php echo e(__('Product')); ?></a></li>
     <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Product Detail')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <!-- Product title -->
                    <h5 class="h4"><?php echo e($product->name); ?></h5>
                    <!-- Rating -->
                    <div class="row align-items-center">

                        <div class="col-sm-6 text-sm-right">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <span
                                        class="badge badge-pill badge-soft-info"><?php echo e(__('ID: #')); ?><?php echo e($product->SKU); ?></span>
                                </li>
                                <li class="list-inline-item">
                                    <?php if($product->enable_product_variant != 'on'): ?>
                                        <?php if($product->quantity == 0): ?>
                                            <span class="badge badge-pill badge-soft-danger">
                                                <?php echo e(__('Out of stock')); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-pill badge-soft-success">
                                                <?php echo e(__('In stock')); ?>

                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Description -->
                    <?php echo $product->description; ?>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <?php if($product->enable_product_variant == 'on'): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <input type="hidden" id="product_id" value="<?php echo e($product->id); ?>">
                            <input type="hidden" id="variant_id" value="">
                            <input type="hidden" id="variant_qty" value="">
                            <?php $__currentLoopData = $product_variant_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-6 mb-4 mb-sm-0">
                                    <span class="d-block h6 mb-0">
                                        <th>
                                            <label for="" class="col-form-label"> <?php echo e($variant->variant_name); ?></label>

                                        </th>
                                        <select name="product[<?php echo e($key); ?>]" id='choices-multiple-<?php echo e($key); ?>'  class="form-control multi-select  pro_variants_name<?php echo e($key); ?> change_price" >
                                        <option value=""><?php echo e(__('Select')); ?></option>
                                            <?php $__currentLoopData = $variant->variant_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($values); ?>" class="price_options"><?php echo e($values); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-sm-6 mb-4 mb-sm-0">
                            <span class="d-block h3 mb-0 variasion_price">
                                <?php if($product->enable_product_variant == 'on'): ?>
                                    <?php echo e(\App\Models\Utility::priceFormat(0)); ?>

                                <?php else: ?>
                                    <?php echo e(\App\Models\Utility::priceFormat($product->price)); ?>

                                <?php endif; ?>

                            </span>
                            <?php echo e(!empty($product->product_taxs) ? $product->product_taxs->name : ''); ?>

                            <?php echo e(!empty($product->product_taxs->rate) ? $product->product_taxs->rate . '%' : ''); ?>

                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary btn-icon">
                                <span class="btn-inner--icon variant_qty">
                                    <?php if($product->enable_product_variant == 'on'): ?>
                                        0
                                    <?php else: ?>
                                        <?php echo e($product->quantity); ?>

                                    <?php endif; ?>
                                </span>
                                <span class="btn-inner--text">
                                    <?php echo e(__('Total Avl.Quantity')); ?>

                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product images -->
            <div class="card">
                <div class="card-body">
                    <?php if(!empty($product->is_cover)): ?>
                        <a href="<?php echo e(asset(Storage::url('uploads/is_cover_image/' . $product->is_cover))); ?>"
                            data-fancybox="product">
                            <img alt="Image placeholder"
                                src="<?php echo e(asset(Storage::url('uploads/is_cover_image/' . $product->is_cover))); ?>"
                                class="img-center pro_max_width1">
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>"
                            data-fancybox="product">
                            <img alt="Image placeholder"
                                src="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>"
                                class="img-center pro_max_width1">
                        </a>
                    <?php endif; ?>
                    <div class="row mt-4">
                        <?php $__currentLoopData = $product_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-4">
                                <div class="p-3 border rounded">
                                    <?php if(!empty($product_image[$key]->product_images)): ?>
                                        <a href="<?php echo e(asset(Storage::url('uploads/product_image/' . $product_image[$key]->product_images))); ?>"
                                            class="stretched-link" data-fancybox="product">
                                            <img alt="Image placeholder"
                                                src="<?php echo e(asset(Storage::url('uploads/product_image/' . $product_image[$key]->product_images))); ?>"
                                                class="img-fluid">
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(asset(Storage::url('uploads/product_image/default.jpg'))); ?>"
                                            class="stretched-link" data-fancybox="product">
                                            <img alt="Image placeholder"
                                                src="<?php echo e(asset(Storage::url('uploads/product_image/default.jpg'))); ?>"
                                                class="img-fluid">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', '.change_price', function () {
            var variants = [];
            $(".change_price").each(function (index, element) {
                variants.push(element.value);
            });
            if (variants.length > 0) {
                $.ajax({
                    url: '<?php echo e(route('get.products.variant.quantity')); ?>',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        variants: variants.join(' : '),
                        product_id: $('#product_id').val()
                    },

                    success: function (data) {
                        console.log(data);
                        $('.variasion_price').html(data.price);
                        $('#variant_id').val(data.variant_id);
                        $('.variant_qty').html(data.quantity);
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/store/public_html/resources/views/product/view.blade.php ENDPATH**/ ?>