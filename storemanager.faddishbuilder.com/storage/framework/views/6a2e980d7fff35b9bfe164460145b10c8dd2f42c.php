<?php $__env->startSection('page-title'); ?>
    <?php echo e($emailTemplate->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Email Template')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<div class="d-flex justify-content-end drp-languages">
    <ul class="list-unstyled mb-0 m-2">
        <li class="dropdown dash-h-item drp-language">
            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                href="#" role="button" aria-haspopup="false" aria-expanded="false"
                id="dropdownLanguage">

                <span
                    class="drp-text hide-mob text-primary"><?php echo e(__('Locale: ')); ?><?php echo e(Str::upper($currEmailTempLang->lang)); ?></span>
                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
            </a>
            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                aria-labelledby="dropdownLanguage">
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('manage.email.language', [$emailTemplate->id, $lang])); ?>"
                        class="dropdown-item <?php echo e($currEmailTempLang->lang == $lang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($lang)); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </li>
    </ul>
    <ul class="list-unstyled mb-0 m-2">
        <li class="dropdown dash-h-item drp-language">
            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                href="#" role="button" aria-haspopup="false" aria-expanded="false"
                id="dropdownLanguage">
                <span
                    class="drp-text hide-mob text-primary"><?php echo e(__('Template: ')); ?><?php echo e($emailTemplate->name); ?></span>
                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
            </a>

            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                aria-labelledby="dropdownLanguage">
                <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('manage.email.language', [$EmailTemplate->id,(Request::segment(3)?Request::segment(3):\Auth::user()->lang)])); ?>"
                        class="dropdown-item <?php echo e($EmailTemplate->name == $emailTemplate->name ? 'text-primary' : ''); ?>"><?php echo e($EmailTemplate->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </li>

    </ul>
</div>
<?php $__env->stopSection(); ?>
    
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                        <?php echo e(Form::model($currEmailTempLang, ['route' => ['updateEmail.settings', $currEmailTempLang->parent_id], 'method' => 'PUT'])); ?>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h6 class="font-weight-bold pb-1"><?php echo e(__('Place Holder')); ?></h6>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row text-xs">
                                        <p class="mb-1"><?php echo e(__('App Name')); ?> : <span
                                            class="pull-right text-primary">{app_name}</span></p>
                                    <p class="mb-1"><?php echo e(__('Order Name')); ?> : <span
                                            class="pull-right text-primary">{order_name}</span></p>
                                    <p class="mb-1"><?php echo e(__('Order Status')); ?> : <span
                                            class="pull-right text-primary">{order_status}</span></p>
                                    <p class="mb-1"><?php echo e(__('Order URL')); ?> : <span
                                            class="pull-right text-primary">{order_url}</span></p>
                                    <p class="mb-1"><?php echo e(__('Order Id')); ?> : <span
                                            class="pull-right text-primary">{order_id}</span></p>
                                    <p class="mb-1"><?php echo e(__('Order Date')); ?> : <span
                                            class="pull-right text-primary">{order_date}</span></p>
                                    <p class="mb-1"><?php echo e(__('Owner Name')); ?> : <span
                                            class="pull-right text-primary">{owner_name}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <?php echo e(Form::label('subject', __('Subject'), ['class' => 'col-form-label text-dark'])); ?>

                            <?php echo e(Form::text('subject', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                        </div>
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('from', __('From'), ['class' => 'col-form-label text-dark'])); ?>

                            <?php echo e(Form::text('from', $emailTemplate->from, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                        </div>


                        <div class="form-group col-12">
                            <?php echo e(Form::label('content', __('Email Message'), ['class' => 'col-form-label text-dark'])); ?>

                            <?php echo e(Form::textarea('content', $currEmailTempLang->content, ['class' => 'summernote-simple', 'required' => 'required'])); ?>

                        </div>


                        <div class="modal-footer">
                            <?php echo e(Form::hidden('lang', null)); ?>

                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                        </div>

                        <?php echo e(Form::close()); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/store/public_html/resources/views/email_templates/show.blade.php ENDPATH**/ ?>