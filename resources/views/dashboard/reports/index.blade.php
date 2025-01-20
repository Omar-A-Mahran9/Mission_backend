@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{ __('Export report') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" method="GET"
                        action="{{ route('dashboard.reports-export') }}" onsubmit="return validateForm(event)">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <div class="d-flex flex-column flex-md-row gap-5">
                                <div class="fv-row flex-row-fluid">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2 required"
                                        for="from_to_date_inp">{{ __('Choose date') }}
                                        <span class="ms-1" data-bs-toggle="tooltip" </span></label>
                                    <!--End::Label-->
                                    <!--begin::Row-->
                                    <div class="row" data-kt-buttons="true"
                                        data-kt-buttons-target="[data-kt-button='true']">
                                        <!--begin::Col-->
                                        <div class="col-12 col-xl-12 col-lg-12 ">
                                            <!--begin::Daterangepicker-->
                                            <input
                                                class="form-control form-control-solid d-flex text-start filter-datatable-inp"
                                                name="from_to_date" placeholder="{{ __('Pick date range') }}"
                                                id="from_to_date_inp" />
                                            <!--end::Daterangepicker-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="from_to_date"></div>
                                </div>
                                <div class="fv-row flex-row-fluid">
                                    <!--begin::Label-->
                                    <label class="required form-label"
                                        for="payment_method_inp">{{ __('Payment method') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="payment_method" id="payment_method_inp"
                                        data-placeholder="{{ __('Choose the payment method') }}"
                                        data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                        <option value="">{{ __('Choose the payment method') }}</option>
                                        <option value="0"> {{ __('All') }} </option>
                                        <option value="1"> {{ __('Cash on delivery') }} </option>
                                        <option value="2"> {{ __('Prepaid Cards') }} </option>
                                    </select>
                                    <!--end::Select2-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="payment_method">
                                    </div>

                                </div>
                                <div class="fv-row flex-row-fluid">
                                    <!--begin::Label-->
                                    <label class="required form-label"
                                        for="shipping_type_inp">{{ __('Shipping type') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="shipping_type" id="shipping_type_inp"
                                        data-placeholder="{{ __('Choose the shipping type') }}"
                                        data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                        <option value="">{{ __('Choose the shipping type') }}</option>
                                        <option value="2"> {{ __('All') }} </option>
                                        <option value="0"> {{ __('Regular shipping') }} </option>
                                        <option value="1"> {{ __('Fast shipping') }} </option>
                                    </select>
                                    <!--end::Select2-->
                                    <div class="fv-plugins-message-container invalid-feedback" id="shipping_type">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <!--begin::Button-->
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    <i class="fa fa-file-excel fs-5"></i>
                                    {{ __('Excel') }}
                                </span>
                                <span class="indicator-progress">
                                    {{ __('Please wait...') }} <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection
@push('scripts')
    <script>
        function validateForm(event) {
            {{--  event.preventDefault(); // Prevent form submission initially  --}}

            let fromDate = document.getElementById("from_to_date_inp");
            let paymentMethod = document.getElementById("payment_method_inp");
            let shippingType = document.getElementById("shipping_type_inp");
            let fromDateError = document.getElementById("from_to_date");
            let paymentMethodError = document.getElementById("payment_method");
            let shippingTypeError = document.getElementById("shipping_type");
            let isValid = true; // Initialize form validity

            // Validate "from date" field
            if (!fromDate.value) {
                fromDate.classList.add("is-invalid");
                fromDateError.textContent = __("The choose date field is required");
                fromDateError.style.display = "block";
                isValid = false;
            } else {
                fromDate.classList.remove("is-invalid");
                fromDateError.style.display = "none";
                fromDateError.textContent = "";
            }

            // Validate "payment method" field
            if (!paymentMethod.value) {
                $('#payment_method_inp').next('.select2-container').find('.select2-selection').addClass('is-invalid');
                paymentMethodError.textContent = __("The payment method field is required");
                paymentMethodError.style.display = "block";
                isValid = false;
            } else {
                $('#payment_method_inp').next('.select2-container').find('.select2-selection').removeClass('is-invalid');
                paymentMethodError.style.display = "none";
                paymentMethodError.textContent = "";
            }

            // Validate "shipping type" field
            if (!shippingType.value) {
                $('#shipping_type_inp').next('.select2-container').find('.select2-selection').addClass('is-invalid');
                shippingTypeError.textContent = __("The shipping type field is required");
                shippingTypeError.style.display = "block";
                isValid = false;
            } else {
                $('#shipping_type_inp').next('.select2-container').find('.select2-selection').removeClass('is-invalid');
                shippingTypeError.style.display = "none";
                shippingTypeError.textContent = "";
            }

            // Only submit the form if all fields are valid
            if (!isValid) {
                event.preventDefault(); // Prevent form submission if there are errors
            }
        }
    </script>
    <script>
        let fromToDp = $("#from_to_date_inp");
        let start = moment().subtract(29, "days");
        let end = moment();

        function cb(start, end) {
            fromToDp.html(start.format("yyyy-mm-d") + "  -  " + end.format("yyyy-mm-d"));
        }


        fromToDp.daterangepicker({
            startDate: start,
            endDate: end,
            locale: {
                format: 'YYYY-MM-DD',
                applyLabel: __('Apply'),
                cancelLabel: __('Cancel'),
            },
            ranges: {
                '{{ __('All') }}': [moment().subtract(50, "years"), moment()],
                '{{ __('Today') }}': [moment(), moment()],
                '{{ __('Yesterday') }}': [moment().subtract(1, "days"), moment().subtract(1, "days")],
                '{{ __('Last 7 Days') }}': [moment().subtract(6, "days"), moment()],
                '{{ __('Last 30 Days') }}': [moment().subtract(29, "days"), moment()],
                '{{ __('This Month') }}': [moment().startOf("month"), moment().endOf("month")],
                '{{ __('Last Month') }}': [moment().subtract(1, "month").startOf("month"), moment().subtract(1,
                    "month").endOf("month")]
            }
        }, cb).val('');

        $('li[data-range-key="Custom Range"]').html(__('Custom Range'))
    </script>
@endpush
