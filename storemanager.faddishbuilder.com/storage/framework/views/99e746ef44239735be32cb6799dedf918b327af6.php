<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('product.index')); ?>"><?php echo e(__('Product')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Product Edit')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        var Dropzones = function() {
            var e = $('[data-toggle="dropzone1"]'),
                t = $(".dz-preview");
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            e.length && (Dropzone.autoDiscover = !1, e.each(function() {
                var e, a, n, o, i;
                e = $(this), a = void 0 !== e.data("dropzone-multiple"), n = e.find(t), o = void 0, i = {
                    url: "<?php echo e(route('products.update', $product->id)); ?>",
                    method: 'PUT',
                    headers: {
                        'x-csrf-token': CSRF_TOKEN,
                    },
                    thumbnailWidth: null,
                    thumbnailHeight: null,
                    previewsContainer: n.get(0),
                    previewTemplate: n.html(),
                    maxFiles: 10,
                    parallelUploads: 10,
                    autoProcessQueue: false,
                    uploadMultiple: true,
                    acceptedFiles: a ? null : "image/*",
                    success: function(file, response) {
                        if (response.flag == "success") {
                            show_toastr('success', response.msg, 'success');
                            window.location.href = "<?php echo e(route('product.index')); ?>";
                        } else {
                            show_toastr('Error', response.msg, 'error');
                        }
                    },
                    error: function(file, response) {
                        // Dropzones.removeFile(file);
                        if (response.error) {
                            show_toastr('Error', response.error, 'error');
                        } else {
                            show_toastr('Error', response, 'error');
                        }
                    },
                    init: function() {
                        var myDropzone = this;

                        this.on("addedfile", function(e) {
                            !a && o && this.removeFile(o), o = e
                        })
                    }
                }, n.html(""), e.dropzone(i)
            }))
        }()

        $('#submit-all').on('click', function(e) {
            e.preventDefault();

            var form = $(this).parents('form');
            var variantNameEle = $('#variant_name');
            var variantOptionsEle = $('#variant_options');
            var isValid = true;
            if (variantNameEle.val() == '') {
                variantNameEle.focus();
                isValid = false;
            } else if (variantOptionsEle.val() == '') {
                variantOptionsEle.focus();
                isValid = false;
            }

            if (isValid) {

                // console.log($('#hiddenVariantOptions').val());
                $.ajax({
                    url: form.attr('action'),
                    datType: 'json',
                    data: {
                        variant_name: variantNameEle.val(),
                        variant_options: variantOptionsEle.val(),
                        hiddenVariantOptions: $('#hiddenVariantOptions').val()

                    },
                    success: function(data) {
                        $('#hiddenVariantOptions').val(data.hiddenVariantOptions);
                        $('.variant-table').html(data.varitantHTML);
                        $("#commonModal").modal('hide');
                    }
                })
            }


            $('#cost').trigger('keyup');

            var fd = new FormData();
            var file = document.getElementById('is_cover_image').files[0];
            var downloadable_prodcutfile = document.getElementById('downloadable_prodcut').files[0];

            if (file) {
                fd.append('is_cover_image', file);
            }
            if (downloadable_prodcutfile) {
                fd.append('downloadable_prodcut', downloadable_prodcutfile);
            }

            var files = $('[data-toggle="dropzone1"]').get(0).dropzone.getAcceptedFiles();
            $.each(files, function(key, file) {
                fd.append('multiple_files[' + key + ']', $('[data-toggle="dropzone1"]')[0].dropzone
                    .getAcceptedFiles()[key]); // attach dropzone image element
            });
            var other_data = $('#frmTarget').serializeArray();

            $.each(other_data, function(key, input) {
                fd.append(input.name, input.value);
            });

            $.ajax({
                url: "<?php echo e(route('products.update', $product->id)); ?>",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {

                    if (data.flag == "success") {
                        show_toastr('success', data.msg, 'success');
                        window.location.href = "<?php echo e(route('product.index')); ?>";
                    } else {
                        show_toastr('Error', data.msg, 'error');
                    }
                },
                error: function(data) {
                    if (data.error) {
                        show_toastr('Error', data.error, 'error');
                    } else {
                        show_toastr('Error', data, 'error');
                    }
                },
            });
        });

        $(".deleteRecord").click(function() {

            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: '<?php echo e(route('products.file.delete', '__product_id')); ?>'.replace('__product_id', id),
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function(data) {
                    if (data.success == "success") {
                        show_toastr('success', data.success, 'success');
                        $('.product_Image[data-id="' + data.id + '"]').remove();
                        location.reload();
                    } else {
                        show_toastr('Error', data.msg, 'error');
                    }
                }
            });
        });


        // $('.varint_array_modify').keyup(function() {
        //     varint_array_modify();
        // });

        // function varint_array_modify() {
            // var arrrr = [];
            // $('.variant_option_table thead th').each(function(index, currentElement) {
            //     var tt = $(this).find('span').text();
            //     if (tt != 'Price' || tt != 'Quantity' || tt !== '') {
            //         var tb = [];
            //         $('.variant_option_table tbody tr').each(function(index1, currentElement1) {
            //             var dsa = $(this).find('td:eq(' + index + ') input').val();
            //             tb.push(dsa);
            //         });
            //         arrrr[tt] = tb;
            //     }
            // });

            // $('#hiddenVariantOptions').val(arrrr);
        // }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <!--account edit -->
            <div id="account_edit">
                <div class="card ">
                    <div class="card-body">
                        <?php echo e(Form::model($product, ['method' => 'POST', 'id' => 'frmTarget', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('name', __('Name'), ['class' => 'col-form-label'])); ?>

                                    <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name')]); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('product_categorie', __('Product Categories'), ['class' => 'col-form-label'])); ?>

                                    <?php echo Form::select('product_categorie[]', $product_categorie, explode(',', $product->product_categorie), [
                                        'class' => 'form-control multi-select',
                                        'id' => 'note1',
                                        'data-toggle' => 'select',
                                        'multiple',
                                    ]); ?>

                                    <?php if(count($product_categorie) == 0): ?>
                                        <?php echo e(__('Add product category')); ?>

                                        <a href="<?php echo e(route('product_categorie.index')); ?>">
                                            <?php echo e(__('Click here')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('SKU', __('SKU'), ['class' => 'col-form-label'])); ?>

                                    <?php echo Form::text('SKU', null, ['class' => 'form-control', 'placeholder' => __('Enter SKU')]); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('product_tax', __('Product Tax'))); ?>

                                    <?php echo Form::select('product_tax[]', $product_tax, explode(',', $product->product_tax), [
                                        'class' => 'form-control multi-select',
                                        'id' => 'note2',
                                        'data-toggle' => 'select',
                                        'multiple',
                                    ]); ?>

                                    <?php if(count($product_tax) == 0): ?>
                                        <?php echo e(__('Add product tax')); ?>

                                        <a href="<?php echo e(route('product_tax.index')); ?>">
                                            <?php echo e(__('Click here')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php $__errorArgs = ['product_tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-product_tax" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-6 proprice">
                                <div class="form-group">
                                    <?php echo e(Form::label('price', __('Price'), ['class' => 'col-form-label'])); ?>

                                    <?php echo Form::text('price', null, ['class' => 'form-control', 'placeholder' => __('Enter Price ')]); ?>

                                </div>
                            </div>
                            <div class="col-6 proprice">
                                <div class="form-group">
                                    <?php echo e(Form::label('quantity', __('Stock Quantity'), ['class' => 'col-form-label'])); ?>

                                    <?php echo Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => __('Enter Stock Quantity')]); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="downloadable_prodcut"
                                        class="col-form-label font-bold-700"><?php echo e(__('Downloadable Product')); ?></label>
                                    <input type="file" name="downloadable_prodcut" id="downloadable_prodcut"
                                        class="form-control"
                                        onchange="document.getElementById('downProduct').src = window.URL.createObjectURL(this.files[0])"
                                        multiple>
                                    <img id="downProduct" src="" width="25%" />
                                    <small><?php echo e($product->downloadable_prodcut); ?></small>
                                </div>
                            </div>
                            <div class="col-12">
                                <h6><?php echo e(__('Custom Field')); ?> </h6>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('custom_field_1', __('Custom Field'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('custom_field_1', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Field'), 'required' => 'required'])); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('custom_value_1', __('Custom Value'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('custom_value_1', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Value'), 'required' => 'required'])); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('custom_field_2', __('Custom Field'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('custom_field_2', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Field'), 'required' => 'required'])); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('custom_value_2', __('Custom Value'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('custom_value_2', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Value'), 'required' => 'required'])); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('custom_field_3', __('Custom Field'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('custom_field_3', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Field'), 'required' => 'required'])); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('custom_value_3', __('Custom Value'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('custom_value_3', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Value'), 'required' => 'required'])); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('custom_field_4', __('Custom Field'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('custom_field_4', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Field'), 'required' => 'required'])); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('custom_value_4', __('Custom Value'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('custom_value_4', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Value'), 'required' => 'required'])); ?>

                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('product_display', __('Product Display'), ['class' => 'col-form-label'])); ?>

                                <div class="custom-control form-switch">
                                    <input type="checkbox" name="product_display" class="form-check-input"
                                        id="product_display" <?php echo e($product->product_display == 'on' ? 'checked' : ''); ?>>
                                    <?php echo e(Form::label('product_display', __('Product Display'), ['class' => 'form-check-label'])); ?>

                                </div>
                                <?php $__errorArgs = ['product_display'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-product_display" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <?php if(isset($product_variant_names) && !empty($product_variant_names)): ?>
                                <div class="form-group col-md-6 py-4">
                                    <div class="custom-control form-switch">
                                        <input type="checkbox" class="form-check-input" name="enable_product_variant"
                                            id="enable_product_variant"
                                            <?php echo e($product['enable_product_variant'] == 'on' ? 'checked' : ''); ?>>

                                        <label class="custom-control-label"
                                            for="enable_product_variant"><?php echo e(__('Display Variants')); ?></label>
                                    </div>
                                </div>
                                <div id="productVariant" class="col-md-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card my-3">
                                                <div class="card-header">
                                                    <h5 class="card-header-title"><?php echo e(__('Product Variants')); ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row form-group">
                                                        <div class="table-responsive">
                                                            <div class="card-body">
                                                                
                                                                <input type="hidden" id="hiddenVariantOptions"
                                                                    name="hiddenVariantOptions"
                                                                    value="<?php echo e($product->variants_json); ?>">
                                                                <div class="variant-table">
                                                                </div>
                                                            </div>
                                                            <table class="table variant_option_table">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <?php if(isset($product_variant_names)): ?>
                                                                            <?php $__currentLoopData = $product_variant_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <th><span><?php echo e(ucwords($variant)); ?></span>
                                                                                </th>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                        <th><span><?php echo e(__('Price')); ?></span></th>
                                                                        <th><span><?php echo e(__('Quantity')); ?></span></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if(isset($productVariantArrays)): ?>
                                                                        <?php $__currentLoopData = $productVariantArrays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter => $productVariant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <tr
                                                                                data-id="<?php echo e($productVariant['product_variants']['id']); ?>">
                                                                                <?php $__currentLoopData = explode(' : ', $productVariant['product_variants']['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <td>
                                                                                        <input type="text"
                                                                                            name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][variants][<?php echo e($key); ?>][]"
                                                                                            autocomplete="off"
                                                                                            spellcheck="false"
                                                                                            class="form-control varint_array_modify"
                                                                                            value="<?php echo e($values); ?>" readonly>
                                                                                    </td>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][price]"
                                                                                        autocomplete="off"
                                                                                        spellcheck="false"
                                                                                        placeholder="<?php echo e(__('Enter Price')); ?>"
                                                                                        class="form-control vprice_<?php echo e($counter); ?>"
                                                                                        value="<?php echo e($productVariant['product_variants']['price']); ?>">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][quantity]"
                                                                                        autocomplete="off"
                                                                                        spellcheck="false"
                                                                                        placeholder="<?php echo e(__('Enter Quantity')); ?>"
                                                                                        class="form-control vquantity_<?php echo e($counter); ?>"
                                                                                        value="<?php echo e($productVariant['product_variants']['quantity']); ?>">
                                                                                </td>
                                                                                <td
                                                                                    class="d-flex align-items-center mt-3 border-0">
                                                                                    <div class="action-btn bg-danger ms-2">
                                                                                        <?php echo Form::open([
                                                                                            'method' => 'POST',
                                                                                            'route' => ['products.variant.delete', $productVariant['product_variants']['id']],
                                                                                            'id' => 'delete-form-' . $productVariant['product_variants']['id'],
                                                                                        ]); ?>

                                                                                        <?php if($loop->iteration == 1): ?>
                                                                                            <form action=""
                                                                                                method=""></form>
                                                                                        <?php endif; ?>
                                                                                        <a href="#!"
                                                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm">
                                                                                            <span class="text-white"> <i
                                                                                                    class="ti ti-trash"></i></span>
                                                                                            <?php echo Form::close(); ?>

                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-12 border-0">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-0"><?php echo e(__('Product Image')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('sub_images', __('Upload Product Images'), ['class' => 'col-form-label'])); ?>

                                            <div class="dropzone dropzone-multiple" data-toggle="dropzone1"
                                                data-dropzone-url="http://" data-dropzone-multiple>
                                                <div class="fallback">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="dropzone-1"
                                                            name="file" multiple>
                                                        <label class="custom-file-label"
                                                            for="customFileUpload"><?php echo e(__('Choose file')); ?></label>
                                                    </div>
                                                </div>
                                                <ul
                                                    class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush">
                                                    <li class="list-group-item px-0">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar">
                                                                    <img class="rounded" src=""
                                                                        alt="Image placeholder" data-dz-thumbnail>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="text-sm mb-1" data-dz-name>...</h6>
                                                                <p class="small text-muted mb-0" data-dz-size></p>
                                                            </div>
                                                            <div class="col-auto">
                                                                <a href="#" class="dropdown-item" data-dz-remove>
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-wrapper p-3 lead-common-box">
                                                <?php $__currentLoopData = $product_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="card mb-3 border shadow-none product_Image"
                                                        data-id="<?php echo e($file->id); ?>">
                                                        <div class="px-3 py-3">
                                                            <div class="row align-items-center">
                                                                <div class="col ml-n2">
                                                                    <p class="card-text small text-muted">
                                                                        <img class="rounded"
                                                                            src=" <?php echo e(asset(Storage::url('uploads/product_image/' . $file->product_images))); ?>"
                                                                            width="70px" alt="Image placeholder"
                                                                            data-dz-thumbnail>
                                                                    </p>
                                                                </div>
                                                                <div class="col-auto actions">
                                                                    <a class="action-item"
                                                                        href=" <?php echo e(asset(Storage::url('uploads/product_image/' . $file->product_images))); ?>"
                                                                        download="" data-toggle="tooltip"
                                                                        data-original-title="<?php echo e(__('Download')); ?>">
                                                                        <i class="fas fa-download"></i>
                                                                    </a>
                                                                </div>

                                                                <div class="col-auto actions">
                                                                    <a name="deleteRecord"
                                                                        class="action-item deleteRecord"
                                                                        data-id="<?php echo e($file->id); ?>">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="is_cover_image"
                                                class="col-form-label"><?php echo e(__('Upload Cover Image')); ?></label>
                                            <input type="file" name="is_cover_image" id="is_cover_image"
                                                class="form-control"
                                                onchange="document.getElementById('coverImg').src = window.URL.createObjectURL(this.files[0])"
                                                multiple>
                                            <img id="coverImg"src="" width="20%" class="mt-2" />
                                        </div>

                                        <div class="card-wrapper p-3 lead-common-box">
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <p class="card-text small text-muted">
                                                                <img class="rounded"
                                                                    src=" <?php echo e(asset(Storage::url('uploads/is_cover_image/' . $product->is_cover))); ?>"
                                                                    width="70px" alt="Image placeholder"
                                                                    data-dz-thumbnail>
                                                            </p>
                                                        </div>
                                                        <div class="col-auto actions">
                                                            <a class="action-item"
                                                                href=" <?php echo e(asset(Storage::url('uploads/is_cover_image/' . $product->is_cover))); ?>"
                                                                download="" data-toggle="tooltip"
                                                                data-original-title="<?php echo e(__('Download')); ?>">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 pt-4">
                                <div class="form-group">
                                    <?php echo e(Form::label('description', __('Product Description'), ['class' => 'col-form-label'])); ?>

                                    <?php echo Form::textarea('description', !empty($product->description) ? $product->description : '', [
                                        'class' => 'form-control summernote-simple',
                                        'rows' => 2,
                                        'rows' => 2,
                                        'placeholder' => __('Product Description'),
                                    ]); ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 d-flex justify-content-end col-form-label">
                            <a href="<?php echo e(route('product.index')); ?>"
                                class="btn btn-secondary btn-light"><?php echo e(__('Cancel')); ?></a>
                            <input id="submit-all" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/store/public_html/resources/views/product/edit.blade.php ENDPATH**/ ?>