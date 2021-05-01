<template>
    <ul class="chat-users-list contact-list media-list">
        <li v-bind:key="index" v-for="(index, contact) in contacts">a
            <span class="avatar"><img v-bind:src="contact.info.avatar" height="42" width="42" alt="Generic placeholder image" />
            </span>
            <div class="chat-info">
                <h5 class="mb-0">{{contact.info.username}}</h5>
                <p class="card-text text-truncate">
                    {{contact.info.email}}
                </p>
            </div>
        </li>

        <li class="no-results" v-if="contacts.length === 0">
            <h6 class="mb-0">No Contacts Found</h6>
        </li>
    </ul>
</template>

<script>
  export default {
    props: ['contacts']
  };
</script>