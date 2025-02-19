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

        <!--begin::Form-->
        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
            data-kt-redirect="apps/ecommerce/catalog/products.html">

            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{ __('Create Product') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin:::Content-->
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Product Details') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Name In Arabic') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="name_ar" id="name_ar_inp"
                                        class="form-control form-control-solid mb-2"
                                        placeholder="{{ __('Write the product name in Arabic') }}" value="" />
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="name_ar">
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Name In English') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="product_name" class="form-control form-control-solid mb-2"
                                        placeholder="{{ __('Write the product name in English') }}"name="name_en"
                                        id="name_en_inp" value="" />
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="name_en">
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Description In Arabic') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <textarea class="form-control form-control-lg form-control-solid mb-3" rows="1" name="description_ar"
                                        id="description_ar_inp" data-kt-autosize="true" placeholder="{{ __('Write the description in Arabic') }}"></textarea>
                                    <!--end::Editor-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Description In English') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <textarea class="form-control form-control-lg form-control-solid mb-3" name="description_en" id="description_en_inp"
                                        rows="1" data-kt-autosize="true" placeholder="{{ __('Write the description in English') }}"></textarea>
                                    <!--end::Editor-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                    <!--begin::Media-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Product images') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="fv-row mb-2">
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="dropzone_input">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="ki-outline ki-file-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">
                                                {{ __('Drop files here or click to upload') }}</h3>
                                            <span
                                                class="fs-7 fw-semibold text-gray-500">{{ __('Upload up to 10 images') }}</span>
                                        </div>
                                        <!--end::Info-->
                                        <input class="d-none" type="file" id="images_input" name="images[]" multiple>
                                    </div>
                                    <div class="fv-plugins-message-container invalid-feedback" id="images"></div>

                                </div>
                                <!--end::Dropzone-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Media-->
                    <!--begin::Pricing-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Price details') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Base Price') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="product_price" class="form-control mb-2"
                                        placeholder="{{ __('Write the basic product price') }}" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Opening Price') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="start_price" class="form-control mb-2"
                                        placeholder="{{ __('Write the opening product price') }}" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Bidding Price') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="start_price" class="form-control mb-2"
                                        placeholder="{{ __('Write the bidding price for the product') }}"
                                        value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Ticket price') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="ticket_price" class="form-control mb-2"
                                        placeholder="{{ __('Write the ticket price for the product') }}"
                                        value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end:Tax-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Pricing-->
                </div>
                <!--end::Content-->
                <div class="d-flex justify-content-end">
                    <!--begin::Button-->
                    <a href="apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel"
                        class="btn btn-light me-5">Cancel</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                        <span class="indicator-label">Save Changes</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
            <!--end::Main column-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
@endsection
@push('scripts')
    <script>
        window.isArabic = '{{ isArabic() }}';
    </script>
    <script src="{{ asset('assets/js/components/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/global/crud-operations.js') }}"></script>
@endpush
