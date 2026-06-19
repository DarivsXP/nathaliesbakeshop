<script setup>
import { Link } from '@inertiajs/vue3';
import {
    Cake,
    ClipboardList,
    LayoutDashboard,
    Package,
    Tags,
} from 'lucide-vue-next';

const navItems = [
    { name: 'Dashboard', route: 'admin.dashboard', icon: LayoutDashboard },
    { name: 'Products', route: 'admin.products.index', icon: Package },
    { name: 'Categories', route: 'admin.categories.index', icon: Tags },
    { name: 'Orders', route: 'admin.orders.index', icon: ClipboardList },
    { name: 'Inquiries', route: 'admin.inquiries.index', icon: Cake },
];
</script>

<template>
    <div class="flex min-h-screen bg-gray-50">
        <aside class="relative hidden w-64 flex-shrink-0 bg-charcoal text-white lg:block">
            <div class="border-b border-white/10 p-6">
                <Link :href="route('home')" class="font-display text-lg font-bold text-gold">
                    Nathalie's Bakeshop
                </Link>
                <p class="mt-1 text-xs text-white/60">Admin Panel</p>
            </div>
            <nav class="space-y-1 p-4">
                <Link
                    v-for="item in navItems"
                    :key="item.route"
                    :href="route(item.route)"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm transition hover:bg-white/10"
                    :class="{ 'bg-ube text-white': route().current(item.route) || route().current(item.route.replace('.index', '.*')) }"
                >
                    <component :is="item.icon" class="h-4 w-4" />
                    {{ item.name }}
                </Link>
            </nav>
            <div class="absolute bottom-0 w-64 border-t border-white/10 p-4">
                <Link :href="route('home')" class="text-sm text-white/60 hover:text-white">
                    &larr; Back to storefront
                </Link>
            </div>
        </aside>

        <div class="flex flex-1 flex-col">
            <header class="border-b bg-white px-6 py-4 lg:hidden">
                <div class="flex items-center justify-between">
                    <span class="font-display font-bold text-ube">Admin</span>
                    <Link :href="route('home')" class="text-sm text-gray-500">Storefront</Link>
                </div>
                <nav class="mt-3 flex gap-2 overflow-x-auto pb-1 text-sm">
                    <Link
                        v-for="item in navItems"
                        :key="item.route"
                        :href="route(item.route)"
                        class="whitespace-nowrap rounded-full bg-gray-100 px-3 py-1.5"
                    >
                        {{ item.name }}
                    </Link>
                </nav>
            </header>

            <main class="flex-1 p-6 md:p-8">
                <slot />
            </main>
        </div>
    </div>
</template>
