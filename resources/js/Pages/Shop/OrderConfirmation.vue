<script setup>
import ShopLayout from '@/Layouts/ShopLayout.vue';
import { Link } from '@inertiajs/vue3';
import { CheckCircle } from 'lucide-vue-next';

defineProps({
    order: Object,
});
</script>

<template>
    <ShopLayout title="Order Confirmed">
        <div class="mx-auto max-w-2xl px-4 py-16 text-center sm:px-6">
            <div class="card p-10">
                <CheckCircle class="mx-auto h-16 w-16 text-green-500" />
                <h1 class="mt-6 font-display text-3xl font-bold text-charcoal">Thank You!</h1>
                <p class="mt-3 text-gray-600">
                    Your demo order <strong class="text-ube">{{ order.order_number }}</strong> has been placed successfully.
                </p>
                <p class="mt-2 text-sm text-gray-500">
                    We'll review your order and contact you at {{ order.customer_email }} to confirm pickup or delivery details.
                </p>

                <div class="mt-8 rounded-xl bg-cream p-6 text-left">
                    <h2 class="font-semibold text-charcoal">Order Summary</h2>
                    <ul class="mt-4 space-y-2">
                        <li v-for="item in order.items" :key="item.id" class="flex justify-between text-sm">
                            <span>{{ item.quantity }}x {{ item.product_name }} <span v-if="item.variant" class="text-gray-400">({{ item.variant }})</span></span>
                            <span>${{ parseFloat(item.line_total).toFixed(2) }}</span>
                        </li>
                    </ul>
                    <div class="mt-4 flex justify-between border-t border-gray-200 pt-4 font-bold">
                        <span>Total</span>
                        <span class="text-ube">${{ parseFloat(order.total).toFixed(2) }}</span>
                    </div>
                    <p class="mt-2 text-xs text-gray-400">Payment status: Demo (no charge)</p>
                </div>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
                    <Link :href="route('menu')" class="btn-primary">Continue Shopping</Link>
                    <Link :href="route('home')" class="btn-secondary">Back to Home</Link>
                </div>
            </div>
        </div>
    </ShopLayout>
</template>
