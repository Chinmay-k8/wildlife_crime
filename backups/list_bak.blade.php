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
                        <tbody>
                            @foreach ($formData as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->id }}</td>
                                    <td class="circle-name" data-id="{{ $data->circle }}">{{ $data->circle }}</td>
                                    <td class="division-name" data-id="{{ $data->division }}">{{ $data->division }}</td>
                                    <td class="range-name" data-id="{{ $data->range }}">{{ $data->range }}</td>
                                    <td class="section-name" data-id="{{ $data->section }}">{{ $data->section }}</td>
                                    <td class="beat-name" data-id="{{ $data->beat }}">{{ $data->beat }}</td>
                                    <td>{{ $data->case_type }}</td>
                                    <td>{{ $data->case_no }}</td>
                                    <td class="place-name" data-id="{{ $data->detection_place }}">{{ $data->detection_place }}</td>
                                    <td>{{ $data->case_date }}</td>
                                    <td>{{ $data->detection_date }}</td>
                                    <td>{{ $data->latitude }}</td>
                                    <td>{{ $data->longitude }}</td>
                                    <td>{{ $data->detection_agency }}</td>
                                    <td>{{ $data->investigating_agency }}</td>
                                    <td>{{ $data->species_name }}</td>
                                    <td>{{ $data->species_age }}</td>
                                    <td>{{ $data->species_sex }}</td>
                                    <td>{{ $data->old_schedule_species }}</td>
                                    <td>{{ $data->new_schedule_species }}</td>
                                    <td>{{ $data->property_recovered_type }}</td>
                                    <td>{{ $data->brief_fact }}</td>

                                    <!-- Accused Details -->
                                    <td>
                                        @if($data->accused->isNotEmpty())
                                            <ul>
                                                @foreach ($data->accused as $accused)
                                                    <li>
                                                        <strong>Name:</strong> {{ $accused->name }} <br>
                                                        <strong>Alias:</strong> {{ $accused->alias }} <br>
                                                        <strong>Father's Name:</strong> {{ $accused->father_name }} <br>
                                                        <strong>Address:</strong> {{ $accused->address }} <br>
                                                        <strong>Mobile:</strong> {{ $accused->mobile }} <br>
                                                        <strong>IMEI:</strong> {{ $accused->imei }}
                                                    </li>
                                                    <hr>
                                                @endforeach
                                            </ul>
                                        @else
                                            No Accused Details
                                        @endif
                                    </td>

                                    <!-- Arrested Accused Details -->
                                    <td>
                                        @if($data->arrestedAccused->isNotEmpty())
                                            <ul>
                                                @foreach ($data->arrestedAccused as $arrested)
                                                    <li>
                                                        <strong>Name:</strong> {{ $arrested->name }} <br>
                                                        <strong>Alias:</strong> {{ $arrested->alias }} <br>
                                                        <strong>Father's Name:</strong> {{ $arrested->fathers_name }} <br>
                                                        <strong>Address:</strong> {{ $arrested->address }} <br>
                                                        <strong>Mobile:</strong> {{ $arrested->mobile_number }} <br>
                                                        <strong>IMEI:</strong> {{ $arrested->imei_number }}
                                                    </li>
                                                    <hr>
                                                @endforeach
                                            </ul>
                                        @else
                                            No Arrested Accused Details
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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
        // If the element has already been populated, do not fetch again
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

    $('tr').each(function() {
        var $row = $(this);
        var circleId = $row.find('.circle-name').data('id');
        var divisionId = $row.find('.division-name').data('id');
        var rangeId = $row.find('.range-name').data('id');
        var sectionId = $row.find('.section-name').data('id');
        var beatId = $row.find('.beat-name').data('id');
        var forestblockId = $row.find('.place-name').data('id');

        // Fetch and populate names only if not already populated
        if (circleId) fetchAndPopulateName('/circle-name', circleId, $row.find('.circle-name'));
        if (divisionId) fetchAndPopulateName('/division-name', divisionId, $row.find('.division-name'));
        if (rangeId) fetchAndPopulateName('/range-name', rangeId, $row.find('.range-name'));
        if (sectionId) fetchAndPopulateName('/section-name', sectionId, $row.find('.section-name'));
        if (beatId) fetchAndPopulateName('/beat-name', beatId, $row.find('.beat-name'));
        if (forestblockId) fetchAndPopulateName('/forestblock-name', forestblockId, $row.find('.place-name'));
    });
});
</script>

@endsection
