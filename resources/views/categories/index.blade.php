@extends('layout.root')

@section('title', 'Categories')
@section('content')

    <h1 class="text-3xl font-bold underline">
        Categories
    </h1>
    @can('manage_categories')
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3"> Create Category</a>
    @endcan
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-md-4 mb-5">
                <div class="card-content">
                    <div class="card-img">
                        <img src="{{ asset('images/' . $category->image) }}" alt="notfound">
                    </div>
                    <div class="card-desc">
                        <h3>{{ $category->title }}</h3>

                            @can('manage_categories')
                            <a href="{{ route('categories.show', $category) }}" class="btn btn-secondary">Show</a>  
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary">Edit</a>
                            @endcan
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form> 
                            

                      
                    </div>
                </div>
            </div>
        @endforeach   
        </div>
    </div>
@endsection