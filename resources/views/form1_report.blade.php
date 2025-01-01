@extends('layouts.dashboard')
@section('form1')
<div class="mt-2">
    <div class="col-12">
        <div class="card" style="border-color: rgb(0, 80, 64);">
            <div class="card-header" style="background-color: rgb(0, 80, 64); color: white;">
                <h5 style="color:white">COMPASSIONATE PAYMENT DUE TO WILD ANIMAL DEPREDATION    </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('form1.report') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4">
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

                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <label for="year">Schedule Of Species under WLPA</label>
                            <select id="year" name="year" class="form-control">
                                <?php
                                $currentYear = date('Y'); // Get the current year
                                for ($year = 2016; $year <= $currentYear; $year++) {
                                    echo "<option value=\"$year\">$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                        

                    </div>
                    <div class="text-right mt-4">
                        <button type="submit" class="btn" style="background-color: rgb(0, 80, 64); color: white;">Search</button>
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


</script>
@endsection