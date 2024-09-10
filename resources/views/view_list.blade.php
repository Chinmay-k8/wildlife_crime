<!-- resources/views/forms/readonly-form.blade.php -->
@extends('layouts.modal')

@section('modal-title', 'View Details')

@section('modal-body')
<div class="row">
    <div class="col-6">
        <label for="caseNumber" class="form-label">Case Number</label>
        <input type="text" id="caseNumber" class="form-control" readonly>
    </div>
    <div class="col-6">
        <label for="range" class="form-label">Range</label>
        <input type="text" id="range" class="form-control" readonly>
    </div>
    <div class="col-6">
        <label for="section" class="form-label">Section</label>
        <input type="text" id="section" class="form-control" readonly>
    </div>
    <div class="col-6">
        <label for="beat" class="form-label">Beat</label>
        <input type="text" id="beat" class="form-control" readonly>
    </div>
    <!-- Add additional fields here as needed -->
</div>
@endsection

@section('modal-footer')
    <!-- You can leave this empty or customize it based on your needs -->
@endsection
