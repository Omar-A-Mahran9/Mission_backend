$(document).ready(function () {
    retrieveCertificatesFormBackend();

    $("#filter-form").submit(function (e) {
        e.preventDefault();
        retrieveCertificatesFormBackend();
    });

    $("input[name='name']").keyup(function (e) {
        retrieveCertificatesFormBackend();
    });

    pageTransition();
});


function retrieveCertificatesFormBackend(page = 1) {
    let form = document.getElementById('filter-form');
    let isAdvancedSearch = $("#kt_advanced_search_form").hasClass("show");

    $("input[name='advanced_search']").val(isAdvancedSearch);
    showLoading();
    $.ajax({
        type: "get",
        url: `/dashboard/users/${userId}/certificates?page=${page}`,
        data: $(form).serialize(),
        success: function (response) {
            hideLoading();
            console.log(response);
            certificateItems(response);
        },
        error: function (response) {
            hideLoading();
            console.log(response);
        }
    });
}

var certificateItems = function (response) {
    var certificates = response.certificates.data || {};
    var certificateCards = '';

    if (certificates.length > 0) {
        certificateCards = `
        <div class="mb-3 text-end">
        <button id="toggle-all" class="btn btn-sm btn-primary">${__('Expand All')}</button>
    </div>`;
        $("#no-results-alert").hide();
        certificates.forEach((certificate, index) => {
            const expiration = certificate.expiration_date ?? '';
            const reviewed = certificate.is_review ? 'Yes' : 'No';

            let filesHtml = '';
            certificate.files.forEach(file => {
                const extension = file.file.split('.').pop().toLowerCase();
                const filename = file.file.split('/').pop();
                const nameOnly = filename.includes('_') ? filename.split('_').pop().split('.')[0] : filename;
                let icon = '';

                switch (extension) {
                    case 'pdf':
                        icon = 'pdf.svg';
                        break;
                    case 'jpg':
                    case 'jpeg':
                        icon = 'jpg.png';
                        break;
                    case 'png':
                        icon = 'png.png';
                        break;
                    default:
                        icon = 'file.svg';
                        break;
                }

                filesHtml += `
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                <a href="${file.full_image_path}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <div class="symbol symbol-60px mb-5">
                                        <img src="/assets/media/svg/files/${icon}" class="theme-light-show" alt="">
                                    </div>
                                    <div class="fs-5 fw-bold mb-2">${nameOnly}</div>
                                </a>
                                <div class="fs-7 fw-semibold text-gray-500">${file.created_at_human}</div>
                            </div>
                        </div>
                    </div>
                `;
            });

            certificateCards += `
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <a href="#certificate-${certificate.id}" class="text-gray-800 text-hover-primary d-flex flex-column" data-bs-toggle="collapse" data-bs-target="#certificate-${certificate.id}" style="cursor: pointer;">
                                <div class="symbol symbol-75px mb-5">
                                    <img src="/assets/media/svg/files/folder-document.svg" class="theme-light-show" alt="">
                                </div>
                                <div class="fs-5 fw-bold mb-2">${certificate.name}</div>
                            </a>
                            <div class="fs-7 fw-semibold text-gray-500 mb-6">${certificate.files.length} files</div>
                            <div class="d-flex flex-center flex-wrap">
                                ${expiration ? `<div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3"><div class="fs-6 fw-bold text-gray-700">${expiration}</div><div class="fw-semibold text-gray-500">Expiration date</div></div>` : ''}
                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                    <div class="fs-6 fw-bold text-gray-700">${reviewed}</div>
                                    <div class="fw-semibold text-gray-500">Reviewed?</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="certificate-${certificate.id}" class="collapse ps-10 mt-3">${filesHtml}</div>
                </div>
            `;
        });

    } else {
        if (response.total > 0) { // check if database contains products
            certificateCards = ``;
            $("#no-results-alert").fadeIn();
        }
    }

    $(".certificates-container").html(certificateCards);
    paginator(response);
    KTMenu.createInstances();
    // window.products = products;

}
var paginator = function (response) {
    var links = '';
    var paginationContent = '';
    var certificates = response.certificates.data || [];
    var paginationData = response.certificates;
    var prevUrl = paginationData.prev_page_url || 'javascript:;';
    var nextUrl = paginationData.next_page_url || 'javascript:;';

    // Serialize the filter form to include filter parameters
    var filterParams = $('#filter-form').serialize();

    if (certificates.length != 0) {
        for (var i = 1; i <= paginationData.last_page; i++) {
            var isCurrentPage = paginationData.current_page == i;
            var activeClass = isCurrentPage ? 'active' : '';

            if (paginationData.links[i] !== undefined) {
                // Append filter parameters to the pagination URLs
                var pageUrl = paginationData.links[i].url + '&' + filterParams;
                links += `
                <li class="page-item ${activeClass}">
                    <a href="${isCurrentPage ? '#' : pageUrl}" class="page-link">${i}</a>
                </li>
                `;
            }
        }

        var prevPageUrl = prevUrl !== 'javascript:;' ? prevUrl + '&' + filterParams : 'javascript:;';
        var nextPageUrl = nextUrl !== 'javascript:;' ? nextUrl + '&' + filterParams : 'javascript:;';

        paginationContent = `
        <div class="spinner-border spinner-border-sm my-auto d-none" id="pagination-loading" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <li class="page-item previous ${prevUrl == 'javascript:;' ? 'disabled' : ''}">
            <a href="${prevPageUrl}" class="page-link">
                <i class="previous"></i>
            </a>
        </li>
        ${links}
        <li class="page-item next ${nextUrl == 'javascript:;' ? 'disabled' : ''}">
            <a href="${nextPageUrl}" class="page-link">
                <i class="next"></i>
            </a>
        </li>
        `;

        $(".pagination-info").text(__(`Show 1 to`) + ` ${paginationData.per_page} ` + __(`from total`) + ` ${paginationData.total} `);

        $("#pagination-container").show();
    } else {
        $("#pagination-container").hide();
    }

    $(".pagination").html(paginationContent);
}

var pageTransition = function () {
    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');

        if (url != '#') {
            $("#pagination-loading").removeClass('d-none');

            // Use the serialized filter form data in the AJAX request
            $.get(url, function (response) {
                $("#pagination-loading").addClass('d-none');
                certificateItems(response);
            });
        }
    });
}
function showLoading() {
    $('#certificates-container').html('');
    $('#loading-alert').removeClass('d-none');
}
function hideLoading() {
    $('#loading-alert').addClass('d-none');
}
