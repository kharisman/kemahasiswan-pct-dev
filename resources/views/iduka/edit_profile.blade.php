@extends('iduka.layouts.app')

@section('title', 'Edit Profile')

@section('contents')
    <!-- Profile Section -->
    <div class="card">
        <div class="card-body text-left">
            <!-- ... -->
            <form method="POST" action="{{ route('iduka.update', $iduka->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Perusahaan" value="{{ $iduka->name }}">
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Alamat Perusahaan" value="{{ $iduka->address }}">
                </div>
                <div class="form-group">
                    <label for="phone">Nomor telepon</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Nomor Telepon" value="{{ $iduka->phone }}">
                </div>
               
               <div class="form-group">
                    <label for="photo">Foto Profil</label>
                    <input type="file" name="photo" class="form-control" id="photo" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                    @if ($iduka->photo)
                    <img src="{{ asset($iduka->photo) }}" id="output" class="img-fluid mt-2" alt="Belum punya foto profil" style="max-height: 200px;">
                    @else
                    <img src="path/to/default/photo" id="output" class="img-fluid mt-2" alt="Belum punya foto profil" style="max-height: 200px;">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
