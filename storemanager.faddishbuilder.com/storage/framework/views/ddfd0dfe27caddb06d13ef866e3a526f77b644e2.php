
<form method="POST" action="<?php echo e(route('get.product.variants.possibilities')); ?>">
    <?php echo csrf_field(); ?>
    <div class="card-body">
         <div class="form-group">
            <label for="variant_name" class="col-form-label"><?php echo e(__('Variant Name')); ?></label>
            <input class="form-control" name="variant_name" type="text" id="variant_name" placeholder="<?php echo e(__('Variant Name, i.e Size, Color etc')); ?>">
        </div>
        <div class="form-group">
            <label for="variant_options" class="col-form-label"><?php echo e(__('Variant Options')); ?></label>
            <input class="form-control" name="variant_options" type="text" id="variant_options" placeholder="<?php echo e(__('Variant Options separated by|pipe symbol, i.e Black|Blue|Red')); ?>">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
        <button type="submit" class="btn  btn-primary add-variants"><?php echo e(__('Add Variants')); ?></button>
    </div>
</form>
<?php /**PATH /home/faddishbuilder/public_html/storemanager.faddishbuilder.com/resources/views/product/variants/create.blade.php ENDPATH**/ ?>