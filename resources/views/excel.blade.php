@extends('layouts.dashboard')
@section('form-content')
 <div class="container mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="circle">Circle</label>
                                    <select id="circle" name="circle" class="form-control">
                                        <option value="">Select Circle</option>
                                    </select>
                                </div>
                            </div>
                            <label for="excel_file">Upload Excel File</label>
                            <input type="file" id="excel_file" name="excel_file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
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