<script setup>
import {Head} from '@inertiajs/vue3';

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateTweet from "@/Components/app/CreateTweet.vue";
import TweetList from "@/Components/app/TweetList.vue";


const props = defineProps({
    tweets: Object
});


</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="mt-20 grid lg:grid-cols-12 md:grid-cols-8 gap-3">
<!--            <div class="mt-20 lg:col-span-3 md:col-span-2 order-1">-->
<!--    &lt;!&ndash;            Logo + menu&ndash;&gt;-->
<!--            </div>-->

            <div class="lg:col-start-3 lg:col-span-5 md:col-start-2 md:col-span-5">
    <!--            main content-->
                <CreateTweet />

<!--                decompose or not-->
                <TweetList :tweets="props.tweets" />
                <span class="bg-red-500" id="observeMe"/>
            </div>
            <div class="lg:col-start-10 lg:col-span-2 md:col-span-1">
                Following
            </div>
        </div>
    </AuthenticatedLayout>
</template>
