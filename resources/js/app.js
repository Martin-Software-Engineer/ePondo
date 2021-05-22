require('./bootstrap');

Vue.component('chat-contacts', require('./components/ChatContacts.vue').default);
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('chat-head', require('./components/ChatHead.vue').default);

const app = new Vue({
    el: '#app',

    data: {
        messages: [],
        contacts: [],
        selectedUser: {},
        isChatActive: false,
        conversation_id: null
    },

    created() {
        this.fetchContacts();

        Echo.join('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
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
        addMessage(message) {
            this.messages.push(message);
            axios.post('/messages', message);
        }
    }
});

