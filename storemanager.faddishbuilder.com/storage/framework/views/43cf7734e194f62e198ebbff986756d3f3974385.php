<?php echo e(Form::open(array('url'=>'product_categorie','method'=>'post'))); ?>

<div class="card-body">
	<div class="row">
	    <div class="col-12">
	        <div class="form-group">
	            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Product Category'),'required'=>'required'))); ?>

	        </div>
	    </div>
	</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Save')); ?></button>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/store/public_html/resources/views/product_category/create.blade.php ENDPATH**/ ?>