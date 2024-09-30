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
        <select id="circle" name="circle" class="form-control" {{ in_array($designationId, [4, 5, 6]) ? 'disabled' : '' }}>
            <option value="">Select Circle</option>
            @foreach($circles as $circle)
                <option value="{{ $circle->id }}" {{ $circle->id == $selectedCircle ? 'selected' : '' }}>
                    {{ $circle->name_e }}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="circle" id="circle-hidden" value="{{ $selectedCircle }}">
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="division">Division</label>
        <select id="division" name="division" class="form-control" {{ in_array($designationId, [4, 5, 6]) ? 'disabled' : '' }}>
            <option value="">Select Division</option>
            @foreach($divisions as $division)
                <option value="{{ $division->id }}" {{ $division->id == $selectedDivision ? 'selected' : '' }}>
                    {{ $division->name_e }}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="division" id="division-hidden" value="{{ $selectedDivision }}">
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
                                    <option value="Forest_Department">Forest Department</option>
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
                                    <option value="Forest_Department" selected>Forest Department</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                    <div class="row">
                         <div class="col-md-4">
                            <div class="form-group">
                                    <label for="schedule_type">Shedule Type of Species (New/Old)</label>
                                    <select id="schedule_type" name="schedule_type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="new">New</option>
                                        <option value="old">Old</option>
                                    </select>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="species_schedule">Schedule Of Species under WLPA</label>
                                    <select id="species_schedule" name="species_schedule" class="form-control" >
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
                                    <label for="species_name">Name Of the Species</label>
                                    <select id="species_name" name="species_name" class="form-control">
                                        <!-- <option value="">Select Agency</option>
                                        <option value="Forest">Forest</option>
                                        <option value="Other">Other</option> -->
                                    </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row mt-4">
                    <div class="row">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="property_recovered_type">Property Recovered Type</label>
                                    <select id="property_recovered_type" name="property_recovered_type" class="form-control" >
                                        <option value="">Select Type</option>
                                        <option value="Live_animal">Live animal</option>
                                        <option value="Meat">Meat</option>
                                        <option value="Carcass">Carcass</option>
                                        <option value="Body_parts">Body parts</option>
                                        <option value="Arms_and_Ammunition">Arms and Ammunition</option>
                                        <option value="GI_wire">Tool</option>
                                        <option value="Vehicles">Vehicles</option>
                                        <option value="Other_Material">Other Material</option>
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
                                    <label for="in_officer_name">Name of the Investigating Officer</label>
                                    <input type="text" id="in_officer_name" name="in_officer_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="in_officer_mobile">Mobile Number of Investigating Officer</label>
                                    <input type="text" id="in_officer_mobile" name="in_officer_mobile" class="form-control" required>
                                </div>
                            </div>
                    </div>
                    <!-- <div class="row mt-4">
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
                    </div> -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Mobile(s) recovered</h5>
                            <table class="table table-bordered" id="mobiles-recovered-table">
                                <thead>
                                    <tr>
                                        <th>Mobile Number</th>
                                        <th>IMEI Number</th>
                                        <th>
                                            <button id="add-row3" type="button" class="btn btn-sm" style="background-color: rgb(0, 80, 64); color: white; cursor: pointer;">
                                                Add More
                                            </button>
                                        </th>
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
                                        <th>
                                            <button id="add-row2" type="button" class="btn btn-sm" style="background-color: rgb(0, 80, 64); color: white; cursor: pointer;">Add More</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="arrested_accused[0][accused_name]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12" id="detected-absconded-accused-container">
                            <div class="form-group">
                                <label for="detected_absconded_accused_option">Absconded Accused Detected if any</label>
                                <select id="detected_absconded_accused_option" name="detected_absconded_accused_option" class="form-control" required>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"  id="absconded-accused-count-container" style="display: none;">
                            <div class="form-group">
                                <label for="no_of_detected_absconded_accused">No of Absconded Accused Detected</label>
                                <select id="no_of_detected_absconded_accused" name="no_of_detected_absconded_accused" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" id="absconded-accused-table-container" style="display: none;">
                        <div class="col-12">    
                            <h5>Absconded Accused Detail</h5>
                            <table class="table table-bordered" id="absconded-accused-details-table">
                                <thead>
                                    <tr>
                                        <th>Accused Name</th>
                                    </tr>
                                </thead>
                                <tbody id="absconded-accused-table-body">
                                    <!-- Rows will be dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12" id="undetected-absconded-accused-container">
                            <div class="form-group">
                                <label for="undetected_absconded_accused_option">Absconded Accused Undetected if any</label>
                                <select id="undetected_absconded_accused_option" name="undetected_absconded_accused_option" class="form-control" required>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"  id="undetected_absconded-accused-count-container">
                            <div class="form-group">
                                <label for="no_of_undetected_absconded_accused">No of Undetected Absconded Accused</label>
                                <select id="no_of_undetected_absconded_accused" name="no_of_undetected_absconded_accused" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
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
                                    <span class="input-group-text">2(b) CC No</span>
                                    <input type="text" id="case_part_1" name="case_part_1" maxlength="3" class="form-control" required>
                                    <span class="input-group-text">of</span>
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
                                        <th>
                                            <button id="add-row5" type="button" class="btn btn-sm" style="background-color: rgb(0, 80, 64); color: white; cursor: pointer;">
                                                    Add More
                                            </button>
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="nbw_accused[0][accused_name]" class="form-control"></td>
                                        <td><input type="text" name="nbw_accused[0][nbw_status]" class="form-control"></td>
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
                                        <th>
                                            <button id="add-row4" type="button" class="btn btn-sm" style="background-color: rgb(0, 80, 64); color: white; cursor: pointer;">
                                                Add More
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="released_accused[0][accused_name]" class="form-control"></td>
                                        <td><input type="date" id="release_date" name="released_accused[0][bail_date]" class="form-control" max="{{ date('Y-m-d') }}" required></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <h5>Submission of final PR</h5>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pr_number">Final PR number</label>
                                    <input type="text" id="pr_number" name="pr_number" class="form-control" required>
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pr_date">Date</label>
                                <input type="date" id="pr_date" name="pr_date" class="form-control" max="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pr_status">Status</label>
                                    <input type="text" id="pr_status" name="pr_status" class="form-control" required>
                                </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                    <label for="additional_pr_option">Additional PR if any</label>
                                    <select id="additional_pr_option" name="additional_pr_option" class="form-control" required>
                                        <option value="No">No</option>    
                                        <option value="Yes">Yes</option>
                                    </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row mt-4" id="additional-pr-container" style="display: none;">
                        <div class="col-12">
                            <h5>Submission of Additional PR</h5>
                            <table class="table table-bordered" id="additional-pr-table">
                                <thead>
                                    <tr>
                                        <th>PR Number</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>
                                            <button id="add-pr-row" type="button" class="btn btn-sm" style="background-color: rgb(0, 80, 64); color: white; cursor: pointer;">
                                                    Add More
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="additional_pr[0][number]" class="form-control"></td>
                                        <td><input type="date" name="additional_pr[0][date]" class="form-control" max="{{ date('Y-m-d') }}"></td>
                                        <td><input type="text" name="additional_pr[0][status]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
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
                                        <option value="Under_investigation_prosecution_not_submitted">Under investigation prosecution not submitted</option>
                                        <option value="Prosecution_submitted_matter_not_listed">Prosecution submitted matter not listed</option>
                                        <option value="Matter_listed_hearing_not_started">Matter listed hearing not started</option>
                                        <option value="Under_trial">Under trial</option>
                                        <option value="Hearing_completed_judgement_reserved">Hearing completed judgement reserved</option>
                                        <option value="Hearing_completed_judgement_pronounced_offence_acquitted">Hearing completed judgement pronounced offence acquitted</option>
                                        <option value="Hearing_completed_judgement_pronounced_offence_convicted">Hearing completed judgement pronounced offence convicted</option>
                                    </select>
                            </div>  
                        </div>
                    </div>
                    <div class="row mt-4">
                    <h5>Uploads</h5>
                    <div class="row">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Post Mortem Report</th>
                                <th>Report from Electrical Inspector</th>
                                <th>Laboratory Report/Other Report</th>
                                <th>Judgement of the Court</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="file" class="form-control" id="post_mortem_report" name="post_mortem_report" accept=".pdf,.doc,.docx">
                                </td>
                                <td>
                                    <input type="file" class="form-control" id="electrical_inspector_report" name="electrical_inspector_report" accept=".pdf,.doc,.docx">
                                </td>
                                <td>
                                    <input type="file" class="form-control" id="laboratory_report" name="laboratory_report" accept=".pdf,.doc,.docx">
                                </td>
                                <td>
                                    <input type="file" class="form-control" id="court_judgement" name="court_judgement" accept=".pdf,.doc,.docx">
                                </td>
                            </tr>
                        </tbody>
                    </table>
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

    document.getElementById('additional_pr_option').addEventListener('change', function() {
        const additionalPrContainer = document.getElementById('additional-pr-container');
        if (this.value === 'Yes') {
            additionalPrContainer.style.display = 'block'; // Show the additional PR table
        } else {
            additionalPrContainer.style.display = 'none'; // Hide the additional PR table
            // Optionally clear the existing inputs when hidden
            const inputs = additionalPrContainer.querySelectorAll('input');
            inputs.forEach(input => input.value = ''); // Clear all inputs
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
                <td><input type="text" name="arrested_accused[${index}][accused_name]" class="form-control"></td>
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
                <td><input type="text" name="released_accused[${index}][accused_name]" class="form-control"></td>
                <td><input type="date" name="released_accused[${index}][bail_date]" class="form-control" max="{{ date('Y-m-d') }}" required></td>
                <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-released-accused" style="cursor: pointer; width: 24px;"></td>
            </tr>`;
        $('#released-accused-table tbody').append(newRow);
        updateIndices4();
    });
    $('#add-row5').click(function() {
        var index = $('#nbw-accused-table tbody tr').length;
        var newRow = `
            <tr>
                <td><input type="text" name="nbw_accused[${index}][accused_name]" class="form-control"></td>
                <td><input type="text" name="nbw_accused[${index}][nbw_status]" class="form-control"></td>
                <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-nbw-accused" style="cursor: pointer; width: 24px;"></td>
            </tr>`;
        $('#nbw-accused-table tbody').append(newRow);
        updateIndices4();
    });
    $('#add-pr-row').click(function() {
        var index = $('#additional-pr-table tbody tr').length;
        var newRow = `
            <tr>
                <td><input type="text" name="additional_pr[${index}][number]" class="form-control"></td>
                <td><input type="date" name="additional_pr[${index}][date]" class="form-control" max="{{ date('Y-m-d') }}"></td>
                 <td><input type="text" name="additional_pr[${index}][status]" class="form-control"></td>
                <td> <img src="{{ asset('assets/images/users/delete.png') }}" alt="Delete" class="delete-pr" style="cursor: pointer; width: 24px;"></td>
            </tr>`;
        $('#additional-pr-table tbody').append(newRow);
        updateIndices6();
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
    $(document).on('click', '.delete-pr', function() {
        $(this).closest('tr').remove();
        updateIndices6();
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
    function updateIndices6(){
        $('#additional-pr-table tbody tr').each(function(index) {
            $(this).find('input').each(function() {
                var name = $(this).attr('name');
                var newName = name.replace(/\d+/, index);
                $(this).attr('name', newName);
            });
        });
    }
     document.getElementById('case_present_status').addEventListener('change', function() {
        const courtJudgementContainer = document.getElementById('court-judgement-container');
        const courtJudgementInput = document.getElementById('court_judgement');
        const selectedStatus = this.value;

        // Check if the selected status is one of the last three options
        if (selectedStatus === 'Hearing_completed_judgement_reserved' ||
            selectedStatus === 'Hearing_completed_judgement_pronounced_offence_acquitted' ||
            selectedStatus === 'Hearing_completed_judgement_pronounced_offence_convicted') {
                
            courtJudgementInput.setAttribute('required', 'required');  // Make it required
        } else {
            courtJudgementInput.removeAttribute('required');  // Remove required attribute
            courtJudgementInput.value = '';  // Clear file input if hidden
        }
    });
    document.getElementById('detected_absconded_accused_option').addEventListener('change', function() {
        const abscondedAccusedContainer = document.getElementById('absconded-accused-count-container');
        const detectedAccusedContainer = document.getElementById('detected-absconded-accused-container');
        const abscondedAccusedDropdown = document.getElementById('no_of_detected_absconded_accused');  // Added this line to reference the dropdown

        if (this.value === 'Yes') {
            abscondedAccusedContainer.style.display = 'block';
            detectedAccusedContainer.classList.replace('col-md-12', 'col-md-6');
            abscondedAccusedDropdown.value = '';  // Reset dropdown value when 'Yes' is selected
        } else {
            abscondedAccusedContainer.style.display = 'none';
            detectedAccusedContainer.classList.replace('col-md-6', 'col-md-12');
            abscondedAccusedDropdown.value = '';  // Reset dropdown value when 'No' is selected
            resetTable(); // Reset table when 'No' is selected
        }
    });
    document.getElementById('no_of_detected_absconded_accused').addEventListener('change', function() {
        const tableContainer = document.getElementById('absconded-accused-table-container');
        const tableBody = document.getElementById('absconded-accused-table-body');
        const numAccused = parseInt(this.value);

        // Show the table only if a valid number is selected
        if (numAccused > 0) {
            tableContainer.style.display = 'block';
            generateTableRows(numAccused, tableBody);
        } else {
            tableContainer.style.display = 'none';
        }
    });

    function generateTableRows(count, tableBody) {
        // Clear existing rows
        tableBody.innerHTML = '';

        // Create rows based on the selected number of accused
        for (let index = 0; index < count; index++) {
            const row = document.createElement('tr');
            const cell = document.createElement('td');
            const input = document.createElement('input');
            
            input.type = 'text';
            input.name = `absconded_accused[${index}][accused_name]`;
            input.classList.add('form-control');
            input.placeholder = 'Enter Accused Name';

            cell.appendChild(input);
            row.appendChild(cell);
            tableBody.appendChild(row);
        }
    }

    function resetTable() {
        document.getElementById('absconded-accused-table-body').innerHTML = '';
        document.getElementById('absconded-accused-table-container').style.display = 'none';
    }
    const undetectedAccusedOption = document.getElementById('undetected_absconded_accused_option');
    const unabscondedAccusedContainer = document.getElementById('undetected_absconded-accused-count-container');
    const undetectedAccusedContainer = document.getElementById('undetected-absconded-accused-container');
    const unabscondedAccusedDropdown = document.getElementById('no_of_undetected_absconded_accused');

    // Function to handle the dropdown visibility based on the option selected
    function updateAbscondedAccusedDisplay(){
        if (undetectedAccusedOption.value === 'Yes') {
            unabscondedAccusedContainer.style.display = 'block';
            undetectedAccusedContainer.classList.replace('col-md-12', 'col-md-6');
            unabscondedAccusedDropdown.value = '';  // Reset dropdown value when 'Yes' is selected
        } else {
            unabscondedAccusedContainer.style.display = 'none';
            undetectedAccusedContainer.classList.replace('col-md-6', 'col-md-12');
            unabscondedAccusedDropdown.value = '';  // Reset dropdown value when 'No' is selected
        }
    }

    // Check the initial state when the page loads
    updateAbscondedAccusedDisplay();

    // Listen for changes in the dropdown
    undetectedAccusedOption.addEventListener('change',updateAbscondedAccusedDisplay);
        // Pre-populate division and range if designation is 4, 5, or 6
        const selectedDivision = '{{ $selectedDivision }}';
        const selectedCircle = '{{ $selectedCircle }}';
        
        // If a division is selected, trigger change to populate the range
        if (selectedDivision) {
            $('#division').val(selectedDivision).trigger('change');
        }

        // If a circle is selected and designation allows dynamic changes
        if (selectedCircle && !{{ in_array($designationId, [4, 5, 6]) ? 'true' : 'false' }}) {
            $('#circle').val(selectedCircle).trigger('change');
        }
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
        // Handle division change event
        $('#division').change(function() {
            const divisionId = $(this).val();
            $('#range').prop('disabled', !divisionId);
            $('#range').empty().append('<option value="">Select Range</option>');
            $('#section').prop('disabled', true).empty().append('<option value="">Select Section</option>');
            $('#beat').prop('disabled', true).empty().append('<option value="">Select Beat</option>');

            if (divisionId) {
                $.getJSON(`divisions/${divisionId}/ranges`, function(data) {
                    $('#range').append(data.map(range => `<option value="${range.id}">${range.name_e}</option>`));
                });
            }
        });

        // Handle range change event
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

        // Handle section change event
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

        // Trigger change on load to populate range if division is selected
        $('#division').trigger('change');
    // $('#species_name').select2(
    //     // placeholder: 'Select Species',
    //     // allowClear: true,
    //     // width: '100%',
    //     // minimumInputLength: 2, // Start searching after 2 characters
    //     // // Optional: Customize no results message
    //     // language: {
    //     //     noResults: function() {
    //     //         return "No species found.";
    //     //     }
    //     // }
    // );
    $('#schedule_type').change(function() {
        const scheduleType = $(this).val();

        // Reset species_schedule and species_name on schedule_type change
        $('#species_schedule').empty().append('<option value="">Select Schedule</option>');
        $('#species_name').empty().append('<option value="">Select Species</option>');

        // Populate species_schedule dropdown based on schedule_type
        if (scheduleType === 'new') {
            $('#species_schedule').append('<option value="I">I</option>');
            $('#species_schedule').append('<option value="II">II</option>');
            $('#species_schedule').append('<option value="III">III</option>');
            $('#species_schedule').append('<option value="IV">IV</option>');
        } else if (scheduleType === 'old') {
            $('#species_schedule').append('<option value="I">I</option>');
            $('#species_schedule').append('<option value="II">II</option>');
            $('#species_schedule').append('<option value="III">III</option>');
            $('#species_schedule').append('<option value="IV">IV</option>');
            $('#species_schedule').append('<option value="V">V</option>');
            $('#species_schedule').append('<option value="VI">VI</option>');
        }
    });

    $('#species_schedule').change(function() {
        const scheduleType = $('#schedule_type').val();
        const schedule = $(this).val();

        // Reset species_name dropdown
        $('#species_name').empty().append('<option value="">Select Species</option>');

        // Make API call only if both scheduleType and schedule are selected
        if (scheduleType && schedule) {
            $.getJSON(`/species/${scheduleType}/${schedule}`, function(data) {
                $('#species_name').append(data.map(species => `<option value="${species.id}">${species.species_name}</option>`));
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
