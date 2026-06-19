<script setup>
const props = defineProps({
    delay: {
        type: Number,
        default: 0,
    },
    duration: {
        type: Number,
        default: 700,
    },
    y: {
        type: Number,
        default: 28,
    },
    x: {
        type: Number,
        default: 0,
    },
    scale: {
        type: Number,
        default: 1,
    },
    /** 'enter' = on mount (hero), 'visible' = scroll into view */
    when: {
        type: String,
        default: 'visible',
    },
});

const spring = {
    type: 'spring',
    stiffness: 90,
    damping: 18,
    mass: 0.8,
};

const target = {
    opacity: 1,
    y: 0,
    x: 0,
    scale: 1,
    transition: {
        ...spring,
        delay: props.delay,
        duration: props.duration,
    },
};

const initial = {
    opacity: 0,
    y: props.y,
    x: props.x,
    scale: props.scale < 1 ? props.scale : 0.96,
};
</script>

<template>
    <div
        v-if="when === 'enter'"
        v-motion
        :initial="initial"
        :enter="target"
    >
        <slot />
    </div>
    <div
        v-else
        v-motion
        :initial="initial"
        :visibleOnce="target"
    >
        <slot />
    </div>
</template>
