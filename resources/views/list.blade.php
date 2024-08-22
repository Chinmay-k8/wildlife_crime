@extends('layouts.dashboard')

@section('user-info')
<h1>Complain 1</h1>
@endsection

@section('form-content')
<div class="container mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="overflow-x: auto; overflow-y: auto; max-height: 500px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Case-id</th>
                                <th>Circle</th>
                                <th>Division</th>
                                <th>Range</th>
                                <th>Section</th>
                                <th>Beat</th>
                                <th>Case Type</th>
                                <th>Case Number</th>
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
                                <th>Arrested Accused Details</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-body">
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
    function fetchAndPopulateName(url, id, $element) {
        if ($element.text() !== id.toString()) return;

        $.ajax({
            url: url + '/' + id,
            method: 'GET',
            success: function(response) {
                $element.text(response.name_e || 'Not Found');
            },
            error: function() {
                $element.text('Error fetching data');
            }
        });
    }

    function populateTable(data) {
        var $tableBody = $('#data-table-body');
        $tableBody.empty();

        data.forEach(function(item, index) {
            var $row = $('<tr>');
            $row.append('<td>' + (index + 1) + '</td>');
            $row.append('<td>' + item.id + '</td>');
            $row.append('<td class="circle-name" data-id="' + item.circle + '">' + item.circle + '</td>');
            $row.append('<td class="division-name" data-id="' + item.division + '">' + item.division + '</td>');
            $row.append('<td class="range-name" data-id="' + item.range + '">' + item.range + '</td>');
            $row.append('<td class="section-name" data-id="' + item.section + '">' + item.section + '</td>');
            $row.append('<td class="beat-name" data-id="' + item.beat + '">' + item.beat + '</td>');
            $row.append('<td>' + item.case_type + '</td>');
            $row.append('<td>' + item.case_no + '</td>');
            $row.append('<td class="place-name" data-id="' + item.detection_place + '">' + item.detection_place + '</td>');
            $row.append('<td>' + item.case_date + '</td>');
            $row.append('<td>' + item.detection_date + '</td>');
            $row.append('<td>' + item.latitude + '</td>');
            $row.append('<td>' + item.longitude + '</td>');
            $row.append('<td>' + item.detection_agency + '</td>');
            $row.append('<td>' + item.investigating_agency + '</td>');
            $row.append('<td>' + item.species_name + '</td>');
            $row.append('<td>' + item.species_age + '</td>');
            $row.append('<td>' + item.species_sex + '</td>');
            $row.append('<td>' + item.old_schedule_species + '</td>');
            $row.append('<td>' + item.new_schedule_species + '</td>');
            $row.append('<td>' + item.property_recovered_type + '</td>');
            $row.append('<td>' + item.brief_fact + '</td>');

            var accusedDetails = item.accused.length ? '<ul>' : 'No Accused Details';
            item.accused.forEach(function(accused) {
                accusedDetails += '<li>' +
                                  '<strong>Name:</strong> ' + accused.name + '<br>' +
                                  '<strong>Alias:</strong> ' + accused.alias + '<br>' +
                                  '<strong>Father\'s Name:</strong> ' + accused.father_name + '<br>' +
                                  '<strong>Address:</strong> ' + accused.address + '<br>' +
                                  '<strong>Mobile:</strong> ' + accused.mobile + '<br>' +
                                  '<strong>IMEI:</strong> ' + accused.imei +
                                  '</li><hr>';
            });
            if (item.accused.length) accusedDetails += '</ul>';
            $row.append('<td>' + accusedDetails + '</td>');

            var arrestedDetails = item.arrested_accused.length ? '<ul>' : 'No Arrested Accused Details';
            item.arrested_accused.forEach(function(arrested) {
                arrestedDetails += '<li>' +
                                   '<strong>Name:</strong> ' + arrested.name + '<br>' +
                                   '<strong>Alias:</strong> ' + arrested.alias + '<br>' +
                                   '<strong>Father\'s Name:</strong> ' + arrested.fathers_name + '<br>' +
                                   '<strong>Address:</strong> ' + arrested.address + '<br>' +
                                   '<strong>Mobile:</strong> ' + arrested.mobile + '<br>' +
                                   '<strong>IMEI:</strong> ' + arrested.imei +
                                   '</li><hr>';
            });
            if (item.arrested_accused.length) arrestedDetails += '</ul>';
            $row.append('<td>' + arrestedDetails + '</td>');

            $tableBody.append($row);
        });

        // Populate the names with the existing AJAX logic
        $('tr').each(function() {
            var $row = $(this);
            var circleId = $row.find('.circle-name').data('id');
            var divisionId = $row.find('.division-name').data('id');
            var rangeId = $row.find('.range-name').data('id');
            var sectionId = $row.find('.section-name').data('id');
            var beatId = $row.find('.beat-name').data('id');
            var forestblockId = $row.find('.place-name').data('id');

            if (circleId) fetchAndPopulateName('/circle-name', circleId, $row.find('.circle-name'));
            if (divisionId) fetchAndPopulateName('/division-name', divisionId, $row.find('.division-name'));
            if (rangeId) fetchAndPopulateName('/range-name', rangeId, $row.find('.range-name'));
            if (sectionId) fetchAndPopulateName('/section-name', sectionId, $row.find('.section-name'));
            if (beatId) fetchAndPopulateName('/beat-name', beatId, $row.find('.beat-name'));
            if (forestblockId) fetchAndPopulateName('/forestblock-name', forestblockId, $row.find('.place-name'));
        });
    }

    // Fetch data via AJAX and populate the table
    $.ajax({
        url: '{{ route('list.data') }}',
        method: 'GET',
        success: function(response) {
            populateTable(response);
        },
        error: function() {
            alert('Error fetching data.');
        }
    });
});
</script>

@endsection
