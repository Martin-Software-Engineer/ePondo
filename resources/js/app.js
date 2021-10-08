require('./bootstrap');

Vue.component('chat-app', require('./components/ChatApp.vue').default);

const app = new Vue({
    el: '#app'
});

