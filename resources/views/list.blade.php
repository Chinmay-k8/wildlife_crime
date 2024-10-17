@extends('layouts.dashboard')
@section('list-content')
@include('edit_list')
@include('view_list')
@section('user-info')
<h1>Form-X</h1>
@endsection
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
                                <th>Case Type</th>
                                <th>Case Number</th>
                                <th>Case Date</th>
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
                $row.append('<td>' + item.case_type + '</td>');
                $row.append('<td style="text-align: left;">' + item.case_no + '</td>');
                let date = new Date(item.case_date);  // Parse the date string
                let day = String(date.getDate()).padStart(2, '0'); 
                let month = String(date.getMonth() + 1).padStart(2, '0');
                let year = date.getFullYear();

                // Format the date as 'd-m-y'
                let formattedDate = `${day}-${month}-${year}`;

                // Append the formatted date to the row
                $row.append('<td>' + formattedDate + '</td>');
                $row.append('<td>' + (item.range ? item.range.name_e : item.range_id) + '</td>');
                $row.append('<td>' + (item.section ? item.section.name_e : item.section_id) + '</td>');
                $row.append('<td>' + (item.beat ? item.beat.name_e : item.beat_id) + '</td>');
                $row.append('<td>' + (item.approval_status ? item.approval_status : 'Pending') + '</td>');
                $row.append(`
                    <td>
                         <div class="dropdown">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" id="actions" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="dripicons-menu"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" id="action-options">
                                                <a href="#" class="dropdown-item" id="view-details" data-id="${item.id}"><i class="mdi mdi-eye me-1"></i>View Details</a>
                                                <a href="#" class="dropdown-item" id="edit-details" data-id="${item.id}"><i class="mdi mdi-pencil me-1"></i>Edit Details</a>
                                            </div>
                                        </div>
                    </td>
                `);

                $tableBody.append($row);
            });
        }

        $(document).on('click', '#actions', function () {
            $(this).siblings('#action-options').toggle(); 
        });

        // Hide the div if clicked outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#actions, #action-options').length) {
                $('#action-options').hide();
            }
        });
      
         // Fetch circle data once and store it
        var circleData = [];
        $.getJSON('circles', function(data) {
            circleData = data;  // Store the circle data for future use
        });
        // When the Edit Details button is clicked
        $(document).on('click', '#edit-details', function (e) {
            
            e.preventDefault();
            var id = $(this).data('id');
            $('#editForm').attr('action', '{{ route("update-form", "") }}/' + id);  // Update the action attribute dynamically
            
            // $('#edit-modal #saveChangesButton').on('click', function() {
            //     console.log('Save Changes button clicked');
            //     console.log($('#editForm').attr('action'));
            // });
            var selectedItem = fetchedData.find(item => item.id === id);

            $('#edit-modal #circle-dropdown').empty();
            $('#edit-modal #division-dropdown').empty();
            $('#edit-modal #range-dropdown').empty();       //Empty the dropdowns each time the modal loads
            $('#edit-modal #section-dropdown').empty();
            $('#edit-modal #beat-dropdown').empty();
            $('#edit-modal #species_name-dropdown').empty();
            $('#edit-modal #species_schedule-dropdown').empty();
            $('#edit-modal #schedule_type-dropdown').empty();
            
            $('#edit-modal #circle-dropdown').show();       // Show text input by default
            $('#edit-modal #division-dropdown').show();
            $('#edit-modal #range-dropdown').show();
            $('#edit-modal #section-dropdown').show();
            $('#edit-modal #beat-dropdown').show();
            $('#edit-modal #species_name-dropdown').show();
            $('#edit-modal #species_schedule-dropdown').show();
            $('#edit-modal #schedule_type-dropdown').show();

            


           
            if (selectedItem) {
                
                $('#edit-modal #circle-dropdown').append(`<option value="${selectedItem.circle.id}" selected>${selectedItem.circle.name_e}</option>`); //Append the fetched circle data
                circleData.forEach(circle => {
                $('#edit-modal #circle-dropdown').append(`<option value="${circle.id}">${circle.name_e}</option>`);});  //Populate the circle dropdown with master data.

                // When the dropdown value is changed, update the textbox
                $('#edit-modal #circle-dropdown').on('change', function() {
                    let selectedText = $(this).find('option:selected').text(); //fetch the name of the newly slected circle
                    let selectedValue = $(this).find('option:selected').attr('value'); //fetch the id of newly selected circle
                    if (selectedValue) {
                        $.getJSON(`circles/${selectedValue}/divisions`, function(data) {
                            $('#edit-modal #division-dropdown').empty();
                            $('#edit-modal #division-dropdown').append(`<option value="">Select Division</option>`);  // Default option
                            data.forEach(function(division) {
                                $('#edit-modal #division-dropdown').append(`<option value="${division.id}">${division.name_e}</option>`);
                            });
                        });
                    }
                    // console.log( selectedValue);
                   
                });
                $('#edit-modal #division-dropdown').append(`<option value="${selectedItem.division.id}" selected>${selectedItem.division.name_e}</option>`);
                $('#edit-modal #division-dropdown').on('change', function() {
                    let selectedText = $(this).find('option:selected').text(); 
                    let selectedValue = $(this).find('option:selected').attr('value'); 
                    if (selectedValue) {
                        $.getJSON(`divisions/${selectedValue}/ranges`, function(data) {
                            $('#edit-modal #range-dropdown').empty();
                            $('#edit-modal #range-dropdown').append(`<option value="">Select Range</option>`);  // Default option
                            data.forEach(function(range) {
                                $('#edit-modal #range-dropdown').append(`<option value="${range.id}">${range.name_e}</option>`);
                            });
                        });
                    }
                    // console.log( selectedValue);
                   
                });

                $('#edit-modal #range-dropdown').append(`<option value="${selectedItem.range.id}" selected>${selectedItem.range.name_e}</option>`); //Append the fetched circle data
                $('#edit-modal #range-dropdown').on('change', function() {
                    let selectedText = $(this).find('option:selected').text(); 
                    let selectedValue = $(this).find('option:selected').attr('value'); 
                    if (selectedValue) {
                        $.getJSON(`ranges/${selectedValue}/sections`, function(data) {
                            $('#edit-modal #section-dropdown').empty();
                            $('#edit-modal #section-dropdown').append(`<option value="">Select Section</option>`);  
                            data.forEach(function(section) {
                                $('#edit-modal #section-dropdown').append(`<option value="${section.id}">${section.name_e}</option>`);
                            });
                        });
                    }
                    // console.log( selectedValue);
                   
                });

                $('#edit-modal #section-dropdown').append(`<option value="${selectedItem.section.id}" selected>${selectedItem.section.name_e}</option>`);
                $('#edit-modal #section-dropdown').on('change', function() {
                    let selectedText = $(this).find('option:selected').text(); 
                    let selectedValue = $(this).find('option:selected').attr('value'); 
                    if (selectedValue) {
                        $.getJSON(`sections/${selectedValue}/beats`, function(data) {
                            $('#edit-modal #beat-dropdown').empty();
                            $('#edit-modal #beat-dropdown').append(`<option value="">Select Section</option>`);  // Default option
                            data.forEach(function(beat) {
                                $('#edit-modal #beat-dropdown').append(`<option value="${beat.id}">${beat.name_e}</option>`);
                            });
                        });
                    }
                    // console.log( selectedValue);
                   
                });

                $('#edit-modal #beat-dropdown').append(`<option value="${selectedItem.beat.id}" selected>${selectedItem.beat.name_e}</option>`);
                 
                $('#edit-modal #case_type-dropdown').val(selectedItem.case_type);
                updateCaseNumberLabel();
                function updateCaseNumberLabel() {
                    const caseType = $('#edit-modal #case_type-dropdown').val();
                    const label = caseType ? caseType + ' Case Number' : 'Case Number';
                    
                    $('#edit-modal #case_no_label').text(label); // Update the label text
                }
                $('#edit-modal #case_type-dropdown').on('change', function() {
                    updateCaseNumberLabel();
                });
                $('#edit-modal #case_no').val(selectedItem.case_no);
                $('#edit-modal #penal_code').val(selectedItem.penal_code);
                $('#edit-modal #detection_place_type-dropdown').val(selectedItem.detection_place_type);
                $('#edit-modal #detection_place').val(selectedItem.detection_place);
                $('#edit-modal #case_date').val(selectedItem.case_date);
                $('#edit-modal #detection_date').val(selectedItem.detection_date);
                $('#edit-modal #latitude').val(selectedItem.latitude);
                $('#edit-modal #longitude').val(selectedItem.longitude);
                $('#edit-modal #detection_agency-dropdown').append(`<option value="${selectedItem.detection_agency}" selected>${selectedItem.detection_agency}</option>`);
                document.getElementById('detection_agency-dropdown').addEventListener('change', function () {
                    var otherAgencyGroup = document.getElementById('other-agency-group');
                    var detectionAgencyGroup = document.getElementById('detection-agency-group');
                    var investigatingAgencyGroup = document.getElementById('investigating-agency-group');
                    var detectionAgency = this.value;

                    if (detectionAgency === 'Other') {
                        // Show the 'Other Agency Name' input field
                        otherAgencyGroup.style.display = 'block';

                        // Adjust all columns to fit three elements in a row
                        detectionAgencyGroup.classList.remove('col-md-6');
                        detectionAgencyGroup.classList.add('col-md-4');
                        
                        investigatingAgencyGroup.classList.remove('col-md-6');
                        investigatingAgencyGroup.classList.add('col-md-4');

                        otherAgencyGroup.classList.remove('col-md-6');
                        otherAgencyGroup.classList.add('col-md-4');
                    } else {
                        // Hide the 'Other Agency Name' input field
                        otherAgencyGroup.style.display = 'none';

                        // Reset the columns back to two elements
                        detectionAgencyGroup.classList.remove('col-md-4');
                        detectionAgencyGroup.classList.add('col-md-6');
                        
                        investigatingAgencyGroup.classList.remove('col-md-4');
                        investigatingAgencyGroup.classList.add('col-md-6');
                    }
                });
                $('#edit-modal #investigating_agency').val("Forest Department");
                $('#edit-modal #species_age').val(selectedItem.species_age);
                $('#edit-modal #species_sex-dropdown').val(selectedItem.species_sex);
                $('#edit-modal #species_name-dropdown').append(`<option value="${selectedItem.species.id}" selected>${selectedItem.species.species_name}</option>`);
                $('#edit-modal #species_schedule-dropdown').append(`<option value="${selectedItem.species.schedule_no}" selected>${selectedItem.species.schedule_no}</option>`);
                $('#edit-modal #schedule_type-dropdown').val(selectedItem.species.species_type);
                
                // // Assuming selectedItem.species.schedule_no contains the selected value
                // const selectedValue = selectedItem.species.schedule_no;

                // // Check if the selected value already exists in the dropdown
                // const speciesScheduleDropdown = $('#edit-modal #species_schedule-dropdown');

                // // If the option already exists, just mark it as selected
                // let optionExists = speciesScheduleDropdown.find(`option[value="${selectedValue}"]`).length > 0;

                // if (optionExists) {
                //     speciesScheduleDropdown.val(selectedValue);  // Mark the existing option as selected
                // } else {
                //     // If it doesn't exist, append the new option with selected attribute
                //     speciesScheduleDropdown.append(`<option value="${selectedValue}" selected>${selectedValue}</option>`);
                // }

                $('#edit-modal #property_recovered_type-dropdown').val(selectedItem.property_recovered_type);
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
                $('#edit-modal #action_against_staff-dropdown').val(selectedItem.action_against_staff);
                $('#edit-modal #case_present_status').val(selectedItem.case_present_status);
                
                // $('#edit-modal #accused-details-table tbody').empty();
                // function checkRowCount1() {
                //     var rowCount = $('#edit-modal #accused-details-table tbody tr').length;

                //     if (rowCount === 1) {
                //         // If only one row is left, hide the delete button
                //         $('#edit-modal #accused-details-table tbody tr').find('.delete-accused').hide();
                //     } else {
                //         // If more than one row, show the delete button
                //         $('#edit-modal #accused-details-table tbody tr').find('.delete-accused').show();
                //     }
                // }
                // selectedItem.accused.forEach((accused, index) => {
                //     var index = $('#edit-modal #accused-details-table tbody tr').length;

                //     var newRow = `
                //         <tr>
                //             <td><input type="text" value="${accused.name}" class="form-control"></td>
                //             <td><input type="text" value="${accused.alias ? accused.alias : ''}" class="form-control"></td>
                //             <td><input type="text" value="${accused.father_name}" class="form-control"></td>
                //             <td><input type="text" value="${accused.address ? accused.address : ''}" class="form-control"></td>
                //              <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-accused" id="delete-acc" style="cursor: pointer; width: 24px;"></td>
                //         </tr>`;
                //     $('#edit-modal #accused-details-table tbody').append(newRow);
                //     updateIndices();
                //     checkRowCount1();
                // });
                // function updateIndices() {
                //     $('#accused-details-table tbody tr').each(function(index) {
                //         $(this).find('input').each(function() {
                //             var name = $(this).attr('name');
                            
                //             // Log the current name value to debug
                //             console.log('Current name:', name);

                //             // Only try to update if the name attribute exists
                //             if (name !== undefined) {
                //                 var newName = name.replace(/\d+/, index);
                //                 console.log('Updated name:', newName); // Log the new name for debugging
                //                 $(this).attr('name', newName);
                //             }
                //         });
                //     });
                // }
                // $('#edit-modal #add-row').off('click').click(function() {
                //     var index = $('#edit-modal #accused-details-table tbody tr').length;
                //     var newRow = `
                //         <tr>
                //             <td><input type="text" name="accused[${index}][name]" class="form-control"></td>
                //             <td><input type="text" name="accused[${index}][alias]" class="form-control"></td>
                //             <td><input type="text" name="accused[${index}][father_name]" class="form-control"></td>
                //             <td><input type="text" name="accused[${index}][address]" class="form-control"></td>
                //             <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-accused" id= "delete-acc" style="cursor: pointer; width: 24px;"></td>
                //         </tr>`;
                //     $('#edit-modal #accused-details-table tbody').append(newRow);
                //     updateIndices();
                //     checkRowCount1();
                // });
                // $(document).on('click', '#edit-modal #delete-acc', function() {
                //     $(this).closest('tr').remove();
                //     updateIndices();
                //     checkRowCount1();
                // });


                $('#edit-modal #mobiles-recovered-table tbody').empty();
                function checkRowCount2() {
                    var rowCount = $('#edit-modal #mobiles-recovered-table tbody tr').length;

                    if (rowCount === 1) {
                        // If only one row is left, hide the delete button
                        $('#edit-modal #mobiles-recovered-table tbody tr').find('.delete-mobile').hide();
                    } else {
                        // If more than one row, show the delete button
                        $('#edit-modal #mobiles-recovered-table tbody tr').find('.delete-mobile').show();
                    }
                }
                selectedItem.accused_mobiles.forEach((accused_mobiles, index) => {
                    var index = $('#edit-modal #mobiles-recovered-table tbody tr').length;
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${accused_mobiles.mobile_no}" class="form-control"></td>
                            <td><input type="text" value="${accused_mobiles.imei_no}" class="form-control"></td>
                            <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-mobile" id="delete-mob" style="cursor: pointer; width: 24px;"></td>
                        </tr>`;
                    $('#edit-modal #mobiles-recovered-table tbody').append(newRow);
                    updateIndices3();
                    checkRowCount2();
                });
                function updateIndices3() {
                    $('#edit-modal #mobiles-recovered-table tbody tr').each(function(index) {
                        $(this).find('input').each(function() {
                            var name = $(this).attr('name');
                            
                            // Log the current name value to debug
                            // console.log('Current name:', name);

                            // Only try to update if the name attribute exists
                            if (name !== undefined) {
                                var newName = name.replace(/\d+/, index);
                                console.log('Updated name:', newName); // Log the new name for debugging
                                $(this).attr('name', newName);
                            }
                        });
                    });
                }
                $('#add-row3').off('click').click(function() {
                    var index = $('#edit-modal #mobiles-recovered-table tbody tr').length;
                    var newRow = `
                        <tr>
                            <td><input type="text" name="accused_mobile[${index}][mobile_no]" class="form-control"></td>
                            <td><input type="text" name="accused_mobile[${index}][imei_no]" class="form-control"></td>
                            <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-mobile" id="delete-mob" style="cursor: pointer; width: 24px;"></td>
                        </tr>`;
                    $('#edit-modal #mobiles-recovered-table tbody').append(newRow);
                    updateIndices3();
                    checkRowCount2();
                });
                $(document).on('click', '#edit-modal #delete-mob', function() {
                    $(this).closest('tr').remove();
                    updateIndices3();
                    checkRowCount2();
                });

                $('#edit-modal #arrested-accused-details-table tbody').empty();
                function checkRowCount3() {
                    var rowCount = $('#edit-modal #arrested-accused-details-table tbody tr').length;

                    if (rowCount === 1) {
                        // If only one row is left, hide the delete button
                        $('#edit-modal #arrested-accused-details-table tbody tr').find('.delete-accused2').hide();
                    } else {
                        // If more than one row, show the delete button
                        $('#edit-modal #arrested-accused-details-table tbody tr').find('.delete-accused2').show();
                    }
                }
                selectedItem.arrested_accused.forEach((arrested_accused, index) => {
                    var index = $('#edit-modal #arrested-accused-details-table tbody tr').length;
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${arrested_accused.name}" class="form-control"></td>
                            <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-accused2" id="delete-acc2" style="cursor: pointer; width: 24px;"></td>
                        </tr>`;
                    $('#edit-modal #arrested-accused-details-table tbody').append(newRow);
                    updateIndices2();
                    checkRowCount3();
                });
                $('#edit-modal #add-row2').off('click').click(function() {
                    var index = $('#arrested-accused-details-table tbody tr').length;
                    var newRow = `
                        <tr>
                            <td><input type="text" name="arrested_accused[${index}][name]" class="form-control"></td>
                            <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-accused2" id="delete-acc2"  style="cursor: pointer; width: 24px;"></td>
                        </tr>`;
                    $('#arrested-accused-details-table tbody').append(newRow);
                    updateIndices2();
                    checkRowCount3();
                });
                function updateIndices2(){
                    $('#edit-modal #arrested-accused-details-table tbody tr').each(function(index) {
                        $(this).find('input').each(function() {
                            var name = $(this).attr('name');
                            if (name !== undefined) {
                                var newName = name.replace(/\d+/, index);
                                console.log('Updated name:', newName); // Log the new name for debugging
                                $(this).attr('name', newName);
                            }
                        });
                    });
                }
                $(document).on('click', '#edit-modal #delete-acc2', function() {
                    $(this).closest('tr').remove();
                    updateIndices2();
                    checkRowCount3();
                });

                $('#edit-modal #nbw-accused-table tbody').empty();
                function checkRowCount4() {
                    var rowCount = $('#edit-modal #nbw-accused-table tbody tr').length;

                    if (rowCount === 1) {
                        // If only one row is left, hide the delete button
                        $('#edit-modal #nbw-accused-table tbody tr').find('.delete-nbw-accused').hide();
                    } else {
                        // If more than one row, show the delete button
                        $('#edit-modal #nbw-accused-table tbody tr').find('.delete-nbw-accused').show();
                    }
                }
                selectedItem.nbw_accused.forEach((nbw_accused, index) => {
                    var index = $('#edit-modal #nbw-accused-table tbody tr').length;
                    var newRow = `
                        <tr>
                            <td><input type="text" name="nbw_accused[${index}][name]" value="${nbw_accused.name}" class="form-control"></td>
                            <td><input type="text" name="nbw_accused[${index}][status]" value="${nbw_accused.status}" class="form-control"></td>
                            <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-nbw-accused" style="cursor: pointer; width: 24px;"></td>
                        </tr>`;
                    $('#edit-modal #nbw-accused-table tbody').append(newRow);
                    updateIndices5(); // Update the indices after appending each row
                    checkRowCount4();
                });
                $('#edit-modal #add-row5').off('click').click(function() {
                    var index = $('#edit-modal #nbw-accused-table tbody tr').length; // Get the current row count
                    var newRow = `
                        <tr>
                            <td><input type="text" name="nbw_accused[${index}][name]" class="form-control"></td>
                            <td><input type="text" name="nbw_accused[${index}][status]" class="form-control"></td>
                            <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-nbw-accused" style="cursor: pointer; width: 24px;"></td>
                        </tr>`;
                    $('#edit-modal #nbw-accused-table tbody').append(newRow);
                    updateIndices5(); // Update the indices after appending a new row
                    checkRowCount4();
                });
                function updateIndices5() {
                    $('#edit-modal #nbw-accused-table tbody tr').each(function(index) {
                        $(this).find('input').each(function() {
                            var name = $(this).attr('name');
                            if (name !== undefined) {
                                var newName = name.replace(/\d+/, index); // Replace the number in the name attribute
                                console.log('Updated name:', newName); // Debugging output
                                $(this).attr('name', newName);
                            }
                        });
                    });
                }
                $(document).on('click', '.delete-nbw-accused', function() {
                    $(this).closest('tr').remove();
                    updateIndices5(); // Update the indices after removing a row
                    checkRowCount4();
                });

                $('#edit-modal #released-accused-table tbody').empty();
                function checkRowCount5() {
                    var rowCount = $('#edit-modal #released-accused-table tbody tr').length;

                    if (rowCount === 1) {
                        // If only one row is left, hide the delete button
                        $('#edit-modal #released-accused-table tbody tr').find('.delete-released-accused').hide();
                    } else {
                        // If more than one row, show the delete button
                        $('#edit-modal #released-accused-table tbody tr').find('.delete-released-accused').show();
                    }
                }
                selectedItem.released_accused.forEach((released_accused, index) => {
                    var index = $('#edit-modal #released-accused-table tbody tr').length;
                    var newRow = `
                        <tr>
                            <td><input type="text" name="released_accused[${index}][name]" value="${released_accused.name}" class="form-control"></td>
                            <td><input type="date" name="released_accused[${index}][date]" value="${released_accused.date}" class="form-control"></td>
                            <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-released-accused" style="cursor: pointer; width: 24px;"></td>
                        </tr>`;
                    $('#edit-modal #released-accused-table tbody').append(newRow);
                    updateIndices4();
                    checkRowCount5();
                });
                $('#edit-modal #add-row4').off('click').click(function() {
                    var index = $('#edit-modal #released-accused-table tbody tr').length; // Get the current row count
                    var newRow = `
                        <tr>
                            <td><input type="text" name="released_accused[${index}][name]" class="form-control"></td>
                            <td><input type="date" name="released_accused[${index}][date]" class="form-control"></td>
                            <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-released-accused" style="cursor: pointer; width: 24px;"></td>
                        </tr>`;
                    $('#edit-modal #released-accused-table tbody').append(newRow);
                    updateIndices4();
                    checkRowCount5();
                });
                function updateIndices4() {
                    $('#edit-modal #released-accused-table tbody tr').each(function(index) {
                        $(this).find('input').each(function() {
                            var name = $(this).attr('name');
                            if (name !== undefined) {
                                var newName = name.replace(/\d+/, index); // Replace the number in the name attribute
                                console.log('Updated name:', newName); // Debugging output
                                $(this).attr('name', newName);
                            }
                        });
                    });
                }
                $(document).on('click', '#edit-modal .delete-released-accused', function() {
                    $(this).closest('tr').remove();
                    updateIndices4(); // Update the indices after removing a row
                    checkRowCount5();
                });

                // Use the Laravel route helper to generate URLs for the download route
                const baseUrl = '{{ url("download") }}';

                if (selectedItem.uploads && selectedItem.uploads.length > 0) {
                    const upload = selectedItem.uploads[0]; // Assuming only one set of uploads per form

                    // Populate Post Mortem Report
                    if (upload.post_mortem_report) {
                        $('#edit-modal #post_mortem_report_container').html(`
                            <a href="${baseUrl}/post-mortem-report/${upload.post_mortem_report}" target="_blank">${upload.post_mortem_report}</a>
                        `);
                    } else {
                        $('#edit-modal #post_mortem_report_container').text('No document uploaded');
                    }

                    // Populate Electrical Inspector Report
                    if (upload.electrical_inspector_report) {
                        $('#edit-modal #electrical_inspector_report_container').html(`
                            <a href="${baseUrl}/electrical-inspector-report/${upload.electrical_inspector_report}" target="_blank">${upload.electrical_inspector_report}</a>
                        `);
                    } else {
                        $('#edit-modal #electrical_inspector_report_container').text('No document uploaded');
                    }

                    // // Populate Laboratory Report
                    if (upload.laboratory_report) {
                        $('#edit-modal #lab_report_container').html(`
                            <a href="${baseUrl}/laboratory-report/${upload.laboratory_report}" target="_blank">${upload.laboratory_report}</a>
                        `);
                    } else {
                        $('#edit-modal #lab_report_container').text('No document uploaded');
                    }

                    // // Populate Court Judgement
                    if (upload.court_judgement) {
                        $('#edit-modal #court_judgement_container').html(`
                            <a href="${baseUrl}/court-judgement/${upload.court_judgement}" target="_blank">${upload.court_judgement}</a>
                        `);
                    } else {
                        $('#edit-modal #court_judgement_container').text('No document uploaded');
                    }
                } else {
                    // If no uploads data exists
                    $('#edit-modal #post_mortem_report_container').text('No document uploaded');
                    $('#edit-modal #electrical_inspector_report_container').text('No document uploaded');
                    $('#edit-modal #lab_report_container').text('No document uploaded');
                    $('#edit-modal #court_judgement_container').text('No document uploaded');
                }

                // Show the edit modal
                $('#edit-modal').modal('show');
                
            } else {
                alert('Error: Record not found.');
            }
        });

        // Handle View Details
        $(document).on('click', '#view-details', function (e) {
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
                $('#view-full-width-modal #investigating_agency').val("Forest Department");
                if (selectedItem.species) {
                    // If species is not null, populate the values from the species object
                    $('#view-full-width-modal #schedule_type').val(selectedItem.species.species_type);
                    $('#view-full-width-modal #species_schedule').val(selectedItem.species.schedule_no);
                    $('#view-full-width-modal #species_name').val(selectedItem.species.species_name);
                } else {
                    // If species is null, use values from the selectedItem directly
                    $('#view-full-width-modal #schedule_type').val(selectedItem.species_name); 
                    $('#view-full-width-modal #species_schedule').val(selectedItem.species_schedule); 
                    $('#view-full-width-modal #species_name').val("old"); 
                }
                $('#view-full-width-modal #species_age').val(selectedItem.species_age);
                $('#view-full-width-modal #species_sex').val(selectedItem.species_sex);
                $('#view-full-width-modal #property_recovered_type').val(selectedItem.property_recovered_type);
                $('#view-full-width-modal #property_recovered_details').val(selectedItem.property_recovered_details);
                $('#view-full-width-modal #officer_name').val(selectedItem.in_officer_name);
                $('#view-full-width-modal #officer_number').val(selectedItem.in_officer_mobile);
                $('#view-full-width-modal #brief_fact').val(selectedItem.brief_fact);
                $('#view-full-width-modal #detected_absconded_accused_option').val(selectedItem.detected_absconded_accused_option);

                // Check if the value is "Yes"
                if (selectedItem.detected_absconded_accused_option === "Yes") {
                    // Show the "No of Absconded Accused Detected" section and the table
                    $('#absconded-accused-section').show();
                    $('#absconded-accused-table-row').show();

                    // Set the value for no_of_detected_absconded_accused
                    $('#view-full-width-modal #no_of_detected_absconded_accused').val(selectedItem.no_of_detected_absconded_accused);

                    // Clear any existing rows in the table
                    $('#view-full-width-modal #absconded-accused-details-table tbody').empty();

                    // Loop through absconded_accused and append rows to the table
                    selectedItem.absconded_accused.forEach((absconded_accused, index) => {
                        var newRow = `
                            <tr>
                                <td><input type="text" value="${absconded_accused.accused_name}" class="form-control" readonly></td>
                            </tr>`;
                        $('#view-full-width-modal #absconded-accused-details-table tbody').append(newRow);
                    });

                    // Adjust the layout of the "Absconded Accused Detected if any" div to take up half the width (col-md-6)
                    $('#detected-accused-section').removeClass('col-md-12').addClass('col-md-6');

                } else {
                    // Hide the "No of Absconded Accused Detected" section and the table
                    $('#view-full-width-modal #absconded-accused-section').hide();
                    $('#view-full-width-modal #absconded-accused-table-row').hide();

                    // Make the "Absconded Accused Detected if any" div take the full width (col-md-12)
                    $('#view-full-width-modal #detected-accused-section').removeClass('col-md-6').addClass('col-md-12');
                }
                $('#view-full-width-modal #undetected_absconded_accused_option').val(selectedItem.undetected_absconded_accused_option);
                if(selectedItem.undetected_absconded_accused_option === "Yes"){
                    $('#view-full-width-modal #un-absconded-accused-section').show();
                    $('#view-full-width-modal #no_of_undetected_absconded_accused').val(selectedItem.no_of_undetected_absconded_accused);
                    $('#view-full-width-modal #undetected-accused-section').removeClass('col-md-12').addClass('col-md-6');
                }
                else{
                    $('#view-full-width-modal #undetected-accused-section').removeClass('col-md-6').addClass('col-md-12');
                }

                $('#view-full-width-modal #additional_pr_option').val(selectedItem.additional_pr_option);
                if (selectedItem.additional_pr_option === "Yes") {
                    $('#view-full-width-modal #additional-pr-table-row').show();
                    
                    // Clear any existing rows in the table
                    $('#view-full-width-modal #additional-pr-table tbody').empty();

                    // Loop through additionalpr and append rows to the table
                    selectedItem.additionalpr.forEach((additionalpr, index) => {
                        var newRow = `
                            <tr>
                                <td><input type="text" value="${additionalpr.number}" class="form-control" readonly></td>
                                <td><input type="text" value="${additionalpr.date}" class="form-control" readonly></td>
                                <td><input type="text" value="${additionalpr.status}" class="form-control" readonly></td>
                            </tr>`;
                        $('#view-full-width-modal #additional-pr-table tbody').append(newRow);
                    });

                } else {
                    $('#view-full-width-modal #additional-pr-table-row').hide();
                }
                
                $('#view-full-width-modal #court_forward_date').val(selectedItem.court_forward_date);
                $('#view-full-width-modal #court_name').val(selectedItem.court_name);
                $('#view-full-width-modal #court_case_number').val(selectedItem.court_case_number);
                $('#view-full-width-modal #pr_number').val(selectedItem.pr_number);
                $('#view-full-width-modal #pr_date').val(selectedItem.pr_date);
                $('#view-full-width-modal #pr_status').val(selectedItem.pr_status);
                $('#view-full-width-modal #action_against_staff').val(selectedItem.action_against_staff);
                $('#view-full-width-modal #case_present_status').val(selectedItem.case_present_status);
                
                // $('#view-full-width-modal #accused-details-table tbody').empty();
                // selectedItem.accused.forEach((accused, index) => {
                //     var newRow = `
                //         <tr>
                //             <td><input type="text" value="${accused.name}" class="form-control" readonly></td>
                //             <td><input type="text" value="${accused.alias ? accused.alias : ''}" class="form-control" readonly></td>
                //             <td><input type="text" value="${accused.father_name}" class="form-control" readonly></td>
                //             <td><input type="text" value="${accused.address ? accused.address : ''}" class="form-control" readonly></td>
                //         </tr>`;
                //     $('#accused-details-table tbody').append(newRow);
                // });

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
                            <td><input type="text" value="${arrested_accused.accused_name}" class="form-control" readonly></td>
                        </tr>`;
                    $('#arrested-accused-details-table tbody').append(newRow);
                });

                $('#view-full-width-modal #nbw-accused-table tbody').empty();
                selectedItem.nbw_accused.forEach((nbw_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${nbw_accused.accused_name}" class="form-control" readonly></td>
                            <td><input type="text" value="${nbw_accused.nbw_status}" class="form-control" readonly></td>
                        </tr>`;
                    $('#nbw-accused-table tbody').append(newRow);
                });

                $('#view-full-width-modal #released-accused-table tbody').empty();
                selectedItem.released_accused.forEach((released_accused, index) => {
                    var newRow = `
                        <tr>
                            <td><input type="text" value="${released_accused.accused_name}" class="form-control" readonly></td>
                            <td><input type="date" value="${released_accused.bail_date}" class="form-control" readonly></td>
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
                        `);
                    } else {
                        $('#view-full-width-modal #post_mortem_report_container').text('No document uploaded');
                    }

                    // Populate Electrical Inspector Report
                    if (upload.electrical_inspector_report) {
                        $('#view-full-width-modal #electrical_inspector_report_container').html(`
                            <a href="${baseUrl}/electrical-inspector-report/${upload.electrical_inspector_report}" target="_blank">${upload.electrical_inspector_report}</a>
                        `);
                    } else {
                        $('#view-full-width-modal #electrical_inspector_report_container').text('No document uploaded');
                    }

                    // Populate Laboratory Report
                    if (upload.laboratory_report) {
                        $('#view-full-width-modal #lab_report_container').html(`
                            <a href="${baseUrl}/laboratory-report/${upload.laboratory_report}" target="_blank">${upload.laboratory_report}</a>
                        `);
                    } else {
                        $('#view-full-width-modal #lab_report_container').text('No document uploaded');
                    }

                    // Populate Court Judgement
                    if (upload.court_judgement) {
                        $('#view-full-width-modal #court_judgement_container').html(`
                            <a href="${baseUrl}/court-judgement/${upload.court_judgement}" target="_blank">${upload.court_judgement}</a>
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