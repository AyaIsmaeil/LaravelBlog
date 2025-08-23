@extends('layout.root')
@section('title', 'Category Details')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Category Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name:{{ $category->title }}</h5>
                <p class="card-text">
                    <strong>Image:</strong>
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}" width="100">
                    @endif
                </p>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection