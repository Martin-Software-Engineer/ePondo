<template>
    <ul class="chat-users-list contact-list media-list">
        <li v-for="(contact, index) in contacts" :key="index" v-on:click="selectUser(contact.info)" :class="currentChatId == contact.info.id ? 'active' : ''">
            <span class="avatar" v-if="contact.info.avatar != '' && contact.info.avatar != null">
                <img v-bind:src="contact.info.avatar" height="42" width="42" />
            </span>
            <div class="d-flex justify-content-left align-items-center" v-else>
                <div class="avatar colorClass">
                    <span class="avatar-content avatar-header">{{contact.info.username | toUpper | subStr}}</span> 
                </div>
                <div class="d-flex flex-column">
                    <span class="emp_name text-truncate font-weight-bold"></span>
                    <small class="emp_post text-truncate text-muted"></small>
                </div>
            </div>
            <div class="chat-info">
                <h5 class="mb-0">{{contact.info.username}} <span class="badge badge-pill badge-danger" v-if="contact.unreadmessages > 0">{{contact.unreadmessages}}</span></h5>
                <p class="card-text text-truncate">
                    {{contact.info.email}} 
                </p>
            </div>
        </li>

        <li v-if="contacts.length === 0">
            <h6 class="mb-0">No Contacts Found</h6>
        </li>
    </ul>
</template>

<script>
  export default {
    props: ['contacts', 'me', 'selected-user-id'],
    data(){
        return {
            currentChatId: '',
        }
    },
    created(){
        if(this.selectedUserId != null){
            this.currentChatId = this.selectedUserId;
        }
    },
    methods: {
        async selectUser(user){
            this.currentChatId = user.id;
            let messages = await axios.get('/get-messages/'+user.id);
            this.$emit('update-messages', messages.data);
            this.$emit('select-user', user);

            window.history.pushState( {} , '', '/chats/?'+$.param({contact_id: user.id}));

            
            //jQuery.param.querystring(window.location.href, $.param({contact_id: user.id}));
        },
        async updateConversationId(id){
            //let user = await axios.get('/get-chat-user/'+id);
            let messages = await axios.get('/get-messages/'+id);
            this.$emit('update-messages', messages.data);
            //this.$emit('select-user', user.data);
            this.$emit('update-chatid', id);
        }
    },
    filters: {
        subStr: function(string) {
    	    return string.substring(0,2);
        },
        toUpper: function(string){
            return string.toUpperCase();
        }
    }
  };
</script>