@extends('admin/index')
@section('content')
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Event</h1>
                <a href="{{url('admin/event')}}" class=" btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            </div>

            <div class="row">
                <div class="card w-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Event</h6>
                    </div>
                    <div class="card-body">
                        <div class="">

                             @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <form id="projectForm" method="POST" class="project" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id" class="form-control" id="id" value="{{ Auth::user()->id }}" readonly>


                                <div class="form-group">
                                    <label for="images">Cover:</label>
                                    <input type="file" class="form-control-file @error('images') is-invalid @enderror" name="images" accept="image/jpeg,image/png,image/jpg">
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="judul_acara">Judul Acara</label>
                                    <input type="text" name="judul_acara" class="form-control @error('judul_acara') is-invalid @enderror" id="judul_acara" value="{{ old('judul_acara') }}" required>
                                    @error('judul_acara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_peserta">Jumlah Peserta</label>
                                    <input type="number" name="jumlah_peserta" class="form-control @error('jumlah_peserta') is-invalid @enderror" id="jumlah_peserta" value="{{ old('jumlah_peserta') }}" required>
                                    @error('jumlah_peserta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="periode_pendaftaran">Periode Pendaftaran</label>
                                    <input type="text" name="periode_pendaftaran" class="form-control datetimepicker @error('periode_pendaftaran') is-invalid @enderror" id="periode_pendaftaran" value="{{ old('periode_pendaftaran') }}" placeholder="yyyy-mm-dd - yyyy-mm-dd" required>
                                    @error('periode_pendaftaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="periode_acara">Periode Acara</label>
                                    <input type="text" name="periode_acara" class="form-control datetimepicker @error('periode_acara') is-invalid @enderror" id="periode_acara" value="{{ old('periode_acara') }}" placeholder="yyyy-mm-dd - yyyy-mm-dd" required>
                                    @error('periode_acara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                                        <option value="Aktif" {{ old('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Tidak" {{ old('status') === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label for="deskripsi">Deskripsi Acara</label>
                                <textarea class="form-control summernote @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="30" rows="10">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>

                            
                        </div>
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
            timePicker: true, // Menambahkan picker waktu
            timePicker24Hour: true, // Menggunakan format waktu 24 jam
            singleDatePicker: false,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss', // Format datetime yang digunakan
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

        $('#periode_acara').daterangepicker({
            timePicker: true, // Menambahkan picker waktu
            timePicker24Hour: true, // Menggunakan format waktu 24 jam
            singleDatePicker: false,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss', // Format datetime yang digunakan
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
