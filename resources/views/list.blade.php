@extends('layouts.dashboard')

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
</style>
<div class="container mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" >
                    <table class="table table-bordered" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>Sl. No.</th> 
                                <th>Case Number</th>   
                                <!-- <th>Case-id</th> -->
                                <!-- <th>Circle</th>
                                <th>Division</th> -->
                                <th>Range</th>
                                <th>Section</th>
                                <th>Beat</th>
                                <th>Approval Status</th>
                                <!-- <th>Case Type</th>
                                <th>Place of Detection</th>
                                <th>Case Date</th>
                                <th>Detection Date</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Detection Agency</th>
                                <th>Investigating Agency</th>
                                <th>Name Of the Species</th>
                                <th>Age of the Species</th>
                                <th>Sex Of the Species</th>
                                <th>Old Schedule Of Species under WLPA</th>
                                <th>New Schedule Of Species under WLPA</th>
                                <th>Property Recovered Type</th>
                                <th>Brief Fact</th>
                                <th>Accused Details</th>
                                <th>Arrested Accused Details</th> -->
                            </tr>
                        </thead>
                        <tbody id="data-table-body" style="text-align: center;">
                            <!-- Data will be populated here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>        
</div>

<script>
$(document).ready(function() {
    function populateTable(data) {
        var $tableBody = $('#data-table-body');
        $tableBody.empty();

        data.forEach(function(item, index) {
            var $row = $('<tr>');
            $row.append('<td>' + (index + 1) + '</td>');
            // $row.append('<td>' + item.id + '</td>');
            // $row.append('<td>' + (item.circle.name_e || item.circle_id) + '</td>');
            // $row.append('<td>' + (item.division.name_e || item.division_id) + '</td>');
            $row.append('<td>' + item.case_no + '</td>');
            $row.append('<td>' + (item.range ? item.range.name_e : item.range_id) + '</td>');
            $row.append('<td>' + (item.section ? item.section.name_e : item.section_id) + '</td>');
            $row.append('<td>' + (item.beat ? item.beat.name_e : item.beat_id) + '</td>');
            $row.append('<td> </td>');
            // $row.append('<td>' + item.case_type + '</td>');
            // $row.append('<td>' + (item.forestblock.name_e || item.detection_place) + '</td>');
            // $row.append('<td>' + item.case_date + '</td>');
            // $row.append('<td>' + item.detection_date + '</td>');
            // $row.append('<td>' + item.latitude + '</td>');
            // $row.append('<td>' + item.longitude + '</td>');
            // $row.append('<td>' + item.detection_agency + '</td>');
            // $row.append('<td>' + item.investigating_agency + '</td>');
            // $row.append('<td>' + item.species_name + '</td>');
            // $row.append('<td>' + item.species_age + '</td>');
            // $row.append('<td>' + item.species_sex + '</td>');
            // $row.append('<td>' + item.old_schedule_species + '</td>');
            // $row.append('<td>' + item.new_schedule_species + '</td>');
            // $row.append('<td>' + item.property_recovered_type + '</td>');
            // $row.append('<td>' + item.brief_fact + '</td>');

            // var accusedDetails = item.accused.length ? '<ul>' : 'No Accused Details';
            // item.accused.forEach(function(accused) {
            //     accusedDetails += '<li>' +
            //                       '<strong>Name:</strong> ' + accused.name + '<br>' +
            //                       '<strong>Alias:</strong> ' + accused.alias + '<br>' +
            //                       '<strong>Father\'s Name:</strong> ' + accused.father_name + '<br>' +
            //                       '<strong>Address:</strong> ' + accused.address + '<br>' +
            //                       '<strong>Mobile:</strong> ' + accused.mobile + '<br>' +
            //                       '<strong>IMEI:</strong> ' + accused.imei +
            //                       '</li><hr>';
            // });
            // if (item.accused.length) accusedDetails += '</ul>';
            // $row.append('<td>' + accusedDetails + '</td>');

            // var arrestedDetails = item.arrested_accused.length ? '<ul>' : 'No Arrested Accused Details';
            // item.arrested_accused.forEach(function(arrested) {
            //     arrestedDetails += '<li>' +
            //                        '<strong>Name:</strong> ' + arrested.name + '<br>' +
            //                        '<strong>Alias:</strong> ' + arrested.alias + '<br>' +
            //                        '<strong>Father\'s Name:</strong> ' + arrested.fathers_name + '<br>' +
            //                        '<strong>Address:</strong> ' + arrested.address + '<br>' +
            //                        '<strong>Mobile:</strong> ' + arrested.mobile + '<br>' +
            //                        '<strong>IMEI:</strong> ' + arrested.imei +
            //                        '</li><hr>';
            // });
            // if (item.arrested_accused.length) arrestedDetails += '</ul>';
            // $row.append('<td>' + arrestedDetails + '</td>');

            $tableBody.append($row);
        });
    }

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
});
</script>


@endsection
