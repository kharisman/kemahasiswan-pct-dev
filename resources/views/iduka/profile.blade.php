@extends('iduka/layouts.app')

@section('title', 'Profile')

@section('contents')

<!-- Profile Section -->
<div class="card">
    <div class="card-body text-left">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="text-right">
            <form method="POST" action="{{ route('iduka.update', $iduka->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <p class="mb-0 {{ $iduka->status == 'aktif' ? 'text-success' : 'text-danger' }}">
                    Status: {{ $iduka->status == 'aktif' ? 'Aktif' : 'Belum Aktif' }}
                </p>
        </div>
        <div class="row">
            <div class="col-md-4">
                @if ($iduka->photo)
                <img src="{{ asset($iduka->photo) }}" id="profile-picture" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="300">
                @else
                <p>Tidak ada foto profil saat ini.</p>
                @endif
                <div class="custom-file-upload">
                    <label for="photo">
                        <i class="fas fa-camera"></i> Upload Foto
                    </label>
                    <input type="file" name="photo" class="form-control" id="photo" accept="image/*" style="display: none;">
                </div>
            </div>



            <div class="col-md-8">
                <h4 class="card-title">Iduka Profile</h4>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $iduka->name) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $iduka->user->email) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $iduka->address) }}">
                </div>

                <div class="form-group">
                    <label for="phone">Nomor telepon</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $iduka->phone) }}">
                </div>







                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End of Main Content -->
</body>
@endsection
</html>
