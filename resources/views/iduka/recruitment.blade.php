@extends('iduka.layouts.app')
@section('title', 'Form Buat Project')
@section('contents')
<div class="container-fluid">
    <!-- Page Content -->
    <div class="card">
        <div class="card-body text-left">
            <form action="{{ route('save_project') }}" method="POST" class="project">
                @csrf
                <div class="form-group">
                    <label for="category_id">Kategori Project</label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            @if ($category->status == 'Aktif')
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Nama Project</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama project" value="{{ old('name') }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="periode_pendaftaran">Periode Pendaftaran</label>
                    <input type="text" name="periode_pendaftaran" class="form-control" id="periode_pendaftaran" placeholder="periode pendaftaran project" value="{{ old('periode_pendaftaran') }}">
                    @error('periode_pendaftaran')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="periode_pengerjaan">Periode Pengerjaan</label>
                    <input type="text" name="periode_pengerjaan" class="form-control" id="periode_pengerjaan" placeholder="periode pengerjaan project" value="{{ old('periode_pengerjaan') }}">
                    @error('periode_pengerjaan')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Tingkat Kesulitan</label>
                    <select name="tingkat_Kesulitan" class="form-control" id="status">
                        <option value="Mudah" {{ old('tingkat_Kesulitan') == 'Mudah' ? 'selected' : '' }}>Mudah</option>
                        <option value="Sedang" {{ old('tingkat_Kesulitan') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Susah" {{ old('tingkat_Kesulitan') == 'Susah' ? 'selected' : '' }}>Susah</option>
                    </select>
                    @error('tingkat_Kesulitan')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="notes">Deskripsi Project</label>
                    <textarea name="notes" id="notes" cols="30" rows="10">{{ old('notes') }}</textarea>
                    @error('notes')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div><p></p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css" integrity="sha512-rBi1cGvEdd3NmSAQhPWId5Nd6QxE8To4ADjM2a6n0BrqQdisZ/RPUlm0YycDzvNL1HHAh1nKZqI0kSbif+5upQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    $(document).ready(function() {
        $('#periode_pendaftaran').daterangepicker({
            timePicker: false
            , startDate: moment().startOf('hour')
            , endDate: moment().startOf('hour').add(1, 'day')
            , locale: {
                format: 'YYYY-MM-DD', // Ganti sesuai dengan format yang Anda inginkan
                applyLabel: 'Apply'
                , cancelLabel: 'Cancel',
                // ... (tambahkan konfigurasi lain sesuai kebutuhan)
            }
        });

        $('#periode_pengerjaan').daterangepicker({
            timePicker: false
            , startDate: moment().startOf('hour')
            , endDate: moment().startOf('hour').add(1, 'day')
            , locale: {
                format: 'YYYY-MM-DD ', // Ganti sesuai dengan format yang Anda inginkan
                applyLabel: 'Apply'
                , cancelLabel: 'Cancel',
                // ... (tambahkan konfigurasi lain sesuai kebutuhan)
            }
        });
    });




    $('#notes').summernote({
        placeholder: 'Notes'
        , tabsize: 2
        , height: 200
        , toolbar: [
            ['style', ['style']]
            , ['font', ['bold', 'underline', 'clear']]
            , ['color', ['color']]
            , ['para', ['ul', 'ol', 'paragraph']]
            , ['table', ['table']]
            , ['insert', ['link', 'picture', 'video']]
            , ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

</script>
@endsection
