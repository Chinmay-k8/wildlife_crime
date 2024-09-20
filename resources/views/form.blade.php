<!-- resources/views/form.blade.php -->
@extends('layouts.dashboard')
@section('user-info')
<h1>Form-X</h1>
@endsection
@section('form-content')
<div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="data-form" action="{{ route('submit-form') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="penal_code" id="penal_code">Penal Code</label>
                                <input type="text" id="penal_code" name="penal_code" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="detection_place_type">Place of Detection Type</label>
                                <select id="detection_place_type" name="detection_place_type" class="form-control">
                                    <option value="forest">Forest Block</option>
                                    <option value="revenue">Revenue Forest</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="detection_place">Place of Detection</label>
                                    <input type="text" id="detection_place" name="detection_place" class="form-control" required>
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="case_date">Case Date</label>
                                <input type="date" id="case_date" name="case_date" class="form-control" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                                <div class="d-flex">
                                    <input type="number" id="lat_deg" name="lat_deg" class="form-control" placeholder="Deg" required style="width: 30%;">
                                    <input type="number" id="lat_min" name="lat_min" class="form-control" placeholder="Min" required style="width: 30%; margin-left: 5px;">
                                    <input type="number" id="lat_sec" name="lat_sec" class="form-control" placeholder="Sec" required style="width: 30%; margin-left: 5px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <div class="d-flex">
                                    <input type="number" id="long_deg" name="long_deg" class="form-control" placeholder="Deg" required style="width: 30%;">
                                    <input type="number" id="long_min" name="long_min" class="form-control" placeholder="Min" required style="width: 30%; margin-left: 5px;">
                                    <input type="number" id="long_sec" name="long_sec" class="form-control" placeholder="Sec" required style="width: 30%; margin-left: 5px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6" id="detection-agency-group">
                            <div class="form-group">
                                <label for="detection_agency">Case Detection Agency</label>
                                <select id="detection_agency" name="detection_agency" class="form-control" required>
                                    <option value="">Select Agency</option>
                                    <option value="Forest Department">Forest Department</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Hidden by default -->
                        <div class="col-md-4" id="other-agency-group" style="display: none;">
                            <div class="form-group">
                                <label for="other_detection_agency">Other Agency Name</label>
                                <input type="text" id="other_detection_agency" name="other_detection_agency" class="form-control" placeholder="Enter other agency name">
                            </div>
                        </div>

                        <div class="col-md-6" id="investigating-agency-group">
                            <div class="form-group">
                                <label for="investigating_agency">Case Investigating Agency</label>
                                <select id="investigating_agency" name="investigating_agency" class="form-control" required>
                                    <option value="">Select Agency</option>
                                    <option value="Forest Department">Forest Department</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="species_name">Name Of the Species</label>
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
                                        <option value="">Select Scedule</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                    </select>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="new_wlpa">New Schedule Of Species under WLPA</label>
                                    <select id="new_wlpa" name="new_wlpa" class="form-control" >
                                        <option value="">Select Scedule</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                    </select>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="property_recovered_type">Property Recovered Type</label>
                                    <select id="property_recovered_type" name="property_recovered_type" class="form-control" >
                                        <option value="">Select Type</option>
                                        <option value="Live animal">Live animal</option>
                                        <option value="Carcass">Carcass</option>
                                        <option value="Body parts">Body parts</option>
                                        <option value="Arms and Ammunition">Arms and Ammunition</option>
                                        <option value="GI wire">GI wire</option>
                                        <option value="Vehicles">Vehicles</option>
                                        <option value="Other Material">Other Material</option>
                                    </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="property_recovered_details" class="form-label">Property Recovered Details:</label>
                                <textarea class="form-control" id="property_recovered_details" name="property_recovered_details" rows="1" style="resize: none;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brief_fact" class="form-label">Brief Fact / Cause of Death:</label>
                                <textarea class="form-control" id="brief_fact" name="brief_fact" rows="1" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>  
                    <div class="row mt-4">
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="officer_name">Name of the Investigating Officer</label>
                                    <input type="text" id="officer_name" name="officer_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="officer_number">Mobile Number of Investigating Officer</label>
                                    <input type="text" id="officer_number" name="officer_number" class="form-control" required>
                                </div>
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
                                        <th><img src="{{ asset('assets/images/users/add.png') }}" alt="Add More" id="add-row" style="cursor: pointer; width: 24px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="accused[0][name]" class="form-control"></td>
                                        <td><input type="text" name="accused[0][alias]" class="form-control"></td>
                                        <td><input type="text" name="accused[0][father_name]" class="form-control"></td>
                                        <td><input type="text" name="accused[0][address]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Mobiles recovered</h5>
                            <table class="table table-bordered" id="mobiles-recovered-table">
                                <thead>
                                    <tr>
                                        <th>Mobile Number</th>
                                        <th>IMEI Number</th>
                                        <th><img src="{{ asset('assets/images/users/add.png') }}" alt="Add More" id="add-row3" style="cursor: pointer; width: 24px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="accused_mobile[0][mobile_no]" class="form-control"></td>
                                        <td><input type="text" name="accused_mobile[0][imei_no]" class="form-control"></td>
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
                                        <th><img src="{{ asset('assets/images/users/add.png') }}" alt="Add More" id="add-row2" style="cursor: pointer; width: 24px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="arrested_accused[0][name]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">  
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="court_forward_date">Date of forwarding to court</label>
                                <input type="date" id="court_forward_date" name="court_forward_date" class="form-control" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="court_name">Court name</label>
                                    <input type="text" id="court_name" name="court_name" class="form-control" required>
                                </div>
                        </div>
                        <div class="col-md-4">
    <div class="form-group">
        <label for="court_case_number">Case (2(b) CC/No.) number</label>
        <div class="input-group">
            <!-- Hardcoded text part (you don't need this in the backend) -->
            <span class="input-group-text">2(b) CC No</span>

            <!-- Input for the first part (the number) -->
            <input type="text" id="case_part_1" name="case_part_1" maxlength="3" class="form-control" required>

            <!-- "of" separator -->
            <span class="input-group-text">of</span>

            <!-- Dropdown for the year -->
            <select id="case_year" name="case_year" class="form-control" required>
                <option value="">Select Year</option>
                <?php
                $currentYear = date('Y');
                for ($year = 2000; $year <= $currentYear; $year++) {
                    echo "<option value=\"$year\">$year</option>";
                }
                ?>
            </select>
        </div>
    </div>
</div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Name of accused against whom NBW issued & status of NBW execution</h5>
                            <table class="table table-bordered" id="nbw-accused-table">
                                <thead>
                                    <tr>
                                        <th>Accused Name</th>
                                        <th>NBW Execution Status</th>
                                        <th><img src="{{ asset('assets/images/users/add.png') }}" alt="Add More" id="add-row5" style="cursor: pointer; width: 24px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="nbw_accused[0][name]" class="form-control"></td>
                                        <td><input type="text" name="nbw_accused[0][status]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Name of the accused released on bail with date</h5>
                            <table class="table table-bordered" id="released-accused-table">
                                <thead>
                                    <tr>
                                        <th>Accused name </th>
                                        <th>Date</th>
                                        <th><img src="{{ asset('assets/images/users/add.png') }}" alt="Add More" id="add-row4" style="cursor: pointer; width: 24px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="released_accused[0][name]" class="form-control"></td>
                                        <td><input type="date" id="release_date" name="released_accused[0][date]" class="form-control" max="{{ date('Y-m-d') }}" required></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <h5>Submission of final PR</h5>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="officer_name">Final PR number</label>
                                    <input type="text" id="pr_number" name="pr_number" class="form-control" required>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pr_date">Date</label>
                                <input type="date" id="pr_date" name="pr_date" class="form-control" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pr_status">Status</label>
                                    <input type="text" id="pr_status" name="pr_status" class="form-control" required>
                                </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                    <label for="action_against_staff">Action taken against any staff(Departmental Staff)</label>
                                    <select id="action_against_staff" name="action_against_staff" class="form-control" required>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        <option value="Under trial">Under trial</option>
                                    </select>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                    <label for="case_present_status">Present Status of the case</label>
                                    <select id="case_present_status" name="case_present_status" class="form-control" placeholder="Test" required>
                                        <option value="">Select Status</option>
                                        <option value="Under investigation prosecution not submitted">Under investigation prosecution not submitted</option>
                                        <option value="Prosecution submitted matter not listed">Prosecution submitted matter not listed</option>
                                        <option value="Matter listed hearing not started">Matter listed hearing not started</option>
                                        <option value="Under trial">Under trial</option>
                                        <option value="Hearing completed judgement reserved">Hearing completed judgement reserved</option>
                                        <option value="Hearing completed judgement pronounced offence acquitted">Hearing completed judgement pronounced offence acquitted</option>
                                        <option value="Hearing completed judgement pronounced offence convicted">Hearing completed judgement pronounced offence convicted</option>
                                    </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row mt-4">
                    <div class="row">
                        <h5>Uploads</h5>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="post_mortem_report">Post Mortem Report</label>
                                <input type="file" class="form-control" id="post_mortem_report" name="post_mortem_report" accept=".pdf,.doc,.docx">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="electrical_inspector_report">Report from Electrical Inspector</label>
                                <input type="file" class="form-control" id="electrical_inspector_report" name="electrical_inspector_report" accept=".pdf,.doc,.docx">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lab_report">Laboratory Report/Other Report</label>
                                <input type="file" class="form-control" id="laboratory_report" name="laboratory_report" accept=".pdf,.doc,.docx">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="court_judgement">Judgement of the Court</label>
                                <input type="file" class="form-control" id="court_judgement" name="court_judgement" accept=".pdf,.doc,.docx">
                            </div>
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

        document.getElementById('detection_agency').addEventListener('change', function () {
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



    $('#add-row').click(function() {
        var index = $('#accused-details-table tbody tr').length;
        var newRow = `
            <tr>
                <td><input type="text" name="accused[${index}][name]" class="form-control"></td>
                <td><input type="text" name="accused[${index}][alias]" class="form-control"></td>
                <td><input type="text" name="accused[${index}][father_name]" class="form-control"></td>
                <td><input type="text" name="accused[${index}][address]" class="form-control"></td>
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
                <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-accused2" style="cursor: pointer; width: 24px;"></td>
            </tr>`;
        $('#arrested-accused-details-table tbody').append(newRow);
        updateIndices2();
    });
    $('#add-row3').click(function() {
        var index = $('#mobiles-recovered-table tbody tr').length;
        var newRow = `
            <tr>
                <td><input type="text" name="accused_mobile[${index}][mobile_no]" class="form-control"></td>
                <td><input type="text" name="accused_mobile[${index}][imei_no]" class="form-control"></td>
                <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-mobile" style="cursor: pointer; width: 24px;"></td>
            </tr>`;
        $('#mobiles-recovered-table tbody').append(newRow);
        updateIndices3();
    });
    $('#add-row4').click(function() {
        var index = $('#released-accused-table tbody tr').length;
        var newRow = `
            <tr>
                <td><input type="text" name="released_accused[${index}][name]" class="form-control"></td>
                <td><input type="date" name="released_accused[${index}][date]" class="form-control" max="{{ date('Y-m-d') }}" required></td>
                <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-released-accused" style="cursor: pointer; width: 24px;"></td>
            </tr>`;
        $('#released-accused-table tbody').append(newRow);
        updateIndices4();
    });
    $('#add-row5').click(function() {
        var index = $('#nbw-accused-table tbody tr').length;
        var newRow = `
            <tr>
                <td><input type="text" name="nbw_accused[${index}][name]" class="form-control"></td>
                <td><input type="text" name="nbw_accused[${index}][status]" class="form-control"></td>
                <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-nbw-accused" style="cursor: pointer; width: 24px;"></td>
            </tr>`;
        $('#nbw-accused-table tbody').append(newRow);
        updateIndices4();
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
    $(document).on('click', '.delete-mobile', function() {
        $(this).closest('tr').remove();
        updateIndices3();
    });
    $(document).on('click', '.delete-released-accused', function() {
        $(this).closest('tr').remove();
        updateIndices4();
    });
    $(document).on('click', '.delete-nbw-accused', function() {
        $(this).closest('tr').remove();
        updateIndices5();
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
    function updateIndices3(){
        $('#mobiles-recovered-table tbody tr').each(function(index) {
            $(this).find('input').each(function() {
                var name = $(this).attr('name');
                var newName = name.replace(/\d+/, index);
                $(this).attr('name', newName);
            });
        });
    }
    function updateIndices4(){
        $('#released-accused-table tbody tr').each(function(index) {
            $(this).find('input').each(function() {
                var name = $(this).attr('name');
                var newName = name.replace(/\d+/, index);
                $(this).attr('name', newName);
            });
        });
    }
    function updateIndices5(){
        $('#nbw-accused-table tbody tr').each(function(index) {
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
        // $('#detection_place').prop('disabled', !divisionId);
        // $('#detection_place').empty().append('<option value="">Select Forest Block</option>');
        $('#range').prop('disabled', !divisionId);
        $('#range').empty().append('<option value="">Select Range</option>');
        $('#section').prop('disabled', true).empty().append('<option value="">Select Section</option>');
        $('#beat').prop('disabled', true).empty().append('<option value="">Select Beat</option>');

        if (divisionId) {
            $.getJSON(`divisions/${divisionId}/ranges`, function(data) {
                $('#range').append(data.map(range => `<option value="${range.id}">${range.name_e}</option>`));
            });
            // $.getJSON(`divisions/${divisionId}/forest_blocks`, function(data) {
            //     $('#detection_place').append(data.map(forest_block => `<option value="${forest_block.id}">${forest_block.name_e}</option>`));
            // });
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
