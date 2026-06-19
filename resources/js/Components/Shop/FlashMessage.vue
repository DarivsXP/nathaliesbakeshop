<script setup>
import { usePage } from '@inertiajs/vue3';
import { watch } from 'vue';

const page = usePage();

watch(
    () => page.props.flash?.success,
    (message) => {
        if (message) {
            // Flash is consumed on render; parent pages can also show inline
        }
    },
);
</script>

<template>
    <div
        v-if="page.props.flash?.success"
        class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
    >
        {{ page.props.flash.success }}
    </div>
</template>
