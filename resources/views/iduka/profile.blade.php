@extends('iduka/layouts.app')

@section('title', 'Profile')

@section('contents')

<!-- Profile Section -->
<div class="card">
    <div class="card-body text-left">
        <div class="text-right">
            <p class="mb-0 {{ $iduka->status == 'aktif' ? 'text-success' : 'text-danger' }}">
                Status: {{ $iduka->status }}
            </p>
        </div>
        <div class="row">
            <div class="col-md-4">
                @if ($iduka->photo) 
                <img src="{{ asset($iduka->photo) }}" id="profile-picture" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="300">
                @else
                <p>Tidak ada foto profil saat ini.</p>
                @endif
            </div>
            <div class="col-md-8">
                <h4 class="card-title">Iduka Profile</h4>
                <form>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $iduka->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="notelpon">Alamat Email</label>
                        <input type="text" class="form-control" id="age" value="{{ $iduka->user->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" value="{{ $iduka->address }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="notelpon">Nomor telepon</label>
                        <input type="text" class="form-control" id="age" value="{{ $iduka->phone }}" readonly>
                    </div>
                    
                    <a href="{{ route('iduka.edit', $iduka->id) }}" class="btn btn-primary">Edit Profile</a>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- End of Main Content -->
</body>
@endsection 
</html>
