@extends('layouts.main')

@section('title')
    Dashboard Member
@endsection

@section('content')
    <div class="card row">
        <div class="card-body col-12">
            <div class="d-flex justify-content-between">
                <h5>Data Pribadi</h5>
                <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-info mr-3"><i class="fa fa-edit"></i> Edit</a>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <img src="{{ $user->foto ? url('storage/'. $user->foto) : asset('assets/img/empty-image.png') }}" alt="" id="" class="mt-2" height="150px" width="150px">
            </div>
            <div class="row py-3 mt-5">
                <div class="col-md-3 d-grid gap-3">
                    <h6>Nama</h6>
                    <h6>Username</h6>
                    <h6>Email</h6>
                    <h6>No HP</h6>
                    <h6>Tanggal Lahir</h6>
                    <h6>Jenis Kelamin</h6>
                    <h6>No KTP</h6>
                </div>
                <div class="mr-2 d-grid gap-3">
                    <h6>:</h6>
                    <h6>:</h6>
                    <h6>:</h6>
                    <h6>:</h6>
                    <h6>:</h6>
                    <h6>:</h6>
                    <h6>:</h6>
                </div>
                <div class="col-md-7 mb-5 d-grid gap-3">
                    <h6>{{ $user->nama ?? '-' }}</h6>
                    <h6>{{ $user->username ?? '-' }}</h6>
                    <h6>{{ $user->email ?? '-' }}</h6>
                    <h6>{{ $user->no_hp }}</h6>
                    <h6>{{ date("d-m-Y", strtotime($user->tanggal_lahir)) }}</h6>
                    <h6>{{ $user->jenis_kelamin }}</h6>
                    <h6>{{ $user->no_ktp }}</h6>
                </div>
            </div>

        </div>
    </div>
@endsection