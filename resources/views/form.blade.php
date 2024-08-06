<!-- resources/views/form.blade.php -->
@extends('layouts.dashboard')

@section('form-content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Add Data Form</h1>
            <form>
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="circle">Circle</label>
                            <select id="circle" class="form-control">
                                <option value="">Select Circle</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="division">Division</label>
                            <select id="division" class="form-control" disabled>
                                <option value="">Select Division</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="range">Range</label>
                            <select id="range" class="form-control" disabled>
                                <option value="">Select Range</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="section">Section</label>
                            <select id="section" class="form-control" disabled>
                                <option value="">Select Section</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="beat">Beat</label>
                            <select id="beat" class="form-control" disabled>
                                <option value="">Select Beat</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





<script>
$(document).ready(function() {
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
});
</script>
@endsection
