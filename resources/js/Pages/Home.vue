<script setup>
import {Head} from '@inertiajs/vue3';

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateTweet from "@/Components/app/CreateTweet.vue";
import TweetList from "@/Components/app/TweetList.vue";


const props = defineProps({
    tweets: Object,
    likes: Array
});

</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="mt-20 grid lg:grid-cols-12 md:grid-cols-8 gap-3">
            <div class="lg:col-start-3 lg:col-span-5 md:col-start-2 md:col-span-5">
                <CreateTweet />

                <TweetList :tweets="props.tweets" :likes="props.likes" />
            </div>
            <div class="lg:col-start-10 lg:col-span-2 md:col-span-1">
                Following
            </div>
        </div>
    </AuthenticatedLayout>
</template>
