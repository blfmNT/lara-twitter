<script setup>
import PrimaryButton from "@/Components/ui/PrimaryButton.vue";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import { TransitionRoot } from '@headlessui/vue'

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
    tweetForm.post(route('tweet.store'), {
        preserveScroll: true,
        resetOnSuccess: false,
    });
}
const isShowing = ref(true)

function handleEnterLeave(e) {
    if (e.type === 'mouseenter') {
        isShowing.value = true;
    } else if (e.type === 'mouseleave') {
        isShowing.value = false;
    }
}


</script>

<template>
    <div class="mb-8 border-2 border-dashed border-gray-300 rounded-lg px-2 py-1"
         @mouseenter="handleEnterLeave"
         @mouseleave="handleEnterLeave">
        {{ props.errors }}

        <div v-show="!isShowing" class="items-center text-center">Post something</div>

        <TransitionRoot
            :show="isShowing"
            enter="transition-opacity"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="transition-opacity duration-75"
            leave-from="opacity-100"
            leave-to="opacity-0"
        >
            <form @submit.prevent="submit()">
                <textarea id="textarea"
                    class="rounded-lg w-full resize-none outline-none focus:outline-none focus:ring-0 ring-0 border-0"
                    @input="ebuchayaTextAreaUpdate"
                    placeholder="Post something"></textarea>
                <div class="post-buttons mt-2">
                    <PrimaryButton type="submit">Post</PrimaryButton>
                </div>
            </form>

        </TransitionRoot>
    </div>



</template>

<style scoped>
.shake {
    animation: shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
    transform: translate3d(0, 0, 0);
}

.hide {
    animation: hide 1s ease-in-out;
}

.show {
    animation: show 0.3 ease-in-out;
}

@keyframes shake {
    10%,
    90% {
        transform: translate3d(-1px, 0, 0);
    }

    20%,
    80% {
        transform: translate3d(2px, 0, 0);
    }

    30%,
    50%,
    70% {
        transform: translate3d(-4px, 0, 0);
    }

    40%,
    60% {
        transform: translate3d(4px, 0, 0);
    }
}


@keyframes hide {
    10% {
        opacity: 1;
    }
    50%{
        opacity: .5;
    }
    100% {
        opacity: 0;
        display: none;
    }
}

@keyframes show {
    10% {
        opacity: .2;
        display: block;
    }
    50%{
        opacity: .5;
    }
    100% {
        opacity: 1;
    }
}

</style>
