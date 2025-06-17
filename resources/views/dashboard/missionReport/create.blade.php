@extends('dashboard.partials.master')
@section('content')

    <!--begin::Form-->
    <form class="form d-flex flex-column flex-lg-row report-form" action="{{ route('dashboard.report.storeReport') }}"
        method="post" data-success-callback="onAjaxSuccess" >
        @csrf
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
 
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="settings_about_us" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ __('Create Report') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('Label in arabic') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <input class="form-control"   name="name_ar"
                                            id="name_ar_inp" placeholder="{{ __('name in arabic') }}" />
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="name_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('Name en') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <input class="form-control"  name="name_en"
                                            id="name_en_inp" placeholder="{{ __('Name in english') }}" />
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="name_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                 
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
                    <span class="indicator-progress"> {{ __('Please wait...') }}
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
{{-- createReport.js --}}


    <script src="{{ asset('assets/js/datatables/createReport.js') }}"></script>


    <script>
        window['onAjaxSuccess'] = () => {
            soundStatus = $("[name='sound_status']:checked").val();
            showToast();
        }
    </script>
    <script>
        let language = locale == 'en' ? 'ltr' : 'rtl';
     
    
        
    </script>
@endpush
