$(document).ready(function () {
    retrieveLicensesFormBackend();

    $("#filter-form").submit(function (e) {
        e.preventDefault();
        retrieveLicensesFormBackend();
    });

    $("input[name='name']").keyup(function (e) {
        retrieveLicensesFormBackend();
    });

    pageTransition();
});


function retrieveLicensesFormBackend(page = 1) {
    let form = document.getElementById('filter-form');

    showLoading();
    $.ajax({
        type: "get",
        url: `/dashboard/users/${userId}/licenses`,
        data: $(form).serialize(),
        success: function (response) {
            hideLoading();
            console.log(response);
            licenseItems(response);
        },
        error: function (response) {
            hideLoading();
            console.log(response);
        }
    });
}

var licenseItems = function (response) {
    var licenses = response.licenses.data || {};
    var licenseCards = '';
    if (licenses.length > 0) {
        licenseCards = `
        <div  id="licenses-grid">
        <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
        `;
        $("#no-results-alert").hide();
        licenses.forEach((license, index) => {
            const expirationHtml = license.expiration_date
                ? `<div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                <div class="fs-6 fw-bold text-gray-700">${license.expiration_date}</div>
                <div class="fw-semibold text-gray-500">${__('Expiration date')}</div>
           </div>`
                : '';
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const approveFormHtml = !license.is_review
                ? `<form method="POST"
                    action="/dashboard/users/${userId}/document/${license.id}"
                    data-redirection-url="${window.location.href}"
                    class="form ajax-form">
                <input type="hidden" name="_token" value="${csrfToken}">
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-sm btn-primary mt-3">
                    ${__('Approve')}
                </button>
            </form>`
                : '';
            licenseCards += `
            <div class="col-md-6 col-lg-4 col-xl-3" id="${index + 1}">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card body-->
                <div class="card-body card-custom d-flex justify-content-center text-center flex-column p-8"
                    data-bs-toggle="collapse" style="cursor: pointer;">
                    <!--begin::Name-->
                    <a href="#license-${license.id}"
                        class="text-gray-800 text-hover-primary d-flex flex-column license-click" data-license-id="${license.id}" >
                        <!--begin::Image-->
                        <div class="symbol symbol-75px mb-5">
                            <img src="/assets/media/svg/files/folder-document.svg"
                                class="theme-light-show" alt="" />
                            <img src="/assets/media/svg/files/folder-document-dark.svg"
                                class="theme-dark-show" alt="" />
                        </div>
                        <!--end::Image-->
                        <!--begin::Title-->
                        <div class="fs-5 fw-bold mb-2">${license.name}</div>
                        <!--end::Title-->
                    </a>
                    <!--end::Name-->
                    <!--begin::Description-->
                    <div class="fs-7 fw-semibold text-gray-500 mb-6">
                         ${license.files.length} ${__('files')}</div>
                    <!--end::Description-->
                    <!--begin::Info-->
                    <div class="d-flex flex-center flex-wrap">
                        <!--begin::Stats-->
                        ${expirationHtml}
                        <!--end::Stats-->
                        <!--begin::Stats-->
                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                            <div class="fs-6 fw-bold text-gray-700">
                                ${license.is_review ? __('Yes') : __('No')}
                            </div>
                            <div class="fw-semibold text-gray-500">${__('Reviewed?')}</div>
                        </div>
                        <!--end::Stats-->
                    </div>
                    ${approveFormHtml}
                    <!--end::Info-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>`;
        });
        licenseCards += `
        </div> <!-- close .row -->
      </div> <!-- close #licenses-grid -->
      <div id="license-details" style="display: none;"></div>
      `;
    } else {
        if (response.total == 0) { // check if database contains products
            licenseCards = ``;
            $("#no-results-alert").fadeIn();
        }
    }

    $(".licenses-container").html(licenseCards);
    $(".license-click").off("click").on("click", function () {
        const certId = $(this).data("license-id");

        $("#licenses-grid").hide();

        $("#license-details").html(""); // Clear previous content

        const cert = licenses.find(c => c.id === certId);
        if (cert) {
            let filesHtml = `
        <div class="mb-4">
            <!--begin::Table header-->
                <div class="d-flex flex-stack mb-4 back-to-licenses">
                    <!--begin::Folder path-->
                    <div class="badge badge-lg "style="background: #409597;">
                        <div class="d-flex align-items-center flex-wrap">
                        <i class="ki-outline ki-abstract-32 fs-2x text-white me-3"></i>
                        <a href="#" class="text-white" >${__("Licenses")}</a>
                        <i class="ki-outline ki-right fs-2x text-white mx-1"></i>
                        <a href="#" class="text-white">${cert.name}</a>
                    </div>
                    </div>
                    <!--end::Folder path-->
                </div>
            <!--end::Table header-->

            <div class="row g-6">`;

            cert.files.forEach(file => {
                const extension = file.file.split('.').pop().toLowerCase();
                const filename = file.file.split('/').pop();
                const nameOnly = filename.includes('_') ? filename.split('_').pop().split('.')[0] : filename;

                let icon = 'file.svg';
                if (extension === 'pdf') icon = 'pdf.svg';
                else if (['jpg', 'jpeg'].includes(extension)) icon = 'jpg.png';
                else if (extension === 'png') icon = 'png.png';

                filesHtml += `
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <a href="${file.full_image_path}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                <div class="symbol symbol-60px mb-5">
                                    <img src="/assets/media/svg/files/${icon}" alt="">
                                </div>
                                <div class="fs-5 fw-bold mb-2">${nameOnly}</div>
                            </a>
                            <div class="fs-7 fw-semibold text-gray-500">${file.created_at}</div>
                        </div>
                    </div>
                </div>`;
            });

            filesHtml += `</div></div>`;
            $("#license-details").html(filesHtml).fadeIn();
        }
    });

    // Handle the back button click
    $(document).on("click", ".back-to-licenses", function () {
        $("#license-details").hide();
        $("#licenses-grid").fadeIn();
    });

    paginator(response);
    KTMenu.createInstances();
    // window.products = products;

}
var paginator = function (response) {
    var links = '';
    var paginationContent = '';
    var licenses = response.licenses.data || [];
    var paginationData = response.licenses;
    var prevUrl = paginationData.prev_page_url || 'javascript:;';
    var nextUrl = paginationData.next_page_url || 'javascript:;';

    if (licenses.length != 0) {
        for (var i = 1; i <= paginationData.last_page; i++) {
            var isCurrentPage = paginationData.current_page == i;
            var activeClass = isCurrentPage ? 'active' : '';

            if (paginationData.links[i] !== undefined) {
                // Append filter parameters to the pagination URLs
                var pageUrl = paginationData.links[i].url;
                links += `
                <li class="page-item ${activeClass}">
                    <a href="${isCurrentPage ? '#' : pageUrl}" class="page-link">${i}</a>
                </li>
                `;
            }
        }

        var prevPageUrl = prevUrl !== 'javascript:;' ? prevUrl : 'javascript:;';
        var nextPageUrl = nextUrl !== 'javascript:;' ? nextUrl : 'javascript:;';

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
                licenseItems(response);
            });
        }
    });
}
function showLoading() {
    $('#licenses-container').html('');
    $('#loading-alert').removeClass('d-none');
}
function hideLoading() {
    $('#loading-alert').addClass('d-none');
}
