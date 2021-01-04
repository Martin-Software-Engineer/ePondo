@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="mt-5 float-left">Users</h1>
            <a class="btn btn-sm btn-success" href="{{ route('admin.users.create') }}" role="button">Create</a>
        </div>
    </div>
    
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role Id</th>
            <th scope="col">Role Name</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            @foreach($user->roles as $role)
            <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit',$user->id)}}" role="button">Edit</a>
                <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-user-form-{{ $user->id }}')
                        .submit()">
                    Delete
                </button>
                <form id="delete-user-form-{{ $user->id }}"action="{{route('admin.users.destroy',$user->id)}}" method="POST" style="display: none">
                @csrf
                @method('DELETE')
                </form>
            </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection