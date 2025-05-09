"use strict";

var datatable;
// Class definition
var KTDatatablesServerSide = function () {
    let dbTable = 'products';
    // Private functions
    var initDatatable = function () {
        datatable = $("#kt_datatable_bids").DataTable({
            language: language,
            searchDelay: searchDelay,
            processing: processing,
            serverSide: serverSide,
            order: [],
            stateSave: saveState,
            ajax: {
                url: `/dashboard/${dbTable}/${productId}?type=bids`,
            },
            columns: [
                { data: 'user.name' },
                { data: 'bid_amount' },
                { data: 'created_at' },
            ],
            columnDefs: [
                {
                    targets: 1, // "bid_amount" is the second column (index starts from 0)
                    className: "text-center"
                }
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
