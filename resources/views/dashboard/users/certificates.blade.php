@extends('dashboard.users.show')

@section('certificates')
    <!--begin::Row-->
    <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
        @forelse ($user->certificates as $certificate)
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3" id="{{ $loop->index }}">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8" data-bs-toggle="collapse"
                        data-bs-target="#certificate-{{ $certificate->id }}">
                        <!--begin::Name-->
                        <a href="#certificate-{{ $certificate->id }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-75px mb-5">
                                <img src="{{ asset('assets/media/svg/files/folder-document.svg') }}"
                                    class="theme-light-show" alt="" />
                                <img src="{{ asset('assets/media/svg/files/folder-document-dark.svg') }}"
                                    class="theme-dark-show" alt="" />
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bold mb-2">{{ $certificate->name }}</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                        <!--begin::Description-->
                        <div class="fs-7 fw-semibold text-gray-500">
                            {{ $certificate->files->count() . ' ' . __('files') }}</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--begin::Body-->
            <div id="certificate-{{ $certificate->id }}" class="fs-6 collapse ps-10" data-bs-parent="#{{ $loop->index }}">
                ...
            </div>
            <!--end::Body-->
            <!--end::Col-->
        @empty
            <p class="text-muted">{{ __('No certificates found.') }}</p>
        @endforelse
    </div>
    <!--end:Row-->
@endsection
