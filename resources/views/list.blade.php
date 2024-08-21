@extends('layouts.dashboard')
@section('user-info')
<h1>Complain 1</h1>
@endsection
@section('form-content')
<?php $serialNumber = 1; ?>

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
                                <th>Accused Name</th>
                                <th>Accused Alias</th>
                                <th>Father's Name</th>
                                <th>Address</th>
                                <th>Mobile Number</th>
                                <th>IMEI Number</th>
                                <th>Arrested Accused Name</th>
                                <th>Arrested Accused Alias</th>
                                <th>Father's Name</th>
                                <th>Address</th>
                                <th>Mobile Number</th>
                                <th>IMEI Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formData as $data)
                                @php
                                    $rowCount = max($data->accused->count(), $data->arrestedAccused->count(), 1);
                                @endphp

                                @for ($i = 0; $i < $rowCount; $i++)
                                    <tr>
                                        <td>{{ $serialNumber++ }}</td>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->circle }}</td>
                                        <td>{{ $data->division }}</td>
                                        <td>{{ $data->range }}</td>
                                        <td>{{ $data->section }}</td>
                                        <td>{{ $data->beat }}</td>
                                        <td>{{ $data->case_type }}</td>
                                        <td>{{ $data->case_number }}</td>
                                        <td>{{ $data->place_of_detection }}</td>
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
                                        <td>{{ $data->accused[$i]->name ?? '' }}</td>
                                        <td>{{ $data->accused[$i]->alias ?? '' }}</td>
                                        <td>{{ $data->accused[$i]->fathers_name ?? '' }}</td>
                                        <td>{{ $data->accused[$i]->address ?? '' }}</td>
                                        <td>{{ $data->accused[$i]->mobile_number ?? '' }}</td>
                                        <td>{{ $data->accused[$i]->imei_number ?? '' }}</td>

                                        <!-- Arrested Accused Details -->
                                        <td>{{ $data->arrestedAccused[$i]->name ?? '' }}</td>
                                        <td>{{ $data->arrestedAccused[$i]->alias ?? '' }}</td>
                                        <td>{{ $data->arrestedAccused[$i]->fathers_name ?? '' }}</td>
                                        <td>{{ $data->arrestedAccused[$i]->address ?? '' }}</td>
                                        <td>{{ $data->arrestedAccused[$i]->mobile_number ?? '' }}</td>
                                        <td>{{ $data->arrestedAccused[$i]->imei_number ?? '' }}</td>
                                    </tr>
                                @endfor
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>        
</div>

@endsection
