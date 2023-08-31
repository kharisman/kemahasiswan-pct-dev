@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">                    
        @if(session('success'))
        <div class="alert alert-success w-100">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger w-100">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{url('internship-data')}}" method="post" enctype="multipart/form-data">@csrf
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        Data Pribadi
                    </div>
                    <div class="card-body">
                        <div class="row mb-3 text-end">
                            <label for="name" class="col-sm-4 col-form-label text-start">Nama</label>
                            <div class="col-sm-8">
                                <input id="name" class="form-control" type="text" name="name" placeholder="name..."
                                    required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="date_of_birth" class="col-sm-4 col-form-label text-start">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input id="date_of_birth" class="form-control" type="date" name="date_of_birth" placeholder="date_of_birth..."
                                    required>
                                    @error('date_of_birth')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="gender" class="col-sm-4 col-form-label text-start">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Input Jenis Kelamin</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="address" class="col-sm-4 col-form-label text-start">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="address" id="address" cols="32" rows="2" placeholder="address..."></textarea>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="photo" class="col-sm-4 col-form-label text-start">Photo</label>
                            <div class="col-sm-8">
                                <input id="photo" class="form-control" type="file" name="photo" required>
                                @error('photo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="nationality" class="col-sm-4 col-form-label text-start">Negara</label>
                            <div class="col-sm-8">
                                <input id="nationality" class="form-control" type="text" name="nationality" placeholder="nationality..."
                                    required>
                                    @error('nationality')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="education" class="col-sm-4 col-form-label text-start">Pendidikan</label>
                            <div class="col-sm-8">
                                <input id="education" class="form-control" type="text" name="education" placeholder="education..."
                                    required>
                                    @error('education')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="interest" class="col-sm-4 col-form-label text-start">Interest</label>
                            <div class="col-sm-8">
                                <input id="interest" class="form-control" type="text" name="interest" placeholder="interest..."
                                    required>
                                    @error('interest')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="phone" class="col-sm-4 col-form-label text-start">Nomor Telepon</label>
                            <div class="col-sm-8">
                                <input id="phone" class="form-control" type="text" placeholder="nomor telepon ..." name="phone" required>
                            </div>
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <p class="d-inline-flex gap-1 text-end">
                                <div class="text-dark" data-bs-toggle="collapse" href="#collapseExample1" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    Kontak >>
                                </div>
                            </p>
                        </div>
                        <div class="collapse" id="collapseExample1">
                            <div class="card card-body">
                                <div id="media-link-1">
                                    <div class="row mb-3 text-end">
                                        <label class="col-sm-4 col-form-label text-start">Media Sosial 1</label>
                                        <div class="col-sm-8">
                                            <select class="form-control media-select" name="name_account1" id="name_account1">
                                                <option value="">Input Media Sosial</option>
                                                <option value="github">Github</option>
                                                <option value="instagram">Instagram</option>
                                                <option value="linkedin">Linked</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3 text-end">
                                        <label class="col-sm-4 col-form-label text-start">Link 1</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" placeholder="url ..." name="link1" id="link1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 text-end">
                                    <div class="col-sm-8 offset-sm-4">
                                        <button type="button" id="add-media-btn" class="btn btn-primary">Tambah Media</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            let mediaCount = 1;
                            function addMediaInput() {
                                mediaCount++;
                                const newMediaLinkInputs = `
                                    <div class="row mb-3 text-end">
                                        <label class="col-sm-4 col-form-label text-start">Media Sosial ${mediaCount}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control media-select" name="name_account${mediaCount}">
                                                <option value="">Input Media Sosial</option>
                                                <option value="Github">Github</option>
                                                <option value="instagram">Instagram</option>
                                                <option value="linkedin">Linkedin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3 text-end">
                                        <label class="col-sm-4 col-form-label text-start">Link ${mediaCount}</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="text" placeholder="url ..." name="link${mediaCount}">
                                        </div>
                                    </div>
                                `;
                                $("#media-link-1").append(newMediaLinkInputs);
                                if (mediaCount >= 3) {
                                    $("#add-media-btn").hide();
                                }
                            }
                            $("#add-media-btn").click(function () {
                                addMediaInput();
                            });
                        });
                    </script>
                <div class="card">
                    <div class="card-header">

                        <p class="d-inline-flex gap-1 text-end">
                        <div class="text-dark" data-bs-toggle="collapse" href="#collapseExample2" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            Dokumen >>
                        </div>
                        </p>
                    </div>
                    <div class="collapse" id="collapseExample2">
                        <div class="card card-body">
                            <div class="row mb-3 text-end">
                                <label for="application_letter" class="col-sm-4 col-form-label text-start">Surat Lamaran</label>
                                <div class="col-sm-8">
                                    <input id="application_letter" class="form-control" type="file" name="application_letter">
                                    @error('application_letter')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <button type="submit" class="btn btn-warning btn-sm text-center w-100">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
