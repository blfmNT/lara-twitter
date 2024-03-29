<script setup>

defineProps({
    tweet: Object
});

</script>

<template>
    <div class="tweet border rounded-lg p-2 mb-2 border-blue-300 flex flex-col">
        <div class="tweet-author border-b border-b-blue-400 flex gap-3 items-center py-2">
            <img class="w-[32px] h-[32px] rounded-full" :src="tweet.user.avatar_url" alt="">
            <div class="flex justify-between w-full">
                {{ tweet.user.name }}
                <small class="text-xs">{{ tweet.created_at }}</small>
            </div>
        </div>
        <div class="tweet-body py-2 px-2">
            {{ tweet.text }}
        </div>
        <div class="action-area">
            Like/ne like/tuda/suda
        </div>
    </div>
</template>

<style scoped>

</style>
