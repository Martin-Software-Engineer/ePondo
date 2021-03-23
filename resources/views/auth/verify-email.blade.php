@extends('layouts.verify')

@section('content')
<!-- Coming soon page-->
<div class="misc-wrapper"><a class="brand-logo" href="javascript:void(0);">
    <h2 class="brand-text text-primary ml-1">Epondo</h2>
</a>
<div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
        <h2 class="mb-1">Please verify email address🚀</h2>
        <p class="mb-3">We have sent you a verification link, please check your email inbox.<br>
            If you have not received any email from us. Please click the button below.</p>
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary mt-1">Resend Email Verification Link</button>
        </form>
    </div>
</div>
</div>
<!-- / Coming soon page-->
@endsection
