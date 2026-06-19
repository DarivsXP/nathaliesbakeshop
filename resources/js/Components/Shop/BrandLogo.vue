<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    size: {
        type: String,
        default: 'md',
    },
    showText: {
        type: Boolean,
        default: true,
    },
    light: {
        type: Boolean,
        default: false,
    },
});

const sizes = {
    sm: 'h-9 w-9',
    md: 'h-12 w-12',
    lg: 'h-20 w-20',
    xl: 'h-28 w-28',
};
</script>

<template>
    <Link :href="route('home')" class="group flex items-center gap-3">
        <img
            src="/logo.png"
            alt="Nathalie's Bakeshop"
            :class="[sizes[size], 'rounded-full object-cover shadow-md ring-2 ring-gold/40 transition duration-500 group-hover:scale-105 group-hover:shadow-lg group-hover:ring-gold/70']"
        />
        <div v-if="showText">
            <span
                class="font-display text-lg font-bold transition group-hover:text-ube"
                :class="light ? 'text-white' : 'text-charcoal'"
            >
                Nathalie's Bakeshop
            </span>
            <p class="text-xs" :class="light ? 'text-gold/90' : 'text-ube'">
                Filipino flavors, baked in Canada
            </p>
        </div>
    </Link>
</template>
