@extends('layouts.dashboard')
@include('view_list')

@section('user-info')
<h1>Complain 1</h1>
@endsection

@section('form-content')
<style>
.table thead th {
    background-color: rgb(0, 80, 64); 
    color: white; 
    text-align: center; 
    vertical-align: middle; 
}
td {
    text-align: center; 
    vertical-align: middle; 
}
.action-options {
    display: none;
    background-color: white;
    border: 1px solid #ccc;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 10px;
    width: 120px;
}
.action-options a {
    color: #333;
    text-decoration: none;
    display: block;
    padding: 8px;
    transition: background-color 0.2s;
}
.action-options a:hover {
    background-color: #f1f1f1;
}
</style>

<div class="container mt-5">
    <div class="col-30">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Case Number</th>
                                <th>Range</th>
                                <th>Section</th>
                                <th>Beat</th>
                                <th>Approval Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-body" style="text-align: center;">
                            <!-- Data populated via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Full-width modal for showing detailed data -->
<div class="modal fade" id="full-width-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Case Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Form inside modal -->
                <form>
                    <div class="row">
                        <div class="col-6">
                            <label for="caseNumber" class="form-label">Case Number</label>
                            <input type="text" id="caseNumber" class="form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="range" class="form-label">Range</label>
                            <input type="text" id="range" class="form-control" readonly>
                        </div>
                        <!-- Add other fields as needed -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var fetchedData = [];  // Store the fetched data here   
    function populateTable(data) {
        fetchedData = data;
        console.log(fetchedData);

        var $tableBody = $('#data-table-body');
        $tableBody.empty();

        data.forEach(function(item, index) {
            var $row = $('<tr>');
            $row.attr('data-id', item.id);  // Assign the ID to each row
            $row.append('<td>' + (index + 1) + '</td>');
            $row.append('<td>' + item.case_no + '</td>');
            $row.append('<td>' + (item.range ? item.range.name_e : item.range_id) + '</td>');
            $row.append('<td>' + (item.section ? item.section.name_e : item.section_id) + '</td>');
            $row.append('<td>' + (item.beat ? item.beat.name_e : item.beat_id) + '</td>');
            $row.append('<td>' + (item.approval_status ? item.approval_status : 'Pending') + '</td>');
            $row.append(`
                <td>
                    <div style="position: relative; display: inline-block;">
                        <img src="{{ asset('assets/images/users/setting.png') }}" alt="Actions" class="actions" style="cursor: pointer; width: 24px;">
                        <div class="action-options" style="display: none;">
                            <a href="#" class="view-details" data-id="${item.id}">View Details</a>
                            <a href="#" class="edit-details" data-id="${item.id}">Edit Details</a>
                        </div>
                    </div>
                </td>
            `);

            $tableBody.append($row);
        });
    }

    // Fetch data via AJAX and populate the table
    $.ajax({
        url: '{{ route('list.data') }}',
        method: 'GET',
        success: function(response) {
            console.log('Received Data:', response);
            populateTable(response);
        },
        error: function() {
            alert('Error fetching data.');
        }
    });

    $(document).on('click', '.actions', function () {
        $(this).siblings('.action-options').toggle(); // Toggle the visibility of the options div
    });

    // Hide the div if clicked outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.actions, .action-options').length) {
            $('.action-options').hide();
        }
    });

    // Handle View Details
    $(document).on('click', '.view-details', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        // Find the selected record from the fetched data
        var selectedItem = fetchedData.find(item => item.id === id);

        // Populate the modal with the selected item details
        if (selectedItem) {
            console.log(selectedItem);

            $('#caseNumber').val(selectedItem.case_no);
            $('#range').val(selectedItem.range ? selectedItem.range.name_e : '');
            $('#section').val(selectedItem.section ? selectedItem.section.name_e : '');
            $('#beat').val(selectedItem.beat ? selectedItem.beat.name_e : '');
            // Populate other modal fields here...

            // Show the modal
            $('#full-width-modal').modal('show');
        } else {
            alert('Error: Record not found.');
        }
    });
});
</script>
@endsection
