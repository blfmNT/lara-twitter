<script setup>
import {usePage, useForm, Head} from "@inertiajs/vue3";
import {computed, ref} from "vue";

import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Edit from "@/Pages/Profile/Edit.vue";
import {XMarkIcon, CheckCircleIcon} from "@heroicons/vue/24/solid/index.js";
import PrimaryButton from "@/Components/ui/PrimaryButton.vue";
import ProfileTab from "@/Pages/Profile/Partials/ProfileTab.vue";
import TweetList from "@/Components/app/TweetList.vue";
import {CameraIcon} from "@heroicons/vue/24/solid/index.js";

const authUser = usePage().props.auth.user;

const isMyProfile = computed(() => authUser && authUser.id === props.user.id);

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    user: {
        type: Object
    },
    tweets: Array,
    errors: Object
});

console.log(props.tweets);

</script>

<template>
    <Head :title="user.username" />

    <AuthenticatedLayout>
        <div class="max-w-[768px] mx-auto bg-gray-200 mt-16">
            <div class="min-h-[148px] p-4 bg-white">
                <div class="w-[128px] h-[128px] flex flex-col items-center">
                    <div class="relative group">
                        <img class="rounded-full" src="https://xsgames.co/randomusers/avatar.php?g=male" alt="">
                        <div class="absolute top-0 left-0 w-full h-full bg-gray-200 text-gray-500 rounded-full text-center items-center hidden group-hover:inline-block">
                            <button>
                                <CameraIcon class="w-6 h-6" />
                                Update avatar
                                <input type="file" class="opacity-0 absolute w-full h-full">
                            </button>
                        </div>
                    </div>
                    <div class="flex-1 mt-2">
                        <PrimaryButton>Follow</PrimaryButton>
                    </div>
                </div>
            </div>

            <div class="w-full sm:px-0">
                <TabGroup>
                    <TabList class="pl-[200px] flex bg-white">
                        <Tab v-slot="{ selected }" as="template">
                            <ProfileTab :selected="selected" text="Tweets"/>
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <ProfileTab :selected="selected" text="Followers"/>
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <ProfileTab :selected="selected" text="Following"/>
                        </Tab>
                        <Tab v-slot="{ selected }" v-if="isMyProfile" as="template">
                            <ProfileTab :selected="selected" text="Settings"/>
                        </Tab>
                    </TabList>

                    <TabPanels class="mt-2">
                        <TabPanel class="bg-white p-3 shadow">
                            <div v-if="tweets.data">
                                <TweetList :tweets="tweets.data" />
                            </div>
                            <div v-else>
                                Tweets not found
                            </div>
                        </TabPanel>
                        <TabPanel class="bg-white p-3 shadow">
                            Followers
                        </TabPanel>
                        <TabPanel class="bg-white p-3 shadow">
                            Following
                        </TabPanel>
                        <TabPanel v-if="isMyProfile"  class="bg-white p-3 shadow">
                            <Edit :must-verify-email="mustVerifyEmail" :status="status"></Edit>
                        </TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
