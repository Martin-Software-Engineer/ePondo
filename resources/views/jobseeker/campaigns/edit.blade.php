@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Edit Campaign</h1>
            <div class="card">
                <form method="POST" action="{{ route('admin.users.update',$user->id) }}">
                    @method('PATCH')
                    <h1>{{ $id->id}}</h1>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection