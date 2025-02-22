"use strict";

var datatable;
// Class definition
var KTDatatablesServerSide = function () {
    let dbTable = 'products';
    // Private functions
    var initDatatable = function () {
        datatable = $("#kt_datatable").DataTable({
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
                url: `/dashboard/${dbTable}/${productId}`,
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
            initToggleToolbar();
            KTMenu.createInstances();
        });
    }

    // Public methods
    return {
        init: function () {
            initDatatable();
            initToggleToolbar();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
