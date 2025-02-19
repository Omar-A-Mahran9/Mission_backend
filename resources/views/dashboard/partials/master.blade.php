<!DOCTYPE html>
<html
    @if (!isArabic()) lang="en" direction="ltr" style="direction:ltr" @else lang="ar" direction="rtl" style="direction:rtl" @endif
    data-theme-mode="{{ setting('theme_mode') ?? 'light' }}" data-theme="{{ setting('theme_mode') ?? 'light' }}">
<!--begin::Head-->

<head>
    @include('dashboard.partials.head')
    @stack('styles')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="false" class="app-default">

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
            {{--  document.querySelectorAll("theme-mode-menu").forEach(item => {
                item.addEventListener("click", function(event) {
                    event.preventDefault();
                    let selectedMode = this.getAttribute("data-kt-value");  --}}

            // Send the mode to the server
            {{--  fetch(`/change-theme-mode/${themeMode}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]')
                            .getAttribute("content")
                    },
                    body: JSON.stringify({
                        mode: selectedMode
                    })
                }).then(response => response.json())
                .then(data => console.log("Theme mode updated:", data))
                .catch(error => console.error("Error updating theme mode:", error));  --}}
            {{--  });
            });  --}}
            console.log(themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            @include('dashboard.partials.header')
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Wrapper container-->
                <div class="app-container container-fluid d-flex flex-grow-1">
                    <!--begin::Sidebar-->
                    @include('dashboard.partials.aside')
                    <!--end::Sidebar-->
                    <!--begin::Main-->
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        <!--begin::Content wrapper-->
                        <div class="d-flex flex-column flex-column-fluid">
                            <!--begin::Toolbar-->
                            {{--  <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">  --}}
                            <!--begin::Toolbar container-->
                            {{--  <div id="kt_app_toolbar_container"
                                    class="app-container container-fluid d-flex align-items-stretch">  --}}
                            <!--begin::Toolbar wrapper-->
                            {{--  <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                                    <!--begin::Page title-->
                                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3 ms-1">
                                        @yield('breadcrumbs')
                                    </div>
                                    <!--end::Page title-->
                                </div>  --}}
                            <!--end::Toolbar wrapper-->
                            {{--  </div>  --}}
                            <!--end::Toolbar container-->
                            {{--  </div>  --}}
                            <!--end::Toolbar-->
                            <!--begin::Content-->
                            <div id="kt_app_content" class="app-content pt-4">
                                <!--begin::Content container-->
                                <div id="kt_app_content_container" class="container-fluid">
                                    @yield('content')
                                </div>
                                <!--end::Content container-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Content wrapper-->
                        <!--begin::Footer-->
                        @include('dashboard.partials.footer')
                        <!--end::Footer-->
                    </div>
                    <!--end:::Main-->
                </div>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--end::Drawers-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>
    <!--end::Scrolltop-->

    @include('dashboard.partials.foot')

    <!--begin::Toast-->
    <div class="position-fixed bottom-0 start-0 p-3 " style="z-index: 1090">
        <div id="kt_docs_toast_toggle" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="{{ asset('placeholder_images/favicon-light.svg') }}" class="me-2 theme-light-show"
                    width="20" srcset="">
                <img src="{{ asset('placeholder_images/favicon-dark.svg') }}" class="me-2 theme-dark-show"
                    width="20" srcset="">
                <strong class="me-auto">{{ __('' . setting('website_name')) }}</strong>
                <small>{{ __('Now') }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ __('Done successfully') }}.
            </div>
        </div>
    </div>
    <!-- end::Toast -->
    <script>
        var sessionHasSuccess = {{ request()->session()->has('success') ? 1 : 0 }};

        if (sessionHasSuccess) {
            showToast()
        }
        $(document).ready(function() {
            let mode = "{{ setting('theme_mode') ?? 'light' }}";
            localStorage.setItem("data-theme", mode);
            localStorage.setItem("data-theme-mode", mode);
        });
        {{--  document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("theme-mode-menu").forEach(item => {
                item.addEventListener("click", function(event) {
                    event.preventDefault();
                    let selectedMode = this.getAttribute("data-kt-value");

                    // Send the mode to the server
                    fetch(`/change-theme-mode/${selectedMode}`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector(
                                        'meta[name="csrf-token"]')
                                    .getAttribute("content")
                            },
                            body: JSON.stringify({
                                mode: selectedMode
                            })
                        }).then(response => response.json())
                        .then(data => console.log("Theme mode updated:", data))
                        .catch(error => console.error("Error updating theme mode:", error));
                });
            });
        });  --}}
        {{--  var favIconCounter = {{ $unreadNotifications->count() }};
        var favicon;

        $(document).ready(function() {
            favicon = new Favico({
                animation: 'popFade'
            });

            if (favIconCounter > 0)
                favicon.badge(favIconCounter);

            KTLayoutSearch.init();
        });  --}}
    </script>
</body>
<!--end::Body-->

</html>
