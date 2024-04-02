<script setup>
import {usePage, useForm, Head} from "@inertiajs/vue3";
import {computed, ref} from "vue";

import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Edit from "@/Pages/Profile/Edit.vue";
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
    tweets : {
        type: Object,
        default: null,
    },
    likes: Array,
    errors: Object
});

var coversEdited = false;

const coversForm = useForm({
    avatar: props.user.avatar,
    profile_cover: props.user.profile_cover,
});

function updateAvatar(e) {
    let file = e.target.files[0];
    let reader = new FileReader();

    if (file) {
        reader.readAsDataURL(file);

        reader.onload = function() {
            props.user.avatar = reader.result;
            coversForm.avatar = file;
            coversEdited = true;
        };
    }
}

function updateCover(e) {
    let file = e.target.files[0];
    let reader = new FileReader();

    if (file) {
        reader.readAsDataURL(file);

        reader.onload = function() {
            props.user.profile_cover = reader.result;
            coversForm.profile_cover = file;
            coversEdited = true;
        };
    }
}

function applyCoverChanges() {
    coversForm.post(route('profile.covers'), {
        // forceFormData: true,
        onSuccess: (response) => {
            coversForm.reset();
            coversEdited = false;
        }
    });
}

</script>

<template>
    <Head :title="user.username" />

    <AuthenticatedLayout>
        <div class="max-w-[768px] mx-auto bg-gray-200 mt-16">
            <div class="min-h-[148px] p-4 bg-white relative group/cover">
                <img
                    class="absolute top-0 left-0 z-0 h-full w-full object-fill"
                    :src="props.user.profile_cover || '/img/profile_cover.png'"
                >
                <div v-if="isMyProfile" class="hidden group-hover/cover:inline-flex cursor-pointer absolute top-2 right-2 p-2 text-gray-100 border-gray-100 border-2">
                    <CameraIcon class="w-6 h-6 mr-2" />
                    <button class="">Update cover
                        <input
                            type="file"
                            class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer"
                            accept=".png, .jpg, .jpeg"
                            @change="updateCover"
                        >
                    </button>

                </div>

                <div class="w-[128px] max-h-[172px] flex flex-col items-center">

                    <div class="relative group/avatar">
                        <img class="max-w-[128px] max-h-[128px] rounded-full" :src="props.user.avatar || '/img/avatar.png'" />
                        <div v-if="isMyProfile"
                             class="absolute top-0 left-0 w-full h-full bg-gray-200 text-gray-500 rounded-full text-center items-center hidden group-hover/avatar:inline-flex"
                        >
                            <CameraIcon class="w-6 h-6 mr-0" />

                            <button>
                                Update avatar
                                <input type="file"
                                       class="opacity-0 cursor-pointer top-0 left-0 absolute w-full h-full"
                                       accept=".png, .jpg, .jpeg"
                                       @change="updateAvatar"
                                >
                            </button>
                        </div>
                    </div>
                    <div class="flex-1 mt-2 w-full text-center z-20 text-gray-100">
                        <h2>@{{ user.username }}</h2>
                        <h2>{{ user.name }}</h2>
                        <template v-if="!isMyProfile">
                            <PrimaryButton class="mt-2">Follow</PrimaryButton>
                        </template>
                        <PrimaryButton class="mt-2" @click="applyCoverChanges" v-if="coversEdited">Save</PrimaryButton>
                    </div>
                </div>
            </div>
            <pre>{{ props.user }}</pre>

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
                            <div v-if="props.tweets.data">
                                <TweetList :tweets="props.tweets" :user="props.user" :likes="props.likes"/>
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
