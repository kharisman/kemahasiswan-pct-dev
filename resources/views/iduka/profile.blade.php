@extends('iduka/layouts.app')

@section('title', 'Profile')

@section('contents')

                <!-- Profile Section -->

                <div class="card">
                    <div class="card-body text-left">
                        <img src="img/undraw_profile.svg" id="profile-picture" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="150">
                        <h4 class="card-title">Iduka Profile</h4>
                        <form>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Perusahaan">
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control" id="address" placeholder="Alamat Perusahaan">
                            </div>
                            <div class="form-group">
                                <label for="notelpon">Nomor telepon</label>
                                <input type="text" class="form-control" id="age" placeholder="Nomor Telepon">
                            </div>
                            <div class="form-group">
                                <label for="foto_profile">Foto profile</label>
                                <input type="file" class="form-control" id="occupation" placeholder="Website Perusahaan">
                            </div>
                            <button type="button" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <!-- End of Main Content -->
    </body>
@endsection 
</html>