<script setup>
import ShopLayout from '@/Layouts/ShopLayout.vue';
import { useCartStore } from '@/stores/cart';
import { Link, router, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const cart = useCartStore();

const form = useForm({
    customer_name: '',
    customer_email: '',
    customer_phone: '',
    fulfillment_type: 'pickup',
    shipping_address: {
        street: '',
        city: '',
        province: '',
        postal_code: '',
    },
    notes: '',
    items: [],
});

onMounted(() => {
    if (!cart.items.length) {
        router.visit(route('cart'));
    }
    form.items = cart.toOrderPayload();
});

function submit() {
    form.post(route('checkout.store'), {
        onSuccess: () => cart.clear(),
    });
}
</script>

<template>
    <ShopLayout title="Checkout">
        <div class="bg-ube py-12 text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h1 class="font-display text-4xl font-bold">Checkout</h1>
                <p class="mt-2 text-white/80">Demo checkout — no payment required</p>
            </div>
        </div>

        <div class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
            <form class="grid gap-8 lg:grid-cols-5" @submit.prevent="submit">
                <div class="space-y-6 lg:col-span-3">
                    <div class="card p-6">
                        <h2 class="font-display text-lg font-semibold">Contact Information</h2>
                        <div class="mt-4 space-y-4">
                            <div>
                                <label class="mb-1 block text-sm font-medium">Full Name</label>
                                <input v-model="form.customer_name" type="text" class="input-field" required />
                                <p v-if="form.errors.customer_name" class="mt-1 text-sm text-red-500">{{ form.errors.customer_name }}</p>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="mb-1 block text-sm font-medium">Email</label>
                                    <input v-model="form.customer_email" type="email" class="input-field" required />
                                    <p v-if="form.errors.customer_email" class="mt-1 text-sm text-red-500">{{ form.errors.customer_email }}</p>
                                </div>
                                <div>
                                    <label class="mb-1 block text-sm font-medium">Phone</label>
                                    <input v-model="form.customer_phone" type="tel" class="input-field" required />
                                    <p v-if="form.errors.customer_phone" class="mt-1 text-sm text-red-500">{{ form.errors.customer_phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card p-6">
                        <h2 class="font-display text-lg font-semibold">Fulfillment</h2>
                        <div class="mt-4 flex gap-4">
                            <label class="flex cursor-pointer items-center gap-2">
                                <input v-model="form.fulfillment_type" type="radio" value="pickup" class="text-ube focus:ring-ube" />
                                <span class="text-sm font-medium">Pickup</span>
                            </label>
                            <label class="flex cursor-pointer items-center gap-2">
                                <input v-model="form.fulfillment_type" type="radio" value="delivery" class="text-ube focus:ring-ube" />
                                <span class="text-sm font-medium">Delivery</span>
                            </label>
                        </div>

                        <div v-if="form.fulfillment_type === 'delivery'" class="mt-4 space-y-4">
                            <div>
                                <label class="mb-1 block text-sm font-medium">Street Address</label>
                                <input v-model="form.shipping_address.street" type="text" class="input-field" />
                            </div>
                            <div class="grid gap-4 sm:grid-cols-3">
                                <div>
                                    <label class="mb-1 block text-sm font-medium">City</label>
                                    <input v-model="form.shipping_address.city" type="text" class="input-field" />
                                </div>
                                <div>
                                    <label class="mb-1 block text-sm font-medium">Province</label>
                                    <input v-model="form.shipping_address.province" type="text" class="input-field" />
                                </div>
                                <div>
                                    <label class="mb-1 block text-sm font-medium">Postal Code</label>
                                    <input v-model="form.shipping_address.postal_code" type="text" class="input-field" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card p-6">
                        <label class="mb-1 block text-sm font-medium">Order Notes (optional)</label>
                        <textarea v-model="form.notes" rows="3" class="input-field" placeholder="Allergies, pickup time preferences, etc." />
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="card sticky top-24 p-6">
                        <h2 class="font-display text-lg font-semibold">Order Summary</h2>
                        <ul class="mt-4 space-y-3 border-b border-gray-100 pb-4">
                            <li v-for="item in cart.items" :key="`${item.productId}-${item.variant}`" class="flex justify-between text-sm">
                                <span>{{ item.quantity }}x {{ item.name }} <span v-if="item.variant" class="text-gray-400">({{ item.variant }})</span></span>
                                <span class="font-medium">${{ (item.price * item.quantity).toFixed(2) }}</span>
                            </li>
                        </ul>
                        <div class="mt-4 flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-ube">${{ cart.subtotal.toFixed(2) }}</span>
                        </div>
                        <button type="submit" class="btn-primary mt-6 w-full" :disabled="form.processing">
                            Place Demo Order
                        </button>
                        <p class="mt-3 text-center text-xs text-gray-400">
                            Payment integration coming soon. This is a demo order.
                        </p>
                        <Link :href="route('cart')" class="mt-3 block text-center text-sm text-ube hover:underline">
                            &larr; Back to cart
                        </Link>
                    </div>
                </div>
            </form>
        </div>
    </ShopLayout>
</template>
