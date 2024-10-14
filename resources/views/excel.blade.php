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
        <!-- Hidden input might override dynamic selection, so it's removed -->
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="division">Division</label>
        <select id="division" name="division" class="form-control" {{ in_array($designationId, [4, 5, 6]) ? 'disabled' : '' }}>
            <option value="">Select Division</option>
            @foreach($divisions as $division)
                <option value="{{ $division->id }}" {{ $division->id == $selectedarea ? 'selected' : '' }}>
                    {{ $division->name_e }}
                </option>
            @endforeach
        </select>
    </div>
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
    const selectedDivision = '{{ $selectedarea }}';
const selectedCircle = '{{ $selectedCircle }}';

// If a division is selected, trigger change to populate range
if (selectedDivision) {
    $('#division').val(selectedDivision).trigger('change');
}

// If a circle is selected and designation allows dynamic changes
if (selectedCircle && !{{ in_array($designationId, [4, 5, 6]) ? 'true' : 'false' }}) {
    $('#circle').val(selectedCircle).trigger('change');
}

$('#circle').change(function() {
    const circleId = $(this).val();
    
    // Enable division dropdown
    $('#division').prop('disabled', !circleId);
    $('#division').empty().append('<option value="">Select Division</option>');

    // Fetch divisions based on selected circle
    if (circleId) {
        $.getJSON(`/circles/${circleId}/divisions`, function(data) {
            $('#division').append(data.map(division => `<option value="${division.id}">${division.name_e}</option>`));
        });
    }
});

    const baseUrl = '{{ url("download_excel") }}';
    $('#demo_excel_container').html(`
                            <button class="btn btn-primary btn-sm" onclick="window.open('${baseUrl}', '_blank')">Download</button>
    `);

</script>

@endsection