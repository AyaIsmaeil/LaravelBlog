@extends('layout.root')
     @section('title', 'Edit Category')
     @section('content')
         <h1>Edit Category</h1>
         <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="mb-3">
                 <label for="name" class="form-label">Name</label>
                 <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->title) }}">
                 @error('name')
                     <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
             </div>
             <div class="mb-3">
                 <label for="image" class="form-label">Image URL</label>
                 <input type="file" name="image" id="image" class="form-control" value="{{ old('image', $category->image) }}">
                 @error('image')
                     <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
             </div>
             <button type="submit" class="btn btn-primary">Update</button>
         </form>
     @endsection