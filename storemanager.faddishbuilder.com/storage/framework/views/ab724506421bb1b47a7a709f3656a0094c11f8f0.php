<div class="table-responsive">
    <table class="table">
        <thead>
        <tr class="text-center">
            <?php $__currentLoopData = $variantArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><span><?php echo e(ucwords($variant)); ?></span></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th><span><?php echo e(__('Price')); ?></span></th>
            <th><span><?php echo e(__('Quantity')); ?></span></th>
            
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $possibilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter => $possibility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php $__currentLoopData = explode(' : ', $possibility); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td>
                    <input type="text" autocomplete="off" spellcheck="false" class="form-control" value="<?php echo e($values); ?>" name="verians[<?php echo e($counter); ?>][name]" readonly>
                </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td>
                    <input type="number" id="vprice_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(__('Enter Price')); ?>" class="form-control" name="verians[<?php echo e($counter); ?>][price]">
                </td>
                <td>
                    <input type="number" id="vquantity_<?php echo e($counter); ?>" autocomplete="off" spellcheck="false" placeholder="<?php echo e(__('Enter Quantity')); ?>" class="form-control" name="verians[<?php echo e($counter); ?>][qty]">
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH /home/store/public_html/resources/views/product/variants/list.blade.php ENDPATH**/ ?>