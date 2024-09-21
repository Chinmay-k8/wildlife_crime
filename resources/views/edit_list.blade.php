@extends('layouts.edit-modal')
@section('edit-details')
    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">    
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="circle">Circle</label>
                                    <select id="circle-dropdown" name="circle" class="form-control" style="display: none;">
                                        <option value="">Select Circle</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="division">Division</label>
                                    <select id="division-dropdown" name="division" class="form-control" style="display: none;">
                                        <option value="">Select Division</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="range">Range</label>
                                    <select id="range-dropdown" name="range" class="form-control" style="display: none;">
                                        <option value="">Select Range</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <select id="section-dropdown" name="section" class="form-control" style="display: none;">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="beat">Beat</label>
                                    <select id="beat-dropdown" name="beat" class="form-control" style="display: none;">
                                        <option value="">Select Beat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="case_type">Case Type</label>
                                    <select id="case_type-dropdown" name="case_type" class="form-control" required>
                                        <option value="">Select Case Type</option>
                                        <option value="UD">UD</option>
                                        <option value="OR">OR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="case_no" id="case_no_label">Case Number</label>
                                    <input type="text" id="case_no" name="case_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="penal_code" id="penal_code">Penal Code</label>
                                    <input type="text" id="penal_code" name="penal_code" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="detection_place_type">Place of Detection Type</label>
                                    <select id="detection_place_type-dropdown" name="detection_place_type" class="form-control">
                                        <option value="forest">Forest Block</option>
                                        <option value="revenue">Revenue Forest</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>   
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="detection_place">Place of Detection</label>
                                        <input type="text" id="detection_place" name="detection_place" class="form-control" >
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="case_date">Case Date</label>
                                    <input type="date" id="case_date" name="case_date" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="detection_date">Detection Date</label>
                                    <input type="date" id="detection_date" name="detection_date" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5>Case Detection GPS Location</h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="detection_agency">Case Detection Agency</label>
                                    <select id="detection_agency-dropdown" name="detection_agency" class="form-control" required>
                                        <option value="">Select Agency</option>
                                        <option value="Forest Department">Forest Department</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="investigating_agency">Case Investigating Agency</label>
                                    <select id="investigating_agency-dropdown" name="investigating_agency" class="form-control" required>
                                        <option value="">Select Agency</option>
                                        <option value="Forest Department">Forest Department</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div >
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="species_name">Name Of the Species</label>
                                        <input type="text" id="species_name" name="species_name" class="form-control" >
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="species_age">Age of the Species</label>
                                        <input type="text" id="species_age" name="species_age" class="form-control" >
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="species_sex">Sex Of the Species</label>
                                        <select id="species_sex-dropdown" name="species_sex" class="form-control" required>
                                            <option value="">Select Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="old_wlpa">Old Schedule Of Species under WLPA</label>
                                    <input type="text" id="old_wlpa" name="old_wlpa" class="form-control" >
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="property_recovered_type">Property Recovered Type</label>
                                    <select id="property_recovered_type-dropdown" name="property_recovered_type" class="form-control" >
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
                        <div class="row">
                            <div class="col md-12">
                                <label for="briefFact" class="col-sm-2 col-form-label">Property recovered details:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="property_recovered_details" name="property_recovered_details" rows="2" style="resize: none;" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="officer_name">Name of the Incharge Officer</label>
                                        <input type="text" id="officer_name" name="officer_name" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="officer_number">Mobile Number of Incharge Officer</label>
                                        <input type="text" id="officer_number" name="officer_number" class="form-control" >
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col md-12">
                                <label for="brief_fact" class="col-sm-2 col-form-label">Brief Fact / Cause of death:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="brief_fact" name="brief_fact" rows="6" style="resize: none;" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                        <div class="row">
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
                        <div class="row ">
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="court_forward_date">Date of forwarding to court</label>
                                    <input type="date" id="court_forward_date" name="court_forward_date" class="form-control" max="{{ date('Y-m-d') }}" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="court_name">Court name</label>
                                    <input type="text" id="court_name" name="court_name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="court_case_number">Case (2bcc) number</label>
                                    <input type="text" id="court_case_number" name="court_case_number" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                        <div class="row">
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
                                            <td><input type="date" id="release_date" name="released_accused[0][date]" class="form-control" ></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <h5>Submission of final PR</h5>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="officer_name">Final PR number</label>
                                    <input type="text" id="pr_number" name="pr_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pr_date">Date</label>
                                    <input type="date" id="pr_date" name="pr_date" class="form-control" max="{{ date('Y-m-d') }}" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pr_status">Status</label>
                                    <input type="text" id="pr_status" name="pr_status" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-6">
                                <div class="form-group">
                                    <label for="action_against_staff">Action taken against any staff(Departmental Staff)</label>
                                    <select id="action_against_staff-dropdown" name="action_against_staff" class="form-control" required>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        <option value="Under trial">Under trial</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="col md-6">
                                <div class="form-group">
                                    <label for="case_present_status">Present Status of the case</label>
                                    <input type="text" id="case_present_status" name="case_present_status" class="form-control" >
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <h5>Uploads</h5>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="post_mortem_report">Post Mortem Report</label>
                                    <div id="post_mortem_report_container">
                                        <!-- The file name will be dynamically inserted here -->
                                    </div>
                                    <input type="file" class="form-control" id="post_mortem_report" name="post_mortem_report" accept=".pdf,.doc,.docx">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="electrical_inspector_report">Report from Electrical Inspector</label>
                                    <div id="electrical_inspector_report_container">
                                        <!-- The file name will be dynamically inserted here -->
                                    </div>
                                    <input type="file" class="form-control" id="electrical_inspector_report" name="electrical_inspector_report" accept=".pdf,.doc,.docx">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lab_report">Laboratory Report/Other Report</label>
                                    <div id="lab_report_container">
                                        <!-- The file name will be dynamically inserted here -->
                                    </div>
                                    <input type="file" class="form-control" id="laboratory_report" name="laboratory_report" accept=".pdf,.doc,.docx">
                                </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="court_judgement">Judgement of the Court</label>
                                <div id="court_judgement_container">
                                    <!-- The file name will be dynamically inserted here -->
                                </div>
                                <input type="file" class="form-control" id="court_judgement" name="court_judgement" accept=".pdf,.doc,.docx">
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="saveChangesButton" class="btn btn-primary">Save Changes</button>
                            </div>                               
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
