<!--begin::Row-->
<div class="row g-6 g-xl-9 mb-6 mb-xl-9">
    <div class="mb-3 text-end">
        <button id="toggle-all-licenses" class="btn btn-sm btn-primary">{{ __('Expand All') }}</button>
    </div>
    @forelse ($user->licenses as $license)
        <!--begin::Col-->
        <div class="col-md-6 col-lg-4 col-xl-3" id="{{ $loop->index }}">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->
                <div class="card-body card-custom-licens d-flex justify-content-center text-center flex-column p-8"
                    data-bs-toggle="collapse" id="fileCollapse-licens-{{ $license->id }}"
                    data-bs-target="#license-{{ $license->id }}" style="cursor: pointer;">
                    <!--begin::Name-->
                    <a href="#license-{{ $license->id }}" class="text-gray-800 text-hover-primary d-flex flex-column">
                        <!--begin::Image-->
                        <div class="symbol symbol-75px mb-5">
                            <img src="{{ asset('assets/media/svg/files/folder-document.svg') }}"
                                class="theme-light-show" alt="" />
                            <img src="{{ asset('assets/media/svg/files/folder-document-dark.svg') }}"
                                class="theme-dark-show" alt="" />
                        </div>
                        <!--end::Image-->
                        <!--begin::Title-->
                        <div class="fs-5 fw-bold mb-2">{{ $license->name }}</div>
                        <!--end::Title-->
                    </a>
                    <!--end::Name-->
                    <!--begin::Description-->
                    <div class="fs-7 fw-semibold text-gray-500 mb-6">
                        {{ $license->files->count() . ' ' . __('files') }}</div>
                    <!--end::Description-->
                    <!--begin::Info-->
                    <div class="d-flex flex-center flex-wrap">
                        <!--begin::Stats-->
                        @if ($license->expiration_date)
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">{{ $license->expiration_date }}</div>
                                <div class="fw-semibold text-gray-500">{{ __('Expiration date') }}</div>
                            </div>
                        @endif
                        <!--end::Stats-->
                        <!--begin::Stats-->
                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                            <div class="fs-6 fw-bold text-gray-700">
                                {{ $license->is_review ? __('Yes') : __('No') }}
                            </div>
                            <div class="fw-semibold text-gray-500">{{ __('Reviewed?') }}</div>
                        </div>
                        <!--end::Stats-->
                    </div>
                    @if (!$license->is_review)
                        <form method="POST"
                            action="{{ route('dashboard.approve', ['user' => $user->id, 'document' => $license->id]) }}"
                            data-redirection-url="{{ route('dashboard.users.show', $user) }}" class="form ajax-form"
                            method="POST">
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-primary mt-3">
                                {{ __('Approve') }}
                            </button>
                        </form>
                    @endif
                    <!--end::Info-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>

        <!--begin::Body-->
        <div id="license-{{ $license->id }}" class="fs-6 collapse card-open-custom-licens ps-10"
            data-bs-parent="#{{ $loop->index }}">
            <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                @forelse ($license->files as $file)
                    @php
                        $extension = strtolower(pathinfo($file->file, PATHINFO_EXTENSION));
                        $filename = pathinfo($file->file, PATHINFO_FILENAME);
                        $nameOnly = Str::afterLast($filename, '_');
                    @endphp
                    <!--begin::Col-->
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class=" card-body d-flex justify-content-center text-center flex-column p-8">
                                <!--begin::Name-->
                                <a href="{{ $file->full_image_path }}"
                                    class="text-gray-800 text-hover-primary d-flex flex-column" target="_blank">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-60px mb-5">
                                        @switch($extension)
                                            @case('pdf')
                                                <img src="{{ asset('assets/media/svg/files/pdf.svg') }}"
                                                    class="theme-light-show" alt="">
                                                <img src="{{ asset('assets/media/svg/files/pdf-dark.svg') }}"
                                                    class="theme-dark-show" alt="">
                                            @break

                                            @case('jpg')
                                                <img src="{{ asset('assets/media/svg/files/jpg.png') }}"
                                                    class="theme-light-show" alt="">
                                                <img src="{{ asset('assets/media/svg/files/jpg-dark.png') }}"
                                                    class="theme-dark-show" alt="">
                                            @break

                                            @case('jpeg')
                                                <img src="{{ asset('assets/media/svg/files/jpg.png') }}"
                                                    class="theme-light-show" alt="">
                                                <img src="{{ asset('assets/media/svg/files/jpg-dark.png') }}"
                                                    class="theme-dark-show" alt="">
                                            @break

                                            @case('png')
                                                <img src="{{ asset('assets/media/svg/files/png.png') }}"
                                                    class="theme-light-show" alt="">
                                                <img src="{{ asset('assets/media/svg/files/png-dark.png') }}"
                                                    class="theme-dark-show" alt="">
                                            @break
                                        @endswitch
                                    </div>
                                    <!--end::Image-->
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">{{ $nameOnly }}</div>
                                    <!--end::Title-->
                                </a>
                                <!--end::Name-->
                                <!--begin::Description-->
                                <div class="fs-7 fw-semibold text-gray-500">{{ $file->created_at->diffForHumans() }}
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                    @empty
                    @endforelse
                </div>
            </div>
            <!--end::Body-->
            <!--end::Col-->
            @empty
                <p class="text-muted">{{ __('No licenses found.') }}</p>
            @endforelse
        </div>
        <!--end:Row-->
