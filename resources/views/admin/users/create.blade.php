@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Create User</h1>
            <div class="card">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @include('admin.users.partials.form',['create' => true])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
