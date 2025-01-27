<!-- resources/views/layouts/edit-modal.blade.php -->
<div id="approval-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="approvalModalLabel">Approval Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @yield('approval-body')
            </div>
        </div>
    </div>
</div>
