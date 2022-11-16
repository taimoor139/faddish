<?php echo e(Form::open(array('url'=>'shipping','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name'),array('class'=>'form-control-label'))); ?>

                <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('price',__('Price'),array('class'=>'form-control-label'))); ?>

                <?php echo e(Form::text('price',null,array('class'=>'form-control','placeholder'=>__('Enter Price'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('Location',__('Location'),array('class'=>'form-control-label'))); ?>

                <?php echo Form::select('location[]', $locations, null,array('class' => 'form-control multi-select','id'=>'note1','data-toggle'=>'select','multiple')); ?>

            </div>
        </div>
    </div>
</div>

 <div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Save')); ?></button>
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home/store/public_html/resources/views/shipping/create.blade.php ENDPATH**/ ?>