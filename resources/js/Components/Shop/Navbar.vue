<script setup>
import BrandLogo from '@/Components/Shop/BrandLogo.vue';
import { Link } from '@inertiajs/vue3';
import { useCartStore } from '@/stores/cart';
import { Menu, ShoppingBag, X } from 'lucide-vue-next';
import { ref } from 'vue';

const cart = useCartStore();
const mobileOpen = ref(false);

const links = [
    { name: 'Home', route: 'home' },
    { name: 'Menu', route: 'menu' },
    { name: 'Custom Cakes', route: 'custom-cakes.create' },
    { name: 'About', route: 'about' },
    { name: 'Contact', route: 'contact' },
];
</script>

<template>
    <header class="sticky top-0 z-50 border-b border-gray-200 bg-cream/95 backdrop-blur-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            <BrandLogo size="md" />

            <nav class="hidden items-center gap-6 md:flex">
                <Link
                    v-for="link in links"
                    :key="link.route"
                    :href="route(link.route)"
                    class="text-sm text-charcoal/80 hover:text-ube"
                    :class="{ 'font-semibold text-ube': route().current(link.route) }"
                >
                    {{ link.name }}
                </Link>
            </nav>

            <div class="flex items-center gap-2">
                <Link
                    v-if="$page.props.auth.user?.role === 'admin'"
                    :href="route('admin.dashboard')"
                    class="hidden text-xs font-medium text-ube md:block"
                >
                    Admin
                </Link>
                <Link
                    :href="route('cart')"
                    class="relative rounded-lg p-2 text-charcoal hover:bg-ube/10"
                >
                    <ShoppingBag class="h-5 w-5" :class="{ 'cart-bounce': cart.justAdded }" />
                    <span
                        v-if="cart.itemCount > 0"
                        class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-ube text-[10px] font-bold text-white"
                    >
                        {{ cart.itemCount }}
                    </span>
                </Link>
                <button class="rounded-lg p-2 md:hidden" @click="mobileOpen = !mobileOpen">
                    <X v-if="mobileOpen" class="h-5 w-5" />
                    <Menu v-else class="h-5 w-5" />
                </button>
            </div>
        </div>

        <nav v-if="mobileOpen" class="border-t border-gray-100 px-4 py-3 md:hidden">
            <Link
                v-for="link in links"
                :key="link.route"
                :href="route(link.route)"
                class="block py-2 text-sm"
                @click="mobileOpen = false"
            >
                {{ link.name }}
            </Link>
        </nav>
    </header>
</template>
