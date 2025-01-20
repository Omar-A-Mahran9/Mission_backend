@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')
    @include('dashboard.partials.settings-nav')

    <!--begin::Form-->
    <form class="form d-flex flex-column flex-lg-row ajax-form"
        action="{{ route('dashboard.settings.store-related-products-filters') }}" method="post"
        data-success-callback="onAjaxSuccess" data-hide-alert="true">
        @csrf
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="settings_terms" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ __('Filters') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('Vendors') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select class="form-select form-select" multiple="multiple" data-control="select2"
                                            id="vendors_inp" data-placeholder="{{ __('Choose the vendors') }}"
                                            name="vendors[]" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->id }}"
                                                    @foreach ($vendorsIDs as $vendorID) {{ $vendorID == $vendor->id ? 'selected' : '' }} @endforeach>
                                                    {{ $vendor->brand ?? $vendor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!--end::Select2-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="vendors"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('Filter elements') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select class="form-select form-select" multiple="multiple" data-control="select2"
                                            name="filters[]" id="filters_inp"
                                            data-placeholder="{{ __('Choose the elements') }}"
                                            data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                            <option value="price"
                                                @foreach ($vendorsFilters as $vendorFilter) {{ $vendorFilter == 'price' ? 'selected' : '' }} @endforeach>
                                                {{ __('Price') }} </option>
                                            <option value="category"
                                                @foreach ($vendorsFilters as $vendorFilter) {{ $vendorFilter == 'category' ? 'selected' : '' }} @endforeach>
                                                {{ __('Category') }} </option>
                                            <option value="subcategory"
                                                @foreach ($vendorsFilters as $vendorFilter) {{ $vendorFilter == 'subcategory' ? 'selected' : '' }} @endforeach>
                                                {{ __('The same product') }} </option>
                                        </select>
                                        <!--end::Select2-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="filters"></div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Inventory-->
                    </div>
                </div>
                <!--end::Tab pane-->
            </div>
            <!--end::Tab content-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <button type="submit" id="submit" class="btn btn-primary">
                    <span class="indicator-label"> {{ __('Save') }}</span>
                    <span class="indicator-progress"> {{ __('Please wait ...') }}
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    <!--end::Form-->
@endsection
@push('scripts')
    <script>
        window['onAjaxSuccess'] = () => {
            showToast();
        }
    </script>
@endpush
