@extends('internship/main')
@section('contentInternship')
<div class="content-wrapper">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Data Lamaran -->
        <div class="card">
            <div class="card-header">
                Data Lamaran
            </div>
            <div class="card-body">
                <!-- File -->
                <input type="hidden" name="projectId" value="{{$projectId->id}}">
                    <!-- Surat Lamaran -->
                    <div class="row mb-3 text-end">
                        <label for="application_letter" class="col-sm-4 col-form-label text-start">Surat Lamaran</label>
                        <div class="col-sm-8">
                            <input id="application_letter" class="form-control border-dark" type="file" name="application_letter">
                            @error('application_letter')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Checkbox untuk CV -->
                    <div class="row mb-3 text-start">
                        <label for="curricullum_vitae" class="col-sm-4 col-form-label text-start">Gunakan CV Lama</label>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input id="curricullum_vitae" name="curricullum_vitae" class="form-check-input mt-0 border-dark" type="checkbox" value="curricullum_vitae" aria-label="Checkbox for following text input">
                            </div>
                            <input type="file" name="curriculum_vitae_new" class="form-control border-dark" aria-label="Text input with checkbox">
                          </div>
                    </div>
            </div>
        </div>

        <!-- Tombol "Update" -->
        <div class="card mb-3">
            <div class="card-header">
                <button type="submit" class="btn btn-warning btn-sm text-center w-100">Kirim</button>
            </div>
        </div>
    </form>

</div>
@endsection
