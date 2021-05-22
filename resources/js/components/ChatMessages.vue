<template>
    <div class="chats">
        <div  v-for="(message, index) in messages" v-bind:key="index">
            <div class="chat" :class="{'chat-left': message.user.id != me.id ? true : ''}">
                <div class="chat-avatar">
                    <span class="avatar box-shadow-1 cursor-pointer">
                        <img v-bind:src="'/../app-assets/images/portrait/small/avatar-s-11.jpg'" alt="avatar" height="36" width="36" />
                    </span>
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
    props: ['messages', 'me']
  };
</script>