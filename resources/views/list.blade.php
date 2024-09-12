@extends('layouts.dashboard')
@include('edit_list')
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
      
        // When the Edit Details button is clicked
        $(document).on('click', '.edit-details', function (e) {

            e.preventDefault();
            var id = $(this).data('id');
            var selectedItem = fetchedData.find(item => item.id === id);
            
            if (selectedItem) {
                  
                $('#edit-modal #case_no').val(selectedItem.case_no);
                $('#edit-modal #circle').val(selectedItem.circle ? selectedItem.circle.name_e : '');
                $('#edit-modal #division').val(selectedItem.division ? selectedItem.division.name_e : '');
                $('#edit-modal #range').val(selectedItem.range ? selectedItem.range.name_e : '');
                $('#edit-modal #section').val(selectedItem.section ? selectedItem.section.name_e : '');
                $('#edit-modal #beat').val(selectedItem.beat ? selectedItem.beat.name_e : '');
                $('#edit-modal #case_type').val(selectedItem.case_type);
                $('#edit-modal #case_no').val(selectedItem.case_no);
                $('#edit-modal #penal_code').val(selectedItem.penal_code);
                $('#edit-modal #detection_place_type').val(selectedItem.detection_place_type);
                $('#edit-modal #detection_place').val(selectedItem.detection_place);
                $('#edit-modal #case_date').val(selectedItem.case_date);
                $('#edit-modal #detection_date').val(selectedItem.detection_date);
                $('#edit-modal #latitude').val(selectedItem.latitude);
                $('#edit-modal #longitude').val(selectedItem.longitude);
                $('#edit-modal #detection_agency').val(selectedItem.detection_agency);
                $('#edit-modal #investigating_agency').val(selectedItem.investigating_agency);
                $('#edit-modal #species_name').val(selectedItem.species_name);
                $('#edit-modal #species_age').val(selectedItem.species_age);
                $('#edit-modal #species_sex').val(selectedItem.species_sex);
                $('#edit-modal #old_wlpa').val(selectedItem.old_wlpa);
                $('#edit-modal #property_recovered_type').val(selectedItem.property_recovered_type);
                $('#edit-modal #property_recovered_details').val(selectedItem.property_recovered_details);
                $('#edit-modal #officer_name').val(selectedItem.officer_name);
                $('#edit-modal #officer_number').val(selectedItem.officer_number);
                $('#edit-modal #brief_fact').val(selectedItem.brief_fact);
                $('#edit-modal #court_forward_date').val(selectedItem.court_forward_date);
                $('#edit-modal #court_name').val(selectedItem.court_name);
                $('#edit-modal #court_case_number').val(selectedItem.court_case_number);
                $('#edit-modal #pr_number').val(selectedItem.pr_number);
                $('#edit-modal #pr_date').val(selectedItem.pr_date);
                $('#edit-modal #pr_status').val(selectedItem.pr_status);
                $('#edit-modal #action_against_staff').val(selectedItem.action_against_staff);
                $('#edit-modal #case_present_status').val(selectedItem.case_present_status);
                
                $('#edit-modal #accused-details-table tbody').empty();
                selectedItem.accused.forEach((accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${accused.name}" class="form-control"></td>
                            <td><input type="text" value="${accused.alias ? accused.alias : ''}" class="form-control"></td>
                            <td><input type="text" value="${accused.father_name}" class="form-control"></td>
                            <td><input type="text" value="${accused.address ? accused.address : ''}" class="form-control"></td>
                        </tr>`;
                    $('#edit-modal #accused-details-table tbody').append(newRow);
                });

                $('#edit-modal #mobiles-recovered-table tbody').empty();
                selectedItem.accused_mobiles.forEach((accused_mobiles, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${accused_mobiles.mobile_no}" class="form-control"></td>
                            <td><input type="text" value="${accused_mobiles.imei_no}" class="form-control"></td>
                        </tr>`;
                    $('#edit-modal #mobiles-recovered-table tbody').append(newRow);
                });

                $('#edit-modal #arrested-accused-details-table tbody').empty();
                selectedItem.arrested_accused.forEach((arrested_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${arrested_accused.name}" class="form-control"></td>
                        </tr>`;
                    $('#edit-modal #arrested-accused-details-table tbody').append(newRow);
                });

                $('#edit-modal #nbw-accused-table tbody').empty();
                selectedItem.nbw_accused.forEach((nbw_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${nbw_accused.name}" class="form-control"></td>
                            <td><input type="text" value="${nbw_accused.status}" class="form-control"></td>
                        </tr>`;
                    $('#edit-modal #nbw-accused-table tbody').append(newRow);
                });

                $('#edit-modal #released-accused-table tbody').empty();
                selectedItem.released_accused.forEach((released_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${released_accused.name}" class="form-control"></td>
                            <td><input type="date" value="${released_accused.date}" class="form-control"></td>
                        </tr>`;
                    $('#edit-modal #released-accused-table tbody').append(newRow);
                });
                
                // Show the edit modal
                $('#edit-modal').modal('show');
                const caseType = $('#edit-modal #case_type').val(); 
                const label = caseType ? caseType + ' Case Number' : 'Case Number';
                $('#edit-modal #case_no_label').text(label); 
            } else {
                alert('Error: Record not found.');
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

                $('#view-full-width-modal #case_no').val(selectedItem.case_no);
                $('#view-full-width-modal #circle').val(selectedItem.circle ? selectedItem.circle.name_e : '');
                $('#view-full-width-modal #division').val(selectedItem.division ? selectedItem.division.name_e : '');
                $('#view-full-width-modal #range').val(selectedItem.range ? selectedItem.range.name_e : '');
                $('#view-full-width-modal #section').val(selectedItem.section ? selectedItem.section.name_e : '');
                $('#view-full-width-modal #beat').val(selectedItem.beat ? selectedItem.beat.name_e : '');
                $('#view-full-width-modal #case_type').val(selectedItem.case_type);
                $('#view-full-width-modal #case_no').val(selectedItem.case_no);
                $('#view-full-width-modal #penal_code').val(selectedItem.penal_code);
                $('#view-full-width-modal #detection_place_type').val(selectedItem.detection_place_type);
                $('#view-full-width-modal #detection_place').val(selectedItem.detection_place);
                $('#view-full-width-modal #case_date').val(selectedItem.case_date);
                $('#view-full-width-modal #detection_date').val(selectedItem.detection_date);
                $('#view-full-width-modal #latitude').val(selectedItem.latitude);
                $('#view-full-width-modal #longitude').val(selectedItem.longitude);
                $('#view-full-width-modal #detection_agency').val(selectedItem.detection_agency);
                $('#view-full-width-modal #investigating_agency').val(selectedItem.investigating_agency);
                $('#view-full-width-modal #species_name').val(selectedItem.species_name);
                $('#view-full-width-modal #species_age').val(selectedItem.species_age);
                $('#view-full-width-modal #species_sex').val(selectedItem.species_sex);
                $('#view-full-width-modal #old_wlpa').val(selectedItem.old_wlpa);
                $('#view-full-width-modal #property_recovered_type').val(selectedItem.property_recovered_type);
                $('#view-full-width-modal #property_recovered_details').val(selectedItem.property_recovered_details);
                $('#view-full-width-modal #officer_name').val(selectedItem.officer_name);
                $('#view-full-width-modal #officer_number').val(selectedItem.officer_number);
                $('#view-full-width-modal #brief_fact').val(selectedItem.brief_fact);
                $('#view-full-width-modal #court_forward_date').val(selectedItem.court_forward_date);
                $('#view-full-width-modal #court_name').val(selectedItem.court_name);
                $('#view-full-width-modal #court_case_number').val(selectedItem.court_case_number);
                $('#view-full-width-modal #pr_number').val(selectedItem.pr_number);
                $('#view-full-width-modal #pr_date').val(selectedItem.pr_date);
                $('#view-full-width-modal #pr_status').val(selectedItem.pr_status);
                $('#view-full-width-modal #action_against_staff').val(selectedItem.action_against_staff);
                $('#view-full-width-modal #case_present_status').val(selectedItem.case_present_status);
                
                $('#view-full-width-modal #accused-details-table tbody').empty();
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

                $('#view-full-width-modal #mobiles-recovered-table tbody').empty();
                selectedItem.accused_mobiles.forEach((accused_mobiles, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${accused_mobiles.mobile_no}" class="form-control" readonly></td>
                            <td><input type="text" value="${accused_mobiles.imei_no}" class="form-control" readonly></td>
                        </tr>`;
                    $('#mobiles-recovered-table tbody').append(newRow);
                });

                $('#view-full-width-modal #arrested-accused-details-table tbody').empty();
                selectedItem.arrested_accused.forEach((arrested_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${arrested_accused.name}" class="form-control" readonly></td>
                        </tr>`;
                    $('#arrested-accused-details-table tbody').append(newRow);
                });

                $('#view-full-width-modal #nbw-accused-table tbody').empty();
                selectedItem.nbw_accused.forEach((nbw_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${nbw_accused.name}" class="form-control" readonly></td>
                            <td><input type="text" value="${nbw_accused.status}" class="form-control" readonly></td>
                        </tr>`;
                    $('#nbw-accused-table tbody').append(newRow);
                });

                $('#view-full-width-modal #released-accused-table tbody').empty();
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
                        $('#view-full-width-modal #post_mortem_report_container').html(`
                            <a href="${baseUrl}/post-mortem-report/${upload.post_mortem_report}" target="_blank">${upload.post_mortem_report}</a>
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}/post-mortem-report/${upload.post_mortem_report}', '_blank')">Download</button>
                        `);
                    } else {
                        $('#view-full-width-modal #post_mortem_report_container').text('No document uploaded');
                    }

                    // Populate Electrical Inspector Report
                    if (upload.electrical_inspector_report) {
                        $('#view-full-width-modal #electrical_inspector_report_container').html(`
                            <a href="${baseUrl}/electrical-inspector-report/${upload.electrical_inspector_report}" target="_blank">${upload.electrical_inspector_report}</a>
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}/electrical-inspector-report/${upload.electrical_inspector_report}', '_blank')">Download</button>
                        `);
                    } else {
                        $('#view-full-width-modal #electrical_inspector_report_container').text('No document uploaded');
                    }

                    // Populate Laboratory Report
                    if (upload.laboratory_report) {
                        $('#view-full-width-modal #lab_report_container').html(`
                            <a href="${baseUrl}/laboratory-report/${upload.laboratory_report}" target="_blank">${upload.laboratory_report}</a>
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}/laboratory-report/${upload.laboratory_report}', '_blank')">Download</button>
                        `);
                    } else {
                        $('#view-full-width-modal #lab_report_container').text('No document uploaded');
                    }

                    // Populate Court Judgement
                    if (upload.court_judgement) {
                        $('#view-full-width-modal #court_judgement_container').html(`
                            <a href="${baseUrl}/court-judgement/${upload.court_judgement}" target="_blank">${upload.court_judgement}</a>
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}/court-judgement/${upload.court_judgement}', '_blank')">Download</button>
                        `);
                    } else {
                        $('#view-full-width-modal #court_judgement_container').text('No document uploaded');
                    }
                } else {
                    // If no uploads data exists
                    $('#view-full-width-modal #post_mortem_report_container').text('No document uploaded');
                    $('#view-full-width-modal #electrical_inspector_report_container').text('No document uploaded');
                    $('#view-full-width-modal #lab_report_container').text('No document uploaded');
                    $('#view-full-width-modal #court_judgement_container').text('No document uploaded');
                }

                // Show the modal
                $('#view-full-width-modal').modal('show');
                const caseType = $('#view-full-width-modal #case_type').val(); 
                const label = caseType ? caseType + ' Case Number' : 'Case Number';
                $('#view-full-width-modal #case_no_label').text(label); 
            } else {
                alert('Error: Record not found.');
            }
        });

    });
</script>
@endsection
