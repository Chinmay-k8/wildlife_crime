@extends('layouts.dashboard')
@section('form-content')

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

<div class="container mt-5">
    <div class="col-12">
        <div class="card" style="border-color: rgb(0, 80, 64);">
            <div class="card-header" style="background-color: rgb(0, 80, 64); color: white;">
                <h5 style="color:white">Upload Excel File</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="circle">Circle</label>
                            <select id="circle" name="circle" class="form-control" required>
                                <option value="">Select Circle</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="excel_file">Upload Excel File</label>
                            <input type="file" id="excel_file" name="excel_file" class="form-control" required>
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
</script>

@endsection
