@extends('layout.root')
@section('title', 'Tags Details')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Tags Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name:{{ $tags->name }}</h5>
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection