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
    <form action="{{ url('internship-data') }}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Data Pribadi -->
        <div class="card">
            <div class="card-header">
                Data Pribadi
            </div>
            <div class="card-body">
                <!-- Nama -->
                <div class="row mb-3 text-end">
                    <label for="name" class="col-sm-4 col-form-label text-start">Nama</label>
                    <div class="col-sm-8">
                        <input id="name" class="form-control" type="text" name="name" placeholder="name..." required value="{{ old('name', $internship->name) }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Tanggal Lahir -->
                <div class="row mb-3 text-end">
                    <label for="date_of_birth" class="col-sm-4 col-form-label text-start">Tanggal Lahir</label>
                    <div class="col-sm-8">
                        <input id="date_of_birth" class="form-control" type="date" name="date_of_birth" placeholder="date_of_birth..." required value="{{ old('date_of_birth', $internship->date_of_birth) }}">
                        @error('date_of_birth')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Jenis Kelamin -->
                <div class="row mb-3 text-end">
                    <label for="gender" class="col-sm-4 col-form-label text-start">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="gender" id="gender">
                            <option value="">Input Jenis Kelamin</option>
                            <option value="Pria" {{ old('gender', $internship->gender) == 'Pria' ? 'selected' : '' }}>Pria</option>
                            <option value="Wanita" {{ old('gender', $internship->gender) == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                        </select>
                        @error('gender')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Alamat -->
                <div class="row mb-3 text-end">
                    <label for="address" class="col-sm-4 col-form-label text-start">Alamat</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="address" id="address" cols="32" rows="2" placeholder="address...">{{ old('address', $internship->address) }}</textarea>
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Foto -->
                <div class="row mb-3 text-end">
                    <label for="photo" class="col-sm-4 col-form-label text-start">Photo</label>
                    <div class="col-sm-8">
                        <input id="photo" class="form-control" type="file" name="photo" >
                        @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Negara -->
                <div class="row mb-3 text-end">
                    <label for="nationality" class="col-sm-4 col-form-label text-start">Negara</label>
                    <div class="col-sm-8">
                        <input id="nationality" class="form-control" type="text" name="nationality" placeholder="nationality..." required value="{{ old('nationality', $internship->nationality) }}">
                        @error('nationality')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Pendidikan -->
                <div class="row mb-3 text-end">
                    <label for="education" class="col-sm-4 col-form-label text-start">Pendidikan</label>
                    <div class="col-sm-8">
                        <input id="education" class="form-control" type="text" name="education" placeholder="education..." required value="{{ old('education', $internship->education) }}">
                        @error('education')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Interest -->
                <div class="row mb-3 text-end">
                    <label for="interest" class="col-sm-4 col-form-label text-start">Interest</label>
                    <div class="col-sm-8">
                        <input id="interest" class="form-control" type="text" name="interest" placeholder="interest..." required value="{{ old('interest', $internship->interest) }}">
                        @error('interest')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Nomor Telepon -->
                <div class="row mb-3 text-end">
                    <label for="phone" class="col-sm-4 col-form-label text-start">Nomor Telepon</label>
                    <div class="col-sm-8">
                        <input id="phone" class="form-control" type="text" placeholder="nomor telepon ..." name="phone" required value="{{ old('phone', $internship->phone) }}">
                    </div>
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

<!-- Kontak Media Sosial -->
<div class="card">
    <div class="card-header">
        <p class="d-inline-flex gap-1 text-end">
            <div class="text-dark" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                Media Sosial >>
            </div>
        </p>
    </div>
    <div class="collapse" id="collapseExample1">
        <div class="card card-body">
            <!-- Link Instagram -->
            <div class="row mb-3 text-end">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" placeholder="Username Instagram" aria-label="Username" name="instagram" value="{{ old('instagram', $internship->instagram ?? '') }}">
                  </div>
                </div>
            </div>

            <!-- Link LinkedIn -->
            <div class="row mb-3 text-end">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" placeholder="Username Linkedin" aria-label="Username" name="linkedin" value="{{ old('linkedin', $internship->linkedin ?? '') }}">
                  </div>
                </div>
            </div>

            <!-- Link Github -->
            <div class="row mb-3 text-end">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control form-control-sm" placeholder="Username Github" aria-label="Username" name="github" value="{{ old('github', $internship->github ?? '') }}">
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>




        <!-- Dokumen -->
        <div class="card">
            <div class="card-header">
                <p class="d-inline-flex gap-1 text-end">
                    <div class="text-dark" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Dokumen >>
                    </div>
                </p>
            </div>
            <div class="collapse" id="collapseExample2">
                <div class="card card-body">
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
                    <!-- cv -->
                    <div class="row mb-3 text-end">
                        <label for="curriculum_vitae" class="col-sm-4 col-form-label text-start">Curriculum Vitae</label>
                        <div class="col-sm-8">
                            <input id="curriculum_vitae" class="form-control" type="file" name="curriculum_vitae">
                            @error('curriculum_vitae')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol "Update" -->
        <div class="card mb-3">
            <div class="card-header">
                <button type="submit" class="btn btn-warning btn-sm text-center w-100 h3"><i class="mdi mdi-pencil-box-outline"></i> Update</button>
            </div>
        </div>
    </form>
{{-- 
    <script>
        
        $(document).ready(function() {
        let mediaCount = {{ count($internship->socialMediaLinks) }};

        function addMediaInput() {
            mediaCount++;
            const newMediaLinkInputs = `
                <div id="media-link-${mediaCount}">
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
                </div>
            `;
            $("#media-link-{{ count($internship->socialMediaLinks) }}").append(newMediaLinkInputs);
            if (mediaCount >= 3) {
                $("#add-media-btn").hide();
            }
        }

        $("#add-media-btn").click(function() {
            addMediaInput();
        });
    })

    </script> --}}

</div>
@endsection
