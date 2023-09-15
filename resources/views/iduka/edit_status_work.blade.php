@extends('iduka/layouts.app')

@section('title', 'Edit status work Project')

@section('contents')

<!-- Begin Page Content --><div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Project {{$project->name}}</h6>
            </div>
<div class="container-fluid">
    <!-- Content Row -->
    <form id="status_workForm" action="{{ route('update_status_work', ['id' => $project->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <p></p>
            <select class="form-control" id="status_work" name="status_work" required>
                <option value="Belum Dimulai" {{ $project->status_work === 'Belum Dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                <option value="Sedang Dikerjakan" {{ $project->status_work === 'Sedang Dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                <option value="Selesai" {{ $project->status_work === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Batal" {{ $project->status_work === 'Batal' ? 'selected' : '' }}>Batal</option>
            </select>
        </div>
        <button id="confirmButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#status_workModal">Save Changes</button> <p></p>
    </form>
</div></div>
</div>
<!-- /.container-fluid -->

<!-- status_work Modal -->
<div class="modal fade" id="status_workModal" tabindex="-1" role="dialog" aria-labelledby="status_workModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="status_workModalLabel">Confirm status_work Change</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ubah status Pengerjaan work?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="finalConfirmButton" type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>

<script>
    // Trigger the final confirmation when the "Confirm" button in the modal is clicked
    document.getElementById('finalConfirmButton').addEventListener('click', function () {
        document.getElementById('status_workForm').submit();
    });
    
    // Trigger the status_work confirmation modal when the initial "Save Changes" button is clicked
    document.getElementById('confirmButton').addEventListener('click', function () {
        $('#status_workModal').modal('show');
    });
</script>
<!-- End of Main Content -->

@endsection
