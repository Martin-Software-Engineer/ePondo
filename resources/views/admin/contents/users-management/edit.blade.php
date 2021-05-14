@extends('admin.layouts.main')

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('admin.partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content')
    <section class="edit-users-wrapper">
        <div class="card">
            <div class="card-body">
                <form class="form form-horizontal" action="{{route('admin.users.update', $user->id)}}">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="username" class="form-control" name="username" placeholder="Username" value="{{$user->username}}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="{{$user->email}}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="confirm_password">Confirm Password</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="firstname">Firstname</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Firstname" value="{{$user->information->firstname}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="lastname">Lastname</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Lastname" value="{{$user->information->lastname}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="role">Role</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="role" id="role" class="select2 form-control">
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}" @if($user->roles[0]->id == $role->id) selected @endif>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function(){
            'use strict';
            var form = $('form');
            form.on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        form.find('button[type=submit]').prop('disabled', true);
                    },
                    success: function(resp) {
                        form.find('button[type=submit]').prop('disabled', false);
                        if (resp.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: resp.msg,
                                icon: 'success',
                            }).then(async function(result) {
                                if (result.isConfirmed) {
                                    location.href = "{{route('admin.users.index')}}"
                                }
                            });
                        }
                    }
                });
            });
        })
    </script>
@endsection