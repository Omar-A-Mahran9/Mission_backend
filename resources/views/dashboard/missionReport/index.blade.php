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
        <!--begin::Products-->
        <div class="card card-flush">
            <!--begin::Card header-->
<div class="card-header border-0 cursor-pointer d-flex justify-content-between align-items-center">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">{{ __('Report list') }}</h3>
                </div>
                <!--end::Card title-->

               <div class="text-end">
    <button class="btn fw-bold m-0 text-white " style="background-color: var(--bs-info); border: none;">
      <a class="text-white" href="{{ route('dashboard.report.create') }}">
    
      {{ __('Create Report') }}
    
    </a>
    </button>
</div>

            </div>
            <!--begin::Card header-->
            <!--begin::Card header-->
            {{-- <div class="card-header align-items-center py-5 gap-2 gap-md-5">
 
                <!--begin::Card title-->
                <!--end::Card title-->

            </div> --}}

           
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                #
                            </th>
                            <th>{{ __('Name ar') }}</th>
                            <th>{{ __('Name en') }}</th>

                            <th class="text-start">{{ __('Created at') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    </tbody>
                </table>

                <div id="pagination" class="mt-4 text-center"></div>

                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Products-->
    </div>
    <!--end::Content-->
@endsection
@push('scripts')
    <script>
        window.isArabic = '{{ isArabic() }}';
   

    </script>
    <script src="{{ asset('assets/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/report.js') }}"></script>
    <script src="{{ asset('assets/js/global/crud-operations.js') }}"></script>
@endpush
