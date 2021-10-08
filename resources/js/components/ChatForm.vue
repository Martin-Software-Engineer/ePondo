<template>
     <!-- Submit Chat form -->
    <form class="chat-app-form" v-on:submit.prevent="sendMessage" method="POST">
        <div class="input-group input-group-merge mr-1 form-send-message">
            <input type="text" class="form-control message" placeholder="Type your message or use speech to text" v-model="newMessage"/>
        </div>
        <button type="button" class="btn btn-primary send" @click="sendMessage">
            <i data-feather="send" class="d-lg-none"></i>
            <span class="d-none d-lg-block">Send</span>
        </button>
    </form>
    <!--/ Submit Chat form -->
</template>

<script>
    export default {
        props: ['user', 'me'],

        data() {
            return {
                newMessage: ''
            }
        },
        mounted(){
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        },
        methods: {
            sendMessage() {
                this.$emit('send-message', {
                    to: this.user,
                    from: this.me,
                    message: this.newMessage
                });

                this.newMessage = '';
            }
        }    
    }
</script>