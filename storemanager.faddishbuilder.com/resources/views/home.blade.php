@extends('layouts.admin')
@section('page-title')
    {{ __('Dashboard') }}
@endsection
@push('script-page')
<script>
    var today = new Date()
    var curHr = today.getHours()
    var target = document.getElementById("greetings")

    if (curHr < 12) {
        target.innerHTML = "{{ __('Good Morning,') }}";
    } else if (curHr < 17) {
        target.innerHTML = "{{ __('Good Afternoon,') }}";
    } else {
        target.innerHTML = "{{ __('Good Evening,') }}";
    }
</script>
@endpush
@section('content')
    @php
    // $logo = asset(Storage::url('uploads/logo/'));
    $logo=\App\Models\Utility::get_file('uploads/logo/');
    $company_logo = \App\Models\Utility::getValByName('company_logo');
    $profile=\App\Models\Utility::get_file('uploads/profile/');
    $logo1=\App\Models\Utility::get_file('uploads/is_cover_image/');
    @endphp
    <!-- [ Main Content ] start -->
    @if (\Auth::user()->type == 'Owner')
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xxl-5">
                        <div class="card dash-card">
                            <div class="card-body  mb-4">
                                <div class="row align-items-center">
                                    <div class="col-xxl-12">
                                        <h3 class="mb-1" id="greetings"></h3>
                                        <h4 class="f-w-400">
                                            {{-- <a href="{{ asset(Storage::url('uploads/profile/' . (!empty(Auth::user()->avatar) ? Auth::user()->avatar : 'avatar.png'))) }}" target="_blank"> --}}
                                            <img
                                            src="{{ !empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png' }}"
                                                class="wid-35 me-2 img-thumbnail rounded-circle">
                                            {{-- </a> --}}

                                            {{ __(Auth::user()->name) }}</h4>
                                        <p class="text-sm">{{__('Have a nice day! Did you know that you can quickly add your favorite product or category to the store?')}}</p>
                                        <div class="dropdown quick-add-btn">
                                            <a class="btn btn-primary btn-sm btn-q-add dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                               role="button" aria-haspopup="false" aria-expanded="false">
                                                <i class="ti ti-plus drp-icon "></i>
                                                <span class="ms-2 me-2">{{__('Quick add')}}</span>
                                            </a>
                                            <div class ="dropdown-menu">
                                                <a href="{{ route('product.create') }}" class="dropdown-item"><span>{{__('Add new product')}}</span></a>
                                                <a href="#" data-size="md" data-url="{{ route('product_tax.create') }}" data-ajax-popup="true"
                                                   data-title="{{ __('Create New Product Tax') }}" class="dropdown-item"
                                                    data-bs-placement="top "><span>{{__('Add new product tax')}}</span></a>

                                                <a href="#" data-size="md" data-url="{{ route('product_categorie.create') }}" data-ajax-popup="true"
                                                   data-title="{{ __('Create New Product Category') }}" class="dropdown-item"
                                                   data-bs-placement="top"><span>{{__('Add new product category')}}</span></a>

                                                <a href="#" data-size="md" data-url="{{ route('product-coupon.create') }}" data-ajax-popup="true"
                                                   data-title="{{ __('Create New Product Coupon') }}" class="dropdown-item"
                                                   data-bs-placement="top "><span>{{__('Add new product coupon')}}</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-7">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="card dash-card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-primary qrcode">
                                            {!! QrCode::generate($store_id['store_url']) !!}
                                        </div>
                                        {{-- @dd($store_id['store_url'] ) --}}
                                        <h6 class="mb-3 mt-4 ">{{ $store_id->name }}</h6>
                                        <a href="#" class="btn btn-primary btn-sm text-sm cp_link"
                                            data-link="{{ $store_id['store_url'] }}" data-toggle="tooltip"
                                            data-original-title="{{ __('Click to copy link') }}">{{ __('Store Link') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card dash-card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-info">
                                            <i class="fas fa-cube"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 ">{{ __('Total Products') }}</h6>
                                        <h4 class="mb-0">{{ $newproduct }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card dash-card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-warning">
                                            <i class="fas fa-cart-plus"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 ">{{ __('Total Sales') }}</h6>
                                        <h4 class="mb-0">{{ \App\Models\Utility::priceFormat($totle_sale) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card dash-card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-danger">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 ">{{ __('Total Orders') }}</h6>
                                        <h4 class="mb-0">{{ $totle_order }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-5">
                            <div class="card min-h-390 overflow-auto top-card">
                                <div class="card-header d-flex justify-content-between ">
                                    <h5>{{ __('Top Products') }}</h5>
                                    <span class="float-right">{{ __('Top') . ' 5 ' . __('Products') }}</span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">
                                                {{ __('Product') }}
                                                </th>
                                            <th scope="col" class="sort" data-sort="budget">
                                                {{ __('Quantity') }}
                                            </th>
                                            <th scope="col" class="sort text-right" data-sort="completion">
                                                {{ __('Price') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($products as $product)
                                            @foreach ($item_id as $k => $item)
                                                @if ($product->id == $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @if (!empty($product->is_cover))
                                                                {{-- <a href="{{ asset(Storage::url('uploads/is_cover_image/' . $product->is_cover)) }}" target="_blank">
                                                                    <img src="{{ asset(Storage::url('uploads/is_cover_image/' . $product->is_cover)) }}"
                                                                        class="wid-25" alt="images">
                                                                </a> --}}
                                                                <a href="{{$logo1.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')}}" target="_blank">
                                                                    <img alt="Image placeholder" alt="your image" src="{{$logo1.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')}}" class="wid-25" alt="images">
                                                                </a>
                                                            @else
                                                                {{-- <a href="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}" target="_blank">
                                                                    <img src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                                    class="wid-25" alt="images">
                                                                </a> --}}
                                                                <a href="{{$logo1.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')}}" target="_blank">
                                                                    <img alt="Image placeholder" alt="your image" src="{{$logo1.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')}}" class="wid-25" alt="images">
                                                                </a>
                                                            @endif
                                                                <div class="ms-3">
                                                                    <h6 class="m-0">{{ $product->name }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h6 class="m-0">{{ $product->quantity }}</h6>
                                                        </td>
                                                        <td>
                                                            <small
                                                                class="text-muted">{{ \App\Models\Utility::priceFormat($product->price) }}</small>
                                                            <h6 class="m-0">{{ $totle_qty[$k] }}
                                                                {{ __('Sold') }}</h6>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-7">
                        <div class="card ">
                            <div class="card-header">
                                <h5>{{ __('Order') }}</h5>
                            </div>
                            <div class="card-body chart-card">
                                <div id="apex-dashborad" data-color="primary" data-height="230"></div>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header card-body table-border-style">
                                <h5></h5>
                                <div class="table-responsive">
                                    <table class="table pc-dt-simple">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ __('Order') }}</th>
                                                <th scope="col" class="sort">{{ __('Date') }}</th>
                                                <th scope="col" class="sort">{{ __('Name') }}</th>
                                                <th scope="col" class="sort">{{ __('Value') }}</th>
                                                <th scope="col" class="sort">{{ __('Payment Type') }}</th>
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(!empty($new_orders))
                                                @foreach ($new_orders as $order)
                                                    @if ($order->status != 'Cancel Order')
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <a href="{{ route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id)) }}"
                                                                        class="btn btn-outline-primary  btn-sm text-sm cp_link"
                                                                        data-link="{{ $store_id['store_url'] }}"
                                                                        data-toggle="tooltip"
                                                                        data-original-title="{{ __('Click to copy link') }}">

                                                                        <span
                                                                            class="btn-inner--text">{{ $order->order_id }}</span>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-0">
                                                                    {{ \App\Models\Utility::dateFormat($order->created_at) }}
                                                                </h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-0">{{ $order->name }}</h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-0">
                                                                    {{ \App\Models\Utility::priceFormat($order->price) }}
                                                                    <h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-0">{{ $order->payment_type }}<h6>
                                                            </td>
                                                            <td>
                                                                <div class="actions ml-3">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-end">
                                                                        <labal
                                                                            class="btn btn-sm {{ $order->status == 'pending' ? 'btn-soft-info' : 'btn-soft-success' }} btn-icon rounded-pill">
                                                                            <span class="btn-inner--icon">
                                                                                @if ($order->status == 'pending')
                                                                                    <i class="fas fa-check soft-info"></i>
                                                                                @else
                                                                                    <i
                                                                                        class="fa fa-check-double soft-success"></i>
                                                                                @endif
                                                                            </span>
                                                                            @if ($order->payment_status == 'approved' && $order->status == 'pending')
                                                                                <span class="btn-inner--text">
                                                                                    {{ __('Paid') }}:
                                                                                    {{ \App\Models\Utility::dateFormat($order->created_at) }}
                                                                                @else
                                                                                </span><span class="btn-inner--text">
                                                                                    {{ __('Delivered') }}:
                                                                                    {{ \App\Models\Utility::dateFormat($order->updated_at) }}
                                                                                </span>
                                                                            @endif
                                                                        </labal>
                                                                        <div class="action-btn bg-warning ms-2">
                                                                            <a href="{{ route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id)) }}"
                                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip"
                                                                            data-title="{{ __('Details') }}">
                                                                                <i class="ti ti-eye text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    @else
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-primary">
                                            <i class="fas fa-cube"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 ">{{ __('Total Store') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_user }}</h3>
                                        {{-- <h6 class="mb-3 mt-4 ">{{ __('Paid Store') }}</h6>
                                        <h3 class="mb-0">{{ $user['total_paid_user'] }}</h3> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-warning">
                                            <i class="fas fa-cart-plus"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 ">{{ __('Total Orders') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_orders }}</h3>
                                        {{-- <h6 class="mb-3 mt-4 ">{{ __('Total Order Amount') }}</h6>
                                        <h3 class="mb-0">
                                            {{ env('CURRENCY_SYMBOL') . $user['total_orders_price'] }}</h3> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="theme-avtar bg-danger">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div>
                                        <h6 class="mb-3 mt-4 ">{{ __('Total Plans') }}</h6>
                                        <h3 class="mb-0">{{ $user['total_plan'] }}</h3>
                                        {{-- <h6 class="mb-3 mt-4 ">{{ __('Most Purchase Plan') }}</h6>
                                        <h3 class="mb-0">
                                            {{ !empty($user['most_purchese_plan']) ? $user['most_purchese_plan'] : '-' }}</h3> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Recent Order') }}</h5>
                            </div>
                            <div class="card-body">
                                <div id="plan_order" data-color="primary" data-height="230"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    @endif
    <!-- [ Main Content ] end -->
@endsection
@push('script-page')
    @if (\Auth::user()->type == 'Owner')
        <script>
            $(document).ready(function() {
                $('.cp_link').on('click', function() {
                    var value = $(this).attr('data-link');
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(value).select();
                    document.execCommand("copy");
                    $temp.remove();
                    show_toastr('Success', '{{ __('Link copied') }}', 'success')
                });
            });

            (function() {
                var options = {
                    chart: {
                        height: 250,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },


                    series: [{
                        name: "Order",
                        data: {!! json_encode($chartData['data']) !!}
                    }],

                    xaxis: {
                        axisBorder: {
                            show: !1
                        },
                        type: "MMM",
                        categories: {!! json_encode($chartData['label']) !!}
                    },
                    colors: ['#e83e8c'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    // markers: {
                    //     size: 4,
                    //     colors: ['#FFA21D'],
                    //     opacity: 0.9,
                    //     strokeWidth: 2,
                    //     hover: {
                    //         size: 7,
                    //     }
                    // },
                    yaxis: {
                        tickAmount: 3,
                    }
                };
                var chart = new ApexCharts(document.querySelector("#apex-dashborad"), options);
                chart.render();
            })();
            var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                target: '#useradd-sidenav',
                offset: 300
            })
        </script>
    @else
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 250,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },


                    series: [{
                        name: "Order",
                        data: {!! json_encode($chartData['data']) !!}
                        // data: [10,20,30,40,50,60,70,40,20,50,60,20,50,70]
                    }],

                    xaxis: {
                        axisBorder: {
                            show: !1
                        },
                        type: "MMM",
                        categories: {!! json_encode($chartData['label']) !!}
                    },
                    colors: ['#e83e8c'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    // markers: {
                    //     size: 4,
                    //     colors: ['#FFA21D'],
                    //     opacity: 0.9,
                    //     strokeWidth: 2,
                    //     hover: {
                    //         size: 7,
                    //     }
                    // },
                    yaxis: {
                        tickAmount: 3,
                    }
                };
                var chart = new ApexCharts(document.querySelector("#plan_order"), options);
                chart.render();
            })();
        </script>
    @endif
@endpush

