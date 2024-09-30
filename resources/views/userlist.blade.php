@extends('layouts.dashboard')
@section('userlist-section')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>Sl no.</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Circle</th>
                                <th>Division</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-body" style="text-align: center;">
                            <!-- Data populated via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Fetch data via AJAX
        $.ajax({
            url: '{{ route('users.fetch') }}',
            method: 'GET',
            success: function(response) {
                console.log('Received Data:', response);
                populateTable(response);
            },
            error: function() {
                alert('Error fetching data.');
            }   
        });

        function populateTable(users) {
            var tableBody = $('#data-table-body');
            tableBody.empty(); // Clear any existing data

            users.forEach((user, index) => {
                const employee = user.employee || {};
                const designation = user.designation || {};
                const userArea = user.user_area[0] || {};
                const division = userArea.division || {};
                
                // Concatenate employee name (first and last)
                const fullName = `${employee.firstname || ''} ${employee.lastname || ''}`;

                // Get circle name by fetching the circle id (parent_id) from division
                const divisionName = division.name_e || '';
                const parentId = division.parent_id || '';

                // Build the table row
                let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${fullName}</td>
                    <td>${designation.designation_name || ''}</td>
                    <td>${employee.email || ''}</td>
                    <td>${employee.phone || ''}</td>
                    <td id="circle-name-${index}"></td>
                    <td>${divisionName}</td>
                </tr>`;

                tableBody.append(row);

                // Fetch the circle name for each user and update the table
                fetchCircleName(parentId, `#circle-name-${index}`);
            });
        }

        function fetchCircleName(parentId, elementId) {
            if (!parentId) {
                $(elementId).text('N/A');
                return;
            }

            $.ajax({
                url: '/circle-name/' + parentId,  // API to get the circle name
                method: 'GET',
                success: function(response) {
                    $(elementId).text(response.name || 'N/A');  // Assuming the API returns a JSON object with 'name' key
                },
                error: function() {
                    $(elementId).text('Error');
                }
            });
        }
    });
</script>
@endsection
