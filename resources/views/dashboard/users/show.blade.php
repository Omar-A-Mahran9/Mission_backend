
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
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xxl-8">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <!--begin: Pic-->
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="{{ $user->full_image_path }}" alt="image" />

                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user->full_name }}</a>
                                    <a href="#">
                                        <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                    </a>
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2 {{ $user->field ? '' : 'd-none' }}">
                                        <i class="ki-outline ki-profile-circle fs-4 me-1"></i>{{ $user->field?->name }}</a>
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                        <i class="ki-outline ki-geolocation fs-4 me-1"></i>{{ $user->city->name }}</a>
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                        <i class="ki-outline ki-phone fs-4 me-1"></i>{{ $user->phone }}</a>
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-500 text-hover-primary me-5  mb-2 {{ $user->email ? '' : 'd-none' }}">
                                        <i class="ki-outline ki-sms fs-4 me-1"></i>{{ $user->email }}</a>

                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                            <div class="d-flex my-4">
                                <!--begin::Menu-->
                                @if ($user->is_valid == 0)
                                    <form class="form ajax-form"
                                        action="{{ route('dashboard.users.is-valid', $user->id) }}" method="POST"
                                        data-success-callback="onAjaxSuccess" data-hide-alert="true">
                                        @csrf
                                        <input type="hidden" name="is_valid" value="1">
                                        <button type="submit" class="btn btn-sm btn-primary me-2">
                                            <span class="indicator-label">
                                                {{ __('Approved') }}
                                            </span>
                                            <span class="indicator-progress">
                                                {{ __('Please wait...') }} <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </form>
                                @endif
                                {{--  <button type="submit" class="btn btn-sm btn-light me-2" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_app">
                                            {{ __('Approved') }}
                                        </button>  --}}
                                <!--end::Menu-->
                            </div>
                            <!--begin::Actions-->

                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <i class="ki-outline ki-discount fs-3 text-success me-2"></i>
                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                data-kt-countup-value="{{ $user->missions_count }}">0</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-gray-500">{{ __('Tasks') }}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <i class="ki-outline ki-notepad-bookmark fs-3 text-danger me-2"></i>
                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                data-kt-countup-value="{{ $user->offers_count }}">0
                                            </div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-gray-500">{{ __('Offers') }}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->

                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
                <!--begin::Navs-->
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab"
                            href="#over_view">{{ __('Overview') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#experiences"
                            data-type="experiences">{{ __('Experiences') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#certificates"
                            data-type="certificates">{{ __('Certificates') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#licenses"
                            data-type="licenses">{{ __('Licenses') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#portfolios"
                            data-type="portfolios">{{ __('Portfolios') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#task">{{ __('Tasks') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
<li class="nav-item mt-2">
    <a   class="nav-link text-active-primary ms-0 me-10 py-5"
     data-bs-toggle="tab"
     data-type="offers"
      href="#offers">
        {{ __('Offers') }}
    </a>
</li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#interest">{{ __('Interests') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#reviews">{{ __('Reviews') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#wallet">{{ __('Wallet') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#chat">{{ __('Chats') }}</a>
                    </li>
                    <!--end::Nav item-->
                </ul>
                <!--begin::Navs-->
            </div>
        </div>
        <!--end::Navbar-->
        <!--begin::Row-->
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="over_view" role="tabpanel">
                @include('dashboard.users.over-view', ['user' => $user])
            </div>
            <div class="tab-pane fade experiences-container" id="experiences" role="tabpanel">
            </div>
            <div class="tab-pane fade certificates-container" id="certificates" role="tabpanel">
            </div>
            <div class="tab-pane fade licenses-container" id="licenses" role="tabpanel">
            </div>
            <div class="tab-pane fade portfolios-container" id="portfolios" role="tabpanel">
            </div>
            <div class="tab-pane fade  " id="offers" role="tabpanel">
            </div>
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row g-6 g-xl-9">
            <!--begin::Col-->
            <div class="col-md-12 col-xxl-12 d-flex flex-column" style="display: none" id="no-results-alert">
                <div class="spinner-border d-none mx-auto" id="loading-alert" role="status">
                    <span class="sr-only">{{ __('Loading...') }}</span>
                </div>
                <!--begin::Button-->
                <div class="" style="justify-items: center">
                    <!--begin::Illustration-->
                    <img src="/assets/vendor-dashboard/media/illustrations/unitedpalms-1/no_results.png" alt=""
                        class="mw-100 mh-250px">
                    <!--end::Illustration-->
                    <!--begin::Label-->
                    <div class="fs-4 text-gray-800 fw-bold mb-0">
                        {{ __('There is no data') }}
                    </div>
                    <!--end::Label-->
                </div>
                <!--begin::Button-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Pagination-->
        <div class="d-flex flex-stack flex-wrap pt-10 mt-5" id="pagination-container">
            <div class="fs-6 fw-semibold pagination-info"></div>
            <!--begin::Pages-->
            <ul class="pagination">
            </ul>
            <!--end::Pages-->
        </div>
        <!--end::Pagination-->
    </div>

    <!--end::Content-->
@endsection


 @push('scripts')
    <script>
        window.isArabic = '{{ isArabic() }}';
    
    let user = {!! json_encode($user) !!};
       const t = {
        id: "{{ __('ID') }}",
        mission: "{{ __('Mission') }}",
        user: "{{ __('User') }}",
        status: "{{ __('Status') }}",
        budget: "{{ __('Available Budget') }}",
        created_at: "{{ __('Created At') }}"
    };

    </script>
    <script>
        let userId = @json($user->id);
        let riyalLogoUrl = "{{ asset('placeholder_images/riyal_logo.svg') }}";
    </script>
    <script src="{{ asset('assets/js/global/datatable-config.js') }}"></script>
    <script>
        var type = ""; // Declare globally
        document.addEventListener("DOMContentLoaded", function() {
            loadScriptForType(type); // Load the default script
            document.querySelectorAll(".nav-link").forEach(function(tab) {
                tab.addEventListener("click", function() {
                    type = this.getAttribute("data-type"); // Read the selected type
                    console.log("Clicked Tab Type:", type); // Verify in console
                    // Call the function to reload DataTable based on the selected tab
                    
                    loadScriptForType(type);
                });
            });
        });


        // Function to load the required script based on tab selection
      function loadScriptForType(type) {
    let scriptSrc =
        type === "certificates" ? "{{ asset('assets/js/forms/users/certificates.js') }}" :
        type === "experiences" ? "{{ asset('assets/js/forms/users/experiences.js') }}" :
        type === "licenses" ? "{{ asset('assets/js/forms/users/licenses.js') }}" :
        type === "portfolios" ? "{{ asset('assets/js/forms/users/portfolios.js') }}" :
        type === "offers" ? "{{ asset('assets/js/forms/users/offer.js') }}" :
        null;

    if (!scriptSrc) return; // Prevent execution if type is not valid

    // Create script element
    let script = document.createElement("script");
    script.src = scriptSrc;
    document.body.appendChild(script);
}

    </script>
    <script>
        window['onAjaxSuccess'] = () => {

            showToast();

            setTimeout(function() {
                window.location.reload();
            }, 1000);
        }
    </script>
@endpush
