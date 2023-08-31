@extends('admin/index')
@section('content')
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Project</h1>
                <a href="{{url('admin/project')}}" class=" btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            </div>

            <div class="row">
                <div class="card w-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Edit Project</h6>
                    </div>
                    <div class="card-body">
                        <div class="">

                             @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form id="projectForm"  method="POST" class="project">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ Auth::user()->id }}" readonly>

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
                                <textarea class=" form-control summernote"  name="notes" id="notes" cols="30" rows="10">{{ old('notes', $project->notes) }}</textarea>
                                <button id="confirmButton" type="button" class="btn btn-primary">Update</button>
                            </form>
                            
                        </div>
                    </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js" integrity="sha512-ZESy0bnJYbtgTNGlAD+C2hIZCt4jKGF41T5jZnIXy4oP8CQqcrBGWyxNP16z70z/5Xy6TS/nUZ026WmvOcjNIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

         $('.summernote').summernote({
            callbacks: {
                onPaste: function(e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
    });

   
</script>
@endsection
