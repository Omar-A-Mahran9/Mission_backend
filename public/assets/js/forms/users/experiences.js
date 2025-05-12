$(document).ready(function () {
    retrieveProductsFormBackend();

    $("#filter-form").submit(function (e) {
        e.preventDefault();
        retrieveProductsFormBackend();
    });

    $("input[name='name']").keyup(function (e) {
        retrieveProductsFormBackend();
    });

    pageTransition();
});


function retrieveProductsFormBackend(page = 1) {
    let form = document.getElementById('filter-form');
    let isAdvancedSearch = $("#kt_advanced_search_form").hasClass("show");

    $("input[name='advanced_search']").val(isAdvancedSearch);
    showLoading();
    $.ajax({
        type: "get",
        url: `/dashboard/users/${userId}/experiences`,
        data: $(form).serialize(),
        success: function (response) {
            hideLoading();
            productItems(response);
        },
        error: function (response) {
            hideLoading();
        }
    });
}

var productItems = function (response) {
    var experiences = response.experiences.data || {};
    var productCards = '';
    productCards = `<div class="d-flex gap-3">`;

    if (Object.keys(experiences).length > 0) {
        $("#no-results-alert").hide();
        $.each(experiences, function (index, product) {
            let skillsHtml = '';
            let specialistsHtml = '';

            // Loop through skills if available
            if (product.skills && product.skills.length > 0) {
                $.each(product.skills, function (i, skill) {
                    skillsHtml += `<span class=" fs-7 m-1" style="border-radius: 4px;
    background: #409597;
    color: white;
    font-size: 14px;
    font-weight: 400;   padding: 7px 7px;">${skill.name}</span>`;
                });
            }
            if (product.specialists && product.specialists.length > 0) {
                $.each(product.specialists, function (i, specialist) {
                    specialistsHtml += `<span class=" fs-7 m-1" style="border-radius: 4px;
    background: #409597;
    color: white;
    font-size: 14px;
    font-weight: 400;   padding: 7px 7px;">${specialist.name}</span>`;
                });
            }
            productCards += `
            <div class="card mb-6 mb-xl-9 col-md-3">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Title-->
                    <div class="d-flex align-items-center mb-3 gap-2">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;font-size: 16px;  background: #409597">
                        ${index + 1}
                    </div>
                        <a href="#" class="fs-4 fw-bold mb-1 text-gray-900 text-hover-primary mb-2"style="width: 225px;height: 19px;font-weight: 500 !important;
font-size: 22px !important;
line-height: 100%;
">${product.field.name}</a>
                    <!--end::Title-->
                    </div>
                    <!--begin::Header-->
                    <div>
                    <h5 class="text-gray-600 fs-6 mb-2" style="font-size:14px;Weight:400;color:#555555;">${__(`Specialists`)}</h5>
                    </div>
                    <div class="d-flex align-items-center flex-wrap mb-6">
                        <!--begin::Badge-->
                        ${specialistsHtml}
                        <!--end::Badge-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Header-->
                    <div>
                    <h5 class="text-gray-600 fs-6 mb-2"style="font-size:14px;Weight:400;color:#555555;">${__(`Skills`)}</h5>
                    </div>
                    <div class="d-flex align-items-center flex-wrap gap-1">
                        <!--begin::Badge-->
                        ${skillsHtml}
                        <!--end::Badge-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card body-->
            </div>
            `
        });
        productCards += `</div>`;

    } else {
        if (response.total == 0) { // check if database contains products
            productCards = ``;
            $("#no-results-alert").fadeIn();
        }
    }
    $(".experiences-container").html(productCards);
    paginator(response);
    KTMenu.createInstances();

}

var paginator = function (response) {
    var links = '';
    var paginationContent = '';
    var products = response.experiences.data || [];
    var paginationData = response.experiences;
    var prevUrl = paginationData.prev_page_url || 'javascript:;';
    var nextUrl = paginationData.next_page_url || 'javascript:;';
    console.log(products.length);
    if (products.length != 0) {
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
                productItems(response);
            });
        }
    });
}

function showLoading() {
    $('#experiences-container').html('');
    $('#loading-alert').removeClass('d-none');
}
function hideLoading() {
    $('#loading-alert').addClass('d-none');
}
