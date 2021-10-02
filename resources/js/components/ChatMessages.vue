<template>
    <div class="chats">
        <div  v-for="(message, index) in messages" v-bind:key="index">
            <div class="chat chat-left" v-if="message.from.id != me.id">
                <div class="chat-avatar" v-if="message.from.avatar != '' && message.from.avatar != null">
                    <span class="avatar box-shadow-1 cursor-pointer">
                        <img v-bind:src="message.from.avatar" alt="avatar" height="42" width="42" />
                    </span>
                </div>
                <div class="chat-avatar" v-else>
                    <div class="avatar colorClass">
                        <span class="avatar-content avatar-header">{{message.from.information.firstname | toUpper | subStr}}</span> 
                        
                    </div>
                    <div class="d-flex flex-column">
                        <span class="emp_name text-truncate font-weight-bold"></span>
                        <small class="emp_post text-truncate text-muted"></small>
                    </div>
                </div>
                <div class="chat-body">
                    <div class="chat-content">
                        <p>{{message.message}}</p>
                    </div>
                </div>
            </div>

            <div class="chat" v-else>
                <div class="chat-avatar" v-if="message.from.avatar != '' && message.from.avatar != null">
                    <span class="avatar box-shadow-1 cursor-pointer">
                        <img v-bind:src="message.from.avatar" alt="avatar" height="42" width="42" />
                    </span>
                </div>
                <div class="chat-avatar" v-else>
                    <div class="avatar box-shadow-1 cursor-pointer">
                        <span class="avatar-content avatar-header">{{message.from.information.firstname | toUpper | subStr}}</span> 
                    </div>
                    <div class="d-flex flex-column">
                        <span class="emp_name text-truncate font-weight-bold"></span>
                        <small class="emp_post text-truncate text-muted"></small>
                    </div>
                </div>
                <div class="chat-body">
                    <div class="chat-content">
                        <p>{{message.message}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    props: ['messages', 'me'],
    mounted(){
        var userChats = $('.user-chats');

        if (userChats.length > 0) {
            new PerfectScrollbar(userChats[0], {
                wheelPropagation: false
            });
            userChats.animate({ scrollTop: userChats[0].scrollHeight }, 400);
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