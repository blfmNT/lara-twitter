<script setup>
import Tweet from "@/Components/app/Tweet.vue";
import {onMounted, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
    tweets: Object,
    likes: Array
});

const page = usePage();
const initialURL = page.url;
const observeMe = ref(null)
const tweetsState = ref(props.tweets.data);

function loadMoreTweets() {
    if (props.tweets.next_page_url === null) {
        return;
    }

    //mb replace with axios in the future
    router.get(props.tweets.next_page_url, {}, {
        preserveScroll: true,
        preserveState: true,
        only: ['tweets'],
        onSuccess: () => {
            tweetsState.value = [...tweetsState.value, ...props.tweets.data];
            window.history.replaceState({}, page.title, initialURL)
        }
    });
}

onMounted(() => {
    const observer = new IntersectionObserver(
        entries => entries.forEach(entry => entry.isIntersecting && loadMoreTweets(), {
            rootMargin: "-150px 0px 0px 0px"
        }));

    observer.observe(observeMe.value);
});

function isTweetLiked(tweet_id) {
    return props.likes.indexOf(tweet_id) !== -1;
}

</script>

<template>
    <div>
        <Tweet v-for="tweet in tweetsState" :tweet="tweet" :user="props.user" :liked="isTweetLiked(tweet.id)" />
        <div ref="observeMe"></div>
    </div>
</template>

<style scoped>

</style>
