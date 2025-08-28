@extends('layout.root')
@section('title', 'Tags')
@section('content')
    <h1>Tags</h1>
    @can('manage_tags')
    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Add Tag</a>
    @endcan
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        @can('manage_tags')
                        <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('tags.show', $tag) }}" class="btn btn-sm btn-info">Show</a>

                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection