<script setup>
import PrimaryButton from "@/Components/ui/PrimaryButton.vue";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    errors: Object
})

const tweetForm = useForm({
    text: String
});

function ebuchayaTextAreaUpdate(e) {
    tweetForm.text = e.target.value;
}

function submit() {
    tweetForm.post(route('tweet.store'));
}

</script>

<template>
    <div class="mb-8 border border-gray-300 rounded-lg px-2 py-1 group">
        {{ props.errors }}
        <form @submit.prevent="submit()">
            <textarea id="textarea"
                class="rounded-lg w-full resize-none outline-none focus:outline-none focus:ring-0 ring-0 border-0"
                @input="ebuchayaTextAreaUpdate"
                placeholder="ALOLO"></textarea>
            <div class="post-buttons  group-hover:block mt-4">
                <PrimaryButton type="submit">Post</PrimaryButton>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
