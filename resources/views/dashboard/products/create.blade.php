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
        <form action="{{ route('dashboard.products.store') }}" data-redirection-url="{{ route('dashboard.products.index') }}"
            id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row ajax-form" method="POST">

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
                            <!--begin::Input group-->
                            <div class="d-flex flex-wrap gap-5">
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Start Time') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="input-group" id="start_time_date">
                                        <input type="text" name="start_time" id="start_time_inp"
                                            placeholder="{{ __('Pick date & time') }}"
                                            class="form-control form-control datetimepicker" />
                                        <span class="input-group-text" data-td-target="#start_time_date"
                                            data-td-toggle="datetimepicker">
                                            <i class="bi bi-calendar-check fs-2"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </span>
                                    </div>
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="start_time">
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('End Time') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div class="input-group" id="end_time_date">
                                        <input type="text" name="end_time" id="end_time_inp"
                                            placeholder="{{ __('Pick date & time') }}"
                                            class="form-control form-control datetimepicker" />
                                        <span class="input-group-text" data-td-target="#end_time_date"
                                            data-td-toggle="datetimepicker">
                                            <i class="bi bi-calendar-check fs-2"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </span>
                                    </div>
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="end_time"></div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                    <!--begin::Image-->
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
                    <!--end::Image-->
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
                                    <input type="text" name="product_price"
                                        class="form-control form-control-solid mb-2"
                                        placeholder="{{ __('Write the basic product price') }}" value="" />
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="product_price">
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Opening Price') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="start_price" class="form-control form-control-solid mb-2"
                                        placeholder="{{ __('Write the opening product price') }}" value="" />
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="start_price">
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Bidding Price') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="bid_price" class="form-control form-control-solid mb-2"
                                        placeholder="{{ __('Write the bidding price for the product') }}"
                                        value="" />
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="bid_price">
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ __('Ticket price') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="ticket_price"
                                        class="form-control form-control-solid mb-2"
                                        placeholder="{{ __('Write the ticket price for the product') }}"
                                        value="" />
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="ticket_price">
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="d-flex flex-wrap gap-5">
                                <div class="fv-row w-100 flex-md-root">
                                    <!--begin::Repeater-->
                                    <div id="variations">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <!--begin::Label-->
                                            <label class="form-label">Add Product Variations</label>
                                            <!--end::Label-->
                                            <div data-repeater-list="variations" class="d-flex flex-column gap-3">
                                                <div data-repeater-item>
                                                    <div class="form-group row">
                                                        <div class="d-flex flex-column flex-md-row gap-5">
                                                            <div class="fv-row flex-row-fluid">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="required form-label">{{ __('Bidding Discount') }}
                                                                    %</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input
                                                                    class="form-control form-control-solid mb-2 no-arrow"
                                                                    type="number" step="0.1"
                                                                    name="bidding_discount_percentage" min="1"
                                                                    id="bidding_discount_percentage_inp"
                                                                    placeholder="{{ __('Write the bidding discount percentage') }}" />
                                                                <!--end::Input-->
                                                                <div class="fv-plugins-message-container invalid-feedback"
                                                                    id="bidding_discount_percentage">
                                                                </div>
                                                            </div>
                                                            <div class="fv-row flex-row-fluid">
                                                                <label
                                                                    class="required form-label">{{ __('Bidding Percentage After Discount') }}
                                                                    %</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input
                                                                    class="form-control form-control-solid mb-2 no-arrow"
                                                                    type="number" step="0.1" min="1"
                                                                    name="final_bidding_percentage"
                                                                    id="final_bidding_percentage_inp"
                                                                    placeholder="{{ __('Write the bidding percentage after the discount') }}" />
                                                                <!--end::Input-->
                                                                <div class="fv-plugins-message-container invalid-feedback"
                                                                    id="final_bidding_percentage">
                                                                </div>
                                                            </div>
                                                            <div
                                                                style="display: flex;flex-direction: column-reverse;justify-content: space-evenly;align-items: stretch;margin: 25px auto;">
                                                                <a href="javascript:;" data-repeater-delete
                                                                    class="btn btn-sm btn-light-danger mt-3 mt-md-1">
                                                                    <span class="svg-icon svg-icon-1">
                                                                        <svg width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="7.05025" y="15.5356"
                                                                                width="12" height="2"
                                                                                rx="1"
                                                                                transform="rotate(-45 7.05025 15.5356)"
                                                                                fill="currentColor" />
                                                                            <rect x="8.46447" y="7.05029" width="12"
                                                                                height="2" rx="1"
                                                                                transform="rotate(45 8.46447 7.05029)"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Form group-->
                                        <!--begin::Form group-->
                                        <div class="form-group mt-5" id='add_dev'>
                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="11" y="18" width="12" height="2"
                                                            rx="1" transform="rotate(-90 11 18)"
                                                            fill="currentColor" />
                                                        <rect x="6" y="11" width="12" height="2" rx="1"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->{{ __('Add another variation') }}
                                            </a>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->
                                </div>
                            </div>
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Pricing-->
                </div>
                <!--end::Content-->
                <div class="d-flex justify-content-end">
                    <!--begin::Button-->
                    <a href="apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel"
                        class="btn btn-light me-5">{{ __('Cancel') }}</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                            {{ __('Save Changes') }}
                        </span>
                        <span class="indicator-progress">
                            {{ __('Please wait...') }} <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
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

    <script src={{ asset('assets/js/components/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/global/crud-operations.js') }}"></script>
    <script>
        $('#variations').repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,
            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
@endpush
