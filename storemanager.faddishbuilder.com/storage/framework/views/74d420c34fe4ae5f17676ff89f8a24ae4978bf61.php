
<?php
    // $logo=asset(Storage::url('uploads/logo/'));
    $logo=\App\Models\Utility::get_file('uploads/logo/');
    $logo_img=\App\Models\Utility::getValByName('company_logo');
    $logo_light = \App\Models\Utility::getValByName('company_light_logo');
    // $logo_store = \App\Models\Utility::getValByName('logo');

    $invoice_store = \App\Models\Utility::getValByName('invoice_logo');
    // dd($invoice_store)
    $s_logo=\App\Models\Utility::get_file('uploads/store_logo/');
    $lang=\App\Models\Utility::getValByName('default_language');
     if(\Auth::user()->type=="Super Admin")
    {
        $company_logo=Utility::get_superadmin_logo();
    }
    else
    {
        $company_logo=Utility::get_company_logo();
    }
    $company_favicon=\App\Models\Utility::getValByName('company_favicon');
    $store_logo=\App\Models\Utility::getValByName('logo');
    $lang=\App\Models\Utility::getValByName('default_language');
    if(Auth::user()->type == 'Owner')
    {
        $store_lang=$store_settings->lang;
    }
    $setting = App\Models\Utility::settings();
    $SITE_RTL = $setting['SITE_RTL'];

    $file_type = config('files_types');
    $setting = App\Models\Utility::settings();

    $local_storage_validation    = $setting['local_storage_validation'];
    $local_storage_validations   = explode(',', $local_storage_validation);

    $s3_storage_validation    = $setting['s3_storage_validation'];
    $s3_storage_validations   = explode(',', $s3_storage_validation);

    $wasabi_storage_validation    = $setting['wasabi_storage_validation'];
    $wasabi_storage_validations   = explode(',', $wasabi_storage_validation);

?>
<?php
    $setting = App\Models\Utility::colorset();

     $color = 'theme-3';
    if (!empty($setting['color'])) {
        $color = $setting['color'];
    }
?>
<?php if($color == 'theme-3'): ?>
    <style>
    .btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary, .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #6fd943 !important;
            border-color: #6fd943 !important;

        }

        .btn-outline-primary:hover
        {
            color: #ffffff;
            background-color: #6fd943 !important;
            border-color: #6fd943 !important;
        }
        .btn.btn-outline-primary{
            color: #6fd943;
            border-color: #6fd943 !important;
        }
    </style>
<?php endif; ?>
<?php if($color == 'theme-2'): ?>
    <style>
        .btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary, .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
            border-color: #1F3996 !important;

        }

        .btn-outline-primary:hover
        {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
            border-color: #1F3996 !important;
        }
        .btn.btn-outline-primary{
            color: #1F3996;
            border-color: #1F3996 !important;
        }
        </style>
<?php endif; ?>
<?php if($color == 'theme-4'): ?>
    <style>
        .btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary, .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #584ed2 !important;
            border-color: #584ed2 !important;

        }

        .btn-outline-primary:hover
        {
            color: #ffffff;
            background-color: #584ed2 !important;
            border-color: #584ed2 !important;
        }
        .btn.btn-outline-primary{
            color: #584ed2;
            border-color: #584ed2 !important;
        }
    </style>
<?php endif; ?>
<?php if($color == 'theme-1'): ?>
    <style>
        .btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary, .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
            border-color: #51459d !important;

        }

        .btn-outline-primary:hover
        {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
            border-color: #51459d !important;
        }
        .btn.btn-outline-primary{
            color: #51459d;
            border-color: #51459d !important;
        }
    </style>
<?php endif; ?>
<?php $__env->startSection('page-title'); ?>
    <?php if(Auth::user()->type == 'super admin'): ?>
        <?php echo e(__('Setting')); ?>

    <?php else: ?>
        <?php echo e(__('Store Setting')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>

        <?php if(Auth::user()->type == 'super admin'): ?>

            <?php echo e(__('Setting')); ?>

        <?php else: ?>
            <?php echo e(__('Store Setting')); ?>

        <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php if(Auth::user()->type == 'super admin'): ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Setting')); ?></li>

        <?php else: ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Store Setting')); ?></li>

        <?php endif; ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
    <style>
        hr {
            margin: 8px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>

    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
    <script type="text/javascript">
        $(document).on("click", '.send_email', function(e)
        {
        e.preventDefault();
        var title = $(this).attr('data-title');
        var size = 'md';
        var url = $(this).attr('data-url');
        console.log(url);
        if (typeof url != 'undefined') {
            $("#commonModal .modal-title").html(title);
            $("#commonModal .modal-dialog").addClass('modal-' + size);
            $("#commonModal").modal('show');

            $.post(url, {
                _token:'<?php echo e(csrf_token()); ?>',
                mail_driver: $("#mail_driver").val(),
                mail_host: $("#mail_host").val(),
                mail_port: $("#mail_port").val(),
                mail_username: $("#mail_username").val(),
                mail_password: $("#mail_password").val(),
                mail_encryption: $("#mail_encryption").val(),
                mail_from_address: $("#mail_from_address").val(),
                mail_from_name: $("#mail_from_name").val(),

            }, function(data) {
                    $('#commonModal .body').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function(e) {
                e.preventDefault();
                $("#email_sending").show();
                var post = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    type: "post",
                    url: url,
                    data: post,
                    cache: false,
                    beforeSend: function() {
                        $('#test_email .btn-create').attr('disabled', 'disabled');
                    },
                    success: function(data) {

                        if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('Error', data.message, 'error');
                    }
                        $("#email_sending").hide();
                        $('#commonModal').modal('hide');

                    },
                    complete: function() {
                        $('#test_email .btn-create').removeAttr('disabled');
                    },
                });
            });
    </script>
   <!--  <script>
        // start for tab selection
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // save current clicked tab in local storage does not work in Stacksnippets
            localStorage.setItem('lastActiveTab', $(this).attr('href'));
        });
        //get last active tab from local storage
        var lastTab = localStorage.getItem('lastActiveTab');
        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }
        //end for tab selection
    </script> -->
    <script type="text/javascript">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('On-Off Email Template')): ?>
        $(document).on("click", ".email-template-checkbox", function () {
            var chbox = $(this);
            $.ajax({
                url: chbox.attr('data-url'),
                data: {_token: $('meta[name="csrf-token"]').attr('content'), status: chbox.val()},
                type: 'PUT',
                success: function (response) {
                    if (response.is_success) {
                        show_toastr('Success', response.success, 'success');
                        if (chbox.val() == 1) {
                            $('#' + chbox.attr('id')).val(0);
                        } else {
                            $('#' + chbox.attr('id')).val(1);
                        }
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('Error', response.error, 'error');
                    } else {
                        show_toastr('Error', response, 'error');
                    }
                }
            })
        });
        <?php endif; ?>
    </script>
    <script>
       var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300,

    })
   $(".list-group-item").click(function(){
          $('.list-group-item').filter(function(){
                return this.href == id;
        }).parent().removeClass('text-primary');
    });

   function check_theme(color_val) {
        $('#theme_color').prop('checked', false);
        $('input[value="'+color_val+'"]').prop('checked', true);
    }
