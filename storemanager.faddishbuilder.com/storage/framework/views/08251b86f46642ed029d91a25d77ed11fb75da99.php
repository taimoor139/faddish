<?php echo e(Form::open(array('url'=>'store-resource','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('store_name',__('Store Name'),array('class'=>'col-form-label'))); ?>

                <?php echo e(Form::text('store_name',null,array('class'=>'form-control','placeholder'=>__('Enter Store Name'),'required'=>'required'))); ?>

            </div>
        </div>
        <?php if(\Auth::user()->type == 'super admin'): ?>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name'),array('class'=>'col-form-label'))); ?>

                <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('email',__('Email'),array('class'=>'col-form-label'))); ?>

                <?php echo e(Form::email('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('password',__('Password'),array('class'=>'col-form-label'))); ?>

                <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter Password'),'required'=>'required'))); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
        <button type="submit" class="btn  btn-primary"><?php echo e(__('Save')); ?></button>
    </div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home/store/public_html/resources/views/admin_store/create.blade.php ENDPATH**/ ?>