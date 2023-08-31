@extends('iduka.layouts.app')

@section('title', 'Edit Project')

@section('contents')

<div class="container-fluid">
    <!-- Page Content -->
    <div class="card">
        <div class="card-body text-left">
            <h4 class="col-md-9">Edit Project</h4>
            <form id="projectForm" action="{{ route('update_project', ['id' => $project->id]) }}" method="POST" class="project">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="iduka_id">Iduka ID</label>
                    <input type="text" name="iduka_id" class="form-control" id="iduka_id" value="{{ Auth::user()->id }}" readonly>
                </div>
                
                <div class="form-group">
                    <label for="category_id">Kategori Project</label>
                    <select name="category_id" class="form-control" id="category_id">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $project->category_id == $category->id ? 'selected' : '' }}>{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status Project</label>
                    <input type="text" name="status" class="form-control" id="status" value="{{ $project->status }}" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Title Project</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $project->name }}">
                </div>
                <div class="form-group">
                    <label for="periode_pendaftaran">Periode Pendaftaran</label>
                    <input type="text" name="periode_pendaftaran" class="form-control datetimepicker" id="periode_pendaftaran" value="{{ old('periode_pendaftaran', $project->registration_start_at . ' - ' . $project->registration_end_at) }}" placeholder="yyyy-mm-dd - yyyy-mm-dd">
                </div>
                <div class="form-group">
                    <label for="periode_pengerjaan">Periode Pengerjaan</label>
                    <input type="text" name="periode_pengerjaan" class="form-control datetimepicker" id="periode_pengerjaan" value="{{ old('periode_pengerjaan', $project->work_start_at . ' - ' . $project->work_end_at) }}" placeholder="yyyy-mm-dd - yyyy-mm-dd">
                </div>
                <div class="form-group">
                    <label for="tingkat_Kesulitan">Tingkat Kesulitan</label>
                    <select name="tingkat_Kesulitan" class="form-control" id="tingkat_Kesulitan">
                        <option value="Mudah" {{ $project->level === 'Mudah' ? 'selected' : '' }}>Mudah</option>
                        <option value="Sedang" {{ $project->level === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Susah" {{ $project->level === 'Susah' ? 'selected' : '' }}>Susah</option>
                    </select>
                </div>
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" cols="30" rows="10">{{ old('notes', $project->notes) }}</textarea>
                <button id="confirmButton" type="button" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
<!-- Status Confirmation Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Confirm Project Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin ingin mengubah isi project?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="finalConfirmButton" type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css" integrity="sha512-rBi1cGvEdd3NmSAQhPWId5Nd6QxE8To4ADjM2a6n0BrqQdisZ/RPUlm0YycDzvNL1HHAh1nKZqI0kSbif+5upQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    $(document).ready(function() {
        $('#periode_pendaftaran').daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' - ',
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                weekLabel: 'W',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        });

        $('#periode_pengerjaan').daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' - ',
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                weekLabel: 'W',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        });

        // Trigger the final confirmation when the "Confirm" button in the modal is clicked
        $('#finalConfirmButton').on('click', function () {
            $('#projectForm').submit();
        });

        // Trigger the project confirmation modal when the initial "Update" button is clicked
        $('#confirmButton').on('click', function () {
            $('#projectModal').modal('show');
        });
    });

    $('#notes').summernote({
        placeholder: 'Notes',
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>


@endsection
