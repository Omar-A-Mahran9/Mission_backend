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
                                        class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                        <i class="ki-outline ki-profile-circle fs-4 me-1"></i>{{ $user->field->name }}</a>
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
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#experiences">{{ __('Experiences') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#certificates">{{ __('Certificates') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#licenses">{{ __('Licenses') }}</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#portfolios">{{ __('Portfolios') }}</a>
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
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            href="#offer">{{ __('Offers') }}</a>
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
                @include('dashboard.users.experiences', ['user' => $user])
            </div>
            <div class="tab-pane fade show active" id="over_view" role="tabpanel">
                @include('dashboard.users.over-view', ['user' => $user])
            </div>
            <div class="tab-pane fade" id="certificates" role="tabpanel">
                @include('dashboard.users.certificates', ['user' => $user])
            </div>
            <div class="tab-pane fade" id="licenses" role="tabpanel">
                @include('dashboard.users.licenses', ['user' => $user])
            </div>
            <div class="tab-pane fade" id="portfolios" role="tabpanel">
                @include('dashboard.users.portfolios', ['user' => $user])
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content-->
@endsection


@push('scripts')
    <script>
        window.isArabic = '{{ isArabic() }}';
    </script>
    <script>
        let userId = @json($user->id);
        let riyalLogoUrl = "{{ asset('placeholder_images/riyal_logo.svg') }}";
    </script>
    <script src="{{ asset('assets/js/global/datatable-config.js') }}"></script>
    <script>
        let checkCards = true
        document.getElementById('toggle-all').addEventListener('click', function() {
            checkCards = !checkCards
            const fileCollapses = document.querySelectorAll('[id^="fileCollapse-"]');
            const allShown = Array.from(fileCollapses).every(el => el.classList.contains('show'));
            let cards = document.querySelectorAll('.card-custom');
            let cardsShow = document.querySelectorAll('.card-open-custom');
            cards.forEach(card => {
                card.classList.remove('collapsed');
                if (checkCards) {} else {
                    card.classList.add('collapsed');
                }
            });
            cardsShow.forEach(card => {
                card.classList.remove('show');
                if (checkCards) {} else {
                    card.classList.add('show');
                }
            });
            this.textContent = checkCards ? __('Expand All') : __('Collapse All');
        });
    </script>
    <script>
        let checkCardsLicens = true
        document.getElementById('toggle-all-licenses').addEventListener('click', function() {
            checkCardsLicens = !checkCardsLicens
            const fileCollapses = document.querySelectorAll('[id^="fileCollapse-licens-"]');
            const allShown = Array.from(fileCollapses).every(el => el.classList.contains('show'));
            let cards = document.querySelectorAll('.card-custom-licens');
            let cardsShow = document.querySelectorAll('.card-open-custom-licens');
            cards.forEach(card => {
                card.classList.remove('collapsed');
                if (checkCardsLicens) {} else {
                    card.classList.add('collapsed');
                }
            });
            cardsShow.forEach(card => {
                card.classList.remove('show');
                if (checkCardsLicens) {} else {
                    card.classList.add('show');
                }
            });
            this.textContent = checkCardsLicens ? __('Expand All') : __('Collapse All');
        });
    </script>
    <script>
        let checkCardsPortfolios = true
        document.getElementById('toggle-all-portfolios').addEventListener('click', function() {
            checkCardsPortfolios = !checkCardsPortfolios
            const fileCollapses = document.querySelectorAll('[id^="fileCollapse-portfolios-"]');
            const allShown = Array.from(fileCollapses).every(el => el.classList.contains('show'));
            let cards = document.querySelectorAll('.card-custom-portfolios');
            let cardsShow = document.querySelectorAll('.card-open-custom-portfolios');
            cards.forEach(card => {
                card.classList.remove('collapsed');
                if (checkCardsPortfolios) {} else {
                    card.classList.add('collapsed');
                }
            });
            cardsShow.forEach(card => {
                card.classList.remove('show');
                if (checkCardsPortfolios) {} else {
                    card.classList.add('show');
                }
            });
            this.textContent = checkCardsPortfolios ? __('Expand All') : __('Collapse All');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-desc').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const descEl = document.getElementById('desc-' + id);

                    const isExpanded = this.textContent.trim() === __('Show less');

                    if (isExpanded) {
                        descEl.textContent = this.dataset.short;
                        this.textContent = `(${__('Show more')})`;
                    } else {
                        descEl.textContent = this.dataset.full;
                        this.textContent = `(${__('Show less')})`;
                    }
                });
            });
        });
    </script>
@endpush
