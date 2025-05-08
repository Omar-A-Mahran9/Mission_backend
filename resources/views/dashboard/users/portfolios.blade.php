<!--begin::Row-->
<div class="row g-6 g-xl-9 mb-6 mb-xl-9">
    <div class="mb-3 text-end">
        <button id="toggle-all-portfolios" class="btn btn-sm btn-primary">{{ __('Expand All') }}</button>
    </div>
    @forelse ($user->portfolios as $portfolio)
        @php
            $maxLength = 50;
            $description = $portfolio->description;
            $isLong = strlen($description) > $maxLength;
            $shortDesc = Str::limit($description, $maxLength, '...');
        @endphp
        <!--begin::Col-->
        <div class="col-md-6 col-lg-4 col-xl-3" id="{{ $loop->index }}">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->
                <div class="card-body card-custom-portfolios d-flex justify-content-center text-center flex-column p-8"
                    data-bs-toggle="collapse" id="fileCollapse-portfolios-{{ $portfolio->id }}"
                    data-bs-target="#portfolios-{{ $portfolio->id }}" style="cursor: pointer;">
                    <!--begin::Name-->
                    <a href="#portfolios-{{ $portfolio->id }}"
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
                        <div class="fs-5 fw-bold mb-2">{{ $portfolio->title }}</div>
                        <!--end::Title-->
                    </a>
                    <!--end::Name-->
                    <!--begin::Description-->
                    <div class="fs-7 fw-semibold mb-2"> <span class="description-preview"
                            id="desc-{{ $portfolio->id }}">
                            {{ $isLong ? $shortDesc : $description }}
                        </span>

                        @if ($isLong)
                            <a href="javascript:void(0);" class="fs-8 text-semibold ms-2 toggle-desc"
                                data-id="{{ $portfolio->id }}" data-full="{{ e($description) }}"
                                data-short="{{ e($shortDesc) }}" style="color: gray">
                                ({{ __('Show more') }})
                            </a>
                        @endif
                    </div>
                    <div class="fs-7 fw-semibold text-gray-500 mb-6">
                        {{ $portfolio->files->count() . ' ' . __('files') }}</div>
                    <!--end::Description-->

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>

        <!--begin::Body-->
        <div id="portfolios-{{ $portfolio->id }}" class="fs-6 collapse card-open-custom-portfolios ps-10"
            data-bs-parent="#{{ $loop->index }}">
            <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                @forelse ($portfolio->files as $file)
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
                <p class="text-muted">{{ __('No portfolios found.') }}</p>
            @endforelse
        </div>
        <!--end:Row-->
