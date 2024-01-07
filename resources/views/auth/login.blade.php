@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <div style="margin: 100px 130px 50px 130px;">
        <div class="d-flex justify-content-center align-items-center">
            <img class="" src="{{asset('assets/img/cat-logo.png')}}" alt="Logo" style="width:150px; height:auto;">
        </div>
        <h2 class="font-weight-bold mt-3">Selamat Datang</h2>
        <p class="mt-2">Silahkan login</p>
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
        <form action="{{ route('login.store') }}" class="d-flex flex-column justify-content-center" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" style="border-width: 2px;">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" style="border-width: 2px;">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </span>
                    </div>
                </div>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                {{-- <div class="mt-2">
                    <a href="#" class="text-small">Forgot Password?</a>
                </div> --}}
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary w-50">Login</button>
            </div>
            
            <div class="mt-3 text-center">
                <span>Don't have an account? <a href="{{ route('register.index') }}" class="text-small">Register</a></span>
            </div>
        </form>
    </div>
@endsection

@push('page_js')
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