<?php
  $logo=asset(Storage::url('uploads/logo/'));
   if(\Auth::user()->type=="Super Admin")
    {
        $company_logo=Utility::get_superadmin_logo();
    }
    else
    {
        $company_logo=Utility::get_company_logo();
    }
?>
<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
<?php else: ?>
    <nav class="dash-sidebar light-sidebar">
<?php endif; ?>
    <div class="navbar-wrapper">
      <div class="m-header main-logo">
        <a href="<?php echo e(route('dashboard')); ?>" class="b-brand">
          <!-- = = = = = = = =    change your logo hear   = = = = = = = = = = = =  -->
          <img src="<?php echo e($logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo-dark.png')); ?>"  class="logo logo-lg">
        </a>
      </div>
      <div class="navbar-content">
              <ul class="dash-navbar">
                <?php if(Auth::user()->type == 'Owner'): ?>

                <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'dashboard'  || Request::route()->getName() == 'dashboard' || Request::segment(1) == 'orders'  || Request::segment(1) == 'storeanalytic' ? ' active dash-trigger' : 'collapsed'); ?>">
                  <a href="#!" class="dash-link"
                    ><span class="dash-micon"><i class="ti ti-home"></i></span
                    ><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span
                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                  ></a>
                  <ul class="dash-submenu <?php echo e(Request::segment(1) == 'dashboard' || Request::route()->getName() == 'dashboard' || Request::segment(1) == 'storeanalytic' ? ' show' : ''); ?>">
                    <li class="dash-item <?php echo e(Request::route()->getName() == 'dashboard' ? ' active' : ''); ?>">
                      <a class="dash-link" href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                    </li>
                    <li class="dash-item <?php echo e(Request::route()->getName() == 'storeanalytic' ? ' active' : ''); ?>">
                      <a class="dash-link" href="<?php echo e(route('storeanalytic')); ?>"><?php echo e(__('Store Analytics')); ?></a>
                    </li>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'orders.index' ||  Request::route()->getName() == 'orders.show' ? ' active ' : ''); ?>">
                        <a class="dash-link" href="<?php echo e(route('orders.index')); ?>"><?php echo e(__('Orders')); ?></a>
                    </li>
                  </ul>
                </li>

            <li class="dash-item dash-hasmenu <?php echo e(Request::route()->getName() == 'product.index' ||  Request::route()->getName() == 'product.show' ||  Request::route()->getName() == 'product.edit' || Request::route()->getName() == 'product.create' || Request::route()->getName() == 'product.grid' ||Request::segment(1) == 'product_categorie' ||Request::segment(1) == 'product_tax' ||Request::segment(1) == 'product-coupon' ||Request::segment(1) == 'shipping'? ' active dash-trigger': 'collapsed'); ?>">
                <a href="#" class="dash-link"><span class="dash-micon">
                    <i class="ti ti-layout-2"></i>
                    </span><span class="dash-mtext"><?php echo e(__('Shop')); ?></span><span
                        class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                <ul class="dash-submenu <?php echo e(Request::segment(1) == 'product.index' ? ' show' : ''); ?>">
                    <li
                        class="dash-item <?php echo e(Request::route()->getName() == 'product.index' || Request::route()->getName() == 'product.create'  ||  Request::route()->getName() == 'product.show' ||  Request::route()->getName() == 'product.edit' || Request::route()->getName() == 'product.grid'? ' active' : ''); ?>">
                        <a class="dash-link"
                            href="<?php echo e(route('product.index')); ?>"><?php echo e(__('Products')); ?></a>
                    </li>
                    <li
                        class="dash-item <?php echo e(Request::route()->getName() == 'product_categorie.index' ? ' active' : ''); ?>">
                        <a class="dash-link"
                            href="<?php echo e(route('product_categorie.index')); ?>"><?php echo e(__('Product Category')); ?></a>
                    </li>
                    <li
                        class="dash-item <?php echo e(Request::route()->getName() == 'product_tax.index' ? ' active' : ''); ?>">
                        <a class="dash-link"
                            href="<?php echo e(route('product_tax.index')); ?>"><?php echo e(__('Product Tax')); ?></a>
                    </li>
                    <li
                        class="dash-item <?php echo e(Request::route()->getName() == 'product-coupon.index' || Request::route()->getName() == 'product-coupon.show' ? ' active' : ''); ?>">
                        <a class="dash-link"
                            href="<?php echo e(route('product-coupon.index')); ?>"><?php echo e(__('Product Coupon')); ?></a>
                    </li>
                    <?php if(isset($plan) && $plan->shipping_method == 'on'): ?>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'shipping.index' ? ' active' : ''); ?>">
                            <a class="dash-link"
                                href="<?php echo e(route('shipping.index')); ?>"><?php echo e(__('Shipping')); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
          <li
              class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'customer.index' || Request::route()->getName() =='customer.show' ? ' active' : 'collapsed'); ?>">
              <a href="<?php echo e(route('customer.index')); ?>"
                  class="dash-link <?php echo e(request()->is('customer.index') ? 'active' : ''); ?>"><span
                      class="dash-micon">
                      <i data-feather="user"></i>
                  </span><span class="dash-mtext"><?php echo e(__('Customers')); ?></span></a>
          </li>

        <?php endif; ?>
        <?php if(Auth::user()->type == 'super admin'): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'dashboard' ? ' active' : 'collapsed'); ?>">
                        <a href="<?php echo e(route('dashboard')); ?>"
                            class="dash-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>"><span
                                class="dash-micon">
                                <i class="ti ti-home"></i>
                            </span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>
                    </li>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'store-resource'  || Request::route()->getName() == 'store.grid' ? ' active' : 'collapsed'); ?>">
                        <a href="<?php echo e(route('store-resource.index')); ?>"
                            class="dash-link <?php echo e(request()->is('store-resource') ? 'active' : ''); ?>"><span
                                class="dash-micon">
                                <i data-feather="user"></i>
                            </span><span class="dash-mtext"><?php echo e(__('Stores')); ?></span></a>
                    </li>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'coupons' || Request::route()->getName() == 'product-coupon.show' ? ' active' : 'collapsed'); ?>">
                        <a href="<?php echo e(route('coupons.index')); ?>"
                            class="dash-link <?php echo e(request()->is('coupons') ? 'active' : ''); ?>"><span
                                class="dash-micon">
                                <i class="ti ti-tag"></i>
                            </span><span class="dash-mtext"><?php echo e(__('Coupons')); ?></span></a>
                    </li>
                <?php endif; ?>
                <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'plans' || Request::route()->getName() == 'stripe' ? ' active' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('plans.index')); ?>"
                        class="dash-link <?php echo e(request()->is('plans') ? 'active' : ''); ?>"><span class="dash-micon">
                            <i class="ti ti-trophy"></i>
                        </span><span class="dash-mtext"><?php echo e(__('Plans')); ?></span></a>
                </li>
                <?php if(Auth::user()->type == 'super admin'): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'plan_request' ? ' active' : 'collapsed'); ?>">
                        <a href="<?php echo e(route('plan_request.index')); ?>"
                            class="dash-link <?php echo e(request()->is('plan_request') ? 'active' : ''); ?>"><span
                                class="dash-micon">
                                <i class="ti ti-brand-telegram"></i>
                            </span><span class="dash-mtext"><?php echo e(__('Plan Request')); ?></span></a>
                    </li>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::route()->getName()  == 'manage.email.language' || Request::route()->getName() =='manage.email.language' ? ' active' : 'collapsed'); ?>">
                        <a href="<?php echo e(route('manage.email.language',\Auth::user()->lang)); ?>"
                            class="dash-link <?php echo e(request()->is('email_template') ? 'active' : ''); ?>"><span
                                class="dash-micon">
                                <i class="ti ti-mail"></i>
                            </span><span class="dash-mtext"><?php echo e(__('Email Templates')); ?></span></a>
                    </li>
                <?php endif; ?>
                <!-- <?php if(Auth::user()->type == 'super admin'): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'manage-language' ? ' active' : 'collapsed'); ?>">
                        <a href="<?php echo e(route('manage.language', [$currantLang])); ?>"
                            class="dash-link <?php echo e(request()->is('manage-language') ? 'active' : ''); ?>"><span
                                class="dash-micon">
                                <i class="ti ti-world nocolor"></i>
                            </span><span class="dash-mtext"><?php echo e(__('Language')); ?></span></a>
                    </li>
                <?php endif; ?> -->
                <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'settings' ? ' active' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('settings')); ?>"
                        class="dash-link <?php echo e(request()->is('settings') ? 'active' : ''); ?>">
                        <span class="dash-micon"> <i data-feather="settings"></i>
                        </span><span class="dash-mtext">
                            <?php if(Auth::user()->type == 'super admin'): ?>
                                <?php echo e(__('Settings')); ?>

                            <?php else: ?>
                                <?php echo e(__('Store Settings')); ?>

                            <?php endif; ?>
                        </span></a>
                </li>

        </ul>

      </div>
    </div>
  </nav>
<?php /**PATH /home/store/public_html/resources/views/partials/admin/menu.blade.php ENDPATH**/ ?>