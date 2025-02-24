"use strict";

var datatable;

// Class definition
var KTDatatablesServerSide = function () {
    let dbTable = 'products';
    // Private functions
    var initDatatable = function () {
        datatable = $("#kt_datatable_refunds").DataTable({
            language: language,
            searchDelay: searchDelay,
            processing: processing,
            serverSide: serverSide,
            order: [],
            stateSave: saveState,
            ajax: {
                url: `/dashboard/${dbTable}/${productId}?type=refunds`,
            },
            columns: [
                // { data: 'id' },
                { data: 'user.name' },
                { data: 'reason' },
                { data: 'status_text' },
                { data: 'created_at' },
            ],
            columnDefs: [
                {
                    targets: 2,
                    render: function (data, type, row) {
                        return `<span class="badge ${row.status === 1 ? 'badge-light-warning' :
                            row.status === 2 ? 'badge-light-success' :
                                'badge-light-danger'
                            }" >
                            ${data}
                        </span>`;
                    }
                },
            ],
            // Add data-filter attribute
            createdRow: function (row, data, dataIndex) {
                // $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            }
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            KTMenu.createInstances();
        });
    }

    // Public methods
    return {
        init: function () {
            initDatatable();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
