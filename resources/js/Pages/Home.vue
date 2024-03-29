<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TweetList from "@/Components/app/TweetList.vue";
import CreateTweet from "@/Components/app/CreateTweet.vue";

defineProps({

});


</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="mt-20 grid lg:grid-cols-12 md:grid-cols-8 gap-3">
<!--            <div class="mt-20 lg:col-span-3 md:col-span-2 order-1">-->
<!--    &lt;!&ndash;            Logo + menu&ndash;&gt;-->
<!--            </div>-->

            <div class="lg:col-start-3 lg:col-span-8 md:col-start-2 md:col-span-5">
    <!--            main content-->
                <CreateTweet />
                <TweetList />
            </div>
            <div class="lg:col-span-2 md:col-span-1">
                <!--            Lenta-->
                Following
            </div>
        </div>
    </AuthenticatedLayout>
</template>
