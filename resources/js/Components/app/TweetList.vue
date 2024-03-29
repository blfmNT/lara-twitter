<script setup>

import Tweet from "@/Components/app/Tweet.vue";

const tweet1 = {
    user: {
        id: 1,
        name: 'John Ceena',
        avatar_url: 'https://randomuser.me/api/portraits/men/54.jpg',
    },
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    created_at: '2024-10-10 12:12'
}

const tweet2 = {
    user: {
        id: 1,
        name: 'John Troublevolta',
        avatar_url: 'https://randomuser.me/api/portraits/men/53.jpg',
    },
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    created_at: '2024-10-10 12:12'
}

</script>

<template>
    <div>
        <Tweet :tweet="tweet1" />
        <Tweet :tweet="tweet2" />
    </div>
</template>

<style scoped>

</style>
