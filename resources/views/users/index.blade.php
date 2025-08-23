@extends('layout.root')

@section('content')
<div class="container">
    <h1>mange users</h1>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th> Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                    <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    @if(!$user->hasRole('admin'))
                    <form action="{{ route('users.makeAdmin', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-success">make admin</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
