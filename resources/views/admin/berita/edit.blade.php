@extends('admin/index')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js" integrity="sha512-ZESy0bnJYbtgTNGlAD+C2hIZCt4jKGF41T5jZnIXy4oP8CQqcrBGWyxNP16z70z/5Xy6TS/nUZ026WmvOcjNIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Berita</h1>
                <a href="{{url('admin/settings/berita')}}" class=" btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            </div>

            <div class="row">
                <div class="card w-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Edit Berita</h6>
                    </div>
                    <div class="card-body">
                        <div class="">

                             @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif



                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{ $d->id }}">
                                @csrf
                                @method('POST') <!-- Tambahkan method override untuk HTTP POST -->


                                <div class="form-group">
                                    <label for="images">Cover:</label>
                                    <input type="file" class="form-control-file @error('images') is-invalid @enderror" name="images" accept="image/jpeg,image/png,image/jpg">
                                    <img width="500" src="{{$d->cover}}" alt="">
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror


                                </div>

                                <div class="form-group">
                                    <label for="judul">Nama Berita:</label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $d->title) }}">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control select2 @error('kategori') is-invalid @enderror" name="kategori[]" multiple required>
                                        @foreach ($kat as $kategori)
                                            <option value="{{ $kategori->id }}" 
                                                @if ($d->categories->contains('category_id', $kategori->id))
                                                    selected
                                                @endif>
                                                {{ $kategori->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="konten">Konten Berita:</label>
                                    <textarea class="form-control summernote @error('konten') is-invalid @enderror" name="konten">{{ old('konten', $d->content) }}</textarea>
                                    @error('konten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                                        <option value="Aktif" {{ old('status', $d->status) === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Tidak" {{ old('status', $d->status) === 'Tidak' ? 'selected' : '' }}>Tidak</option>
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

        <script>
        $(document).ready(function() {
            $('.select2').select2({
            closeOnSelect: false
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
