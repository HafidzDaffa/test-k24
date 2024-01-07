@extends('layouts.main')

@section('title')
    Dashboard Admin
@endsection

@section('content')
    <div class="row">
        <div class="col-10">
            <h5>Buat Member</h5>
            <form action="{{ route('user.store') }}" method="post" class="mt-5" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_barang">Nama</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Nama" class="form-control">
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Username" class="form-control">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Password" style="border-width: 2px;">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="number" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" placeholder="No HP" class="form-control">
                            @error('no_hp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Tanggal lahir" class="form-control">
                            @error('tanggal_lahir')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis kelamin</label>
                            <select name="jenis_kelamin" value="{{ old("jenis_kelamin") }}" id="jenis_kelamin" class="form-control">
                                <option value="">Jenis kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_ktp">No KTP</label>
                            <input type="number" name="no_ktp" id="no_ktp" value={{ old('no_ktp') }} placeholder="No KTP" class="form-control">
                            @error('no_ktp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profilePicture">Foto profil</label>
                            <input type="file" name="foto" id="profilePicture" placeholder="Foto profil" class="form-control">
                            @error('gambar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/img/empty-image.png') }}" alt="Preview" id="imagePreview" class="mt-2" style="max-width: 150px; max-height: 150px;">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-4 mt-2">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('page_js')
    <script>
        $(document).ready(function () {
            const defaultImage = $('#imagePreview');
            defaultImage.css({
                'max-width': '150px',
                'max-height': '150px'
            });

            $('#profilePicture').change(function (e) {
                const fileInput = e.target;
                const previewImage = $('#imagePreview');

                if (fileInput.files && fileInput.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewImage.attr('src', e.target.result);
                        previewImage.css({
                            'max-width': '150px',
                            'max-height': '150px'
                        });
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        });
    </script>   

    <script>
        $(document).ready(function(){
            $('#togglePassword').click(function(){
                var passwordField = $('#password');
                var icon = $('#togglePassword');

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('bi-eye').addClass('bi-eye-slash');
                }
            });
        });
    </script>
@endpush     