<template>
<div class="content-area-wrapper mt-1 mt-md-0">
    <div class="sidebar-left">
        <div class="sidebar">
            <!-- Chat Sidebar area -->
            <div class="sidebar-content card" :class="{'show' : showSideBar}">
                <span class="sidebar-close-icon" v-on:click="showSideBar=false">
                    <i data-feather="x"></i>
                </span>
                <!-- Sidebar header start -->
                <div class="chat-fixed-search">
                    <div class="d-flex align-items-center w-100">
                        <div class="input-group input-group-merge ml-1 w-100">
                            <div class="input-group-prepend">
                                <span class="input-group-text round"><i data-feather="search" class="text-muted"></i></span>
                            </div>
                            <input type="text" class="form-control round" id="chat-search" placeholder="Search or start a new chats" aria-label="Search..." aria-describedby="chat-search" />
                        </div>
                    </div>
                </div>
                <!-- Sidebar header end -->

                <!-- Sidebar Users start -->
                <div id="users-list" class="chat-user-list-wrapper list-group">
                    <h4 class="chat-list-title">Chats</h4>
                    <ChatContacts :contacts="contacts" :me="user" :selected-user-id="selectedUserId" v-on:select-user="updateSelectedUser($event)" v-on:update-messages="updateMessages($event)"/>
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
                            <ChatHead :selected-user="selectedUser" v-on:show-sidebar="setShowSideBar" />
                        </div>
                        <!--/ Chat Header -->

                        <!-- User Chat messages -->
                        <div class="user-chats">
                            <ChatMessages :messages="messages" :me="user" />
                        </div>
                        <!-- User Chat messages -->

                        <ChatForm v-on:send-message="addMessage" :me="user" :user="selectedUser" />
                    
                    </div>
                    <!--/ Active Chat -->
                </section>
                <!--/ Main chat area -->

            </div>
        </div>
    </div>
</div>
</template>

<script>
import ChatMessages from './ChatMessages';
import ChatForm from './ChatForm';
import ChatHead from './ChatHead';
import ChatContacts from './ChatContacts';

export default {
    components: {ChatMessages, ChatForm, ChatHead, ChatContacts},
    props: ['user'],
    data(){
        return {
            messages: [],
            contacts: [],
            selectedUser: {},
            selectedUserId: null,
            isChatActive: false,
            showSideBar: false
        }
    },
    created() {
        this.fetchContacts();
        var searchParams = new URLSearchParams(window.location.search);
        var contact_id = searchParams.get('contact_id');

        if(contact_id != null){
            this.selectedUserId = contact_id;
            axios.get('/get-user/'+contact_id).then(user => {
                this.selectedUser = user.data;
            });
            axios.get('/get-messages/'+contact_id).then(message => {
                this.messages = message.data;
                this.isChatActive = true;
            });
        }
        Echo.private(`messages.${this.user.id}`)
            .listen('MessageSent', (e) => {
                this.messages.push(e.message);
            });
    },
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },
        fetchContacts() {
            axios.get('/get-contacts').then(response => {
                this.contacts = response.data;
            });
        },
        updateSelectedUser(user){
            this.selectedUser = user;
            this.isChatActive = true;
        },
        updateChatId(id){
            this.conversation_id = id;
            this.isChatActive = true;
        },
        updateMessages(messages){
            this.messages = messages;
        },
        async addMessage(message) {
            //console.log(message);
            this.messages.push(message);

            await axios.post('/messages', {
                to: message.to.id,
                message: message.message
            });

            $('.user-chats').scrollTop($('.user-chats > .chats').height());
        },
        setShowSideBar(status){
            this.showSideBar = status.show;
        }
    }
}
</script>