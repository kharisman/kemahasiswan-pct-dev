@extends('admin/index')
@section('content')
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Slider</h1>
                <a href="{{url('admin/settings/slider')}}" class=" btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            </div>

            <div class="row">
                <div class="card w-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Slider</h6>
                    </div>
                    <div class="card-body">
                        <div class="">

                             @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif




                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                 <div class="form-group">
                                    <label for="images">Gambar:</label>
                                    <input type="file" class="form-control-file @error('images') is-invalid @enderror" name="images" accept="image/jpeg,image/png,image/jpg">
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sort">Sort:</label>
                                    <input type="number" class="form-control @error('sort') is-invalid @enderror" name="sort" value="{{ old('sort') }}">
                                    @error('sort')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="Aktif" {{ old('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Tidak" {{ old('status') === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Proses</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
