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
                    <div class="fs-7 fw-semibold text-gray-500 mb-6">
                        {{ $certificate->files->count() . ' ' . __('files') }}</div>
                    <!--end::Description-->
                    <!--begin::Info-->
                    <div class="d-flex flex-center flex-wrap">
                        <!--begin::Stats-->
                        @if ($certificate->have_expiration_date == 1)
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">{{ $certificate->expiration_date }}</div>
                                <div class="fw-semibold text-gray-500">{{ __('Expiration date') }}</div>
                            </div>
                        @endif
                        <!--end::Stats-->
                        <!--begin::Stats-->
                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                            <div class="fs-6 fw-bold text-gray-700">
                                {{ $certificate->is_review ? __('Yes') : __('No') }}
                            </div>
                            <div class="fw-semibold text-gray-500">{{ __('Reviewed?') }}</div>
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--begin::Body-->
        <div id="certificate-{{ $certificate->id }}" class="fs-6 collapse ps-10"
            data-bs-parent="#{{ $loop->index }}">
            <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                @forelse ($certificate->files as $file)
                    @php
                        $extension = strtolower(pathinfo($file->file, PATHINFO_EXTENSION));
                        $filename = pathinfo($file->file, PATHINFO_FILENAME);
                        $nameOnly = Str::afterLast($filename, '_');
                    @endphp
                    {{--  @dd(pathinfo($file->file, PATHINFO_EXTENSION))  --}}
                    <!--begin::Col-->
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
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
                                                <img src="{{ asset('assets/media/svg/files/png-dark.svg') }}"
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
                <!--begin::Row-->
                {{--  <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <!--begin::Name-->
                            <a href="apps/file-manager/files.html"
                                class="text-gray-800 text-hover-primary d-flex flex-column">
                                <!--begin::Image-->
                                <div class="symbol symbol-60px mb-5">
                                    <img src="assets/media/svg/files/pdf.svg" class="theme-light-show" alt="" />
                                    <img src="assets/media/svg/files/pdf-dark.svg" class="theme-dark-show"
                                        alt="" />
                                </div>
                                <!--end::Image-->
                                <!--begin::Title-->
                                <div class="fs-5 fw-bold mb-2">Project Reqs..</div>
                                <!--end::Title-->
                            </a>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <div class="fs-7 fw-semibold text-gray-500">3 days ago</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <!--begin::Name-->
                            <a href="apps/file-manager/files.html"
                                class="text-gray-800 text-hover-primary d-flex flex-column">
                                <!--begin::Image-->
                                <div class="symbol symbol-60px mb-5">
                                    <img src="assets/media/svg/files/doc.svg" class="theme-light-show" alt="" />
                                    <img src="assets/media/svg/files/doc-dark.svg" class="theme-dark-show"
                                        alt="" />
                                </div>
                                <!--end::Image-->
                                <!--begin::Title-->
                                <div class="fs-5 fw-bold mb-2">CRM App Docs..</div>
                                <!--end::Title-->
                            </a>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <div class="fs-7 fw-semibold text-gray-500">3 days ago</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <!--begin::Name-->
                            <a href="apps/file-manager/files.html"
                                class="text-gray-800 text-hover-primary d-flex flex-column">
                                <!--begin::Image-->
                                <div class="symbol symbol-60px mb-5">
                                    <img src="assets/media/svg/files/css.svg" class="theme-light-show" alt="" />
                                    <img src="assets/media/svg/files/css-dark.svg" class="theme-dark-show"
                                        alt="" />
                                </div>
                                <!--end::Image-->
                                <!--begin::Title-->
                                <div class="fs-5 fw-bold mb-2">User CRUD Styles</div>
                                <!--end::Title-->
                            </a>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <div class="fs-7 fw-semibold text-gray-500">4 days ago</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <!--begin::Name-->
                            <a href="apps/file-manager/files.html"
                                class="text-gray-800 text-hover-primary d-flex flex-column">
                                <!--begin::Image-->
                                <div class="symbol symbol-60px mb-5">
                                    <img src="assets/media/svg/files/ai.svg" class="theme-light-show" alt="" />
                                    <img src="assets/media/svg/files/ai-dark.svg" class="theme-dark-show"
                                        alt="" />
                                </div>
                                <!--end::Image-->
                                <!--begin::Title-->
                                <div class="fs-5 fw-bold mb-2">Product Logo</div>
                                <!--end::Title-->
                            </a>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <div class="fs-7 fw-semibold text-gray-500">5 days ago</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <!--begin::Name-->
                            <a href="apps/file-manager/files.html"
                                class="text-gray-800 text-hover-primary d-flex flex-column">
                                <!--begin::Image-->
                                <div class="symbol symbol-60px mb-5">
                                    <img src="assets/media/svg/files/sql.svg" class="theme-light-show" alt="" />
                                    <img src="assets/media/svg/files/sql-dark.svg" class="theme-dark-show"
                                        alt="" />
                                </div>
                                <!--end::Image-->
                                <!--begin::Title-->
                                <div class="fs-5 fw-bold mb-2">Orders backup</div>
                                <!--end::Title-->
                            </a>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <div class="fs-7 fw-semibold text-gray-500">1 week ago</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <!--begin::Name-->
                            <a href="apps/file-manager/files.html"
                                class="text-gray-800 text-hover-primary d-flex flex-column">
                                <!--begin::Image-->
                                <div class="symbol symbol-60px mb-5">
                                    <img src="assets/media/svg/files/xml.svg" class="theme-light-show"
                                        alt="" />
                                    <img src="assets/media/svg/files/xml-dark.svg" class="theme-dark-show"
                                        alt="" />
                                </div>
                                <!--end::Image-->
                                <!--begin::Title-->
                                <div class="fs-5 fw-bold mb-2">UTAIR CRM API Co..</div>
                                <!--end::Title-->
                            </a>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <div class="fs-7 fw-semibold text-gray-500">2 weeks ago</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <!--begin::Name-->
                            <a href="apps/file-manager/files.html"
                                class="text-gray-800 text-hover-primary d-flex flex-column">
                                <!--begin::Image-->
                                <div class="symbol symbol-60px mb-5">
                                    <img src="{{ asset('assets/media/svg/files/tif.svg') }}" class="theme-light-show"
                                        alt="" />
                                    <img src="{{ asset('assets/media/svg/files/tif-dark.svg') }}"
                                        class="theme-dark-show" alt="" />
                                </div>
                                <!--end::Image-->
                                <!--begin::Title-->
                                <div class="fs-5 fw-bold mb-2">Tower Hill App..</div>
                                <!--end::Title-->
                            </a>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <div class="fs-7 fw-semibold text-gray-500">3 weeks ago</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
            </div>  --}}
                <!--end:Row-->
            </div>
            <!--end::Body-->
            <!--end::Col-->
            @empty
                <p class="text-muted">{{ __('No certificates found.') }}</p>
            @endforelse
        </div>
        <!--end:Row-->
