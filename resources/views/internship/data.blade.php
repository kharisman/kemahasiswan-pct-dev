@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
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
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="date_of_birth" class="col-sm-4 col-form-label text-start">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input id="date_of_birth" class="form-control" type="date" name="date_of_birth" placeholder="date_of_birth..."
                                    required>
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
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="address" class="col-sm-4 col-form-label text-start">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="address" id="address" cols="32" rows="2" placeholder="address..."></textarea>
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="photo" class="col-sm-4 col-form-label text-start">Photo</label>
                            <div class="col-sm-8">
                                <input id="photo" class="form-control" type="file" name="foto" required>
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="nationality" class="col-sm-4 col-form-label text-start">Negara</label>
                            <div class="col-sm-8">
                                <input id="nationality" class="form-control" type="text" name="nationality" placeholder="nationality..."
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="education" class="col-sm-4 col-form-label text-start">Pendidikan</label>
                            <div class="col-sm-8">
                                <input id="education" class="form-control" type="text" name="education" placeholder="education..."
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3 text-end">
                            <label for="interest" class="col-sm-4 col-form-label text-start">Interest</label>
                            <div class="col-sm-8">
                                <input id="interest" class="form-control" type="text" name="interest" placeholder="interest..."
                                    required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning btn-sm text-center w-100">Update</button>
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
                            <div class="row mb-3 text-end">
                                <label for="phone" class="col-sm-4 col-form-label text-start">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input id="phone" class="form-control" type="text" placeholder="nomor telepon ..."
                                        name="phone" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <label for="name_account1" class="col-sm-4 col-form-label text-start">Media Sosial 1</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="name_account1" id="name_account1">
                                        <option value="">Input Media Sosial</option>
                                        <option value="Github">Github</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Linked">Linked</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <label for="link1" class="col-sm-4 col-form-label text-start">Media Sosial 1</label>
                                <div class="col-sm-8">
                                    <input id="link1" class="form-control" type="text" placeholder="url ..."
                                        name="link1">
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <label for="name_account2" class="col-sm-4 col-form-label text-start">Media Sosial 2</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="name_account2" id="name_account2">
                                        <option value="">Input Media Sosial</option>
                                        <option value="Github">Github</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Linked">Linked</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <label for="link2" class="col-sm-4 col-form-label text-start">Media Sosial 2</label>
                                <div class="col-sm-8">
                                    <input id="link2" class="form-control" type="text" placeholder="url ..."
                                        name="link2">
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <label for="name_account3" class="col-sm-4 col-form-label text-start">Media Sosial 3</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="name_account3" id="name_account3">
                                        <option value="">Input Media Sosial</option>
                                        <option value="Github">Github</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Linked">Linked</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <label for="link3" class="col-sm-4 col-form-label text-start">Media Sosial 3</label>
                                <div class="col-sm-8">
                                    <input id="link3" class="form-control" type="text" placeholder="url ..."
                                        name="link3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <label for="certificate" class="col-sm-4 col-form-label text-start">Sertifikat Lomba</label>
                                <div class="col-sm-8">
                                    <input id="certificate" class="form-control" type="file" name="certificate">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
