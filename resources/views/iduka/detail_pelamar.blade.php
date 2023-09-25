@extends('iduka/layouts.app')

@section('title', 'Profile Internship')

@section('contents')

<!-- Profile Section -->
<div class="card">
    <div class="card-body text-left">
        <div class="text-right">
            <p class="mb-0 {{ $projectApply->internship->status == 'Aktif' ? 'text-success' : 'text-danger' }}">
                Status:{{ $projectApply->internship->status }}
            </p>
        </div>
        <div class="row">
        <div class="col-md-4">
        <img src="{{ asset('images/internship/' . $projectApply->internship->photo) }}" id="profile-picture" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="300">

        </div>
            <div class="col-md-8">
                <div class="card shadow mb-4 p-4">
                    <h6>Deskripsi singkat</h6>
                    <p>{!! $projectApply->notes !!}</p>
                </div>
                <form> 
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $projectApply->internship->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="age" value="{{ $projectApply->internship->gender}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Tanggal Lahir</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ date('d F Y', strtotime($projectApply->internship->date_of_birth)) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" value="{{ $projectApply->internship->address}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">No Handphone</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $projectApply->internship->phone}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Warga Negara</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $projectApply->internship->nationality}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="notelpon">Pendidikan</label>
                        <input type="text" class="form-control" id="age" value="{{ $projectApply->internship->education}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Hoby</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $projectApply->internship->interest}}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="instagram">Instagram:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-instagram" aria-hidden="true"></i></span>
                            </div>
                            <a href="https://www.instagram.com/{{ $projectApply->internship->instagram }}" target="_blank" class="form-control" id="instagram" readonly>
                                {{ $projectApply->internship->instagram }}
                            </a>
                        </div>
                    </div>

                    <!-- LinkedIn -->
                    <div class="form-group">
                        <label for="linkedin">LinkedIn:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-linkedin"></i></span>
                            </div>
                            <a href="https://linkedin.com/{{ $projectApply->internship->linkedin }}" target="_blank" class="form-control" id="linkedin" readonly>
                            {{ $projectApply->internship->linkedin}}</a>
                        </div>
                    </div>

                    <!-- GitHub -->
                    <div class="form-group">
                        <label for="github">GitHub:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-github"></i></span>
                            </div>
                            <a href="https://github.com/{{ $projectApply->internship->github}}" target="_blank" class="form-control" id="github" readonly>
                            {{ $projectApply->internship->github}}</a>
                        </div>
                    </div>
                    
                </form>
                @foreach ($documents as $document)
    <div class="document-item">
        <h5>Document {{ $loop->iteration }}</h5>
        <p> <a href="{{ asset('images/internship/' . $document->application_letter) }}" download>Unduh Application Letter</a></p>
        <p> <a href="{{ asset('images/internship/' . $document->certificate) }}" download>Unduh Certificate</a></p>
        <p> <a href="{{ asset('images/internship/' . $document->curriculum_vitae) }}" download>Unduh Curriculum vitae</a></p>
    </div>
@endforeach
            </div>
        </div>
    </div>
</div>
<p></p>

@endsection
