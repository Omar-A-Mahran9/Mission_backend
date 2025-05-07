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
                            <img src="assets/media/avatars/300-1.jpg" alt="image" />
                            <div
                                class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                            </div>
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
                            href="#portfolio">{{ __('Portfolios') }}</a>
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
                <div class="row g-5 g-xxl-8">
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <!--begin::Feeds Widget 1-->
                        <div class="card mb-5 mb-xxl-8">
                            <!--begin::Body-->
                            <div class="card-body pb-0">
                                <!--begin::Header-->
                                <div class="d-flex align-items-center">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="assets/media/avatars/300-6.jpg" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">Grace
                                                Green</a>
                                            <span class="text-gray-500 fw-bold">PHP, SQLite, Artisan CLI</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Menu-->
                                    <div class="my-0">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-outline ki-category fs-6"></i>
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                    Actions
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Ticket</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Customer</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">New Group</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Member Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Contact</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate
                                                        Reports</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Form-->
                                <form id="kt_forms_widget_1_form" class="ql-quil ql-quil-plain pb-3">
                                    <!--begin::Editor-->
                                    <div id="kt_forms_widget_1_editor" class="py-6"></div>
                                    <!--end::Editor-->
                                    <div class="separator"></div>
                                    <!--begin::Toolbar-->
                                    <div id="kt_forms_widget_1_editor_toolbar" class="ql-toolbar d-flex flex-stack py-2">
                                        <div class="me-2">
                                            <span class="ql-formats ql-size ms-0">
                                                <select class="ql-size w-75px"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-bold"></button>
                                                <button class="ql-italic"></button>
                                                <button class="ql-underline"></button>
                                                <button class="ql-strike"></button>
                                                <button class="ql-image"></button>
                                                <button class="ql-link"></button>
                                                <button class="ql-clean"></button>
                                            </span>
                                        </div>
                                        <div class="me-n3">
                                            <span class="btn btn-icon btn-sm btn-active-color-primary">
                                                <i class="ki-outline ki-paper-clip fs-2"></i>
                                            </span>
                                            <span class="btn btn-icon btn-sm btn-active-color-primary">
                                                <i class="ki-outline ki-geolocation fs-2"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Toolbar-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feeds Widget 1-->
                        <!--begin::Feeds Widget 2-->
                        <div class="card mb-5 mb-xxl-8">
                            <!--begin::Body-->
                            <div class="card-body pb-0">
                                <!--begin::Header-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="assets/media/avatars/300-23.jpg" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">Nick
                                                Logan</a>
                                            <span class="text-gray-500 fw-bold">PHP, SQLite, Artisan CLI</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Menu-->
                                    <div class="my-0">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-outline ki-category fs-6"></i>
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                    Actions
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Ticket</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Customer</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">New Group</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Member Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Contact</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate
                                                        Reports</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Post-->
                                <div class="mb-5">
                                    <!--begin::Text-->
                                    <p class="text-gray-800 fw-normal mb-5">Outlines keep you honest. They stop you from
                                        indulging
                                        in poorly thought-out metaphors about driving and keep you focused on the overall
                                        structure
                                        of your post</p>
                                    <!--end::Text-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center mb-5">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4">
                                            <i class="ki-outline ki-message-text-2 fs-2"></i>120</a>
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                            <i class="ki-outline ki-heart fs-2"></i>15</a>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Post-->
                                <!--begin::Separator-->
                                <div class="separator mb-4"></div>
                                <!--end::Separator-->
                                <!--begin::Reply input-->
                                <form class="position-relative mb-6">
                                    <textarea class="form-control border-0 p-0 pe-10 resize-none min-h-25px" data-kt-autosize="true" rows="1"
                                        placeholder="Reply.."></textarea>
                                    <div class="position-absolute top-0 end-0 me-n5">
                                        <span class="btn btn-icon btn-sm btn-active-color-primary pe-0 me-2">
                                            <i class="ki-outline ki-paper-clip fs-2 mb-3"></i>
                                        </span>
                                        <span class="btn btn-icon btn-sm btn-active-color-primary ps-0">
                                            <i class="ki-outline ki-geolocation fs-2 mb-3"></i>
                                        </span>
                                    </div>
                                </form>
                                <!--edit::Reply input-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feeds Widget 2-->
                        <!--begin::Feeds Widget 3-->
                        <div class="card mb-5 mb-xxl-8">
                            <!--begin::Body-->
                            <div class="card-body pb-0">
                                <!--begin::Header-->
                                <div class="d-flex align-items-center mb-3">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="assets/media/avatars/300-21.jpg" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">Carles
                                                Nilson</a>
                                            <span class="text-gray-500 fw-bold">Yestarday at 5:06 PM</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Menu-->
                                    <div class="my-0">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-outline ki-category fs-6"></i>
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                    Actions
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Ticket</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Customer</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">New Group</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Member Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Contact</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate
                                                        Reports</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Post-->
                                <div class="mb-7">
                                    <!--begin::Text-->
                                    <div class="text-gray-800 mb-5">Outlines keep you honest. They stop you from indulging
                                        in
                                        poorly thought-out metaphors about driving and keep you focused on the overall
                                        structure
                                        of
                                        your post</div>
                                    <!--end::Text-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center mb-5">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4">
                                            <i class="ki-outline ki-message-text-2 fs-2"></i>12</a>
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                            <i class="ki-outline ki-heart fs-2"></i>150</a>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Post-->
                                <!--begin::Replies-->
                                <div class="mb-7">
                                    <!--begin::Reply-->
                                    <div class="d-flex mb-5">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="assets/media/avatars/300-14.jpg" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column flex-row-fluid">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center flex-wrap mb-1">
                                                <a href="#"
                                                    class="text-gray-800 text-hover-primary fw-bold me-2">Alice
                                                    Danchik</a>
                                                <span class="text-gray-500 fw-semibold fs-7">1 day</span>
                                                <a href="#"
                                                    class="ms-auto text-gray-500 text-hover-primary fw-semibold fs-7">Reply</a>
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Post-->
                                            <span class="text-gray-800 fs-7 fw-normal pt-1">Long before you sit dow to put
                                                digital
                                                pen to paper you need to make sure you have to sit down and write.</span>
                                            <!--end::Post-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Reply-->
                                    <!--begin::Reply-->
                                    <div class="d-flex">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="assets/media/avatars/300-9.jpg" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column flex-row-fluid">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center flex-wrap mb-1">
                                                <a href="#"
                                                    class="text-gray-800 text-hover-primary fw-bold me-2">Harris
                                                    Bold</a>
                                                <span class="text-gray-500 fw-semibold fs-7">2 days</span>
                                                <a href="#"
                                                    class="ms-auto text-gray-500 text-hover-primary fw-semibold fs-7">Reply</a>
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Post-->
                                            <span class="text-gray-800 fs-7 fw-normal pt-1">Outlines keep you honest. They
                                                stop
                                                you
                                                from indulging in poorly</span>
                                            <!--end::Post-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Reply-->
                                </div>
                                <!--end::Replies-->
                                <!--begin::Separator-->
                                <div class="separator mb-4"></div>
                                <!--end::Separator-->
                                <!--begin::Reply input-->
                                <form class="position-relative mb-6">
                                    <textarea class="form-control border-0 p-0 pe-10 resize-none min-h-25px" data-kt-autosize="true" rows="1"
                                        placeholder="Reply.."></textarea>
                                    <div class="position-absolute top-0 end-0 me-n5">
                                        <span class="btn btn-icon btn-sm btn-active-color-primary pe-0 me-2">
                                            <i class="ki-outline ki-paper-clip fs-2 mb-3"></i>
                                        </span>
                                        <span class="btn btn-icon btn-sm btn-active-color-primary ps-0">
                                            <i class="ki-outline ki-geolocation fs-2 mb-3"></i>
                                        </span>
                                    </div>
                                </form>
                                <!--edit::Reply input-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feeds Widget 3-->
                        <!--begin::Feeds Widget 4-->
                        <div class="card mb-5 mb-xxl-8">
                            <!--begin::Body-->
                            <div class="card-body pb-0">
                                <!--begin::Header-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="assets/media/avatars/300-7.jpg" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">Carles
                                                Nilson</a>
                                            <span class="text-gray-500 fw-bold">Last week at 10:00 PM</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Menu-->
                                    <div class="my-0">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-outline ki-category fs-6"></i>
                                        </button>
                                        <!--begin::Menu 3-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                            data-kt-menu="true">
                                            <!--begin::Heading-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments
                                                </div>
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Create Invoice</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link flex-stack px-3">Create Payment
                                                    <span class="ms-2" data-bs-toggle="tooltip"
                                                        title="Specify a target name for future usage and reference">
                                                        <i class="ki-outline ki-information fs-6"></i>
                                                    </span></a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Generate Bill</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-end">
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">Subscription</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Plans</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Billing</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Statements</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator my-2"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3">
                                                            <!--begin::Switch-->
                                                            <label
                                                                class="form-check form-switch form-check-custom form-check-solid">
                                                                <!--begin::Input-->
                                                                <input class="form-check-input w-30px h-20px"
                                                                    type="checkbox" value="1" checked="checked"
                                                                    name="notifications" />
                                                                <!--end::Input-->
                                                                <!--end::Label-->
                                                                <span
                                                                    class="form-check-label text-muted fs-6">Recuring</span>
                                                                <!--end::Label-->
                                                            </label>
                                                            <!--end::Switch-->
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-1">
                                                <a href="#" class="menu-link px-3">Settings</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 3-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Post-->
                                <div class="mb-7">
                                    <!--begin::Text-->
                                    <div class="text-gray-800 mb-5">Outlines keep you honest. They stop you from indulging
                                        in
                                        poorly thought-out metaphors about driving and keep you focused on the overall
                                        structure
                                        of
                                        your post</div>
                                    <!--end::Text-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center mb-5">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4">
                                            <i class="ki-outline ki-message-text-2 fs-2"></i>22</a>
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                            <i class="ki-outline ki-heart fs-2"></i>59</a>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Post-->
                                <!--begin::Separator-->
                                <div class="separator mb-4"></div>
                                <!--end::Separator-->
                                <!--begin::Reply input-->
                                <form class="position-relative mb-6">
                                    <textarea class="form-control border-0 p-0 pe-10 resize-none min-h-25px" data-kt-autosize="true" rows="1"
                                        placeholder="Reply.."></textarea>
                                    <div class="position-absolute top-0 end-0 me-n5">
                                        <span class="btn btn-icon btn-sm btn-active-color-primary pe-0 me-2">
                                            <i class="ki-outline ki-paper-clip fs-2 mb-3"></i>
                                        </span>
                                        <span class="btn btn-icon btn-sm btn-active-color-primary ps-0">
                                            <i class="ki-outline ki-geolocation fs-2 mb-3"></i>
                                        </span>
                                    </div>
                                </form>
                                <!--edit::Reply input-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feeds Widget 4-->
                        <!--begin::Feeds widget 5-->
                        <div class="card d-none" id="kt_widget_5">
                            <!--begin::Body-->
                            <div class="card-body pb-0">
                                <!--begin::Header-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-45px me-5">
                                            <img src="assets/media/avatars/300-7.jpg" alt="" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Carles
                                                Nilson</a>
                                            <span class="text-gray-500 fw-bold">Last week at 10:00 PM</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Menu-->
                                    <div class="my-0">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-outline ki-category fs-6"></i>
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                    Actions
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Ticket</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Customer</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">New Group</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Member Group</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">New Contact</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate
                                                        Reports</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Post-->
                                <div class="mb-7">
                                    <!--begin::Image-->
                                    <div class="bgi-no-repeat bgi-size-cover rounded min-h-250px mb-5"
                                        style="background-image:url('assets/media/stock/900x600/19.jpg');"></div>
                                    <!--end::Image-->
                                    <!--begin::Text-->
                                    <div class="text-gray-800 mb-5">Outlines keep you honest. They stop you from indulging
                                        in
                                        poorly thought-out metaphors about driving and keep you focused on the overall
                                        structure
                                        of
                                        your post</div>
                                    <!--end::Text-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center mb-5">
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-success px-4 py-2 me-4">
                                            <i class="ki-outline ki-message-text-2 fs-2"></i>20</a>
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                            <i class="ki-outline ki-heart fs-2"></i>50</a>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Post-->
                                <!--begin::Separator-->
                                <div class="separator mb-4"></div>
                                <!--end::Separator-->
                                <!--begin::Reply input-->
                                <form class="position-relative mb-6">
                                    <textarea class="form-control border-0 p-0 pe-10 resize-none min-h-25px" data-kt-autosize="true" rows="1"
                                        placeholder="Reply.."></textarea>
                                    <div class="position-absolute top-0 end-0 me-n5">
                                        <span class="btn btn-icon btn-sm btn-active-color-primary pe-0 me-2">
                                            <i class="ki-outline ki-paper-clip fs-2 mb-3"></i>
                                        </span>
                                        <span class="btn btn-icon btn-sm btn-active-color-primary ps-0">
                                            <i class="ki-outline ki-geolocation fs-2 mb-3"></i>
                                        </span>
                                    </div>
                                </form>
                                <!--edit::Reply input-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feeds widget 5-->
                        <!--begin::Feeds widget 4, 5 load more-->
                        <button class="btn btn-primary w-100 text-center" id="kt_widget_5_load_more_btn">
                            <span class="indicator-label">More Feeds</span>
                            <span class="indicator-progress">Loading...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Feeds widget 4, 5 load more-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-6">
                        <!--begin::Charts Widget 1-->
                        <div class="card mb-5 mb-xxl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold fs-3 mb-1">Recent Statistics</span>
                                    <span class="text-muted fw-semibold fs-7">More than 400 new members</span>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Menu-->
                                    <button type="button"
                                        class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-outline ki-category fs-6"></i>
                                    </button>
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                        id="kt_menu_673c2acb8c026">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Menu separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Form-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">Status:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <select class="form-select form-select-solid" multiple="multiple"
                                                        data-kt-select2="true" data-close-on-select="false"
                                                        data-placeholder="Select option"
                                                        data-dropdown-parent="#kt_menu_673c2acb8c026"
                                                        data-allow-clear="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="2">In Process</option>
                                                        <option value="2">Rejected</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">Member Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <div class="d-flex">
                                                    <!--begin::Options-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                        <span class="form-check-label">Author</span>
                                                    </label>
                                                    <!--end::Options-->
                                                    <!--begin::Options-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2"
                                                            checked="checked" />
                                                        <span class="form-check-label">Customer</span>
                                                    </label>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">Notifications:</label>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <div
                                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="notifications" checked="checked" />
                                                    <label class="form-check-label">Enabled</label>
                                                </div>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset"
                                                    class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Menu 1-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <div id="kt_charts_widget_1_chart" style="height: 350px"></div>
                                <!--end::Chart-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Charts Widget 1-->
                        <!--begin::List Widget 5-->
                        <div class="card mb-5 mb-xxl-8">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="fw-bold mb-2 text-gray-900">Activities</span>
                                    <span class="text-muted fw-semibold fs-7">890,344 Sales</span>
                                </h3>
                                <div class="card-toolbar">
                                    <!--begin::Menu-->
                                    <button type="button"
                                        class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-outline ki-category fs-6"></i>
                                    </button>
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                        id="kt_menu_673c2acb8c063">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Menu separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Form-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">Status:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <select class="form-select form-select-solid" multiple="multiple"
                                                        data-kt-select2="true" data-close-on-select="false"
                                                        data-placeholder="Select option"
                                                        data-dropdown-parent="#kt_menu_673c2acb8c063"
                                                        data-allow-clear="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="2">In Process</option>
                                                        <option value="2">Rejected</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">Member Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <div class="d-flex">
                                                    <!--begin::Options-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                        <span class="form-check-label">Author</span>
                                                    </label>
                                                    <!--end::Options-->
                                                    <!--begin::Options-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2"
                                                            checked="checked" />
                                                        <span class="form-check-label">Customer</span>
                                                    </label>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">Notifications:</label>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <div
                                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        name="notifications" checked="checked" />
                                                    <label class="form-check-label">Enabled</label>
                                                </div>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset"
                                                    class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Menu 1-->
                                    <!--end::Menu-->
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Timeline-->
                                <div class="timeline-label">
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Label-->
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">08:42</div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-warning fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Text-->
                                        <div class="fw-mormal timeline-content text-muted ps-3">Outlines keep you honest.
                                            And
                                            keep
                                            structure</div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Label-->
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">10:00</div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-success fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Content-->
                                        <div class="timeline-content d-flex">
                                            <span class="fw-bold text-gray-800 ps-3">AEOL meeting</span>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Label-->
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">14:37</div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-danger fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Desc-->
                                        <div class="timeline-content fw-bold text-gray-800 ps-3">Make deposit
                                            <a href="#" class="text-primary">USD 700</a>. to ESL
                                        </div>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Label-->
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-primary fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Text-->
                                        <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving
                                            and
                                            keep structure keep great</div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Label-->
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-danger fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Desc-->
                                        <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                                            <a href="#" class="text-primary">#XF-2356</a>.
                                        </div>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Label-->
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-primary fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Text-->
                                        <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving
                                            and
                                            keep structure keep great</div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Label-->
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-danger fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Desc-->
                                        <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                                            <a href="#" class="text-primary">#XF-2356</a>.
                                        </div>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Label-->
                                        <div class="timeline-label fw-bold text-gray-800 fs-6">10:30</div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-success fs-1"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Text-->
                                        <div class="timeline-content fw-mormal text-muted ps-3">Finance KPI Mobile app
                                            launch
                                            preparion meeting</div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end: Card Body-->
                        </div>
                        <!--end: List Widget 5-->
                    </div>
                    <!--end::Col-->
                </div>
            </div>
            <div class="tab-pane fade" id="certificates" role="tabpanel">
                @include('dashboard.users.tabs.certificates', ['user' => $user])
                @yield('certificates')
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
        function reinitializeDataTables() {
            if (typeof userTicketsInit === "function") {
                userTicketsInit(); // Reinitialize User Tickets Table
            }
            if (typeof userWonInit === "function") {
                userWonInit(); // Reinitialize User Won Table
            }
        }

        // Example: Call this function after an event like button click or AJAX success
        document.addEventListener("DOMContentLoaded", function() {
            reinitializeDataTables(); // Runs on page load
        });
    </script>
    <script>
        var type = "tickets"; // Declare globally
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
            let scriptSrc = type === "address" ?
                "{{ asset('assets/js/datatables/address.js') }}" :
                type === "won" ?
                "{{ asset('assets/js/datatables/user-won.js') }}" :
                "{{ asset('assets/js/datatables/user-tickets.js') }}";

            if (!scriptSrc) return; // Prevent execution if type is not valid

            // Create script element
            let script = document.createElement("script");
            script.src = scriptSrc;
            document.body.appendChild(script);
        }
    </script>
@endpush
