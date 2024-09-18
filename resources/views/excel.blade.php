@extends('layouts.dashboard')
@section('excel-content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mt-2">
    <div class="col-12">
        <div class="card" style="border-color: rgb(0, 80, 64);">
            <div class="card-header" style="background-color: rgb(0, 80, 64); color: white;">
                <h5 style="color:white">Upload Excel File</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="circle">Circle</label>
                            <select id="circle" name="circle" class="form-control" required>
                                <option value="">Select Circle</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="divison">Division</label>
                            <select id="division" name="division" class="form-control" required>
                                <option value="">Select Division </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="excel_file">Upload Excel File</label>
                            <input type="file" id="excel_file" name="excel_file" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="demo_excel">Please Download the Demo Excel Format</label>
                                <div id="demo_excel_container">
                                    <!-- The file name will be dynamically inserted here -->
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="text-right mt-4">
                        <button type="submit" class="btn" style="background-color: rgb(0, 80, 64); color: white;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Fetch circles on page load
    $.getJSON('circles', function(data) {
        $('#circle').append(data.map(circle => `<option value="${circle.id}">${circle.name_e}</option>`));
    });
    $('#circle').change(function() {
        const circleId = $(this).val();
        $('#division').prop('disabled', !circleId);
        $('#division').empty().append('<option value="">Select Division</option>');
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
        // // $('#detection_place').empty().append('<option value="">Select Forest Block</option>');
        // $('#range').prop('disabled', !divisionId);
        // $('#range').empty().append('<option value="">Select Range</option>');
        // $('#section').prop('disabled', true).empty().append('<option value="">Select Section</option>');
        // $('#beat').prop('disabled', true).empty().append('<option value="">Select Beat</option>');

        if (divisionId) {
            $.getJSON(`divisions/${divisionId}/ranges`, function(data) {
                $('#range').append(data.map(range => `<option value="${range.id}">${range.name_e}</option>`));
            });
            // $.getJSON(`divisions/${divisionId}/forest_blocks`, function(data) {
            //     $('#detection_place').append(data.map(forest_block => `<option value="${forest_block.id}">${forest_block.name_e}</option>`));
            // });
        }
    });
    const baseUrl = '{{ url("download_excel") }}';
    $('#demo_excel_container').html(`
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}', '_blank')">Download</button>
    `);

</script>

@endsection
