<?php
    $logo=asset(Storage::url('uploads/logo/'));
    $users=\Auth::user();
    $currantLang = $users->currentLanguages();
    $languages=\App\Models\Utility::languages();
    $footer_text=isset(\App\Models\Utility::settings()['footer_text']) ? \App\Models\Utility::settings()['footer_text'] : '';
    $settings = Utility::settings();
    $setting = App\Models\Utility::settings();
    $SITE_RTL = Utility::getValByName('SITE_RTL');

    $color=$setting['color'];

    if(\Auth::user()->type=="Super Admin")
    {
        $company_logo = Utility::get_superadmin_logo();
    }
    else
    {
        $company_logo = Utility::get_company_logo();
    }
    $plan         = \App\Models\Plan::where('id', $users->plan)->first();
?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo e($settings['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">
<?php echo $__env->make('partials.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body class="<?php echo e($color); ?>">
  <div class="row bg-lg text-info">
    <div class="col-lg-6">
        <a href="https://www.faddishbuilder.com/dashboard/login">Back to Editor</a>
    </div>
    <div class="col-lg-6">
        <a href="https://storemanager.faddishbuilder.com/login">STORE  MANAGER</a>
    </div>
  </div>
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <!-- [ navigation menu ] start -->
  <?php echo $__env->make('partials.admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- [ navigation menu ] end -->

  <!-- [ Header ] start -->
   <?php echo $__env->make('partials.admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- [ Header ] end -->
</body>

<!-- [ Main Content ] start -->
<?php echo $__env->make('partials.admin.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- [ Main Content ] end -->

<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="body">
                </div>
            </div>
        </div>
    </div>

<footer class="dash-footer">
  <div class="footer-wrapper">
    <div class="py-1">
      <span class="text-muted">
        <?php echo e($footer_text); ?>

        </span>
    </div>
  </div>
</footer>
<?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>





<?php if(App\Models\Utility::getValByName('gdpr_cookie') == 'on'): ?>
<script type="text/javascript">

    var defaults = {
    'messageLocales': {
        /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
        'en': "<?php echo e(App\Models\Utility::getValByName('cookie_text')); ?>"
    },
    'buttonLocales': {
        'en': 'Ok'
    },
    'cookieNoticePosition': 'bottom',
    'learnMoreLinkEnabled': false,
    'learnMoreLinkHref': '/cookie-banner-information.html',
    'learnMoreLinkText': {
      'it': 'Saperne di più',
      'en': 'Learn more',
      'de': 'Mehr erfahren',
      'fr': 'En savoir plus'
    },
    'buttonLocales': {
      'en': 'Ok'
    },
    'expiresIn': 30,
    'buttonBgColor': '#d35400',
    'buttonTextColor': '#fff',
    'noticeBgColor': '#000000',
    'noticeTextColor': '#fff',
    'linkColor': '#009fdd'
};
</script>
<script src="<?php echo e(asset('custom/js/cookie.notice.js')); ?>"></script>
<?php endif; ?>

</body>

</html>
<?php /**PATH /home/faddishbuilder/public_html/storemanager.faddishbuilder.com/resources/views/layouts/admin.blade.php ENDPATH**/ ?>