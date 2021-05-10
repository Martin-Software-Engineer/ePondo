@extends('layouts.chat')

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-chat.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-chat-list.css') }}">
@endsection
@section('content')
<div class="sidebar-left">
    <div class="sidebar">
        <!-- Chat Sidebar area -->
        <div class="sidebar-content card">
            <span class="sidebar-close-icon">
                <i data-feather="x"></i>
            </span>
            <!-- Sidebar header start -->
            <div class="chat-fixed-search">
                <div class="d-flex align-items-center w-100">
                    <div class="input-group input-group-merge ml-1 w-100">
                        <div class="input-group-prepend">
                            <span class="input-group-text round"><i data-feather="search" class="text-muted"></i></span>
                        </div>
                        <input type="text" class="form-control round" id="chat-search" placeholder="Search or start a new chat" aria-label="Search..." aria-describedby="chat-search" />
                    </div>
                </div>
            </div>
            <!-- Sidebar header end -->

            <!-- Sidebar Users start -->
            <div id="users-list" class="chat-user-list-wrapper list-group">
                <h4 class="chat-list-title">Contacts</h4>
                <chat-contacts :contacts="contacts"></chat-contacts>
            </div>
            <!-- Sidebar Users end -->
        </div>
        <!--/ Chat Sidebar area -->

    </div>
</div>
<div class="content-right">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="body-content-overlay"></div>
            <!-- Main chat area -->
            <section class="chat-app-window">
                <!-- To load Conversation -->
                <div class="start-chat-area">
                    <div class="mb-1 start-chat-icon">
                        <i data-feather="message-square"></i>
                    </div>
                    <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
                </div>
                <!--/ To load Conversation -->

                <!-- Active Chat -->
                <div class="active-chat d-none">
                    <!-- Chat Header -->
                    <div class="chat-navbar">
                        <header class="chat-header">
                            <div class="d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-lg-none mr-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                                <div class="avatar avatar-border user-profile-toggle m-0 mr-1">
                                    <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36" />
                                    <span class="avatar-status-busy"></span>
                                </div>
                                <h6 class="mb-0">Kristopher Candy</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <i data-feather="phone-call" class="cursor-pointer d-sm-block d-none font-medium-2 mr-1"></i>
                                <i data-feather="video" class="cursor-pointer d-sm-block d-none font-medium-2 mr-1"></i>
                                <i data-feather="search" class="cursor-pointer d-sm-block d-none font-medium-2"></i>
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-transparent hide-arrow btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical" id="chat-header-actions" class="font-medium-2"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="chat-header-actions">
                                        <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Mute Notifications</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Block Contact</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Report</a>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>
                    <!--/ Chat Header -->

                    <!-- User Chat messages -->
                    <div class="user-chats">
                        <chat-messages :messages="messages"></chat-messages>
                    </div>
                    <!-- User Chat messages -->

                    <chat-form v-on:messagesent="addMessage"></chat-form>
                   
                </div>
                <!--/ Active Chat -->
            </section>
            <!--/ Main chat area -->

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('app-assets/js/scripts/pages/app-chat.js') }}"></script>
@endsection