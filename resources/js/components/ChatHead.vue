<template>
    <header class="chat-header">
        <div class="d-flex align-items-center">
            <div class="sidebar-toggle d-block d-lg-none mr-1">
                <i data-feather="menu" class="font-medium-5"></i>
            </div>
            <div class="avatar avatar-border user-profile-toggle m-0 mr-1">
                <img src="/../app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36" />
                <span class="avatar-status-busy"></span>
            </div>
            <h6 class="mb-0">{{selectedUser.username}}</h6>
        </div>
    </header>
</template>

<script>
  export default {
    props: ['selected-user']
  };
</script>