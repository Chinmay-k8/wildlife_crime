@extends('layouts.dashboard')
@include('view_list')

@section('user-info')
<h1>Complain 1</h1>
@endsection

@section('form-content')
<style>
.table thead th {
    background-color: rgb(0, 80, 64); 
    color: white; 
    text-align: center; 
    vertical-align: middle; 
}
td {
    text-align: center; 
    vertical-align: middle; 
}
.action-options {
    display: none;
    background-color: white;
    border: 1px solid #ccc;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 10px;
    width: 120px;
}
.action-options a {
    color: #333;
    text-decoration: none;
    display: block;
    padding: 8px;
    transition: background-color 0.2s;
}
.action-options a:hover {
    background-color: #f1f1f1;
}
</style>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Case Number</th>
                                <th>Range</th>
                                <th>Section</th>
                                <th>Beat</th>
                                <th>Approval Status</th>
                                <th>Actions</th>
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

        // Fetch data via AJAX and populate the table
        $.ajax({
            url: '{{ route('list.data') }}',
            method: 'GET',
            success: function(response) {
                console.log('Received Data:', response);
                populateTable(response);
            },
            error: function() {
                alert('Error fetching data.');
            }
        });
        
        var fetchedData = [];  // Store the fetched data here   
        function populateTable(data) {
            fetchedData = data;
            console.log(fetchedData);

            var $tableBody = $('#data-table-body');
            $tableBody.empty();

            data.forEach(function(item, index) {
                var $row = $('<tr>');
                $row.attr('data-id', item.id);  // Assign the ID to each row
                $row.append('<td>' + (index + 1) + '</td>');
                $row.append('<td>' + item.case_no + '</td>');
                $row.append('<td>' + (item.range ? item.range.name_e : item.range_id) + '</td>');
                $row.append('<td>' + (item.section ? item.section.name_e : item.section_id) + '</td>');
                $row.append('<td>' + (item.beat ? item.beat.name_e : item.beat_id) + '</td>');
                $row.append('<td>' + (item.approval_status ? item.approval_status : 'Pending') + '</td>');
                $row.append(`
                    <td>
                        <div style="position: relative; display: inline-block;">
                            <img src="{{ asset('assets/images/users/setting.png') }}" alt="Actions" class="actions" style="cursor: pointer; width: 24px;">
                            <div class="action-options" style="display: none;">
                                <a href="#" class="view-details" data-id="${item.id}">View Details</a>
                                <a href="#" class="edit-details" data-id="${item.id}">Edit Details</a>
                            </div>
                        </div>
                    </td>
                `);

                $tableBody.append($row);
            });
        }

        $(document).on('click', '.actions', function () {
            $(this).siblings('.action-options').toggle(); 
        });

        // Hide the div if clicked outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.actions, .action-options').length) {
                $('.action-options').hide();
            }
        });

        // Handle View Details
        $(document).on('click', '.view-details', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            
            // Find the selected record from the fetched data
            var selectedItem = fetchedData.find(item => item.id === id);

            // Populate the modal with the selected item details
            if (selectedItem) {
                console.log(selectedItem);

                $('#case_no').val(selectedItem.case_no);
                $('#circle').val(selectedItem.circle ? selectedItem.circle.name_e : '');
                $('#division').val(selectedItem.division ? selectedItem.division.name_e : '');
                $('#range').val(selectedItem.range ? selectedItem.range.name_e : '');
                $('#section').val(selectedItem.section ? selectedItem.section.name_e : '');
                $('#beat').val(selectedItem.beat ? selectedItem.beat.name_e : '');
                $('#case_type').val(selectedItem.case_type);
                $('#case_no').val(selectedItem.case_no);
                $('#detection_place_type').val(selectedItem.detection_place_type);
                $('#detection_place').val(selectedItem.detection_place);
                $('#case_date').val(selectedItem.case_date);
                $('#detection_date').val(selectedItem.detection_date);
                $('#latitude').val(selectedItem.latitude);
                $('#longitude').val(selectedItem.longitude);
                $('#detection_agency').val(selectedItem.detection_agency);
                $('#investigating_agency').val(selectedItem.investigating_agency);
                $('#species_name').val(selectedItem.species_name);
                $('#species_age').val(selectedItem.species_age);
                $('#species_sex').val(selectedItem.species_sex);
                $('#old_wlpa').val(selectedItem.old_wlpa);
                $('#property_recovered_type').val(selectedItem.property_recovered_type);
                $('#property_recovered_details').val(selectedItem.property_recovered_details);
                $('#officer_name').val(selectedItem.officer_name);
                $('#officer_number').val(selectedItem.officer_number);
                $('#brief_fact').val(selectedItem.brief_fact);
                $('#court_forward_date').val(selectedItem.court_forward_date);
                $('#court_name').val(selectedItem.court_name);
                $('#court_case_number').val(selectedItem.court_case_number);
                $('#pr_number').val(selectedItem.pr_number);
                $('#pr_date').val(selectedItem.pr_date);
                $('#pr_status').val(selectedItem.pr_status);
                $('#action_against_staff').val(selectedItem.action_against_staff);
                $('#case_present_status').val(selectedItem.case_present_status);
                
                $('#accused-details-table tbody').empty();
                selectedItem.accused.forEach((accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${accused.name}" class="form-control" readonly></td>
                            <td><input type="text" value="${accused.alias ? accused.alias : ''}" class="form-control" readonly></td>
                            <td><input type="text" value="${accused.father_name}" class="form-control" readonly></td>
                            <td><input type="text" value="${accused.address ? accused.address : ''}" class="form-control" readonly></td>
                        </tr>`;
                    $('#accused-details-table tbody').append(newRow);
                });

                $('#mobiles-recovered-table tbody').empty();
                selectedItem.accused_mobiles.forEach((accused_mobiles, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${accused_mobiles.mobile_no}" class="form-control" readonly></td>
                            <td><input type="text" value="${accused_mobiles.imei_no}" class="form-control" readonly></td>
                        </tr>`;
                    $('#mobiles-recovered-table tbody').append(newRow);
                });

                $('#arrested-accused-details-table tbody').empty();
                selectedItem.arrested_accused.forEach((arrested_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${arrested_accused.name}" class="form-control" readonly></td>
                        </tr>`;
                    $('#arrested-accused-details-table tbody').append(newRow);
                });

                $('#nbw-accused-table tbody').empty();
                selectedItem.nbw_accused.forEach((nbw_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${nbw_accused.name}" class="form-control" readonly></td>
                            <td><input type="text" value="${nbw_accused.status}" class="form-control" readonly></td>
                        </tr>`;
                    $('#nbw-accused-table tbody').append(newRow);
                });

                $('#released-accused-table tbody').empty();
                selectedItem.released_accused.forEach((released_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${released_accused.name}" class="form-control" readonly></td>
                            <td><input type="date" value="${released_accused.date}" class="form-control" readonly></td>
                        </tr>`;
                    $('#released-accused-table tbody').append(newRow);
                });

                // Use the Laravel route helper to generate URLs for the download route
                const baseUrl = '{{ url("download") }}';

                if (selectedItem.uploads && selectedItem.uploads.length > 0) {
                    const upload = selectedItem.uploads[0]; // Assuming only one set of uploads per form

                    // Populate Post Mortem Report
                    if (upload.post_mortem_report) {
                        $('#post_mortem_report_container').html(`
                            <a href="${baseUrl}/post-mortem-report/${upload.post_mortem_report}" target="_blank">${upload.post_mortem_report}</a>
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}/post-mortem-report/${upload.post_mortem_report}', '_blank')">Download</button>
                        `);
                    } else {
                        $('#post_mortem_report_container').text('No document uploaded');
                    }

                    // Populate Electrical Inspector Report
                    if (upload.electrical_inspector_report) {
                        $('#electrical_inspector_report_container').html(`
                            <a href="${baseUrl}/electrical-inspector-report/${upload.electrical_inspector_report}" target="_blank">${upload.electrical_inspector_report}</a>
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}/electrical-inspector-report/${upload.electrical_inspector_report}', '_blank')">Download</button>
                        `);
                    } else {
                        $('#electrical_inspector_report_container').text('No document uploaded');
                    }

                    // Populate Laboratory Report
                    if (upload.laboratory_report) {
                        $('#lab_report_container').html(`
                            <a href="${baseUrl}/laboratory-report/${upload.laboratory_report}" target="_blank">${upload.laboratory_report}</a>
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}/laboratory-report/${upload.laboratory_report}', '_blank')">Download</button>
                        `);
                    } else {
                        $('#lab_report_container').text('No document uploaded');
                    }

                    // Populate Court Judgement
                    if (upload.court_judgement) {
                        $('#court_judgement_container').html(`
                            <a href="${baseUrl}/court-judgement/${upload.court_judgement}" target="_blank">${upload.court_judgement}</a>
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}/court-judgement/${upload.court_judgement}', '_blank')">Download</button>
                        `);
                    } else {
                        $('#court_judgement_container').text('No document uploaded');
                    }
                } else {
                    // If no uploads data exists
                    $('#post_mortem_report_container').text('No document uploaded');
                    $('#electrical_inspector_report_container').text('No document uploaded');
                    $('#lab_report_container').text('No document uploaded');
                    $('#court_judgement_container').text('No document uploaded');
                }

                // Show the modal
                $('#full-width-modal').modal('show');
                const caseType = $('#case_type').val(); 
                const label = caseType ? caseType + ' Case Number' : 'Case Number';
                $('#case_no_label').text(label); 
            } else {
                alert('Error: Record not found.');
            }
        });
    });
</script>
@endsection
