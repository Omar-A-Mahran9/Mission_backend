@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/js/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                <!--begin::Card-->
                <div class="card card-flush pt-3 mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2 class="fw-bold">{{ __('Product Details') }}</h2>
                        </div>
                        <!--begin::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-3">
                        <!--begin::Section-->
                        <div class="mb-10">
                            <!--begin::Details-->
                            <div class="d-flex flex-wrap py-5">
                                <!--begin::Row-->
                                <div class="flex-equal me-5">
                                    <!--begin::Details-->
                                    <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500 min-w-175px w-175px">{{ __('Name') }}:</td>
                                            <td class="text-gray-800">
                                                {{ $product->name }}
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">{{ __('Base Price') }}:</td>
                                            <td class="text-gray-800">{{ $product->product_price }}</td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">{{ __('Bidding Price') }}:</td>
                                            <td class="text-gray-800">{{ $product->bid_price }}</td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">{{ __('Opening Price') }}:</td>
                                            <td class="text-gray-800">{{ $product->start_price }}</td>
                                        </tr>
                                        <!--end::Row-->
                                    </table>
                                    <!--end::Details-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="flex-equal">
                                    <!--begin::Details-->
                                    <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500 min-w-175px w-175px">
                                                {{ __('Description') }}:</td>
                                            <td class="text-gray-800 min-w-200px">
                                                {{ $product->description }}
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">{{ __('Minimum bid') }}:</td>
                                            <td class="text-gray-800">{{ $product->minimum_bid }}</td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">{{ __('Start Time') }}:</td>
                                            <td class="text-gray-800">
                                                {{ $product->start_time->toDateString() . ' ' . $product->start_time->format('h:i:s') . ' ' . ($product->start_time->format('A') == 'PM' ? __('PM') : __('AM')) }}
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <tr>
                                            <td class="text-gray-500">{{ __('End Time') }}:</td>
                                            <td class="text-gray-800">
                                                {{ $product->end_time->toDateString() . ' ' . $product->end_time->format('h:i:s') . ' ' . ($product->end_time->format('A') == 'PM' ? __('PM') : __('AM')) }}
                                            </td>
                                        </tr>
                                        <!--end::Row-->
                                    </table>
                                    <!--end::Details-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <div class="mb-0">
                            <!--begin::Title-->
                            <h5 class="mb-4">{{ __('Bidding Layers') }}:</h5>
                            <!--end::Title-->
                            <!--begin::Product table-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-4 mb-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr
                                            class="border-bottom border-gray-200 text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-150px">{{ __('Bidding Discount Percentage') }}</th>
                                            <th class="min-w-125px">{{ __('Bidding Percentage After Discount') }}</th>
                                            <th class="min-w-125px">{{ __('Created at') }}</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-semibold text-gray-800">
                                        @foreach ($product->productBiddings as $bidding)
                                            <tr>
                                                <td>{{ $bidding->bidding_discount_percentage }} %</td>
                                                <td>{{ $bidding->final_bidding_percentage }} %</td>
                                                <td>{{ $bidding->created_at->toDateString() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Product table-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-flush pt-3 mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ __('Refunded Tickets') }} ({{ $product->refunds_count }})</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <a href="#" class="btn btn-light-primary">{{ __('View All Refunded Tickets') }}</a>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table id="kt_datatable"
                                class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-5"
                                id="kt_table_customers_events">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr
                                        class="border-bottom border-gray-200 text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-150px">{{ __('User Name') }}</th>
                                        <th class="min-w-125px">{{ __('Reason') }}</th>
                                        <th class="min-w-125px">{{ __('Status') }}</th>
                                        <th class="min-w-125px">{{ __('Created at') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600" id="table-body">
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->

            </div>
            <!--end::Content-->
            <!--begin::Sidebar-->
            @if ($product->winners->first())
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
                    <!--begin::Card-->
                    <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary"
                        data-kt-sticky-offset="{default: false, lg: '200px'}"
                        data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto"
                        data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <!--begin::Card header-->

                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <i class="ki-outline ki-medal-star fs-1"></i>
                                <h2>{{ __('Winner') }}</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 fs-6">
                            <!--begin::Section-->
                            <div class="mb-7">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-60px symbol-circle me-3">
                                        <img alt="Pic"
                                            src="{{ $product->winners->first()->user->full_image_path }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="fs-4 fw-bold text-gray-900 text-hover-primary me-2">{{ $product->winners->first()->user->name }}</a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <a href="#"
                                            class="fw-semibold text-gray-600 text-hover-primary">{{ $product->winners->first()->user->email }}</a>
                                        <!--end::Email-->
                                        <!--begin::Phone-->
                                        <a href="#"
                                            class="fw-semibold text-gray-600 text-hover-primary">{{ $product->winners->first()->user->phone }}</a>
                                        <!--end::Phone-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Section-->
                            <div class="mb-7">
                                <!--begin::Title-->
                                <h5 class="mb-4">{{ __('Bidding Details') }}</h5>
                                <!--end::Title-->
                                <!--begin::Details-->
                                <div class="mb-0">
                                    <!--begin::Plan-->
                                    <span class="fw-semibold text-gray-600">{{ __('Bidding Amount') }}:</span>
                                    <!--end::Plan-->
                                    <!--begin::Price-->
                                    <span
                                        class="fw-semibold text-gray-800">{{ $product->winners->first()->bid->amount . ' ' . __('SAR') }}</span>
                                    <!--end::Price-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Details-->
                                <div class="mb-0">
                                    <!--begin::Plan-->
                                    <span class="fw-semibold text-gray-600">{{ __('Created at') }}:</span>
                                    <!--end::Plan-->
                                    <!--begin::Price-->
                                    <span
                                        class="fw-semibold text-gray-800">{{ $product->winners->first()->bid->created_at->toDateString() }}</span>
                                    <!--end::Price-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Section-->
                            <div class="mb-10">
                                <!--begin::Title-->
                                <h5 class="mb-4">{{ __('Payment Details') }}</h5>
                                <!--end::Title-->
                                <!--begin::Details-->
                                <div class="mb-0">
                                    <!--begin::Card info-->
                                    <div class="fw-semibold text-gray-600 d-flex align-items-center">
                                        {{ $product->winners->first()->is_bought ? __('Paid') : __('Unpaid') }}
                                    </div>
                                    <!--end::Card info-->
                                    <!--begin::Card expiry-->
                                    @if ($product->winners->first()->is_bought)
                                        <div class="fw-semibold text-gray-600">
                                            {{ $product->winners->first()->paid_at->toDateString() . ' ' . $product->winner->paid_at->format('h:i:s') . ' ' . ($product->winner->paid_at->format('A') == 'PM' ? __('PM') : __('AM')) }}
                                        </div>
                                    @endif
                                    <!--end::Card expiry-->
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Seperator-->
                            <div class="separator separator-dashed mb-7"></div>
                            <!--end::Seperator-->
                            <!--begin::Section-->
                            <div class="mb-10">
                                <!--begin::Title-->
                                <h5 class="mb-4">{{ __('Address Details') }}</h5>
                                <!--end::Title-->
                                <!--begin::Details-->
                                <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2">
                                    <!--begin::Row-->
                                    <tr class="">
                                        <td class="text-gray-500">{{ __('Address') }}:</td>
                                        <td class="text-gray-800">
                                            {{ $product->winners->first()->address->city->name . ',' . $product->winners->first()->address->address }}
                                        </td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr class="">
                                        <td class="text-gray-500">{{ __('Delivery') }}:</td>
                                        <td class="text-gray-800"><span
                                                class="badge badge-{{ $product->winners->first()->is_deliverd ? 'light-success' : 'light-danger' }}">{{ $product->winners->first()->is_deliverd ? __('Yes') : __('No') }}</span>
                                        </td>
                                    </tr>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <tr class="">
                                        <td class="text-gray-500">{{ __('Delivered Date') }}:</td>
                                        <td class="text-gray-800">
                                            {{ optional($product->winners->first())->deliverd_at ? $product->winners->first()->deliverd_at : '--' }}
                                        </td>
                                    </tr>
                                    <!--end::Row-->
                                </table>
                                <!--end::Details-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Actions-->
                            @if (!$product->winners->first()->is_deliverd)
                                <div class="mb-0">
                                    <form action="{{ route('dashboard.delivery', $product->winners->first()) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary"
                                            id="kt_subscriptions_create_button">{{ __('Update Delivery Status') }}</button>
                                    </form>

                                </div>
                            @endif
                            <!--end::Actions-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
            @endif

            <!--end::Sidebar-->
        </div>
        <!--end::Layout-->
    </div>
    <!--end::Content-->
@endsection
@push('scripts')
    <script>
        window.isArabic = '{{ isArabic() }}';
    </script>
    <script>
        let productId = {{ $product->id }};
    </script>
    <script src="{{ asset('assets/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{--  <script src="{{ asset('assets/js/datatables/datatables.bundle.js') }}"></script>  --}}
    <script src="{{ asset('assets/js/datatables/product-show.js') }}"></script>
    <script src="{{ asset('assets/js/global/crud-operations.js') }}"></script>
@endpush
