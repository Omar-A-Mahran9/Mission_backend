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
        <!--begin::Products-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">{{ __('Promo Codes list') }}</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">

                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                        <input type="text" data-kt-docs-table-filter="search"
                            class="form-control form-control-solid w-250px ps-12"
                            placeholder="{{ __('Search for promo codes') }}" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <div class="w-100 mw-150px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                            data-placeholder="{{ __('Status') }}"
                            data-kt-ecommerce-product-filter="status"data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                            <option></option>
                            <option value="all">All</option>
                            <option value="published">Published</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <!--begin::Add product-->
                    <a href="{{ route('dashboard.products.create') }}"
                        class="btn btn-primary">{{ __('Create Promo Code') }}</a>
                    <!--end::Add product-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                        <div class="fw-bold me-5">
                            <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('Selected item') }}
                        </div>
                        <button type="button" class="btn btn-danger"
                            data-kt-docs-table-select="delete_selected">{{ __('delete') }}</button>
                    </div>
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_datatable .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="text-start ">{{ __('Code') }}</th>
                            <th class="">{{ __('Value') }}</th>
                            <th class="">{{ __('Start Date') }}</th>
                            <th class="">{{ __('End Date') }}</th>
                            <th class="">{{ __('Usage Limit') }}</th>
                            <th class="">{{ __('Status') }}</th>
                            <th class="">{{ __('Created at') }}</th>
                            <th class="">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Products-->
    </div>
    <!--end::Content-->
@endsection

@push('scripts')
    <script>
        window.isArabic = '{{ isArabic() }}';
    </script>
    <script src="{{ asset('assets/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/promo-codes.js') }}"></script>
    <script src="{{ asset('assets/js/global/crud-operations.js') }}"></script>
@endpush
