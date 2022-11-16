<?php echo e(Form::open(array('url'=>'product_tax','method'=>'post'))); ?>

<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('tax_name',__('Tax Name'),array('class'=>'col-form-label'))); ?>

                <?php echo e(Form::text('tax_name',null,array('class'=>'form-control','placeholder'=>__('Enter Tax Name'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('rate',__('Rate').' '.'(%)',array('class'=>'col-form-label'))); ?>

                <?php echo e(Form::text('rate',null,array('class'=>'form-control','placeholder'=>__('Enter Rate'),'required'=>'required'))); ?>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Save')); ?></button>
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home/store/public_html/resources/views/producttax/create.blade.php ENDPATH**/ ?>