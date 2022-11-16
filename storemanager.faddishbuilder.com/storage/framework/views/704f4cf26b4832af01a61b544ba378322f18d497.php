<div class="modal-body">
    <div class="main-content">
    <section class="mh-100vh d-flex align-items-center bg-white" data-offset-top="#header-main">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="text-center">
                        <!-- Empty cart container -->
                        <div class="login-form">
                            <?php echo Form::open(array('route' => array('store.userstore', $slug),'class'=>'login-form-main'), ['method' => 'post']); ?>

                            <div class="form-group mt-2">
                            <label for="exampleInputEmail1" class="form-label float-left w-100 text-left"><?php echo e(__('Full Name')); ?></label>
                            <input name="name" class="form-control" type="text" required="required">
                        </div>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error invalid-email text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label float-left"><?php echo e(__('Email')); ?></label>
                            <input name="email" class="form-control" type="email" required="required">
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error invalid-email text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label float-left"><?php echo e(__('Number')); ?></label>
                            <input name="phone_number" class="form-control" type="text" required="required">
                        </div>
                        <?php $__errorArgs = ['number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error invalid-email text-danger" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label float-left"><?php echo e(__('Password')); ?></label>
                            <input name="password" class="form-control" type="password"  required="required">
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error invalid-email text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label float-left"><?php echo e(__('Confirm Password')); ?></label>
                            <input name="password_confirmation" class="form-control" type="password"  required="required">
                        </div>
                        <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error invalid-email text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="log_in_btn form-group  mb-3 d-flex align-items-center">
                            <button type="submit" class="sign-in-btn bg--gray"><?php echo e(__('Register')); ?></button>
                        </div>
                        <div class="float-left">
                            <?php echo e(__('Already registered ?')); ?>

                        <a data-url="<?php echo e(route('customer.loginform',$slug)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Login')); ?>"  data-toggle="modal"  class="text-primary pb-4"><?php echo e(__('Login')); ?></a>
                        </div>
                        
                        <?php echo Form::close(); ?>

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>    
</div>

<?php /**PATH /home/store/public_html/resources/views/storefront/user/create.blade.php ENDPATH**/ ?>