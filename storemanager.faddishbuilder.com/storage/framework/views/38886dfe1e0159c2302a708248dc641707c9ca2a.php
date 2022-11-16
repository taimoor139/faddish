<?php
    $profile=asset(Storage::url('uploads/profile/'));
    //$default_avatar = asset(Storage::url('uploads/default_avatar/avatar.png'));
?>
<div class="modal-body">
    <?php echo e(Form::model($userDetail,array('route' => array('customer.profile.update',$slug,$userDetail), 'method' => 'put', 'enctype' => "multipart/form-data"))); ?>

    <div class="container-lg px-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="main-informations">
                    <h3 class="profile-heading mb-5">
                        <?php echo e(__('Main Information')); ?>

                    </h3>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Name')); ?></label>
                                <?php echo e(Form::text('name',null,array('class'=>'form-control font-style'))); ?>

                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-name" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Email')); ?></label>
                                <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))); ?>

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
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <label for="name"><?php echo e(__('Avatar')); ?></label>
                            <div class="row">
                                <div class="small-12 large-4 columns">
                                    <div class="imageWrapper bg--gray">
                                        <button class="file-upload bg--gray">
                                            <img src="<?php echo e(asset('custom/img/upload.svg')); ?>" alt="upload" class="img-fluid">
                                            <input type="file" name="profile" id="file-1" class="file-input"><?php echo e(__('Choose file here')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <hr>
    <div class="container-lg px-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="main-informations">
                    <h3 class="profile-heading mb-5">
                        <?php echo e(__('Password Informations')); ?>

                    </h3>
                    <div class="row profile-select-dropdown">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="current_password"><?php echo e(__('Current Password')); ?></label>
                                <?php echo e(Form::password('current_password',array('class'=>'form-control','placeholder'=>__('Enter Current Password')))); ?>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="new_password"><?php echo e(__('New Password')); ?></label>
                                <?php echo e(Form::password('new_password',array('class'=>'form-control','placeholder'=>__('Enter New Password')))); ?>

                                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-new_password" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="confirm_password"><?php echo e(__('Re-type New Password')); ?></label>
                                <?php echo e(Form::password('confirm_password',array('class'=>'form-control','placeholder'=>__('Enter Re-type New Password')))); ?>

                                <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-confirm_password" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                <div class="form-group">
                    <?php echo e(Form::button(__('Save Changes'),array('type'=>'submit','class'=>'btn text-white ml-1  float-right ml-2 bg--gray hover-translate-y-n3 icon-font'))); ?>

                </div>
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
    
<?php /**PATH /home/store/public_html/resources/views/storefront/customer/profile.blade.php ENDPATH**/ ?>