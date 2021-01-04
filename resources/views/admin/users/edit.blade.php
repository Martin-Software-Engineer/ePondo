@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Edit User</h1>
            <div class="card">
                <form method="POST" action="{{ route('admin.users.update',$user->id) }}">
                    @method('PATCH')
                    @include('admin.users.partials.form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
