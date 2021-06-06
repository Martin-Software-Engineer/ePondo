<template>
     <!-- Submit Chat form -->
    <form class="chat-app-form" v-on:submit.prevent="sendMessage" method="POST">
        <div class="input-group input-group-merge mr-1 form-send-message">
            <div class="input-group-prepend">
                <span class="speech-to-text input-group-text"><i data-feather="mic" class="cursor-pointer"></i></span>
            </div>
            <input type="text" class="form-control message" placeholder="Type your message or use speech to text" v-model="newMessage"/>
            <div class="input-group-append">
                <span class="input-group-text">
                    <label for="attach-doc" class="attachment-icon mb-0">
                        <i data-feather="image" class="cursor-pointer lighten-2 text-secondary"></i>
                        <input type="file" id="attach-doc" hidden /> </label></span>
            </div>
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