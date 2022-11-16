<?php echo e(Form::open(array('route' => array('test.send.mail')))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('email', __('Email'),array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::text('email', '', array('class' => 'form-control','required'=>'required'))); ?>

            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-email" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
</div>
<div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
        <button type="submit" class="btn  btn-primary"><?php echo e(__('Send')); ?></button>
    </div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home/store/public_html/resources/views/settings/test_mail.blade.php ENDPATH**/ ?>