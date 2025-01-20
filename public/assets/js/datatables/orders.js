"use strict";

var datatable;
// Class definition
var KTDatatablesServerSide = function () {
    let dbTable = 'orders';
    // if(typeof userId !== 'undefined'){
    //     dbTable +='?user_id='+userId;
    //     console.log(dbTable);
    // }
    // Private functions
    var initDatatable = function () {
        datatable = $("#kt_datatable_orders").DataTable({
            language: language,
            searchDelay: searchDelay,
            processing: processing,
            serverSide: serverSide,
            order: [],
            stateSave: saveState,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                url: `/dashboard/${dbTable}`,
            },
            columns: [
                { data: 'id' },
                { data: 'serial_no' },
                { data: 'customer.name', name: 'customer_id' },
                { data: 'total_price' },
                { data: 'status_name', name: 'status' },
                { data: 'created_at' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                        return `
                            <div>
                                <!--begin::Info-->
                                <div class="d-flex flex-column justify-content-center">
                                    <span class="mb-1 text-gray-600 ">${data ?? 'ــ'}</span>
                                </div>
                                <!--end::Info-->
                            </div>
                        `;
                    }
                },
                {
                    targets: 4,
                    orderable: false,
                    render: function (data) {
                        console.log(data);
                        let status = {
                            'OrderPlaced': { 'color': 'primary', 'title': __('OrderPlaced') },
                            'PaymentConfirmed': { 'color': 'primary', 'title': __('PaymentConfirmed') },
                            'Processing': { 'color': 'primary', 'title': __('Processing') },
                            'Shipped': { 'color': 'info', 'title': __('Shipped') },
                            'Delivered': { 'color': 'success', 'title': __('Delivered') },
                            'Rejected': { 'color': 'danger', 'title': __('Rejected') },
                            'Canceled': { 'color': 'danger', 'title': __('Canceled') },
                            'Refund': { 'color': 'success', 'title': __('Refund') },
                        };

                        return `<span class="badge badge-light-${status[data]['color']}">${__(status[data]['title'])}</span>`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    render: function (data, type, row) {
                        return `
                        <a href="/dashboard/orders/${data.id}" class="btn btn-light btn-active-light-primary btn-sm ">
                            <span class="indicator-label">
                                ${__('Show')}
                            </span>
                            <i class="fa-regular fa-eye fs-4"></i>
                        </a>
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            createdRow: function (row, data, dataIndex) {
                // $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            }
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            //initToggleToolbar();
            // if(typeof userId === 'undefined'){
            // toggleToolbars();
            // }
            KTMenu.createInstances();
        });
    }


    // Public methods
    return {
        init: function () {
            initDatatable();
            // if(typeof userId === 'undefined'){
            handleSearchDatatable();
            handleFilterRowsByColumnIndex();
            //initToggleToolbar();
            // }
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
