@extends('layouts.main')

@section('title')
    Dashboard Admin
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <pre>
                {{ $user_json }}
            </pre>
        </div>
    </div>
@endsection