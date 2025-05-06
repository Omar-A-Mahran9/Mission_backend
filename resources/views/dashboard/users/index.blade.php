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
                    <h3 class="fw-bold m-0">{{ __('Users list') }}</h3>
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
                            placeholder="{{ __('Search for users') }}" />
                    </div>
                    <!--end::Search-->
                    <!--begin::Select2-->
                    <div style="width: 135px;margin: 0 15px;">

                        <select class="form-select form-select-solid filter-input" data-control="select2"
                            data-hide-search="true" data-placeholder="{{ __('Status') }}" data-filter-index="4"
                            data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                            <option></option>
                            <option value="0">{{ __('All') }}</option>
                            <option value="1">{{ __('Active') }}</option>
                            <option value="2">{{ __('InActive') }}</option>
                        </select>
                    </div>
                    <!--end::Select2-->
                </div>
                <!--end::Card title-->

            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                #
                            </th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="text-start">{{ __('Created at') }}</th>
                            <th>{{ __('Actions') }}</th>
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
    <script src="{{ asset('assets/js/datatables/users.js') }}"></script>
    <script src="{{ asset('assets/js/global/crud-operations.js') }}"></script>
@endpush
