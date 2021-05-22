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
                <chat-contacts :contacts="contacts" :me="{{auth()->user()}}" :convo_id="{{$conversation_id}}" v-on:select-user="updateSelectedUser($event)" v-on:update-chatid="updateChatId($event)" v-on:update-messages="updateMessages($event)"></chat-contacts>
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
                <div class="start-chat-area" v-if="!isChatActive">
                    <div class="mb-1 start-chat-icon">
                        <i data-feather="message-square"></i>
                    </div>
                    <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
                </div>
                <!--/ To load Conversation -->

                <!-- Active Chat -->
                <div class="active-chat" v-if="isChatActive">
                    <!-- Chat Header -->
                    <div class="chat-navbar">
                        <chat-head :selected-user="selectedUser"></chat-head>
                    </div>
                    <!--/ Chat Header -->

                    <!-- User Chat messages -->
                    <div class="user-chats">
                        <chat-messages :messages="messages" :me="{{auth()->user()}}"></chat-messages>
                    </div>
                    <!-- User Chat messages -->

                    <chat-form v-on:send-message="addMessage" :chatid="conversation_id"></chat-form>
                   
                </div>
                <!--/ Active Chat -->
            </section>
            <!--/ Main chat area -->

        </div>
    </div>
</div>
@endsection

