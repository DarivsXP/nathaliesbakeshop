<script setup>
import ShopLayout from '@/Layouts/ShopLayout.vue';
import { useCartStore } from '@/stores/cart';
import { Link } from '@inertiajs/vue3';
import { Minus, Plus, ShoppingBag, Trash2 } from 'lucide-vue-next';

const cart = useCartStore();
</script>

<template>
    <ShopLayout title="Cart">
        <div class="bg-ube py-12 text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h1 class="font-display text-4xl font-bold">Your Cart</h1>
            </div>
        </div>

        <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
            <div v-if="cart.items.length" class="space-y-4">
                <div
                    v-for="item in cart.items"
                    :key="`${item.productId}-${item.variant}`"
                    class="card flex items-center gap-4 p-4"
                >
                    <img
                        v-if="item.image"
                        :src="item.image"
                        :alt="item.name"
                        class="h-20 w-20 rounded-xl object-cover"
                    />
                    <div class="flex-1">
                        <h3 class="font-semibold text-charcoal">{{ item.name }}</h3>
                        <p v-if="item.variant" class="text-sm text-gray-500">{{ item.variant }}</p>
                        <p class="mt-1 font-bold text-ube">${{ item.price.toFixed(2) }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            class="rounded-full p-1.5 hover:bg-gray-100"
                            @click="cart.updateQuantity(item.productId, item.variant, item.quantity - 1)"
                        >
                            <Minus class="h-4 w-4" />
                        </button>
                        <span class="w-8 text-center font-semibold">{{ item.quantity }}</span>
                        <button
                            class="rounded-full p-1.5 hover:bg-gray-100"
                            @click="cart.updateQuantity(item.productId, item.variant, item.quantity + 1)"
                        >
                            <Plus class="h-4 w-4" />
                        </button>
                    </div>
                    <p class="hidden w-20 text-right font-bold sm:block">
                        ${{ (item.price * item.quantity).toFixed(2) }}
                    </p>
                    <button
                        class="rounded-full p-2 text-red-400 hover:bg-red-50 hover:text-red-600"
                        @click="cart.removeItem(item.productId, item.variant)"
                    >
                        <Trash2 class="h-4 w-4" />
                    </button>
                </div>

                <div class="card mt-6 p-6">
                    <div class="flex items-center justify-between text-lg">
                        <span class="font-semibold">Subtotal</span>
                        <span class="font-display text-2xl font-bold text-ube">${{ cart.subtotal.toFixed(2) }}</span>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Taxes and delivery fees calculated at checkout (demo).</p>
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <Link :href="route('menu')" class="btn-secondary flex-1 text-center">Continue Shopping</Link>
                        <Link :href="route('checkout')" class="btn-primary flex-1 text-center">Proceed to Checkout</Link>
                    </div>
                </div>
            </div>

            <div v-else class="py-20 text-center">
                <ShoppingBag class="mx-auto h-16 w-16 text-gray-300" />
                <h2 class="mt-4 font-display text-2xl font-bold text-charcoal">Your cart is empty</h2>
                <p class="mt-2 text-gray-500">Browse our menu and add some delicious treats!</p>
                <Link :href="route('menu')" class="btn-primary mt-6 inline-block">Browse Menu</Link>
            </div>
        </div>
    </ShopLayout>
</template>
