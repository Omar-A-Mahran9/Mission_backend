@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')
    @include('dashboard.partials.settings-nav')

    <!--begin::Form-->
    <form class="form d-flex flex-column flex-lg-row ajax-form"
        action="{{ route('dashboard.settings.store-silver-grams-prices') }}" method="post"
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
                                    <h2>{{ __('Silver grams prices') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <div class="card-body pt-0">
                                @foreach ($silverCalibers as $silverCaliber)
                                    <!--begin::Input group-->
                                    <div class="mb-10 row">
                                        <div class="col-lg-4">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Category') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <input class="form-control" value="{{ $silverCategory->name }}"
                                                name="silver_category" id="silver_category_inp" disabled />
                                            <!--end::Editor-->
                                            <!--begin::Description-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="silver_category">
                                            </div>
                                            <!--end::Description-->
                                        </div>
                                        <div class="col-lg-4">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Caliber') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <input class="form-control" value="{{ $silverCaliber }}" name="caliber"
                                                id="caliber_inp" placeholder="{{ __('caliber') }}" disabled />
                                            <!--end::Editor-->
                                            <!--begin::Description-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="caliber"></div>
                                            <!--end::Description-->
                                        </div>
                                        <div class="col-lg-4">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Gram price') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <input class="form-control no-arrow" type="number" step="any"
                                                value="{{ setting('silver_grams_prices') ? setting('silver_grams_prices')['caliber_' . $silverCaliber] : old('gram_price_' . $loop->index) }}"
                                                name="gram_price_{{ $loop->index }}"
                                                id="gram_price_{{ $loop->index }}_inp"
                                                placeholder="{{ __('Gram price') }}" />
                                            <!--end::Editor-->
                                            <!--begin::Description-->
                                            <div class="fv-plugins-message-container invalid-feedback"
                                                id="gram_price_{{ $loop->index }}"></div>
                                            <!--end::Description-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                @endforeach
                            </div>
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
