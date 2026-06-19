<script setup>
import { ref } from 'vue';

const props = defineProps({
    src: {
        type: String,
        required: true,
    },
    alt: {
        type: String,
        default: '',
    },
    imgClass: {
        type: String,
        default: '',
    },
});

const fallback = '/logo.png';
const currentSrc = ref(props.src);

function onError() {
    if (currentSrc.value !== fallback) {
        currentSrc.value = fallback;
    }
}
</script>

<template>
    <img
        :src="currentSrc"
        :alt="alt"
        :class="imgClass"
        loading="lazy"
        @error="onError"
    />
</template>
