@extends('layouts.chat')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-chat.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-chat-list.css') }}">
@endsection
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content chat-application" id="app">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <chat-app :user="{{auth()->user()}}"></chat-app>
</div>
<!-- END: Content-->
@endsection

