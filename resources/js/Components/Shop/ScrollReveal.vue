<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    delay: {
        type: Number,
        default: 0,
    },
    direction: {
        type: String,
        default: 'up',
    },
});

const el = ref(null);
const visible = ref(false);

const directionClass = {
    up: 'translate-y-10',
    down: '-translate-y-10',
    left: 'translate-x-10',
    right: '-translate-x-10',
    scale: 'scale-90',
};

onMounted(() => {
    const observer = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    visible.value = true;
                }, props.delay);
                observer.disconnect();
            }
        },
        { threshold: 0.08, rootMargin: '0px 0px -40px 0px' },
    );

    if (el.value) {
        observer.observe(el.value);
    }
});
</script>

<template>
    <div
        ref="el"
        class="transition-all duration-700 ease-out"
        :class="[
            visible ? 'translate-x-0 translate-y-0 scale-100 opacity-100' : `opacity-0 ${directionClass[direction]}`,
        ]"
    >
        <slot />
    </div>
</template>
