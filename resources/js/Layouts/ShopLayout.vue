<script setup>
import DemoBanner from '@/Components/Shop/DemoBanner.vue';
import Footer from '@/Components/Shop/Footer.vue';
import Navbar from '@/Components/Shop/Navbar.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    title: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <Head :title="title" />
        <DemoBanner />
        <Navbar />
        <main class="flex-1">
            <slot />
        </main>
        <Footer />
    </div>
</template>
