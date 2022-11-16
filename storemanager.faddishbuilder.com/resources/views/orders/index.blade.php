@extends('layouts.admin')
@section('page-title')
    {{__('Order')}}
@endsection
@section('title')
  {{__('Orders')}}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    
    <li class="breadcrumb-item active" aria-current="page">{{ __('Orders') }}</li>
@endsection
@section('action-btn')
    <div class="row  m-1">
        <div class="col-auto pe-0">
             <a href="{{route('order.export', $store->id)}} " class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-original-title="{{__('Export')}}"  >
                <i class="ti ti-file-export text-white"></i>
            </a>
        </div>
    </div>
@endsection
@section('filter')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('Order') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Value') }}</th>
                                    <th>{{ __('Payment Type') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id)) }}"
                                                class="btn btn-sm btn-white btn-icon order-badge btn-outline-primary">
                                                <span class="btn-inner--text">{{ '#' . $order->order_id }}</span>
                                            </a>
                                        </th>
                                        <td class="order">
                                            <span
                                                class="h6 text-sm font-weight-bold mb-0">{{ \App\Models\Utility::dateFormat($order->created_at) }}</span>
                                        </td>
                                        <td>
                                            <span class="client">{{ $order->name }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="value text-sm mb-0">{{ \App\Models\Utility::priceFormat($order->price) }}</span>
                                        </td>
                                        <td>
                                            <span class="taxes text-sm mb-0">{{ $order->payment_type }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex  justify-content-between">
                                                <div class="col-auto">
                                                    @if ($order->status != 'Cancel Order')
                                                    <button type="button"
                                                        class="btn btn-sm {{ $order->status == 'pending' ? 'btn-soft-info' : 'btn-soft-success' }} btn-icon rounded-pill">
                                                        <span class="btn-inner--icon">
                                                            @if ($order->status == 'pending')
                                                                <i class="fas fa-check soft-success"></i>
                                                            @else
                                                                <i class="fa fa-check-double soft-success"></i>
                                                            @endif
                                                        </span>
                                                        @if ($order->status == 'pending')
                                                            <span class="btn-inner--text">
                                                                {{ __('Pending') }}:
                                                                {{ \App\Models\Utility::dateFormat($order->created_at) }}
                                                            </span>
                                                        @else
                                                            <span class="btn-inner--text">
                                                                {{ __('Delivered') }}:
                                                                {{ \App\Models\Utility::dateFormat($order->updated_at) }}
                                                            </span>
                                                        @endif
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm btn-soft-danger btn-icon rounded-pill">
                                                        <span class="btn-inner--icon">
                                                            @if ($order->status == 'pending')
                                                                <i class="fas fa-check soft-success"></i>
                                                            @else
                                                                <i class="fa fa-check-double soft-success"></i>
                                                            @endif
                                                        </span>
                                                        <span class="btn-inner--text">
                                                            {{ __('Cancel Order') }}:
                                                            {{ \App\Models\Utility::dateFormat($order->created_at) }}
                                                        </span>
                                                    </button>
                                                @endif
                                                </div>
                                                <div class="col-auto">
                                                    <span class="">
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="{{ route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id)) }}"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="{{ __('View') }}"><i
                                                                    class="ti ti-eye text-white"></i></a>
                                                        </div>
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['orders.destroy', $order->id],'id'=>'delete-form-'.$order->id]) !!}
                                                            <a class="show_confirm align-items-center btn btn-sm d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Delete')}}">
                                                               <span class="text-white"><i class="ti ti-trash"></i></span>
                                                            </a>
                                                          
                                                               
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </span>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                {{-- @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if (!empty($product->is_cover))
                                                    <img alt="Image placeholder"
                                                        src="{{ asset(Storage::url('uploads/is_cover_image/' . $product->is_cover)) }}"
                                                        class="rounded-circle" alt="images">
                                                @else
                                                    <img alt="Image placeholder"
                                                        src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                        class="rounded-circle" alt="images">
                                                @endif
                                                <div class="ms-3">
                                                    <a href="{{ route('product.show', $product->id) }}"
                                                        class="name h6 mb-0 text-sm">
                                                        {{ $product->name }}
                                                    </a>
                                                    <span class="static-rating static-rating-sm d-block">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @php
                                                                $icon = 'fa-star';
                                                                $color = '';
                                                                $newVal1 = $i - 0.5;
                                                                if ($product->product_rating() < $i && $product->product_rating() >= $newVal1) {
                                                                    $icon = 'fa-star-half-alt';
                                                                }
                                                                if ($product->product_rating() >= $newVal1) {
                                                                    $color = 'text-warning';
                                                                }
                                                            @endphp
                                                            <i class="fas {{ $icon . ' ' . $color }}"></i>
                                                        @endfor
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td> {{ !empty($product->product_category()) ? $product->product_category() : '-' }}
                                        </td>
                                        <td>
                                            @if ($product->enable_product_variant == 'on')
                                                {{ __('In Variant') }}
                                            @else
                                                {{ \App\Models\Utility::priceFormat($product->price) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->enable_product_variant == 'on')
                                                {{ __('In Variant') }}
                                            @else
                                                {{ $product->quantity }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->enable_product_variant == 'on')
                                                <span class="badge bg-success p-2 px-3 rounded">
                                                    {{ __('In Variant') }}
                                                </span>
                                            @else
                                                @if ($product->quantity == 0)
                                                    <span class="badge bg-danger p-2 px-3 rounded">
                                                        {{ __('Out of stock') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-primary p-2 px-3 rounded">
                                                        {{ __('In stock') }}
                                                    </span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{ \App\Models\Utility::dateFormat($product->created_at) }}
                                        </td>
                                        <td class="Action">
                                            <span>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="{{ route('product.show', $product->id) }}"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-toggle="tooltip" data-original-title="{{ __('View') }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ __('View') }}"><i
                                                            class="ti ti-eye text-white"></i></a>
                                                </div>

                                                <div class="action-btn btn-primary ms-2">
                                                    <a href="{{ route('product.edit', $product->id) }}"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ __('Edit Product') }}"><i
                                                            class="ti ti-pencil text-white"></i></a>
                                                </div>
                                                <div class="action-btn bg-danger ms-2">
                                                    <a class="bs-pass-para align-items-center btn btn-sm d-inline-flex"
                                                        href="#" data-title="{{ __('Delete Lead') }}"
                                                        data-confirm="{{ __('Are You Sure?') }}"
                                                        data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="delete-form-{{ $product->id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ __('Delete ') }}">

                                                        <i class="ti ti-trash"></i>

                                                    </a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id], 'id' => 'delete-form-' . $product->id]) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
