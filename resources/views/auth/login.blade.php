<!DOCTYPE html>
<html
    @if (!isArabic()) lang="en" direction="ltr" style="direction:ltr" @else lang="ar" direction="rtl" style="direction:rtl" @endif
    data-theme-mode="{{ setting('theme_mode') ?? 'light' }}" data-theme="{{ setting('theme_mode') ?? 'light' }}">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>{{ __('Peekabid') }}</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Peekabid" />
    <link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/overlay/sign-in.html" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    @if (isArabic())
        <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('assets/media/auth/bg10.jpeg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('assets/media/auth/bg10-dark.jpeg');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="assets/media/auth/agency.png" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="assets/media/auth/agency-dark.png" alt="" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="text-gray-600 fs-base text-center fw-semibold">In this kind of post,
                        <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person
                        they’ve interviewed
                        <br />and provides some background information about
                        <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their
                        <br />work following this is a transcript of the interview.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <!--begin::Form-->
                            <form class="form w-100 ajax-form" action="{{ route('admin.login') }}" method="POST"
                                novalidate="novalidate" data-hide-alert="true" data-success-callback="onAjaxSuccess">
                                @csrf
                                <!--begin::Heading-->
                                <div class="text-center mb-11">
                                    <!--begin::Title-->
                                    <h1 class="text-gray-900 fw-bolder mb-3">{{ __('Sign In') }}</h1>
                                    <!--end::Title-->
                                </div>
                                <!--begin::Heading-->

                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="text" placeholder="{{ __('Email') }}" name="email"
                                        autocomplete="off" class="form-control bg-transparent" />
                                    <p class="invalid-feedback" id="email"></p>
                                    <!--end::Email-->
                                </div>
                                <!--end::Input group=-->
                                <div class="fv-row mb-3">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="{{ __('Password') }}" name="password"
                                        autocomplete="off" class="form-control bg-transparent" />

                                    <!--end::Password-->
                                    <p class="invalid-feedback" id="password"></p>

                                </div>
                                <!--end::Input group=-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <!--begin::Link-->
                                    <a href="authentication/layouts/overlay/reset-password.html"
                                        class="link-primary">{{ __('Forgot Password ?') }}</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Submit button-->
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit-btn" class="btn btn-primary">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">{{ __('Sign In') }}</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">{{ 'Please wait...' }}
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Submit button-->

                            </form>
                            <!--end::Form-->
                            <!--begin::Footer-->
                            <div class="d-flex flex-center flex-column-auto p-10">
                                <!--begin::Links-->
                                <div class="d-flex align-items-center fw-bold fs-6">
                                    <a href="https://webstdy.com/{{ app()->getLocale() }}" target="_blank"
                                        class="text-muted text-hover-primary px-2" id="developed_by">
                                        {{ __('Developed by') }} <img class="mx-4"
                                            src="https://webstdy.com/CDN/cr.png">
                                    </a>
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <script src="{{ asset('assets/js/global/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/global/translations.js') }}"></script>
    <script src="{{ asset('assets/shared/js/global.js') }}"></script>
    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.2/echo.iife.js"></script>  --}}

    <script type='module'>
        {{--  window.Echo = new Echo({
            broadcaster: "reverb",
            host: window.location.hostname + ":8080"
        });  --}}

        console.log(window.Echo);
        const userId = 1;
        setTimeout(() => {
            if (window.Echo) {
                console.log("Trying to subscribe to channel...");
                window.Echo.channel("auction-channel")
                    .listen("AucationEvent", (data) => {
                        console.log("Auction Updated:", data);
                    });
                window.Echo.channel("auction-today")
                    .listen("AucationTodayEvent", (data) => {
                        console.log("Auction today:", data);
                    });
                window.Echo.channel("auction-not-today")
                    .listen("AucationNotTodayEvent", (data) => {
                        console.log("Auction not today:", data);
                    });
                window.Echo.channel("auction-detail.1")
                    .listen("AuctionDetailEvent", (data) => {
                        console.log("Auction detail:", data);
                    });

                window.Echo.channel("auction-live.1")
                    .listen("AuctionDetailEvent", (data) => {
                        console.log("Auction detail:", data);
                    });
                {{--  window.Echo.private(`floating.user.${userId}`)
                    .listen(".FloatingEvent", (data) => {
                        console.log("Auction floating:", data);
                    });  --}}
            } else {
                console.error("Echo is still undefined!");
            }
        }, 400); // Adjust delay if needed
    </script>
    <script>
        let locale = "{{ app()->getLocale() }}";
        $(document).ready(function() {
            $("#submit-btn").prop('disabled', false);
            $("#submit-btn").attr('data-kt-indicator', '');

            window['onAjaxSuccess'] = (response) => {
                console.log(response.url);
                window.location = response.url;
            }
        });
    </script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
