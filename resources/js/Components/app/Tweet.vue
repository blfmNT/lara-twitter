<script setup>

import {HandThumbUpIcon, ShareIcon, ChatBubbleLeftIcon, XMarkIcon } from "@heroicons/vue/24/outline/index.js";
import {useForm, usePage} from "@inertiajs/vue3";

const page = usePage();

const props = defineProps({
    tweet: Object
});

const authUser = usePage().props.auth.user;

const removeForm = useForm({
    tweet_id: props.tweet.id
});

const likeForm = useForm({
    tweet_id: props.tweet.id
});

function removeSubmit() {
    removeForm.delete(route('tweet.destroy', props.tweet.id));
}

function likeSubmit() {
    likeForm.post(route('like.create'));
}

function likeRemoveSubmit() {
    likeForm.delete(route('like.destroy', props.tweet.id));
}

</script>

<template>
    <div class="tweet border rounded-lg p-2 mb-4 bg-gray-100 flex flex-col shadow-lg">
        <div class="tweet-author flex gap-3 py-2 relative">
            <div class="flex items-center">
                <img class="w-[32px] h-[32px] rounded-full"
                     src="https://randomuser.me/api/portraits/men/54.jpg" alt="{{ props.tweet.user.name }}">
                <div class="ml-2 flex flex-col">
                    <h2>{{ props.tweet.user.name }}</h2>
                    <span><a href="#" class="text-sm text-gray-700 hover:text-gray-400 transition-colors">@{{ props.tweet.user.username }}</a></span>
                </div>
            </div>

            <div v-show="authUser.id === tweet.user.id" class="absolute right-0 top-0 text-gray-900 hover:text-red-400 transition-colors">
                <form action="" @submit.prevent="removeSubmit">
                    <button type="submit" ><XMarkIcon class="w-6 h-6" /></button>
                </form>
            </div>
        </div>

        <div class="tweet-body py-2 px-2">
            <h2>#{{ props.tweet.id }}</h2>
            {{ props.tweet.text }}
        </div>

        <div class="bottom-area">

            <small class="text-xs px-1">
                <a :href="route('tweet.show', tweet.id)">
                    {{ props.tweet.created_at }}
                </a>
            </small>

            <div class="p-2 action-buttons grid grid-cols-3 flex justify-items-center">
                <button @click="likeSubmit">
<!--                    <div v-if="page.props.flash.message && page.props.flash.message === 'liked'">-->
                    <div v-if="tweet.like && tweet.like.liked_by === authUser.id">
                        <HandThumbUpIcon class="w-6 h-6 fill-black" />
                    </div>
                    <div v-else>
                        <HandThumbUpIcon class="w-6 h-6" />
                    </div>
                </button>
                <button><ShareIcon class="w-6 h-6" /></button>
                <button><ChatBubbleLeftIcon class="w-6 h-6" /></button>

            </div>

        </div>
    </div>
</template>

<style scoped>
.tweet-body {
    font-family: "Poppins", sans-serif;
}
</style>
