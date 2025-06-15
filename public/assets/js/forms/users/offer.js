


// Replace the following line with a valid JSON assignment from your backend template engine.
// For example, in a Blade template, use:

$(document).ready(function () {
    $(document).ready(function () {
        console.log('DOM ready');
let userId = user;
 

        if(userId){
        // Fetch the data
            fetch(`/dashboard/offer/${userId.id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                return response.json();
            })

            
            .then(data => {

                console.log(data);
        document.getElementById("no-results-alert").style.setProperty('display', 'none', 'important');
                const offerDiv = document.getElementById('offers');

                if (!Array.isArray(data) || data.length === 0) {
                    offerDiv.innerHTML = '<p>No offers available.</p>';
                    return;
                }

                let table = `
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable">
                        <thead>
                            <tr>
                <th>${t.id}</th>
                <th>${t.mission}</th>
                <th>${t.user}</th>
                <th>${t.status}</th>
                <th>${t.budget}</th>
                <th>${t.created_at}</th>
                            </tr>
                        </thead>
                        <tbody>

                         </div>
                `;

                data.forEach(offer => {
                    table += `
                        <tr>
                            <td>${offer.id}</td>
                            <td>${offer.mission.description}</td>
                            <td>${user.full_name }</td>
                            <td>${offer.status.name}</td>
                            <td>${offer.available_budget ?? 'N/A'}</td>
                            <td>${new Date(offer.created_at).toLocaleDateString()}</td>
                        </tr>
                    `;
                });

                table += `</tbody></table>`;
                offerDiv.innerHTML = table;
            })
            .catch(error => {
                console.error('Error loading offers:', error);
                document.getElementById('offers').innerHTML =
                    `<p style="color:red;">Failed to load offers: ${error.message}</p>`;
            });
        }
    });

});
