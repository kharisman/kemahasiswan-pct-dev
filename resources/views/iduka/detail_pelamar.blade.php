@extends('iduka/layouts.app')

@section('title', 'Detail Internship')

@section('contents')

<!-- Profile Section -->
<div class="card">
    <div class="card-body text-left">
        <div class="text-right">
            <p class="mb-0 {{ $projectApply->internship->status == 'aktif' ? 'text-success' : 'text-danger' }}">
                Status:{{ $projectApply->internship->status }}
            </p>
        </div>
        <div class="row">
        <div class="col-md-4">
        <img src="{{ asset('images/internship/' . $projectApply->internship->photo) }}" id="profile-picture" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="300">

</div>

            <div class="col-md-8">
                <h4 class="card-title">Internship Profile</h4>
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
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $projectApply->internship->date_of_birth}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" value="{{ $projectApply->internship->address}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $projectApply->internship->phone}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $projectApply->internship->nationality}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="notelpon">Nomor telepon</label>
                        <input type="text" class="form-control" id="age" value="{{ $projectApply->internship->education}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $projectApply->internship->interest}}" readonly>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
