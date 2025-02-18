@extends('dashboard.partials.master')
@section('content')
<!--begin::Content-->
                            <div id="kt_app_content" class="app-content">
                                <!--begin::Products-->
                                <div class="card card-flush">
                                    <!--begin::Card header-->
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <!--begin::Search-->
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                                <input type="text" data-kt-ecommerce-product-filter="search"
                                                    class="form-control form-control-solid w-250px ps-12"
                                                    placeholder="Search Product" />
                                            </div>
                                            <!--end::Search-->
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                            <div class="w-100 mw-150px">
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Status"
                                                    data-kt-ecommerce-product-filter="status">
                                                    <option></option>
                                                    <option value="all">All</option>
                                                    <option value="published">Published</option>
                                                    <option value="scheduled">Scheduled</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                                <!--end::Select2-->
                                            </div>
                                            <!--begin::Add product-->
                                            <a href="apps/ecommerce/catalog/add-product.html"
                                                class="btn btn-primary">Add Product</a>
                                            <!--end::Add product-->
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                                            id="kt_ecommerce_products_table">
                                            <thead>
                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                data-kt-check="true"
                                                                data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                                value="1" />
                                                        </div>
                                                    </th>
                                                    <th class="min-w-200px">Product</th>
                                                    <th class="text-end min-w-100px">SKU</th>
                                                    <th class="text-end min-w-70px">Qty</th>
                                                    <th class="text-end min-w-100px">Price</th>
                                                    <th class="text-end min-w-100px">Rating</th>
                                                    <th class="text-end min-w-100px">Status</th>
                                                    <th class="text-end min-w-70px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/1.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    1</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01291009</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="24">
                                                        <span class="fw-bold ms-3">24</span>
                                                    </td>
                                                    <td class="text-end pe-0">138</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/2.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    2</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01267004</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="22">
                                                        <span class="fw-bold ms-3">22</span>
                                                    </td>
                                                    <td class="text-end pe-0">79</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/3.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    3</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02707001</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="29">
                                                        <span class="fw-bold ms-3">29</span>
                                                    </td>
                                                    <td class="text-end pe-0">83</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/4.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    4</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04990009</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="10">
                                                        <span class="fw-bold ms-3">10</span>
                                                    </td>
                                                    <td class="text-end pe-0">33</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/5.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    5</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02216009</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="17">
                                                        <span class="fw-bold ms-3">17</span>
                                                    </td>
                                                    <td class="text-end pe-0">293</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/6.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    6</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02395009</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="4">
                                                        <span class="badge badge-light-warning">Low stock</span>
                                                        <span class="fw-bold text-warning ms-3">4</span>
                                                    </td>
                                                    <td class="text-end pe-0">219</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/7.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    7</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02222004</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="35">
                                                        <span class="fw-bold ms-3">35</span>
                                                    </td>
                                                    <td class="text-end pe-0">113</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/8.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    8</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04846006</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="36">
                                                        <span class="fw-bold ms-3">36</span>
                                                    </td>
                                                    <td class="text-end pe-0">216</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/9.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    9</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04434009</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="17">
                                                        <span class="fw-bold ms-3">17</span>
                                                    </td>
                                                    <td class="text-end pe-0">11</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/10.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    10</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04309002</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="21">
                                                        <span class="fw-bold ms-3">21</span>
                                                    </td>
                                                    <td class="text-end pe-0">146</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/11.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    11</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">03960001</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="9">
                                                        <span class="badge badge-light-warning">Low stock</span>
                                                        <span class="fw-bold text-warning ms-3">9</span>
                                                    </td>
                                                    <td class="text-end pe-0">240</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/12.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    12</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01185003</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="37">
                                                        <span class="fw-bold ms-3">37</span>
                                                    </td>
                                                    <td class="text-end pe-0">131</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/13.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    13</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02857007</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="2">
                                                        <span class="badge badge-light-warning">Low stock</span>
                                                        <span class="fw-bold text-warning ms-3">2</span>
                                                    </td>
                                                    <td class="text-end pe-0">15</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/14.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    14</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04980007</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="46">
                                                        <span class="fw-bold ms-3">46</span>
                                                    </td>
                                                    <td class="text-end pe-0">37</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/15.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    15</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01511006</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="28">
                                                        <span class="fw-bold ms-3">28</span>
                                                    </td>
                                                    <td class="text-end pe-0">20</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/16.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    16</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02323006</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="31">
                                                        <span class="fw-bold ms-3">31</span>
                                                    </td>
                                                    <td class="text-end pe-0">16</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/17.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    17</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01901005</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="30">
                                                        <span class="fw-bold ms-3">30</span>
                                                    </td>
                                                    <td class="text-end pe-0">17</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/18.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    18</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">03624008</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="13">
                                                        <span class="fw-bold ms-3">13</span>
                                                    </td>
                                                    <td class="text-end pe-0">77</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/19.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    19</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04750008</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="46">
                                                        <span class="fw-bold ms-3">46</span>
                                                    </td>
                                                    <td class="text-end pe-0">117</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/20.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    20</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02896003</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="47">
                                                        <span class="fw-bold ms-3">47</span>
                                                    </td>
                                                    <td class="text-end pe-0">72</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/21.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    21</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02877003</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="30">
                                                        <span class="fw-bold ms-3">30</span>
                                                    </td>
                                                    <td class="text-end pe-0">261</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/22.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    22</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01208007</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="20">
                                                        <span class="fw-bold ms-3">20</span>
                                                    </td>
                                                    <td class="text-end pe-0">13</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/23.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    23</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01928003</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="24">
                                                        <span class="fw-bold ms-3">24</span>
                                                    </td>
                                                    <td class="text-end pe-0">211</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/24.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    24</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04358001</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="47">
                                                        <span class="fw-bold ms-3">47</span>
                                                    </td>
                                                    <td class="text-end pe-0">117</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/25.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    25</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">03462007</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="23">
                                                        <span class="fw-bold ms-3">23</span>
                                                    </td>
                                                    <td class="text-end pe-0">160</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/26.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    26</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02497003</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="28">
                                                        <span class="fw-bold ms-3">28</span>
                                                    </td>
                                                    <td class="text-end pe-0">76</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/27.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    27</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04906007</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="33">
                                                        <span class="fw-bold ms-3">33</span>
                                                    </td>
                                                    <td class="text-end pe-0">276</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/28.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    28</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02693009</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="43">
                                                        <span class="fw-bold ms-3">43</span>
                                                    </td>
                                                    <td class="text-end pe-0">113</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/29.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    29</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04438002</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="20">
                                                        <span class="fw-bold ms-3">20</span>
                                                    </td>
                                                    <td class="text-end pe-0">245</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/30.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    30</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04424005</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="31">
                                                        <span class="fw-bold ms-3">31</span>
                                                    </td>
                                                    <td class="text-end pe-0">153</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/31.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    31</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04385005</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="32">
                                                        <span class="fw-bold ms-3">32</span>
                                                    </td>
                                                    <td class="text-end pe-0">278</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/32.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    32</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">03631008</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="37">
                                                        <span class="fw-bold ms-3">37</span>
                                                    </td>
                                                    <td class="text-end pe-0">101</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/33.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    33</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02220005</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="26">
                                                        <span class="fw-bold ms-3">26</span>
                                                    </td>
                                                    <td class="text-end pe-0">234</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/34.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    34</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02436007</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="7">
                                                        <span class="badge badge-light-warning">Low stock</span>
                                                        <span class="fw-bold text-warning ms-3">7</span>
                                                    </td>
                                                    <td class="text-end pe-0">158</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/35.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    35</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">03377003</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="12">
                                                        <span class="fw-bold ms-3">12</span>
                                                    </td>
                                                    <td class="text-end pe-0">195</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/36.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    36</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">03943004</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="1">
                                                        <span class="badge badge-light-warning">Low stock</span>
                                                        <span class="fw-bold text-warning ms-3">1</span>
                                                    </td>
                                                    <td class="text-end pe-0">150</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/37.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    37</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02255005</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="23">
                                                        <span class="fw-bold ms-3">23</span>
                                                    </td>
                                                    <td class="text-end pe-0">213</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/38.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    38</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04650007</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="14">
                                                        <span class="fw-bold ms-3">14</span>
                                                    </td>
                                                    <td class="text-end pe-0">262</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/39.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    39</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01382003</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="38">
                                                        <span class="fw-bold ms-3">38</span>
                                                    </td>
                                                    <td class="text-end pe-0">191</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/40.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    40</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01383005</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="10">
                                                        <span class="fw-bold ms-3">10</span>
                                                    </td>
                                                    <td class="text-end pe-0">43</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/41.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    41</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01579008</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="39">
                                                        <span class="fw-bold ms-3">39</span>
                                                    </td>
                                                    <td class="text-end pe-0">229</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/42.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    42</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04261009</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="14">
                                                        <span class="fw-bold ms-3">14</span>
                                                    </td>
                                                    <td class="text-end pe-0">120</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/43.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    43</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">04847009</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="8">
                                                        <span class="badge badge-light-warning">Low stock</span>
                                                        <span class="fw-bold text-warning ms-3">8</span>
                                                    </td>
                                                    <td class="text-end pe-0">282</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/44.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    44</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">03343004</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="10">
                                                        <span class="fw-bold ms-3">10</span>
                                                    </td>
                                                    <td class="text-end pe-0">71</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/45.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    45</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01514008</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="28">
                                                        <span class="fw-bold ms-3">28</span>
                                                    </td>
                                                    <td class="text-end pe-0">267</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/46.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    46</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01605004</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="12">
                                                        <span class="fw-bold ms-3">12</span>
                                                    </td>
                                                    <td class="text-end pe-0">115</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/47.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    47</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">03864009</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="43">
                                                        <span class="fw-bold ms-3">43</span>
                                                    </td>
                                                    <td class="text-end pe-0">60</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Inactive">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-danger">Inactive</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/48.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    48</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">02268006</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="11">
                                                        <span class="fw-bold ms-3">11</span>
                                                    </td>
                                                    <td class="text-end pe-0">185</td>
                                                    <td class="text-end pe-0" data-order="rating-3">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Published">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-success">Published</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/49.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    49</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01405004</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="12">
                                                        <span class="fw-bold ms-3">12</span>
                                                    </td>
                                                    <td class="text-end pe-0">238</td>
                                                    <td class="text-end pe-0" data-order="rating-4">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Thumbnail-->
                                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                                class="symbol symbol-50px">
                                                                <span class="symbol-label"
                                                                    style="background-image:url(assets/media//stock/ecommerce/50.png);"></span>
                                                            </a>
                                                            <!--end::Thumbnail-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                    data-kt-ecommerce-product-filter="product_name">Product
                                                                    50</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="fw-bold">01249005</span>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="18">
                                                        <span class="fw-bold ms-3">18</span>
                                                    </td>
                                                    <td class="text-end pe-0">182</td>
                                                    <td class="text-end pe-0" data-order="rating-5">
                                                        <div class="rating justify-content-end">
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-outline ki-star fs-6"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-0" data-order="Scheduled">
                                                        <!--begin::Badges-->
                                                        <div class="badge badge-light-primary">Scheduled</div>
                                                        <!--end::Badges-->
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="apps/ecommerce/catalog/edit-product.html"
                                                                    class="menu-link px-3">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
                            {{--  <script src="{{ asset('assets/dashboard/js/global/datatable-config.js') }}"></script>
                            <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>
                            <script src="{{ asset('assets/dashboard/js/datatables/observers.js') }}"></script>
                            <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>
                            <script src="{{ asset('assets/dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>  --}}
                        @endpush