</script>
<script>
        $(document).ready(function () {
            if ($('.gdpr_fulltime').is(':checked') ) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

            $('#gdpr_cookie').on('change', function() {
                if ($('.gdpr_fulltime').is(':checked') ) {

                    $('.fulltime').show();
                } else {

                    $('.fulltime').hide();
                }
            });
        });

    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function(){
            $('.list-group-item').filter(function(){
                return this.href == id;
            }).parent().removeClass('text-primary');
        });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }

        $(document).on('change','[name=storage_setting]',function(){
            if($(this).val() == 's3'){
                $('.s3-setting').removeClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').addClass('d-none');
            }else if($(this).val() == 'wasabi'){
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').removeClass('d-none');
                $('.local-setting').addClass('d-none');
            }else{
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').removeClass('d-none');
            }
        });
    </script>
    <script>
         var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button1', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button2', {
                removeItemButton: true,
            }
        );
    </script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row ">

        <div class="col-sm-12">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card sticky-top" style="top:30px">
                            <div class="list-group list-group-flush" id="useradd-sidenav">
                                <?php if(Auth::user()->type == 'Owner'): ?>
                                    <a href="#store_setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Store Settings')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                    

                                     

                                     <a href="#store_payment-setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Payment Setting')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                     <a href="#store_email_setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Mail Setting')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                    <a href="#whatsapp_custom_massage" class="list-group-item list-group-item-action border-0"><?php echo e(__('WhatsApp Mail Setting')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                    <a href="#twilio_setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Twilio Payment')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <?php endif; ?>

                                <?php if(Auth::user()->type == 'super admin'): ?>
                                    <a href="#site_setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Site Setting')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                    <a href="#payment-setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Payment Setting')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                    <a href="#email_setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Setting')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                    <a href="#recaptcha-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('ReCaptcha Setting')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                    <a href="#useradd-13" class="list-group-item list-group-item-action border-0"><?php echo e(__('Storage Setting')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                       <?php if(Auth::user()->type == 'Owner'): ?>
                            <div class="active" id="store_setting">
                                
                                 <?php echo e(Form::model($store_settings,array('route'=>array('settings.store',$store_settings['id']),'method'=>'POST','enctype' => "multipart/form-data"))); ?>

                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><?php echo e(__('Store Settings')); ?></h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class=" setting-card">
                                                    <div class="row mt-2">
                                                        <div class="col-lg-6 col-sm-6 col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5><?php echo e(__('Invoice Logo')); ?></h5>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <div class=" setting-card">
                                                                        <div class="logo-content mt-4">
                                                                            
                                                                            <a href="<?php echo e($s_logo.(isset($store_settings['invoice_logo']) && !empty($store_settings['invoice_logo'])? $store_settings['invoice_logo']:'invoice_logo.png')); ?>" target="_blank">
                                                                                <img id="invoiceOwner" alt="your image" src="<?php echo e($s_logo.(isset($store_settings['invoice_logo']) && !empty($store_settings['invoice_logo'])? $store_settings['invoice_logo']:'invoice_logo.png')); ?>" width="150px" class="big-logo">
                                                                            </a>
                                                                        </div>
                                                                        <div class="choose-files mt-5">
                                                                            <label for="invoice_logo">
                                                                                <div class=" bg-primary  m-auto"> <i
                                                                                        class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                                </div>
                                                                                <input type="file" name="invoice_logo" id="invoice_logo"
                                                                                    class="form-control file" data-filename="invoice_logo_update" onchange="document.getElementById('invoiceOwner').src = window.URL.createObjectURL(this.files[0])">
                                                                            </label>
                                                                        </div>
                                                                        <?php $__errorArgs = ['invoice_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <div class="row">
                                                                                <span class="invalid-invoice_logo" role="alert">
                                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            </div>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-sm-6 col-md-6">

                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <?php echo e(Form::label('store_name', __('Store Name'), ['class' => 'col-col-form-label'])); ?>

                                                            <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Store Name')]); ?>

                                                            <?php $__errorArgs = ['store_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-store_name" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <?php echo e(Form::label('email', __('Email'), ['class' => 'col-col-form-label'])); ?>

                                                            <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Email')])); ?>

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
                                                        <div class="form-group col-md-4">
                                                            <?php echo e(Form::label('address', __('Address'), ['class' => 'col-form-label'])); ?>

                                                            <?php echo e(Form::text('address', null, ['class' => 'form-control', 'placeholder' => __('Address')])); ?>

                                                            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-address" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <?php echo e(Form::label('city', __('City'), ['class' => 'col-form-label'])); ?>

                                                            <?php echo e(Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('City')])); ?>

                                                            <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-city" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <?php echo e(Form::label('state', __('State'), ['class' => 'col-form-label'])); ?>

                                                            <?php echo e(Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('State')])); ?>

                                                            <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-state" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <?php echo e(Form::label('zipcode', __('Zipcode'), ['class' => 'col-form-label'])); ?>

                                                            <?php echo e(Form::text('zipcode', null, ['class' => 'form-control', 'placeholder' => __('Zipcode')])); ?>

                                                            <?php $__errorArgs = ['zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-zipcode" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <?php echo e(Form::label('country', __('Country'), ['class' => 'col-form-label'])); ?>

                                                            <?php echo e(Form::text('country', null, ['class' => 'form-control', 'placeholder' => __('Country')])); ?>

                                                            <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-country" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <?php echo e(Form::label('store_default_language', __('Store Default Language'), ['class' => 'col-form-label'])); ?>

                                                            <div class="changeLanguage">
                                                                <select name="store_default_language"
                                                                    id="store_default_language"
                                                                    class="form-control" data-toggle="select">
                                                                    <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option
                                                                            <?php if($store_lang == $language): ?> selected <?php endif; ?>
                                                                            value="<?php echo e($language); ?>">
                                                                            <?php echo e(Str::upper($language)); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <?php echo e(Form::label('decimal_number_format', __('Decimal Number Format'), ['class' => 'col-form-label'])); ?>

                                                            <?php echo e(Form::number('decimal_number',isset($store_settings['decimal_number']) ? $store_settings['decimal_number'] : 2,['class' => 'form-control', 'placeholder' => __('decimal_number')])); ?>

                                                            <?php $__errorArgs = ['decimal_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-decimal_number" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                        <?php if($plan->shipping_method == 'on'): ?>
                                                            <div class="form-group col-md-3 mt-3">
                                                                <label class="form-check-label" for="enable_shipping"></label>
                                                                <div class="custom-control form-switch">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="enable_shipping" id="enable_shipping"
                                                                        <?php echo e($store_settings['enable_shipping'] == 'on' ? 'checked=checked' : ''); ?>>
                                                                    <?php echo e(Form::label('enable_shipping', __('Shipping Method Enable'), ['class' => 'form-check-label mb-3'])); ?>

                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="form-group col-md-3 mt-3">
                                                            <label class="form-check-label" for="is_checkout_login_required"></label>
                                                            <div class="custom-control form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="is_checkout_login_required" id="is_checkout_login_required"
                                                                    <?php if($store_settings['is_checkout_login_required'] == null): ?>
                                                                        <?php if($settings['is_checkout_login_required'] == 'on'): ?>
                                                                            <?php echo e('checked=checked'); ?>

                                                                        <?php endif; ?>
                                                                    <?php elseif($store_settings['is_checkout_login_required'] == 'on'): ?>
                                                                        <?php echo e('checked=checked'); ?>

                                                                    <?php else: ?>
                                                                        <?php echo e(''); ?>

                                                                    <?php endif; ?>
                                                                    
                                                                    >
                                                                <?php echo e(Form::label('is_checkout_login_required', __('Is Checkout Login Required'), ['class' => 'form-check-label mb-3'])); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 text-end">
                                                <div class="col-lg-12  text-end">
                                                    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-xs btn-primary">
                                                </div>
                                                <?php echo e(Form::close()); ?>

                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['ownerstore.destroy', $store_settings->id],'id'=>'delete-form-'.$store_settings->id]); ?>


                                                       <button type="button"
                                                            class="btn bs-pass-para btn-secondary btn-light show_confirm my-3 px-4">
                                                            <span
                                                                class="text-black"><?php echo e(__('Delete Store')); ?></span>
                                                        </button>
                                                <?php echo Form::close(); ?>



                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="store_payment-setting" class="card">

                                <div class="card-header">
                                    <h5><?php echo e(__('Payment Setting')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <?php echo e(Form::open(array('route'=>array('owner.payment.setting',$store_settings->slug),'method'=>'post'))); ?>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('currency',__('Currency *'),array("class"=>"  col-form-label"))); ?>

                                                    <?php echo e(Form::text('currency',$store_settings['currency_code'],array('class'=>'form-control font-style','required'))); ?>

                                                    <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?>

                                                    <small>
                                                        <a href="https://stripe.com/docs/currencies" target="_blank"><?php echo e(__('you can find out here..')); ?></a>
                                                    </small>
                                                    <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-currency" role="alert">
                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('currency_symbol',__('Currency Symbol *'),array("class"=>"col-form-label"))); ?>

                                                    <?php echo e(Form::text('currency_symbol',$store_settings['currency'],array('class'=>'form-control','required'))); ?>

                                                    <?php $__errorArgs = ['currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-currency_symbol" role="alert">
                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                    </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline mb-3   ">
                                                                <input type="radio" id="customRadio5" name="currency_symbol_position" value="pre" class="form-check-input" <?php if(@$store_settings['currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?>>
                                                                <label class="form-check-label" for="customRadio5"><?php echo e(__('Pre')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline mb-3">
                                                                <input type="radio" id="customRadio6" name="currency_symbol_position" value="post" class="form-check-input" <?php if(@$store_settings['currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>>
                                                                <label class="form-check-label" for="customRadio6"><?php echo e(__('Post')); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="example3cols3Input"><?php echo e(__('Currency Symbol Space')); ?></label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline mb-3">
                                                                <input type="radio" id="customRadio7" name="currency_symbol_space" value="with" class="form-check-input" <?php if(@$store_settings['currency_symbol_space'] == 'with'): ?> checked <?php endif; ?>>
                                                                <label class="form-check-label" for="customRadio7"><?php echo e(__('With Space')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline mb-3">
                                                                <input type="radio" id="customRadio8" name="currency_symbol_space" value="without" class="form-check-input" <?php if(@$store_settings['currency_symbol_space'] == 'without'): ?> checked <?php endif; ?>>
                                                                <label class="form-check-label" for="customRadio8"><?php echo e(__('Without Space')); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6><?php echo e(__('Custom Field For Checkout')); ?></h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('custom_field_title_1',__('Custom Field Title'),array("class"=>"col-form-label"))); ?>

                                                    <?php echo e(Form::text('custom_field_title_1',!empty($store_settings['custom_field_title_1'])?$store_settings['custom_field_title_1']:'',array('class'=>'form-control','placeholder'=>__('Enter Custom Field Title')))); ?>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('custom_field_title_2',__('Custom Field Title'),array("class"=>"col-form-label"))); ?>

                                                    <?php echo e(Form::text('custom_field_title_2',!empty($store_settings['custom_field_title_2'])?$store_settings['custom_field_title_2']:'',array('class'=>'form-control','placeholder'=>__('Enter Custom Field Title')))); ?>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('custom_field_title_3',__('Custom Field Title'),array("class"=>"col-form-label"))); ?>

                                                    <?php echo e(Form::text('custom_field_title_3',!empty($store_settings['custom_field_title_3'])?$store_settings['custom_field_title_3']:'',array('class'=>'form-control','placeholder'=>__('Enter Custom Field Title')))); ?>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('custom_field_title_4',__('Custom Field Title'),array("class"=>"col-form-label"))); ?>

                                                    <?php echo e(Form::text('custom_field_title_4',!empty($store_settings['custom_field_title_4'])?$store_settings['custom_field_title_4']:'',array('class'=>'form-control','placeholder'=>__('Enter Custom Field Title')))); ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="faq justify-content-center">
                                            <div class="col-sm-12 col-md-10 col-xxl-12">
                                                <div class="accordion accordion-flush" id="accordionExample">

                                                    <!-- Strip -->
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-2">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Telegram')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse1" class="accordion-collapse collapse"aria-labelledby="heading-2-2"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('Telegram')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>
                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="enable_telegram" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="enable_telegram" id="enable_telegram" <?php echo e($store_settings['enable_telegram'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="enable_telegram"><?php echo e(__('Enable Telegram')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('telegrambot',__('Telegram Access Token'),array('class'=>'col-col-form-label'))); ?>

                                                                            <?php echo e(Form::text('telegrambot',$store_settings['telegrambot'],array('class'=>'form-control active telegrambot','placeholder'=>'1234567890:AAbbbbccccddddxvGENZCi8Hd4B15M8xHV0'))); ?>

                                                                            <p><?php echo e(__('Get Chat ID')); ?> : https://api.telegram.org/bot-TOKEN-/getUpdates</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('telegramchatid',__('Telegram Chat Id'),array('class'=>'col-col-form-label'))); ?>

                                                                            <?php echo e(Form::text('telegramchatid',$store_settings['telegramchatid'],array('class'=>'form-control active telegramchatid','placeholder'=>'123456789'))); ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-3">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Whatsapp')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse2" class="accordion-collapse collapse"aria-labelledby="heading-2-3"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Whatsapp')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch form-switch-right mb-2">
                                                                        <input type="hidden" name="enable_whatsapp" value="off">
                                                                        <input type="checkbox" class="form-check-input mx-2" name="enable_whatsapp" id="enable_whatsapp" <?php echo e($store_settings['enable_whatsapp'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="form-check-label" for="enable_whatsapp"><?php echo e(__('Enable WhatsApp')); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control input-mask" data-mask="+00 00000000000"  value="<?php echo e($store_settings['whatsapp_number']); ?>" placeholder="+00 00000000000"/>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-4">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Stripe')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse3" class="accordion-collapse collapse"aria-labelledby="heading-2-4"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('Stripe')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>
                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_stripe_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_stripe_enabled" id="is_stripe_enabled" <?php echo e(isset($store_payment_setting['is_stripe_enabled']) && $store_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_stripe_enabled"><?php echo e(__('Enable Stripe')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('stripe_key',__('Stripe Key'),array('class'=>'col-form-label'))); ?>

                                                                            <?php echo e(Form::text('stripe_key',isset($store_payment_setting['stripe_key'])?$store_payment_setting['stripe_key']:'',['class'=>'form-control','placeholder'=>__('Enter Stripe Key')])); ?>

                                                                            <?php $__errorArgs = ['stripe_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-stripe_key" role="alert">
                                                                                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                                                             </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('stripe_secret',__('Stripe Secret'),array('class'=>'col-form-label'))); ?>

                                                                            <?php echo e(Form::text('stripe_secret',isset($store_payment_setting['stripe_secret'])?$store_payment_setting['stripe_secret']:'',['class'=>'form-control ','placeholder'=>__('Enter Stripe Secret')])); ?>

                                                                            <?php $__errorArgs = ['stripe_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-stripe_secret" role="alert">
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

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-5">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('PayPal')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse4" class="accordion-collapse collapse"aria-labelledby="heading-2-5"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('PayPal')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>

                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_paypal_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_paypal_enabled" id="is_paypal_enabled" <?php echo e(isset($store_payment_setting['is_paypal_enabled']) && $store_payment_setting['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_paypal_enabled"><?php echo e(__('Enable Paypal')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="paypal-label col-form-label" for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label> <br>
                                                                        <div class="d-flex">
                                                                            <div class="mr-2" style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="paypal_mode" value="sandbox" class="form-check-input" <?php echo e(!isset($store_payment_setting['paypal_mode']) || $store_payment_setting['paypal_mode'] == '' || $store_payment_setting['paypal_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Sandbox')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="paypal_mode" value="live" class="form-check-input" <?php echo e(isset($store_payment_setting['paypal_mode']) && $store_payment_setting['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Live')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Client ID')); ?></label>
                                                                            <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="<?php echo e(isset($store_payment_setting['paypal_client_id'])?$store_payment_setting['paypal_client_id']:''); ?>" placeholder="<?php echo e(__('Client ID')); ?>"/>
                                                                            <?php if($errors->has('paypal_client_id')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('paypal_client_id')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_secret_key"class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                            <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="<?php echo e(isset($store_payment_setting['paypal_secret_key'])?$store_payment_setting['paypal_secret_key']:''); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                                                            <?php if($errors->has('paypal_secret_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('paypal_secret_key')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-6">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paystack')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse5" class="accordion-collapse collapse"aria-labelledby="heading-2-6"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('Paystack')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>
                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_paystack_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_paystack_enabled" id="is_paystack_enabled" <?php echo e(isset($store_payment_setting['is_paystack_enabled']) && $store_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_paystack_enabled"><?php echo e(__('Enable Paystack')); ?></label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                            <input type="text" name="paystack_public_key" id="paystack_public_key" class="form-control" value="<?php echo e(isset($store_payment_setting['paystack_public_key']) ? $store_payment_setting['paystack_public_key']:''); ?>" placeholder="<?php echo e(__('Public Key')); ?>"/>
                                                                            <?php if($errors->has('paystack_public_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('paystack_public_key')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                            <input type="text" name="paystack_secret_key" id="paystack_secret_key" class="form-control" value="<?php echo e(isset($store_payment_setting['paystack_secret_key']) ? $store_payment_setting['paystack_secret_key']:''); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                                                            <?php if($errors->has('paystack_secret_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('paystack_secret_key')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-7">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Flutterwave')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse6" class="accordion-collapse collapse"aria-labelledby="heading-2-7"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('Flutterwave')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>
                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_flutterwave_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_flutterwave_enabled" id="is_flutterwave_enabled" <?php echo e(isset($store_payment_setting['is_flutterwave_enabled']) && $store_payment_setting['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_flutterwave_enabled"><?php echo e(__('Enable Flutterwave')); ?></label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                            <input type="text" name="flutterwave_public_key" id="flutterwave_public_key" class="form-control" value="<?php echo e(isset($store_payment_setting['flutterwave_public_key'])?$store_payment_setting['flutterwave_public_key']:''); ?>" placeholder="<?php echo e(__('Public Key')); ?>"/>
                                                                            <?php if($errors->has('flutterwave_public_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('flutterwave_public_key')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                            <input type="text" name="flutterwave_secret_key" id="flutterwave_secret_key" class="form-control" value="<?php echo e(isset($store_payment_setting['flutterwave_secret_key'])?$store_payment_setting['flutterwave_secret_key']:''); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                                                            <?php if($errors->has('flutterwave_secret_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('flutterwave_secret_key')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-8">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Razorpay')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse7" class="accordion-collapse collapse"aria-labelledby="heading-2-8"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('Razorpay')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>
                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_razorpay_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_razorpay_enabled" id="is_razorpay_enabled" <?php echo e(isset($store_payment_setting['is_razorpay_enabled']) && $store_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_razorpay_enabled"><?php echo e(__('Enable Razorpay')); ?></label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>

                                                                            <input type="text" name="razorpay_public_key" id="razorpay_public_key" class="form-control" value="<?php echo e(isset($store_payment_setting['razorpay_public_key'])?$store_payment_setting['razorpay_public_key']:''); ?>" placeholder="<?php echo e(__('Public Key')); ?>"/>
                                                                            <?php if($errors->has('razorpay_public_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('razorpay_public_key')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                            <input type="text" name="razorpay_secret_key" id="razorpay_secret_key" class="form-control" value="<?php echo e(isset($store_payment_setting['razorpay_secret_key'])?$store_payment_setting['razorpay_secret_key']:''); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                                                            <?php if($errors->has('razorpay_secret_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('razorpay_secret_key')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-9">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Mercado Pago')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse8" class="accordion-collapse collapse"aria-labelledby="heading-2-9"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('Mercado Pago')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of plan.')); ?></small>
                                                                    </div>

                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_mercado_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_mercado_enabled" id="is_mercado_enabled" <?php echo e(isset($store_payment_setting['is_mercado_enabled']) && $store_payment_setting['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_mercado_enabled"><?php echo e(__('Enable Mercado Pago')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="coingate-label col-form-label" for="mercado_mode"><?php echo e(__('Mercado Mode')); ?></label> <br>
                                                                        <div class="d-flex">
                                                                            <div class="mr-2" style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="mercado_mode" value="sandbox" class="form-check-input" <?php echo e(isset($store_payment_setting['mercado_mode']) && $store_payment_setting['mercado_mode'] == '' || isset($store_payment_setting['mercado_mode']) && $store_payment_setting['mercado_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Sandbox')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="mercado_mode" value="live" class="form-check-input" <?php echo e(isset($store_payment_setting['mercado_mode']) && $store_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Live')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mercado_access_token" class="col-form-label"><?php echo e(__('Access Token')); ?></label>
                                                                            <input type="text" name="mercado_access_token" id="mercado_access_token" class="form-control" value="<?php echo e(isset($store_payment_setting['mercado_access_token']) ? $store_payment_setting['mercado_access_token']:''); ?>" placeholder="<?php echo e(__('Access Token')); ?>"/>
                                                                            <?php if($errors->has('mercado_secret_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('mercado_access_token')); ?>

                                                                        </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-10">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paytm')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse9" class="accordion-collapse collapse"aria-labelledby="heading-2-10"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('Paytm')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>
                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_paytm_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_paytm_enabled" id="is_paytm_enabled" <?php echo e(isset($store_payment_setting['is_paytm_enabled']) && $store_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_paytm_enabled"><?php echo e(__('Enable Paypal')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="paypal-label col-form-label" for="paypal_mode"><?php echo e(__('Paytm Environment')); ?></label> <br>

                                                                        <div class="d-flex">
                                                                            <div class="mr-2" style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="paytm_mode" value="local" class="form-check-input" <?php echo e(isset($store_payment_setting['paytm_mode']) && $store_payment_setting['paytm_mode'] == '' || isset($admin_payment_setting['paytm_mode']) && $store_payment_setting['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Local')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="paytm_mode" value="production" class="form-check-input" <?php echo e(isset($store_payment_setting['paytm_mode']) && $store_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Production')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="paytm_public_key" class="col-form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                                            <input type="text" name="paytm_merchant_id" id="paytm_merchant_id" class="form-control" value="<?php echo e(isset($store_payment_setting['paytm_merchant_id'])? $store_payment_setting['paytm_merchant_id']:''); ?>" placeholder="<?php echo e(__('Merchant ID')); ?>"/>
                                                                            <?php if($errors->has('paytm_merchant_id')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paytm_merchant_id')); ?>

                                                                        </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="paytm_secret_key" class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                            <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" class="form-control" value="<?php echo e(isset($store_payment_setting['paytm_merchant_key']) ? $store_payment_setting['paytm_merchant_key']:''); ?>" placeholder="<?php echo e(__('Merchant Key')); ?>"/>
                                                                            <?php if($errors->has('paytm_merchant_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paytm_merchant_key')); ?>

                                                                        </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="paytm_industry_type" class="col-form-label"><?php echo e(__('Industry Type')); ?></label>
                                                                            <input type="text" name="paytm_industry_type" id="paytm_industry_type" class="form-control" value="<?php echo e(isset($store_payment_setting['paytm_industry_type']) ?$store_payment_setting['paytm_industry_type']:''); ?>" placeholder="<?php echo e(__('Industry Type')); ?>"/>
                                                                            <?php if($errors->has('paytm_industry_type')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paytm_industry_type')); ?>

                                                                        </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-11">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Mollie')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse10" class="accordion-collapse collapse"aria-labelledby="heading-2-11"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('Mollie')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>
                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_mollie_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_mollie_enabled" id="is_mollie_enabled" <?php echo e(isset($store_payment_setting['is_mollie_enabled']) && $store_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_mollie_enabled"><?php echo e(__('Enable Mollie')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mollie_api_key" class="col-form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                                            <input type="text" name="mollie_api_key" id="mollie_api_key" class="form-control" value="<?php echo e(isset($store_payment_setting['mollie_api_key'])?$store_payment_setting['mollie_api_key']:''); ?>" placeholder="<?php echo e(__('Mollie Api Key')); ?>"/>
                                                                            <?php if($errors->has('mollie_api_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('mollie_api_key')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mollie_profile_id" class="col-form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                                                            <input type="text" name="mollie_profile_id" id="mollie_profile_id" class="form-control" value="<?php echo e(isset($store_payment_setting['mollie_profile_id'])?$store_payment_setting['mollie_profile_id']:''); ?>" placeholder="<?php echo e(__('Mollie Profile Id')); ?>"/>
                                                                            <?php if($errors->has('mollie_profile_id')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('mollie_profile_id')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mollie_partner_id" class="col-form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                                                            <input type="text" name="mollie_partner_id" id="mollie_partner_id" class="form-control" value="<?php echo e(isset($store_payment_setting['mollie_partner_id'])?$store_payment_setting['mollie_partner_id']:''); ?>" placeholder="<?php echo e(__('Mollie Partner Id')); ?>"/>
                                                                            <?php if($errors->has('mollie_partner_id')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('mollie_partner_id')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-12">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Skrill')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse11" class="accordion-collapse collapse"aria-labelledby="heading-2-12"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('Skrill')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>
                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_skrill_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_skrill_enabled" id="is_skrill_enabled" <?php echo e(isset($store_payment_setting['is_skrill_enabled']) && $store_payment_setting['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_skrill_enabled"><?php echo e(__('Enable Skrill')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mollie_api_key" class="col-form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                                            <input type="email" name="skrill_email" id="skrill_email" class="form-control" value="<?php echo e(isset($store_payment_setting['skrill_email'])?$store_payment_setting['skrill_email']:''); ?>" placeholder="<?php echo e(__('Mollie Api Key')); ?>"/>
                                                                            <?php if($errors->has('skrill_email')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('skrill_email')); ?>

                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-13">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="true" aria-controls="collapse12">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('CoinGate')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse12" class="accordion-collapse collapse"aria-labelledby="heading-2-13"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                        <h5 class="h5"><?php echo e(__('CoinGate')); ?></h5>
                                                                        <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                    </div>
                                                                    <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_coingate_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_coingate_enabled" id="is_coingate_enabled" <?php echo e(isset($store_payment_setting['is_coingate_enabled']) && $store_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_coingate_enabled"><?php echo e(__('Enable CoinGate')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="coingate-label col-form-label" for="coingate_mode"><?php echo e(__('CoinGate Mode')); ?></label> <br>

                                                                        <div class="d-flex">
                                                                            <div class="mr-2" style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="coingate_mode" value="sandbox" class="form-check-input" <?php echo e(isset($store_payment_setting['coingate_mode']) && $store_payment_setting['coingate_mode'] == '' || isset($store_payment_setting['coingate_mode']) && $store_payment_setting['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Sandbox')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="coingate_mode" value="live" class="form-check-input" <?php echo e(isset($store_payment_setting['coingate_mode']) && $store_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Live')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="coingate_auth_token" class="col-form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                                                                            <input type="text" name="coingate_auth_token" id="coingate_auth_token" class="form-control" value="<?php echo e(isset($store_payment_setting['coingate_auth_token'])?$store_payment_setting['coingate_auth_token']:''); ?>" placeholder="<?php echo e(__('CoinGate Auth Token')); ?>"/>
                                                                            <?php if($errors->has('coingate_auth_token')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('coingate_auth_token')); ?>

                                                                        </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-14">
                                                            <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="true" aria-controls="collapse13">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paymentwall')); ?>

                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse13" class="accordion-collapse collapse"aria-labelledby="heading-2-14"data-bs-parent="#accordionExample" >
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-6 py-2">
                                                                            <h5 class="h5"><?php echo e(__('Paymentwall')); ?></h5>
                                                                        </div>
                                                                        <div class="col-6 py-2 text-end">
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_paymentwall_enabled" value="off">
                                                                            <input type="checkbox" class="form-check-input mx-2" name="is_paymentwall_enabled" id="is_paymentwall_enabled" <?php echo e(isset($store_payment_setting['is_paymentwall_enabled']) && $store_payment_setting['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                            <label class="form-check-label" for="is_paymentwall_enabled"><?php echo e(__('Enable PaymentWall')); ?></label>
                                                                        </div>
                                                                    </div>
                                                                        <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paymentwall_public_key" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                            <input type="text" name="paymentwall_public_key" id="paymentwall_public_key" class="form-control" value="<?php echo e(isset($store_payment_setting['paymentwall_public_key'])?$store_payment_setting['paymentwall_public_key']:''); ?>" placeholder="<?php echo e(__('Public Key')); ?>"/>
                                                                            <?php if($errors->has('paymentwall_public_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('paymentwall_public_key')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paymentwall_private_key" class="col-form-label"><?php echo e(__('Private Key')); ?></label>
                                                                            <input type="text" name="paymentwall_private_key" id="paymentwall_private_key" class="form-control col-form-label" value="<?php echo e(isset($store_payment_setting['paymentwall_private_key'])?$store_payment_setting['paymentwall_private_key']:''); ?>" placeholder="<?php echo e(__('Private Key')); ?>"/>
                                                                            <?php if($errors->has('paymentwall_private_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('paymentwall_private_key')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer ">
                                            <div class="col-sm-12">
                                                <div class="text-end">
                                                    <?php echo e(Form::submit(__('Save Changes'),array('class'=>'btn btn-xs btn-primary'))); ?>

                                                </div>
                                            </div>
                                        </div>

                                        <?php echo e(Form::close()); ?>

                                </div>

                            </div>

                            <div id="store_email_setting" class="card">

                                <div class="card-header">
                                    <h5><?php echo e(__('Mail Setting')); ?></h5>
                                </div>
                                 <?php echo e(Form::open(array('route'=>array('owner.email.setting',$store_settings->slug),'method'=>'post'))); ?>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_from_address',__('Mail From Address'))); ?>

                                            <?php echo e(Form::text('mail_from_address',$store_settings->mail_from_address,array('class'=>'form-control','placeholder'=>__('Enter Mail From Address')))); ?>

                                            <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_address" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_from_name',__('Mail From Name'))); ?>

                                            <?php echo e(Form::text('mail_from_name',$store_settings->mail_from_name,array('class'=>'form-control','placeholder'=>__('Enter Mail From Name')))); ?>

                                            <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_name" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="form-group col-md-12 text-end float-right">
                                            <?php echo e(Form::submit(__('Save Changes'),array('class'=>'btn btn-xs btn-primary'))); ?>

                                        </div>
                                    </div>
                                </div>
                                 <?php echo e(Form::close()); ?>

                            </div>

                            <div id="whatsapp_custom_massage" class="card">

                                <div class="card-header">
                                    <h5><?php echo e(__('WhatsApp Mail Setting')); ?></h5>
                                </div>
                                <?php echo e(Form::model($store_settings, array('route' => array('customMassage',$store_settings->slug), 'method' => 'POST'))); ?>

                                <div class="card-body">
                                    <div class="row text-xs">
                                        <div class="col-6">
                                            <h6 class="font-weight-bold"><?php echo e(__('Order Variable')); ?></h6>
                                            <div class="col-6 float-left">
                                                <p class="mb-1"><?php echo e(__('Store Name')); ?> : <span class="pull-right text-primary">{store_name}</span></p>
                                                <p class="mb-1"><?php echo e(__('Order No')); ?> : <span class="pull-right text-primary">{order_no}</span></p>
                                                <p class="mb-1"><?php echo e(__('Customer Name')); ?> : <span class="pull-right text-primary">{customer_name}</span></p>
                                                <p class="mb-1"><?php echo e(__('Phone')); ?> : <span class="pull-right text-primary">{phone}</span></p>
                                                <p class="mb-1"><?php echo e(__('Billing Address')); ?> : <span class="pull-right text-primary">{billing_address}</span></p>
                                                <p class="mb-1"><?php echo e(__('Shipping Address')); ?> : <span class="pull-right text-primary">{shipping_address}</span></p>
                                                <p class="mb-1"><?php echo e(__('Special Instruct')); ?> : <span class="pull-right text-primary">{special_instruct}</span></p>
                                            </div>
                                            <p class="mb-1"><?php echo e(__('Item Variable')); ?> : <span class="pull-right text-primary">{item_variable}</span></p>
                                            <p class="mb-1"><?php echo e(__('Qty Total')); ?> : <span class="pull-right text-primary">{qty_total}</span></p>
                                            <p class="mb-1"><?php echo e(__('Sub Total')); ?> : <span class="pull-right text-primary">{sub_total}</span></p>
                                            <p class="mb-1"><?php echo e(__('Discount Amount')); ?> : <span class="pull-right text-primary">{discount_amount}</span></p>
                                            <p class="mb-1"><?php echo e(__('Shipping Amount')); ?> : <span class="pull-right text-primary">{shipping_amount}</span></p>
                                            <p class="mb-1"><?php echo e(__('Total Tax')); ?> : <span class="pull-right text-primary">{total_tax}</span></p>
                                            <p class="mb-1"><?php echo e(__('Final Total')); ?> : <span class="pull-right text-primary">{final_total}</span></p>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="font-weight-bold"><?php echo e(__('Item Variable')); ?></h6>
                                            <p class="mb-1"><?php echo e(__('Sku')); ?> : <span class="pull-right text-primary">{sku}</span></p>
                                            <p class="mb-1"><?php echo e(__('Quantity')); ?> : <span class="pull-right text-primary">{quantity}</span></p>
                                            <p class="mb-1"><?php echo e(__('Product Name')); ?> : <span class="pull-right text-primary">{product_name}</span></p>
                                            <p class="mb-1"><?php echo e(__('Variant Name')); ?> : <span class="pull-right text-primary">{variant_name}</span></p>
                                            <p class="mb-1"><?php echo e(__('Item Tax')); ?> : <span class="pull-right text-primary">{item_tax}</span></p>
                                            <p class="mb-1"><?php echo e(__('Item total')); ?> : <span class="pull-right text-primary">{item_total}</span></p>
                                            <div class="form-group">
                                                <label for="storejs" class="col-form-label">{item_variable}</label>
                                                <?php echo e(Form::text('item_variable',null,array('class'=>'form-control','placeholder'=>"{quantity} x {product_name} - {variant_name} + {item_tax} = {item_total}"))); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 px-4 language-form-wrap">
                                    <!-- <div class="card">
                                        <div class="card-body"> -->
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <?php echo e(Form::label('content',__('Whatsapp Message'),['class'=>'col-form-label text-dark'])); ?>

                                                    <?php echo e(Form::textarea('content',null,array('class'=>'form-control','required'=>'required'))); ?>

                                                </div>
                                                <div class="col-md-12 text-right">
                                                    <div class="form-group col-md-12 text-end">
                                                        <?php echo e(Form::submit(__('Save Changes'),array('class'=>'btn btn-xs btn-primary'))); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                 <?php echo e(Form::close()); ?>

                            </div>

                            <div id="twilio_setting" class="card">
                                <form method="POST" action="<?php echo e(route('owner.twilio.setting',$store_settings->slug)); ?>" accept-charset="UTF-8">
                                    <?php echo csrf_field(); ?>
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5><?php echo e(__('Twilio Setting')); ?></h5>
                                                <small><?php echo e(__('This detail will use for enable twilio')); ?></small>
                                            </div>
                                            <div class="col-6 text-end">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="is_twilio_enabled" id="twilio_module" data-toggle="switchbutton" <?php echo e(($store_settings['is_twilio_enabled'] == 'on') ? 'checked=checked' : ''); ?> data-onstyle="primary">
                                                    <label class="form-check-labe" for="twilio_module"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">

                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                    <label for="twilio_token" class="col-form-label"><?php echo e(__('Twilio SID')); ?></label>
                                                    <input class="form-control" name="twilio_sid" type="text" value="<?php echo e($store_settings->twilio_sid); ?>" id="twilio_sid">
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                    <label for="twilio_token" class="col-form-label"><?php echo e(__('Twilio Token')); ?></label>
                                                    <input class="form-control "  name="twilio_token" type="text" value="<?php echo e($store_settings->twilio_token); ?>" id="twilio_token">
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                    <label for="twilio_from" class="col-form-label"><?php echo e(__('Twilio From')); ?></label>
                                                    <input class="form-control " name="twilio_from" type="text" value="<?php echo e($store_settings->twilio_from); ?>" id="twilio_from">
                                                </div>
                                                 <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                    <label for="notification_number" class="col-form-label"><?php echo e(__('Notification Number')); ?></label>
                                                    <input class="form-control " name="notification_number" type="text" value="<?php echo e($store_settings->notification_number); ?>" id="notification_number">
                                                     <small><?php echo e(__('* Use country code with your number *')); ?></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-12  text-end">
                                                <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-xs btn-primary">
                                            </div>

                                    </div>
                                </form>
                            </div>
                       <?php endif; ?>
                       <?php if(Auth::user()->type == 'super admin'): ?>
                            <div class="active card" id="site_setting">
                                <div class="card-header">
                                    <h5><?php echo e(__('Site Setting')); ?></h5>
                                </div>
                                <?php echo e(Form::model($settings,array('route'=>'business.setting','method'=>'POST','enctype' => "multipart/form-data"))); ?>

                                <div class="card-body">
                                    <div class="row">
                                         <div class="col-lg-4 col-sm-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5><?php echo e(__('Logo dark')); ?></h5>
                                                </div>
                                                <div class="card-body mt-3">
                                                    <div class=" setting-card">
                                                        <div class="logo-content mt-4">
                                                            
                                                            <a href="<?php echo e($logo.'logo-dark.png'); ?>" target="_blank">
                                                                <img id="adminlogoDark" alt="your image" src="<?php echo e($logo.'logo-dark.png'); ?>" width="150px" class="big-logo">
                                                            </a>
                                                        </div>
                                                        <div class="choose-files mt-5 ">
                                                            <label for="dark_logo">
                                                                <div class=" bg-primary  m-auto"> <i class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?></div>
                                                                <input type="file" class="form-control file" name="dark_logo" id="dark_logo" data-filename="darklogo_update" onchange="document.getElementById('adminlogoDark').src = window.URL.createObjectURL(this.files[0])">
                                                            </label>
                                                        </div>
                                                        <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="row">
                                                                <span class="invalid-logo" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5><?php echo e(__('Logo Light')); ?></h5>
                                                </div>
                                                <div class="card-body mt-3">
                                                    <div class=" setting-card">
                                                        <div class="logo-content mt-4">

                                                            
                                                            <a href="<?php echo e($logo.'logo-light.png'); ?>" target="_blank">
                                                                <img id="adminLogoLight" alt="your image" src="<?php echo e($logo.'logo-light.png'); ?>" width="150px" class="big-logo img_setting">
                                                            </a>
                                                        </div>
                                                        <div class="choose-files mt-5 ">
                                                            <label for="light_logo">
                                                                <div class=" bg-primary  m-auto"> <i class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?></div>
                                                                <input type="file" class="form-control file" name="light_logo" id="light_logo" data-filename="light_logo_update" onchange="document.getElementById('adminLogoLight').src = window.URL.createObjectURL(this.files[0])">
                                                            </label>
                                                        </div>
                                                        <?php $__errorArgs = ['logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="row">
                                                                <span class="invalid-logo" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5><?php echo e(__('Favicon')); ?></h5>
                                                </div>
                                                <div class="card-body admin_favicon pt-6">
                                                    <div class=" setting-card">
                                                        <div class="logo-content mt-4">
                                                            
                                                            <a href="<?php echo e($logo.(isset($logo) && !empty($logo)? $logo :'favicon.png')); ?>" target="_blank">
                                                                <img id="faviConLoGo" alt="your image" src="<?php echo e($logo.'favicon.png'); ?>" width="50px" class="img_setting">
                                                            </a>
                                                        </div>
                                                        <div class="choose-files mt-5">
                                                            <label for="favicon">
                                                                <div class=" bg-primary  m-auto"> <i
                                                                        class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                </div>
                                                                <input type="file" class="form-control file"  id="favicon" name="favicon"
                                                                    data-filename="favicon_update" onchange="document.getElementById('faviConLoGo').src = window.URL.createObjectURL(this.files[0])">
                                                            </label>
                                                        </div>
                                                        <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="row">
                                                                <span class="invalid-logo" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                                            </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('title_text',__('Title Text'),array('class' => 'col-form-label'))); ?>

                                            <?php echo e(Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))); ?>

                                            <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-title_text" role="alert">
                                             <strong class="text-danger"><?php echo e($message); ?></strong>
                                         </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_text',__('Footer Text'),array('class' => 'col-form-label'))); ?>

                                            <?php echo e(Form::text('footer_text',null,array('class'=>'form-control','placeholder'=>__('Footer Text')))); ?>

                                            <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_text" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                             </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('default_language',__('Default Language'),array('class' => 'col-form-label'))); ?>

                                            <div class="changeLanguage">
                                                <select name="default_language" id="default_language" class="form-control custom-select" data-toggle="select">
                                                    <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e($language); ?>"><?php echo e(Str::upper($language)); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <?php echo e(Form::label('currency_symbol',__('Currency Symbol *'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('currency_symbol',null,array('class'=>'form-control'))); ?>

                                                <small><?php echo e(__('Note: This value will assign when any new store created by Store Owner.')); ?></small>
                                                <?php $__errorArgs = ['currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-currency_symbol" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <?php echo e(Form::label('currency',__('Currency *'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('currency',null,array('class'=>'form-control font-style'))); ?>

                                                <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?>

                                                <small>
                                                    <a href="https://stripe.com/docs/currencies" target="_blank"><?php echo e(__('you can find out here..')); ?></a>
                                                </small>
                                                <br>
                                                <small>
                                                    <?php echo e(__('This value will assign when any new store created by Store Owner.')); ?>

                                                </small>

                                                <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-currency" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <?php echo e(Form::label('gdpr_cookie',__('GDPR Cookie'),array('class' => 'col-form-label'))); ?>


                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input gdpr_fulltime gdpr_type" name="gdpr_cookie" data-toggle="switchbutton" id="gdpr_cookie" <?php echo e(isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-labe" for="gdpr_cookie"></label>
                                                </div>
                                           </div>
                                        <div class="form-group col-md-3">
                                            <?php echo e(Form::label('display_landing_page_',__('Landing Page Display'),array('class' => 'col-form-label'))); ?>

                                            <div class="col-12 mt-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="display_landing_page" data-toggle="switchbutton" id="display_landing_page" <?php echo e($settings['display_landing_page'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-labe" for="display_landing_page"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <?php echo e(Form::label('SITE_RTL',__('RTL'),array('class' => 'col-form-label'))); ?>

                                            <div class="col-12 mt-2">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton" class="custom-control-input" name="SITE_RTL" id="SITE_RTL" value="on" <?php echo e($SITE_RTL== 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-labe" for="SITE_RTL"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <?php echo e(Form::label('signup_button',__('Sign Up'),array('class' => 'col-form-label'))); ?>

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" data-toggle="switchbutton" class="custom-control-input" name="signup_button" id="signup_button" <?php echo e(isset($settings['signup_button']) && $settings['signup_button'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                <label class="form-check-labe" for="signup_button"></label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php if(App\Models\Utility::getValByName('gdpr_cookie') == 'on'): ?>

                                        <?php echo e(Form::label('cookie_text',__('GDPR Cookie Text'),array('class' => 'col-form-label fulltime'))); ?>


                                        <?php echo Form::textarea('cookie_text',$settings['cookie_text'], ['class'=>'form-control fulltime','rows'=>'2','style'=>'display: hidden;height: auto !important;resize:none;']); ?>

                                        <?php endif; ?>
                                    </div>

                                    <h4 class="small-title"><?php echo e(__('Theme Customizer')); ?></h4>
                                    <div class="setting-card setting-logo-box p-3">
                                        <div class="row">
                                            <div class="col-4 my-auto">
                                                <h6 class="mt-3">
                                                    <i data-feather="credit-card" class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                                  </h6>
                                                  <hr class="my-2" />
                                                  <div class="theme-color themes-color">
                                                    <a href="#!" class="<?php echo e(($settings['color'] =='theme-1') ? 'active_color' : ''); ?>" data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                    <input type="radio" class="theme_color" name="color" value="theme-1" style="display: none;">
                                                    <a href="#!" class="<?php echo e(($settings['color'] =='theme-2') ? 'active_color' : ''); ?>" data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                    <input type="radio" class="theme_color" name="color" value="theme-2" style="display: none;">
                                                    <a href="#!" class="<?php echo e(($settings['color'] =='theme-3') ? 'active_color' : ''); ?>" data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                    <input type="radio" class="theme_color" name="color" value="theme-3" style="display: none;">
                                                    <a href="#!" class="<?php echo e(($settings['color'] =='theme-4') ? 'active_color' : ''); ?>" data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                    <input type="radio" class="theme_color" name="color" value="theme-4" style="display: none;">
                                                  </div>
                                            </div>
                                            <div class="col-4 my-auto">
                                                <h6>
                                                    <i data-feather="layout" class="me-2"></i><?php echo e(__('Sidebar settings')); ?>

                                                  </h6>
                                                  <hr class="my-2" />
                                                  <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="cust-theme-bg" name="cust_theme_bg" <?php echo e(Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : ''); ?> />
                                                    <label class="form-check-label f-w-600 pl-1" for="cust-theme-bg"
                                                      ><?php echo e(__('Transparent layout')); ?></label
                                                    >
                                                  </div>
                                            </div>
                                            <div class="col-4 my-auto">
                                                <h6 >
                                                  <i data-feather="sun" class="me-2"></i><?php echo e(__('Layout settings')); ?>

                                                </h6>
                                                <hr class="my-2" />
                                                <div class="form-check form-switch mt-2">
                                                    <input type="checkbox" class="form-check-input" id="cust-darklayout" name="cust_darklayout"<?php echo e(Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : ''); ?> />
                                                    <label class="form-check-label f-w-600 pl-1" for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-end">
                                        <?php echo e(Form::submit(__('Save Changes'),array('class'=>'btn btn-print-invoice  btn-primary m-r-10'))); ?>

                                    </div>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>

                            <div class="card" id="payment-setting">
                                <div class="card-header">
                                    <h5><?php echo e(__('Payment Setting')); ?></h5>
                                </div>
                                <div class="card-body">
                                <?php echo e(Form::open(array('route'=>'payment.setting','method'=>'post'))); ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('currency',__('Currency *'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('currency',env('CURRENCY'),array('class'=>'form-control font-style','required'))); ?>

                                                <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?>

                                                <small>
                                                    <a href="https://stripe.com/docs/currencies" target="_blank"><?php echo e(__('you can find out here..')); ?></a>
                                                </small>
                                                <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-currency" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('currency_symbol',__('Currency Symbol *'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('currency_symbol',env('CURRENCY_SYMBOL'),array('class'=>'form-control','required'))); ?>

                                                <?php $__errorArgs = ['currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-currency_symbol" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class=" pb-3">
                                        <hr>
                                    </div>

                                    <div class="faq justify-content-center">
                                        <div class="col-sm-12 col-md-10 col-xxl-12">
                                            <div class="accordion accordion-flush" id="accordionExample">

                                                <!-- Strip -->
                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-2">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Stripe')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse1" class="accordion-collapse collapse"aria-labelledby="heading-2-2"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Stripe')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_stripe_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_stripe_enabled" id="is_stripe_enabled" <?php echo e(isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_stripe_enabled"><?php echo e(__('Enable Stripe')); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <?php echo e(Form::label('stripe_key',__('Stripe Key'),array('class' => 'col-form-label'))); ?>

                                                                        <?php echo e(Form::text('stripe_key',isset($admin_payment_setting['stripe_key'])?$admin_payment_setting['stripe_key']:'',['class'=>'form-control','placeholder'=>__('Enter Stripe Key')])); ?>

                                                                        <?php $__errorArgs = ['stripe_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-stripe_key" role="alert">
                                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <?php echo e(Form::label('stripe_secret',__('Stripe Secret'),array('class' => 'col-form-label'))); ?>

                                                                        <?php echo e(Form::text('stripe_secret',isset($admin_payment_setting['stripe_secret'])?$admin_payment_setting['stripe_secret']:'',['class'=>'form-control ','placeholder'=>__('Enter Stripe Secret')])); ?>

                                                                        <?php $__errorArgs = ['stripe_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-stripe_secret" role="alert">
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

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-3">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paypal')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse2" class="accordion-collapse collapse"aria-labelledby="heading-2-3"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('PayPal')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_paypal_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_paypal_enabled" id="is_paypal_enabled" <?php echo e(isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_paypal_enabled"><?php echo e(__('Enable Paypal')); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="paypal-label col-form-label" for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label> <br>

                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-labe text-dark">
                                                                                        <input type="radio" name="paypal_mode" value="sandbox" class="form-check-input" <?php echo e(isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == '' || isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-labe text-dark">
                                                                                        <input type="radio" name="paypal_mode" value="live" class="form-check-input" <?php echo e(isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Client ID')); ?></label>
                                                                        <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="<?php echo e(isset($admin_payment_setting['paypal_client_id'])?$admin_payment_setting['paypal_client_id']:''); ?>" placeholder="<?php echo e(__('Client ID')); ?>"/>
                                                                        <?php if($errors->has('paypal_client_id')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                                                    <?php echo e($errors->first('paypal_client_id')); ?>

                                                                                                </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="paypal_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                        <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['paypal_secret_key'])?$admin_payment_setting['paypal_secret_key']:''); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                                                        <?php if($errors->has('paypal_secret_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paypal_secret_key')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-4">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paystack')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse3" class="accordion-collapse collapse"aria-labelledby="heading-2-4"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Paystack')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_paystack_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_paystack_enabled" id="is_paystack_enabled" <?php echo e(isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_paystack_enabled"><?php echo e(__('Enable Paystack')); ?></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                        <input type="text" name="paystack_public_key" id="paystack_public_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['paystack_public_key']) ? $admin_payment_setting['paystack_public_key']:''); ?>" placeholder="<?php echo e(__('Public Key')); ?>"/>
                                                                        <?php if($errors->has('paystack_public_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paystack_public_key')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                        <input type="text" name="paystack_secret_key" id="paystack_secret_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['paystack_secret_key']) ? $admin_payment_setting['paystack_secret_key']:''); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                                                        <?php if($errors->has('paystack_secret_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paystack_secret_key')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-5">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Flutterwave')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse4" class="accordion-collapse collapse"aria-labelledby="heading-2-5"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Flutterwave')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_flutterwave_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_flutterwave_enabled" id="is_flutterwave_enabled" <?php echo e(isset($admin_payment_setting['is_flutterwave_enabled'])  && $admin_payment_setting['is_flutterwave_enabled']== 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_flutterwave_enabled"><?php echo e(__('Enable Flutterwave')); ?></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                        <input type="text" name="flutterwave_public_key" id="flutterwave_public_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['flutterwave_public_key'])?$admin_payment_setting['flutterwave_public_key']:''); ?>" placeholder="<?php echo e(__('Public Key')); ?>"/>
                                                                        <?php if($errors->has('flutterwave_public_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('flutterwave_public_key')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                        <input type="text" name="flutterwave_secret_key" id="flutterwave_secret_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['flutterwave_secret_key'])?$admin_payment_setting['flutterwave_secret_key']:''); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                                                        <?php if($errors->has('flutterwave_secret_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('flutterwave_secret_key')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-6">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Razorpay')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse5" class="accordion-collapse collapse"aria-labelledby="heading-2-6"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Razorpay')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_razorpay_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_razorpay_enabled" id="is_razorpay_enabled" <?php echo e(isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_razorpay_enabled"><?php echo e(__('Enable Razorpay')); ?></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>

                                                                        <input type="text" name="razorpay_public_key" id="razorpay_public_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['razorpay_public_key'])?$admin_payment_setting['razorpay_public_key']:''); ?>" placeholder="<?php echo e(__('Public Key')); ?>"/>
                                                                        <?php if($errors->has('razorpay_public_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('razorpay_public_key')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                        <input type="text" name="razorpay_secret_key" id="razorpay_secret_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['razorpay_secret_key'])?$admin_payment_setting['razorpay_secret_key']:''); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                                                        <?php if($errors->has('razorpay_secret_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('razorpay_secret_key')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-7">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Mercado Pago')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse6" class="accordion-collapse collapse"aria-labelledby="heading-2-7"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                           <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Mercado Pago')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of plan.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-right">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_mercado_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_mercado_enabled" id="is_mercado_enabled" <?php echo e(isset($admin_payment_setting['is_mercado_enabled']) &&  $admin_payment_setting['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_mercado_enabled"><?php echo e(__('Enable Mercado Pago')); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="coingate-label form-control-label" for="mercado_mode"><?php echo e(__('Mercado Mode')); ?></label> <br>
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-labe text-dark">
                                                                                        <input type="radio" name="mercado_mode" value="sandbox" class="form-check-input" <?php echo e(isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == '' || isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-labe text-dark">
                                                                                        <input type="radio" name="mercado_mode" value="live" class="form-check-input" <?php echo e(isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="mercado_access_token" class="col-form-label"><?php echo e(__('Access Token')); ?></label>
                                                                        <input type="text" name="mercado_access_token" id="mercado_access_token" class="form-control" value="<?php echo e(isset($admin_payment_setting['mercado_access_token']) ? $admin_payment_setting['mercado_access_token']:''); ?>" placeholder="<?php echo e(__('Access Token')); ?>"/>
                                                                        <?php if($errors->has('mercado_secret_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                        <?php echo e($errors->first('mercado_access_token')); ?>

                                                                    </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-8">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paytm')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse7" class="accordion-collapse collapse"aria-labelledby="heading-2-8"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                           <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Paytm')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_paytm_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_paytm_enabled" id="is_paytm_enabled" <?php echo e(isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_paytm_enabled"><?php echo e(__('Enable Paytm')); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="paypal-label form-control-label" for="paypal_mode"><?php echo e(__('Paytm Environment')); ?></label> <br>
                                                                    <div class="d-flex">
                                                                            <div class="mr-2" style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="paytm_mode" value="local" class="form-check-input" <?php echo e(isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == '' || isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Local')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label class="form-check-labe text-dark">
                                                                                            <input type="radio" name="paytm_mode" value="production" class="form-check-input" <?php echo e(isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Production')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="paytm_public_key" class="col-form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                                        <input type="text" name="paytm_merchant_id" id="paytm_merchant_id" class="form-control" value="<?php echo e(isset($admin_payment_setting['paytm_merchant_id'])? $admin_payment_setting['paytm_merchant_id']:''); ?>" placeholder="<?php echo e(__('Merchant ID')); ?>"/>
                                                                        <?php if($errors->has('paytm_merchant_id')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                        <?php echo e($errors->first('paytm_merchant_id')); ?>

                                                                    </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="paytm_secret_key" class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                        <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['paytm_merchant_key']) ? $admin_payment_setting['paytm_merchant_key']:''); ?>" placeholder="<?php echo e(__('Merchant Key')); ?>"/>
                                                                        <?php if($errors->has('paytm_merchant_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                        <?php echo e($errors->first('paytm_merchant_key')); ?>

                                                                    </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="paytm_industry_type" class="col-form-label"><?php echo e(__('Industry Type')); ?></label>
                                                                        <input type="text" name="paytm_industry_type" id="paytm_industry_type" class="form-control" value="<?php echo e(isset($admin_payment_setting['paytm_industry_type']) ?$admin_payment_setting['paytm_industry_type']:''); ?>" placeholder="<?php echo e(__('Industry Type')); ?>"/>
                                                                        <?php if($errors->has('paytm_industry_type')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                        <?php echo e($errors->first('paytm_industry_type')); ?>

                                                                    </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-9">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Mollie')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse8" class="accordion-collapse collapse"aria-labelledby="heading-2-9"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                           <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Mollie')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_mollie_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_mollie_enabled" id="is_mollie_enabled" <?php echo e(isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_mollie_enabled"><?php echo e(__('Enable Mollie')); ?></label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="mollie_api_key" class="col-form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                                        <input type="text" name="mollie_api_key" id="mollie_api_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['mollie_api_key'])?$admin_payment_setting['mollie_api_key']:''); ?>" placeholder="<?php echo e(__('Mollie Api Key')); ?>"/>
                                                                        <?php if($errors->has('mollie_api_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('mollie_api_key')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="mollie_profile_id" class="col-form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                                                        <input type="text" name="mollie_profile_id" id="mollie_profile_id" class="form-control" value="<?php echo e(isset($admin_payment_setting['mollie_profile_id'])?$admin_payment_setting['mollie_profile_id']:''); ?>" placeholder="<?php echo e(__('Mollie Profile Id')); ?>"/>
                                                                        <?php if($errors->has('mollie_profile_id')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('mollie_profile_id')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="mollie_partner_id" class="col-form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                                                        <input type="text" name="mollie_partner_id" id="mollie_partner_id" class="form-control" value="<?php echo e(isset($admin_payment_setting['mollie_partner_id'])?$admin_payment_setting['mollie_partner_id']:''); ?>" placeholder="<?php echo e(__('Mollie Partner Id')); ?>"/>
                                                                        <?php if($errors->has('mollie_partner_id')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('mollie_partner_id')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-10">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Skrill')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse9" class="accordion-collapse collapse"aria-labelledby="heading-2-10"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                           <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Skrill')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_skrill_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_skrill_enabled" id="is_skrill_enabled" <?php echo e(isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_skrill_enabled"><?php echo e(__('Enable Skrill')); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="mollie_api_key" class="col-form-labe"><?php echo e(__('Skrill Api Key')); ?></label>
                                                                        <input type="email" name="skrill_email" id="skrill_email" class="form-control" value="<?php echo e(isset($admin_payment_setting['skrill_email'])?$admin_payment_setting['skrill_email']:''); ?>" placeholder="<?php echo e(__('Skrill Api Key')); ?>"/>
                                                                        <?php if($errors->has('skrill_email')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('skrill_email')); ?>

                                                                        </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-11">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('CoinGate')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse10" class="accordion-collapse collapse"aria-labelledby="heading-2-11"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                           <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('CoinGate')); ?></h5>
                                                                    <small> <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                        <input type="hidden" name="is_coingate_enabled" value="off">
                                                                        <input type="checkbox" class="form-check-input" name="is_coingate_enabled" id="is_coingate_enabled" <?php echo e(isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-control-label" for="is_coingate_enabled"><?php echo e(__('Enable CoinGate')); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="coingate-label form-control-label" for="coingate_mode"><?php echo e(__('CoinGate Mode')); ?></label> <br>

                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-labe text-dark">
                                                                                        <input type="radio" name="coingate_mode" value="sandbox" class="form-check-input" <?php echo e(isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == '' || isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-labe text-dark">
                                                                                        <input type="radio" name="coingate_mode" value="live" class="form-check-input" <?php echo e(isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="coingate_auth_token" class="col-form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                                                                        <input type="text" name="coingate_auth_token" id="coingate_auth_token" class="form-control" value="<?php echo e(isset($admin_payment_setting['coingate_auth_token'])?$admin_payment_setting['coingate_auth_token']:''); ?>" placeholder="<?php echo e(__('CoinGate Auth Token')); ?>"/>
                                                                        <?php if($errors->has('coingate_auth_token')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                        <?php echo e($errors->first('coingate_auth_token')); ?>

                                                                    </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header" id="heading-2-12">
                                                        <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                                            <span class="d-flex align-items-center">
                                                                <i class="ti ti-credit-card text-primary"></i> <?php echo e(__('Paymentwall')); ?>

                                                            </span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapse11" class="accordion-collapse collapse"aria-labelledby="heading-2-12"data-bs-parent="#accordionExample" >
                                                        <div class="accordion-body">
                                                          <div class="row">
                                                                <div class="col-6 py-2">
                                                                    <h5 class="h5"><?php echo e(__('Paymentwall')); ?></h5>
                                                                </div>
                                                                <div class="col-6 py-2 text-end">
                                                                    <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paymentwall_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_paymentwall_enabled" id="is_paymentwall_enabled" <?php echo e(isset($admin_payment_setting['is_paymentwall_enabled'])  && $admin_payment_setting['is_paymentwall_enabled']== 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="custom-control-label form-control-label" for="is_paymentwall_enabled"><?php echo e(__('Enable PaymentWall')); ?></label>
                                                                </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paymentwall_public_key" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                    <input type="text" name="paymentwall_public_key" id="paymentwall_public_key" class="form-control" value="<?php echo e(isset($admin_payment_setting['paymentwall_public_key'])?$admin_payment_setting['paymentwall_public_key']:''); ?>" placeholder="<?php echo e(__('Public Key')); ?>"/>
                                                                    <?php if($errors->has('paymentwall_public_key')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paymentwall_public_key')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paymentwall_private_key" class="col-form-label"><?php echo e(__('Private Key')); ?></label>
                                                                    <input type="text" name="paymentwall_private_key" id="paymentwall_private_key" class="form-control form-control-label" value="<?php echo e(isset($admin_payment_setting['paymentwall_private_key'])?$admin_payment_setting['paymentwall_private_key']:''); ?>" placeholder="<?php echo e(__('Private Key')); ?>"/>
                                                                    <?php if($errors->has('paymentwall_private_key')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paymentwall_private_key')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <?php echo e(Form::submit(__('Save Changes'),array('class'=>'btn btn-print-invoice  btn-primary m-r-10'))); ?>

                                    </div>
                                <?php echo e(Form::close()); ?>

                                </div>
                            </div>

                            <div class="card" id="email_setting">
                                <?php echo e(Form::open(array('route'=>'email.setting','method'=>'post'))); ?>

                                <div class="card-header">
                                    <h5><?php echo e(__('Email Setting')); ?></h5>
                                </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('mail_driver',__('Mail Driver'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control','placeholder'=>__('Enter Mail Driver')))); ?>

                                                <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                 <strong class="text-danger"><?php echo e($message); ?></strong>
                                                 </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('mail_host',__('Mail Host'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control ','placeholder'=>__('Enter Mail Host')))); ?>

                                                <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                             </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('mail_port',__('Mail Port'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control','placeholder'=>__('Enter Mail Port')))); ?>

                                                <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('mail_username',__('Mail Username'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Username')))); ?>

                                                <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_username" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('mail_password',__('Mail Password'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control','placeholder'=>__('Enter Mail Password')))); ?>

                                                <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_password" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('mail_encryption',__('Mail Encryption'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))); ?>

                                                <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_encryption" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('mail_from_address',__('Mail From Address'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Address')))); ?>

                                                <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_address" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('mail_from_name',__('Mail From Name'),array('class' => 'col-form-label'))); ?>

                                                <?php echo e(Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Name')))); ?>

                                                <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_name" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <a href="#" data-url="<?php echo e(route('test.mail' )); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Send Test Mail')); ?>" class="send_email btn btn-print-invoice  btn-primary m-r-10">
                                                    <?php echo e(__('Send Test Mail')); ?>

                                                </a>
                                            </div>
                                            <div class="form-group col-md-6 text-end">
                                                <?php echo e(Form::submit(__('Save Changes'),array('class'=>'btn btn-print-invoice  btn-primary m-r-10'))); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <?php echo e(Form::close()); ?>

                            </div>

                            <div class="card" id="recaptcha-settings">
                                <form method="POST" action="<?php echo e(route('recaptcha.settings.store')); ?>" accept-charset="UTF-8">
                                    <?php echo csrf_field(); ?>
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                 <h5><?php echo e(__('Recaptcha Setting')); ?></h5>
                                                 <label class="custom-control-label form-control-label" for="recaptcha_module">
                                                    <?php echo e(__('Google Recaptcha')); ?>

                                                    <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/" target="_blank" class="text-blue">
                                                        <small>(<?php echo e(__('How to Get Google reCaptcha Site and Secret key')); ?>)</small>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton" class="custom-control-input" name="recaptcha_module" id="recaptcha_module" value="yes" <?php echo e(env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : ''); ?>>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-body">

                                        <div class="row ">
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="google_recaptcha_key" class="col-form-label"><?php echo e(__('Google Recaptcha Key')); ?></label>
                                                <input class="form-control" placeholder="<?php echo e(__('Enter Google Recaptcha Key')); ?>" name="google_recaptcha_key" type="text" value="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" id="google_recaptcha_key">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="google_recaptcha_secret" class="col-form-label"><?php echo e(__('Google Recaptcha Secret')); ?></label>
                                                <input class="form-control " placeholder="<?php echo e(__('Enter Google Recaptcha Secret')); ?>" name="google_recaptcha_secret" type="text" value="<?php echo e(env('NOCAPTCHA_SECRET')); ?>" id="google_recaptcha_secret">
                                            </div>
                                        </div>
                                        <div class="col-lg-12  text-end mb-5">
                                            <?php echo e(Form::submit(__('Save Changes'),array('class'=>'btn btn-print-invoice  btn-primary m-r-10'))); ?>

                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div id="useradd-13" class="card mb-3">
                                <?php echo e(Form::open(array('route' => 'storage.setting.store', 'enctype' => "multipart/form-data"))); ?>

                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                <h5 class=""><?php echo e(__('Storage Settings')); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="pe-2">
                                                <input type="radio" class="btn-check" name="storage_setting" id="local-outlined" autocomplete="off" <?php echo e($settings['storage_setting'] == 'local'?'checked':''); ?> value="local" checked>
                                                <label class="btn btn-outline-primary" for="local-outlined"><?php echo e(__('Local')); ?></label>
                                            </div>
                                            <div  class="pe-2">
                                                <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined" autocomplete="off" <?php echo e($settings['storage_setting']=='s3'?'checked':''); ?>  value="s3">
                                                <label class="btn btn-outline-primary" for="s3-outlined"> <?php echo e(__('AWS S3')); ?></label>
                                            </div>

                                            <div  class="pe-2">
                                                <input type="radio" class="btn-check" name="storage_setting" id="wasabi-outlined" autocomplete="off" <?php echo e($settings['storage_setting']=='wasabi'?'checked':''); ?> value="wasabi">
                                                <label class="btn btn-outline-primary" for="wasabi-outlined"><?php echo e(__('Wasabi')); ?></label>
                                            </div>
                                        </div>
                                        <div  class="mt-2">
                                        <div class="local-setting row <?php echo e($settings['storage_setting']=='local'?' ':'d-none'); ?>">
                                            
                                            <div class="col-lg-6 col-md-11 col-sm-12">
                                                <?php echo e(Form::label('local_storage_validation',__('Only Upload Files'),array('class'=>' form-label'))); ?>

                                                <select name="local_storage_validation[]" class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button" placeholder="This is a placeholder" multiple>
                                                    <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(in_array($f, $local_storage_validations)): ?> selected <?php endif; ?>><?php echo e($f); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="local_storage_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                                    <input type="number" name="local_storage_max_upload_size" class="form-control" value="<?php echo e((!isset($settings['local_storage_max_upload_size']) || is_null($settings['local_storage_max_upload_size'])) ? '' : $settings['local_storage_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="s3-setting row <?php echo e($settings['storage_setting']=='s3'?' ':'d-none'); ?>">

                                            <div class=" row ">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_key"><?php echo e(__('S3 Key')); ?></label>
                                                        <input type="text" name="s3_key" class="form-control" value="<?php echo e((!isset($settings['s3_key']) || is_null($settings['s3_key'])) ? '' : $settings['s3_key']); ?>" placeholder="<?php echo e(__('S3 Key')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_secret"><?php echo e(__('S3 Secret')); ?></label>
                                                        <input type="text" name="s3_secret" class="form-control" value="<?php echo e((!isset($settings['s3_secret']) || is_null($settings['s3_secret'])) ? '' : $settings['s3_secret']); ?>" placeholder="<?php echo e(__('S3 Secret')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_region"><?php echo e(__('S3 Region')); ?></label>
                                                        <input type="text" name="s3_region" class="form-control" value="<?php echo e((!isset($settings['s3_region']) || is_null($settings['s3_region'])) ? '' : $settings['s3_region']); ?>" placeholder="<?php echo e(__('S3 Region')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_bucket"><?php echo e(__('S3 Bucket')); ?></label>
                                                        <input type="text" name="s3_bucket" class="form-control" value="<?php echo e((!isset($settings['s3_bucket']) || is_null($settings['s3_bucket'])) ? '' : $settings['s3_bucket']); ?>" placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_url"><?php echo e(__('S3 URL')); ?></label>
                                                        <input type="text" name="s3_url" class="form-control" value="<?php echo e((!isset($settings['s3_url']) || is_null($settings['s3_url'])) ? '' : $settings['s3_url']); ?>" placeholder="<?php echo e(__('S3 URL')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_endpoint"><?php echo e(__('S3 Endpoint')); ?></label>
                                                        <input type="text" name="s3_endpoint" class="form-control" value="<?php echo e((!isset($settings['s3_endpoint']) || is_null($settings['s3_endpoint'])) ? '' : $settings['s3_endpoint']); ?>" placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-8 switch-width">
                                                    <?php echo e(Form::label('s3_storage_validation',__('Only Upload Files'),array('class'=>' form-label'))); ?>

                                                        <select name="s3_storage_validation[]"  class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button1" placeholder="This is a placeholder" multiple>
                                                            <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if(in_array($f, $s3_storage_validations)): ?> selected <?php endif; ?>><?php echo e($f); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_max_upload_size"><?php echo e(__('Max upload size (In KB)')); ?></label>
                                                        <input type="number" name="s3_max_upload_size" class="form-control" value="<?php echo e((!isset($settings['s3_max_upload_size']) || is_null($settings['s3_max_upload_size'])) ? '' : $settings['s3_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="wasabi-setting row <?php echo e($settings['storage_setting']=='wasabi'?' ':'d-none'); ?>">
                                            <div class=" row ">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_key"><?php echo e(__('Wasabi Key')); ?></label>
                                                        <input type="text" name="wasabi_key" class="form-control" value="<?php echo e((!isset($settings['wasabi_key']) || is_null($settings['wasabi_key'])) ? '' : $settings['wasabi_key']); ?>" placeholder="<?php echo e(__('Wasabi Key')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_secret"><?php echo e(__('Wasabi Secret')); ?></label>
                                                        <input type="text" name="wasabi_secret" class="form-control" value="<?php echo e((!isset($settings['wasabi_secret']) || is_null($settings['wasabi_secret'])) ? '' : $settings['wasabi_secret']); ?>" placeholder="<?php echo e(__('Wasabi Secret')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="s3_region"><?php echo e(__('Wasabi Region')); ?></label>
                                                        <input type="text" name="wasabi_region" class="form-control" value="<?php echo e((!isset($settings['wasabi_region']) || is_null($settings['wasabi_region'])) ? '' : $settings['wasabi_region']); ?>" placeholder="<?php echo e(__('Wasabi Region')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="wasabi_bucket"><?php echo e(__('Wasabi Bucket')); ?></label>
                                                        <input type="text" name="wasabi_bucket" class="form-control" value="<?php echo e((!isset($settings['wasabi_bucket']) || is_null($settings['wasabi_bucket'])) ? '' : $settings['wasabi_bucket']); ?>" placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="wasabi_url"><?php echo e(__('Wasabi URL')); ?></label>
                                                        <input type="text" name="wasabi_url" class="form-control" value="<?php echo e((!isset($settings['wasabi_url']) || is_null($settings['wasabi_url'])) ? '' : $settings['wasabi_url']); ?>" placeholder="<?php echo e(__('Wasabi URL')); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="wasabi_root"><?php echo e(__('Wasabi Root')); ?></label>
                                                        <input type="text" name="wasabi_root" class="form-control" value="<?php echo e((!isset($settings['wasabi_root']) || is_null($settings['wasabi_root'])) ? '' : $settings['wasabi_root']); ?>" placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-8 switch-width">
                                                    <?php echo e(Form::label('wasabi_storage_validation',__('Only Upload Files'),array('class'=>'form-label'))); ?>


                                                    <select name="wasabi_storage_validation[]" class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button2" placeholder="This is a placeholder" multiple>
                                                        <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if(in_array($f, $wasabi_storage_validations)): ?> selected <?php endif; ?>><?php echo e($f); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="wasabi_root"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                                        <input type="number" name="wasabi_max_upload_size" class="form-control" value="<?php echo e((!isset($settings['wasabi_max_upload_size']) || is_null($settings['wasabi_max_upload_size'])) ? '' : $settings['wasabi_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                    </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                       <?php endif; ?>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/jquery-mask-plugin/dist/jquery.mask.min.js')); ?>"></script>

    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            show_toastr('Success', "<?php echo e(__('Link copied')); ?>", 'success');
        }

        $(document).on('click', 'input[name="theme_color"]', function () {
            var eleParent = $(this).attr('data-theme');
            var imgpath = $(this).attr('data-imgpath');
            $('.' + eleParent + '_img').attr('src', imgpath);
        });

        $(document).ready(function () {
            setTimeout(function (e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
            }, 300);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Taimoor Ahmad\Desktop\taimoor's work\faddish\storemanager.faddishbuilder.com\resources\views/settings/index.blade.php ENDPATH**/ ?>