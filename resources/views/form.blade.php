<!-- resources/views/form.blade.php -->
@extends('layouts.dashboard')
@section('user-info')
<h1>Complain 1</h1>
@endsection
@section('form-content')
<div class="container mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="data-form" action="{{ route('submit-form') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="circle">Circle</label>
                                <select id="circle" name="circle" class="form-control">
                                    <option value="">Select Circle</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="division">Division</label>
                                <select id="division" name="division" class="form-control" disabled>
                                    <option value="">Select Division</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="range">Range</label>
                                <select id="range" name="range" class="form-control" disabled>
                                    <option value="">Select Range</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="section">Section</label>
                                <select id="section" name="section" class="form-control" disabled>
                                    <option value="">Select Section</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="beat">Beat</label>
                                <select id="beat" name="beat" class="form-control" disabled>
                                    <option value="">Select Beat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="case_type">Case Type</label>
                                <select id="case_type" name="case_type" class="form-control" required>
                                    <option value="">Select Case Type</option>
                                    <option value="UD">UD</option>
                                    <option value="OR">OR</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="case_no" id="case_no_label">Case Number</label>
                                <input type="text" id="case_no" name="case_no" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="detection_place">Place of Detection</label>
                                <select id="detection_place" name="detection_place" class="form-control" disabled>
                                    <option value="">Select Forest Block</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="case_date">Case Date</label>
                                <input type="date" id="case_date" name="case_date" class="form-control" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="case_date">Detection Date</label>
                                <input type="date" id="detection_date" name="detection_date" class="form-control" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Case Detection GPS Location</h5>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control" placeholder="Enter latitude in decimal format" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control" placeholder="Enter longitude in decimal format" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="detection_agency">Case Detection Agency</label>
                                <select id="detection_agency" name="detection_agency" class="form-control" required>
                                    <option value="">Select Agency</option>
                                    <option value="Forest">Forest</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="investigating_agency">Case Investigating Agency</label>
                                <select id="investigating_agency" name="investigating_agency" class="form-control" required>
                                    <option value="">Select Agency</option>
                                    <option value="Forest">Forest</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                    </div>
                    </div>
                    <div class="row mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="detection_agency">Name Of the Species</label>
                                    <select id="species_name" name="species_name" class="form-control">
                                        <!-- <option value="">Select Agency</option>
                                        <option value="Forest">Forest</option>
                                        <option value="Other">Other</option> -->
                                    </select>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="species_age">Age of the Species</label>
                                        <input type="text" id="species_age" name="species_age" class="form-control" required>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="species_sex">Sex Of the Species</label>
                                    <select id="species_sex" name="species_sex" class="form-control" required>
                                        <option value="">Select Sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="old_wlpa">Old Schedule Of Species under WLPA</label>
                                    <select id="old_wlpa" name="old_wlpa" class="form-control" >
                                        <!-- <option value="">Select Agency</option>
                                        <option value="Forest">Forest</option>
                                        <option value="Other">Other</option> -->
                                    </select>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="new_wlpa">New Schedule Of Species under WLPA</label>
                                    <select id="new_wlpa" name="new_wlpa" class="form-control" >
                                        <!-- <option value="">Select Agency</option>
                                        <option value="Forest">Forest</option>
                                        <option value="Other">Other</option> -->
                                    </select>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="property_recovered_type">Property Recovered Type</label>
                                    <select id="property_recovered_type" name="property_recovered_type" class="form-control" >
                                        <!-- <option value="">Select Sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option> -->
                                    </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row mt-4">
                    <div class="form-group row">
                        <label for="briefFact" class="col-sm-2 col-form-label">Brief Fact:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="briefFact" name="briefFact" rows="6" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Accused Detail</h5>
                            <table class="table table-bordered" id="accused-details-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Alias</th>
                                        <th>Father's Name</th>
                                        <th>Address</th>
                                        <th>Mobile Number</th>
                                        <th>IMEI Number</th>
                                        <th><img src="{{ asset('assets/images/users/add.png') }}" alt="Add More" id="add-row" style="cursor: pointer; width: 24px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="accused[0][name]" class="form-control"></td>
                                        <td><input type="text" name="accused[0][alias]" class="form-control"></td>
                                        <td><input type="text" name="accused[0][father_name]" class="form-control"></td>
                                        <td><input type="text" name="accused[0][address]" class="form-control"></td>
                                        <td><input type="text" name="accused[0][mobile]" class="form-control"></td>
                                        <td><input type="text" name="accused[0][imei]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">    
                            <h5>Arrested Accused Detail</h5>
                            <table class="table table-bordered" id="arrested-accused-details-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Alias</th>
                                        <th>Father's Name</th>
                                        <th>Address</th>
                                        <th>Mobile Number</th>
                                        <th>IMEI Number</th>
                                        <th><img src="{{ asset('assets/images/users/add.png') }}" alt="Add More" id="add-row2" style="cursor: pointer; width: 24px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="arrested_accused[0][name]" class="form-control"></td>
                                        <td><input type="text" name="arrested_accused[0][alias]" class="form-control"></td>
                                        <td><input type="text" name="arrested_accused[0][father_name]" class="form-control"></td>
                                        <td><input type="text" name="arrested_accused[0][address]" class="form-control"></td>
                                        <td><input type="text" name="arrested_accused[0][mobile]" class="form-control"></td>
                                        <td><input type="text" name="arrested_accused[0][imei]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






<script>
$(document).ready(function() {
     $('#case_date').attr('max', new Date().toISOString().split('T')[0]);
     $('#detection_date').attr('max', new Date().toISOString().split('T')[0]);


    $('#add-row').click(function() {
        var index = $('#accused-details-table tbody tr').length;
        var newRow = `
            <tr>
                <td><input type="text" name="accused[${index}][name]" class="form-control"></td>
                <td><input type="text" name="accused[${index}][alias]" class="form-control"></td>
                <td><input type="text" name="accused[${index}][father_name]" class="form-control"></td>
                <td><input type="text" name="accused[${index}][address]" class="form-control"></td>
                <td><input type="text" name="accused[${index}][mobile]" class="form-control"></td>
                <td><input type="text" name="accused[${index}][imei]" class="form-control"></td>
                <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-accused" style="cursor: pointer; width: 24px;"></td>
            </tr>`;
        $('#accused-details-table tbody').append(newRow);
        updateIndices();
    });
    $('#add-row2').click(function() {
        var index = $('#arrested-accused-details-table tbody tr').length;
        var newRow = `
            <tr>
                <td><input type="text" name="arrested_accused[${index}][name]" class="form-control"></td>
                <td><input type="text" name="arrested_accused[${index}][alias]" class="form-control"></td>
                <td><input type="text" name="arrested_accused[${index}][father_name]" class="form-control"></td>
                <td><input type="text" name="arrested_accused[${index}][address]" class="form-control"></td>
                <td><input type="text" name="arrested_accused[${index}][mobile]" class="form-control"></td>
                <td><input type="text" name="arrested_accused[${index}][imei]" class="form-control"></td>
                <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-accused2" style="cursor: pointer; width: 24px;"></td>
            </tr>`;
        $('#arrested-accused-details-table tbody').append(newRow);
        updateIndices2();
    });

    // Delete accused details row
    $(document).on('click', '.delete-accused', function() {
        $(this).closest('tr').remove();
        updateIndices();
    });
    $(document).on('click', '.delete-accused2', function() {
        $(this).closest('tr').remove();
        updateIndices2();
    });

    // Update the indices of the accused details rows
    function updateIndices() {
        $('#accused-details-table tbody tr').each(function(index) {
            $(this).find('input').each(function() {
                var name = $(this).attr('name');
                var newName = name.replace(/\d+/, index);
                $(this).attr('name', newName);
            });
        });
    }
    function updateIndices2(){
        $('#arrested-accused-details-table tbody tr').each(function(index) {
            $(this).find('input').each(function() {
                var name = $(this).attr('name');
                var newName = name.replace(/\d+/, index);
                $(this).attr('name', newName);
            });
        });
    }
    // Fetch circles on page load
    $.getJSON('circles', function(data) {
        $('#circle').append(data.map(circle => `<option value="${circle.id}">${circle.name_e}</option>`));
    });
    // Fetch divisions based on selected circle
    $('#circle').change(function() {
        const circleId = $(this).val();
        $('#division').prop('disabled', !circleId);
        $('#division').empty().append('<option value="">Select Division</option>');
        $('#range').prop('disabled', true).empty().append('<option value="">Select Range</option>');
        $('#section').prop('disabled', true).empty().append('<option value="">Select Section</option>');
        $('#beat').prop('disabled', true).empty().append('<option value="">Select Beat</option>');

        if (circleId) {
            $.getJSON(`circles/${circleId}/divisions`, function(data) {
                $('#division').append(data.map(division => `<option value="${division.id}">${division.name_e}</option>`));
            });
        }
    });

    // Fetch ranges based on selected division
    $('#division').change(function() {
        const divisionId = $(this).val();
        $('#detection_place').prop('disabled', !divisionId);
        $('#detection_place').empty().append('<option value="">Select Forest Block</option>');
        $('#range').prop('disabled', !divisionId);
        $('#range').empty().append('<option value="">Select Range</option>');
        $('#section').prop('disabled', true).empty().append('<option value="">Select Section</option>');
        $('#beat').prop('disabled', true).empty().append('<option value="">Select Beat</option>');

        if (divisionId) {
            $.getJSON(`divisions/${divisionId}/ranges`, function(data) {
                $('#range').append(data.map(range => `<option value="${range.id}">${range.name_e}</option>`));
            });
            $.getJSON(`divisions/${divisionId}/forest_blocks`, function(data) {
                $('#detection_place').append(data.map(forest_block => `<option value="${forest_block.id}">${forest_block.name_e}</option>`));
            });
        }
    });

    // Fetch sections based on selected range
    $('#range').change(function() {
        const rangeId = $(this).val();
        $('#section').prop('disabled', !rangeId);
        $('#section').empty().append('<option value="">Select Section</option>');
        $('#beat').prop('disabled', true).empty().append('<option value="">Select Beat</option>');

        if (rangeId) {
            $.getJSON(`ranges/${rangeId}/sections`, function(data) {
                $('#section').append(data.map(section => `<option value="${section.id}">${section.name_e}</option>`));
            });
        }
    });

    // Fetch beats based on selected section
    $('#section').change(function() {
        const sectionId = $(this).val();
        $('#beat').prop('disabled', !sectionId);
        $('#beat').empty().append('<option value="">Select Beat</option>');

        if (sectionId) {
            $.getJSON(`sections/${sectionId}/beats`, function(data) {
                $('#beat').append(data.map(beat => `<option value="${beat.id}">${beat.name_e}</option>`));
            });
        }
    });
    $('#case_type').change(function() {
        const caseType = $(this).val();
        const label = caseType ? caseType + ' Case Number' : 'Case Number';
        $('#case_no_label').text(label);
    });
});
</script>
@endsection
