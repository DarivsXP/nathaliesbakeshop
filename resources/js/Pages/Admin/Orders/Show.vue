<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FlashMessage from '@/Components/Shop/FlashMessage.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    order: Object,
});

const form = useForm({
    status: props.order.status,
});

function submit() {
    form.patch(route('admin.orders.update', props.order.id));
}
</script>

<template>
    <AdminLayout>
        <Head :title="`Order ${order.order_number}`" />
        <Link :href="route('admin.orders.index')" class="text-sm text-ube hover:underline">&larr; Back to orders</Link>
        <h1 class="mt-2 font-display text-2xl font-bold text-charcoal">Order {{ order.order_number }}</h1>

        <FlashMessage class="mt-4" />

        <div class="mt-6 grid gap-6 lg:grid-cols-2">
            <div class="card p-6">
                <h2 class="font-semibold">Customer</h2>
                <dl class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Name</dt><dd>{{ order.customer_name }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Email</dt><dd>{{ order.customer_email }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Phone</dt><dd>{{ order.customer_phone }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Fulfillment</dt><dd class="capitalize">{{ order.fulfillment_type }}</dd></div>
                    <div v-if="order.shipping_address" class="pt-2">
                        <dt class="text-gray-500">Address</dt>
                        <dd class="mt-1">{{ order.shipping_address.street }}, {{ order.shipping_address.city }}, {{ order.shipping_address.province }} {{ order.shipping_address.postal_code }}</dd>
                    </div>
                    <div v-if="order.notes" class="pt-2">
                        <dt class="text-gray-500">Notes</dt>
                        <dd class="mt-1">{{ order.notes }}</dd>
                    </div>
                </dl>
            </div>

            <div class="card p-6">
                <h2 class="font-semibold">Update Status</h2>
                <form class="mt-4 space-y-4" @submit.prevent="submit">
                    <select v-model="form.status" class="input-field">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="ready">Ready</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <button type="submit" class="btn-primary" :disabled="form.processing">Update Status</button>
                </form>
                <p class="mt-4 text-xs text-gray-400">Payment: {{ order.payment_status }} (demo)</p>
            </div>
        </div>

        <div class="card mt-6 p-6">
            <h2 class="font-semibold">Items</h2>
            <table class="mt-4 w-full text-sm">
                <thead>
                    <tr class="border-b text-left text-xs uppercase text-gray-500">
                        <th class="pb-2">Product</th>
                        <th class="pb-2">Qty</th>
                        <th class="pb-2">Unit Price</th>
                        <th class="pb-2 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr v-for="item in order.items" :key="item.id">
                        <td class="py-3">
                            {{ item.product_name }}
                            <span v-if="item.variant" class="text-gray-400">({{ item.variant }})</span>
                        </td>
                        <td class="py-3">{{ item.quantity }}</td>
                        <td class="py-3">${{ parseFloat(item.unit_price).toFixed(2) }}</td>
                        <td class="py-3 text-right font-medium">${{ parseFloat(item.line_total).toFixed(2) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="pt-4 text-right font-bold">Order Total</td>
                        <td class="pt-4 text-right font-bold text-ube">${{ parseFloat(order.total).toFixed(2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </AdminLayout>
</template>
