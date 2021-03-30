<template>
    <!-- <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul> -->
    <div class="chats">
        <div v-bind:key="index" v-for="(index,message) in messages">
            <div class="chat" :class="{'chat-left': messsage.sendFromMe === true}">
                <div class="chat-avatar">
                    <span class="avatar box-shadow-1 cursor-pointer">
                        <img v-bind:src="'../../../app-assets/images/portrait/small/avatar-s-11.jpg'" alt="avatar" height="36" width="36" />
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
    props: ['messages']
  };
</script>