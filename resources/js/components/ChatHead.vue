<template>
    <header class="chat-header">
        <div class="d-flex align-items-center">
            <div class="sidebar-toggle d-block d-lg-none mr-1" v-on:click="sidebarToggle" style="cursor: pointer">
                <i data-feather="users" class="font-medium-5"></i>
            </div>
            <div class="avatar avatar-border user-profile-toggle m-0 mr-1" v-if="selectedUser.avatar != '' && selectedUser.avatar != null">
                <img v-bind:src="selectedUser.avatar" alt="avatar" height="36" width="36" />
                <span class="avatar-status-online"></span>
            </div>
            <div class="d-flex justify-content-left align-items-center" v-else>
                <div class="avatar colorClass">
                    <span class="avatar-content avatar-header">{{selectedUser.fullname | toUpper | subStr}}</span> 
                    <span class="avatar-status-online"></span>
                </div>
                <div class="d-flex flex-column">
                    <span class="emp_name text-truncate font-weight-bold"></span>
                    <small class="emp_post text-truncate text-muted"></small>
                </div>
                
            </div>
            <h6 class="mb-0">{{selectedUser.fullname}}</h6>
        </div>
    </header>
</template>

<script>
  export default {
    props: ['selected-user'],
    methods: {
        sidebarToggle(){
            this.$emit('show-sidebar',{show: true});
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