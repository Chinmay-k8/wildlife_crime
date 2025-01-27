@extends('layouts.approval_modal')
@section('approval-body')
@php
    $designationId = auth()->user()->designation_id;
    $prefix = $designationId == 4 ? 'dfo' : ($designationId == 5 ? 'acf' : '');
@endphp

@if($prefix)
    <form  method="POST" action="{{ route('submit-approval') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="form_id" id="form_id" value="">
        <div class="form-group">
            <label for="{{ $prefix }}_approval_status">Approval Status</label>
            <select name="{{ $prefix }}_approval_status" id="{{ $prefix }}_approval_status" class="form-control">
                <option value="approve">Approve</option>
                <option value="reject">Reject</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="{{ $prefix }}_remarks">Remarks</label>
            <input type="text" name="{{ $prefix }}_remarks" id="{{ $prefix }}_remarks" class="form-control">
        </div>
        <div class="form-group">
            <label for="{{ $prefix }}_digital_signature">Upload Digital Signature</label>
            <input type="file" name="{{ $prefix }}_digital_signature" id="{{ $prefix }}_digital_signature" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
@endif
@endsection
