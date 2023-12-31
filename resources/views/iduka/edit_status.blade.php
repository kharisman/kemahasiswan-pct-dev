@extends('iduka/layouts.app')

@section('title', 'Edit status Project')

@section('contents')

<!-- Begin Page Content --><div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Project {{$project->name}}</h6>
            </div>
<div class="container-fluid">
    <!-- Content Row -->
    <form id="statusForm" action="{{ route('update_status', ['id' => $project->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Edit Status Project</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Aktif" {{ $project->status === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak" {{ $project->status === 'Tidak' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <button id="confirmButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusModal">Save Changes</button><p></p>
    </form>


<!-- /.container-fluid -->

<!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Confirm Status Change</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin ingin mengubah status Project?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="finalConfirmButton" type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
    </div>
<script>
    // Trigger the final confirmation when the "Confirm" button in the modal is clicked
    document.getElementById('finalConfirmButton').addEventListener('click', function () {
        document.getElementById('statusForm').submit();
    });
    
    // Trigger the status confirmation modal when the initial "Save Changes" button is clicked
    document.getElementById('confirmButton').addEventListener('click', function () {
        $('#statusModal').modal('show');
    });
</script>
<!-- End of Main Content -->
</div></div>
@endsection
