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
        url: `/dashboard/users/${userId}/experiences?page=${page}`,
        data: $(form).serialize(),
        success: function (response) {
            hideLoading();
            console.log(response);
            productItems(response);
        },
        error: function (response) {
            hideLoading();
            console.log(response);
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
            console.log(product);
            let skillsHtml = '';
            let specialistsHtml = '';

            // Loop through skills if available
            if (product.skills && product.skills.length > 0) {
                $.each(product.skills, function (i, skill) {
                    skillsHtml += `<span class="badge badge-light-primary fs-7 m-1">${skill.name}</span>`;
                });
            }
            if (product.specialists && product.specialists.length > 0) {
                $.each(product.specialists, function (i, specialist) {
                    specialistsHtml += `<span class=" fs-7 m-1">${specialist.name}</span>`;
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
                    <div class="mb-2">
                        <a href="#" class="fs-4 fw-bold mb-1 text-gray-900 text-hover-primary"style="width: 225px;height: 19px;font-weight: 500 !important;
font-size: 16px !important;
line-height: 100%;
letter-spacing: 0%;
">${product.field.name}</a>
                    </div>
                    <!--end::Title-->
                    </div>
                    <!--begin::Header-->
                    <div>
                    <h5 class="text-gray-600 fs-6 mb-3" style="font-size:14px;Weight:400;color:#555555;">${__(`Specialists`)}</h5>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <!--begin::Badge-->
                        ${specialistsHtml}
                        <!--end::Badge-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Header-->
                    <div>
                    <h5 class="text-gray-600 fs-6 mb-0">${__(`Skills`)}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded p-2 flex-wrap">
                        <!--begin::Badge-->
                        ${skillsHtml}
                        <!--end::Badge-->
                        </div>
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card body-->
            </div>
            `
        });
        productCards += `</div>`;

    } else {
        if (response.total > 0) { // check if database contains products
            productCards = ``;
            $("#no-results-alert").fadeIn();
        }
    }

    $(".experiences-container").html(productCards);
    deleteProduct();
    paginator(response);
    KTMenu.createInstances();

}

var paginator = function (response) {
    console.log(response);
    var links = '';
    var paginationContent = '';
    var products = response.experiences.data || [];
    var paginationData = response.experiences;
    var prevUrl = paginationData.prev_page_url || 'javascript:;';
    var nextUrl = paginationData.next_page_url || 'javascript:;';

    // Serialize the filter form to include filter parameters
    var filterParams = $('#filter-form').serialize();

    if (products.length != 0) {
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
                productItems(response);
            });
        }
    });
}



function showLoading() {
    $('#products-container').html('');
    $('#loading-alert').removeClass('d-none');
}
function hideLoading() {
    $('#loading-alert').addClass('d-none');
}

function deleteProduct(params) {
    $('.delete-item').on('click', function (e) {
        e.preventDefault();

        let id = $(this).attr('data-id');
        deleteElement('', `/dashboard/experiences/${id}`, () => retrieveProductsFormBackend())
    });
}

function handlePreviewClick(imagePath) {
    // Clear the current attachments preview
    $(".attachments").html('');

    // Append the new attachment to be previewed
    $(".attachments").append(`
        <!--begin::Overlay-->
        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="${imagePath}">
            <!--begin::Action-->
            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                <i class="bi bi-eye-fill text-white fs-3x"></i>
            </div>
            <!--end::Action-->
        </a>
        <!--end::Overlay-->
    `);

    // Refresh lightbox instance to ensure the new content is recognized
    refreshFsLightbox();

    // Automatically trigger the first attachment preview (lightbox)
    $("[data-fslightbox='lightbox-basic']:first").trigger('click');
}
