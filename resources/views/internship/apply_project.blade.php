@extends('internship/main')
@section('contentInternship')
<div class="content-wrapper">
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
                            <input id="application_letter" class="form-control" type="file" name="application_letter">
                            @error('application_letter')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Sertifikat Lomba -->
                    <div class="row mb-3 text-end">
                        <label for="certificate" class="col-sm-4 col-form-label text-start">Sertifikat Lomba</label>
                        <div class="col-sm-8">
                            <input id="certificate" class="form-control" type="file" name="certificate">
                            @error('certificate')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
