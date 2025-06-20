$(document).ready(function () {
    loadReports(); // Load page 1 by default
});
    // Fetch the data
    function loadReports(page = 1) {
    fetch(`/dashboard/report/all?page=${page}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(result => {
            console.log(result);
            const data = result.data;
            const tbody = $('#kt_datatable tbody');
            tbody.empty();

            if (data && Array.isArray(data)) {
                data.forEach((report, index) => {
                    const row = `
<tr>
    <td>${index + 1 + ((result.current_page - 1) * result.per_page)}</td>
    <td>${report.name_ar || '-'}</td>
    <td>${report.name_en || '-'}</td>
    <td>${formatDate(report.created_at)}</td>
    <td>
        <div class="">
            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <span class="svg-icon svg-icon-dark svg-icon-1 m-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor"/>
                                    <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor"/>
                                    </svg>
                                </span>
             </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
             
                <div class="menu-item px-3">
                    <a href="report/edit/form/${report.id}" class="menu-link px-3">
                        ${__('Edit')}
                    </a>
                </div>
                <div class="menu-item px-3">
                    <a href="javascript:;" class="menu-link px-3 delete_button" data-id="${report.id}">
                        ${__('Delete')}
                    </a>
                </div>
            </div>
        </div>
        </td>
 </tr>
`;
                    tbody.append(row);
                });

                renderPagination(result); // <-- Render pagination links
                KTMenu.createInstances();
            } else {
                tbody.append(`
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No reports found
                        </td>
                    </tr>
                `);
            }
        })
        .catch(error => {
            $('#kt_datatable tbody').html(`
                <tr>
                    <td colspan="5" class="text-center text-danger py-4">
                        Error loading reports: ${error.message}
                    </td>
                </tr>
            `);
        });
}


 //pagination
 function renderPagination(pagination) {
    const container = $('#pagination'); // add this div in HTML
    container.empty();

    if (pagination.total <= pagination.per_page) return; // no need for pagination

    let buttons = '';

    // Previous button
    if (pagination.prev_page_url) {
        buttons += `<button class="btn btn-sm btn-light me-1" onclick="loadReports(${pagination.current_page - 1})">Prev</button>`;
    }

    // Page numbers
    for (let i = 1; i <= pagination.last_page; i++) {
        const active = i === pagination.current_page ? 'btn-primary' : 'btn-light';
        buttons += `<button class="btn btn-sm ${active} me-1" onclick="loadReports(${i})">${i}</button>`;
    }

    // Next button
    if (pagination.next_page_url) {
        buttons += `<button class="btn btn-sm btn-light" onclick="loadReports(${pagination.current_page + 1})">Next</button>`;
    }

    container.html(buttons);
}



// Helper function to format date
function formatDate(dateString) {
    if (!dateString) return '';
    
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return dateString; // Return original if invalid date
    
    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Function to handle delete action



function deleteReport(reportId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this record!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`report/delete/${reportId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                Swal.fire(
                    'Deleted!',
                    'Report has been deleted.',
                    'success'
                );
                location.reload();
            })
            .catch(error => {
                Swal.fire('Error', 'Error deleting report: ' + error.message, 'error');
            });
        }
    });
}

// Add the event listener using event delegation
document.addEventListener('click', function (e) {
    if (e.target.closest('.delete_button')) {
        const button = e.target.closest('.delete_button');
        const reportId = button.getAttribute('data-id');
        if (reportId) {
            deleteReport(reportId);
        }
    }
});