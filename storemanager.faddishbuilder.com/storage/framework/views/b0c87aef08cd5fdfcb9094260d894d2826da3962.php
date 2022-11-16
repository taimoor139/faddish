<div class="dash-container">
    <div class="dash-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
              <div class="page-block">
                  <div class="row align-items-center">
                      <div class="col-md-12">
                          <div class="d-block d-sm-flex align-items-center justify-content-between">
                              <div>
                                  <div class="page-header-title">
                                      <h4 class="m-b-10"><?php echo $__env->yieldContent('page-title'); ?></h4>
                                  </div>
                                  <ul class="breadcrumb">
                                          <?php echo $__env->yieldContent('breadcrumb'); ?>
                                  </ul>
                              </div>
                              <div>
                                <?php echo $__env->yieldContent('action-btn'); ?>
                              </div>
                              
                          </div>
                      </div>
                  </div>
              </div>
          </div>

        <!-- <div class="row"> -->
               <?php echo $__env->yieldContent('content'); ?>
        
        <!-- </div> -->

    </div>
</div>
<?php /**PATH /home/store/public_html/resources/views/partials/admin/content.blade.php ENDPATH**/ ?>