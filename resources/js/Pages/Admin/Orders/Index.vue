<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    orders: Array,
});

const statusColors = {
    pending: 'bg-yellow-100 text-yellow-700',
    confirmed: 'bg-blue-100 text-blue-700',
    ready: 'bg-purple-100 text-purple-700',
    completed: 'bg-green-100 text-green-700',
    cancelled: 'bg-red-100 text-red-700',
};
</script>

<template>
    <AdminLayout>
        <Head title="Orders" />
        <h1 class="font-display text-2xl font-bold text-charcoal">Orders</h1>
        <p class="text-sm text-gray-500">{{ orders.length }} total orders</p>

        <div class="card mt-6 overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-6 py-3">Order #</th>
                        <th class="px-6 py-3">Customer</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Fulfillment</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr v-for="order in orders" :key="order.id" class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <Link :href="route('admin.orders.show', order.id)" class="font-medium text-ube hover:underline">
                                {{ order.order_number }}
                            </Link>
                        </td>
                        <td class="px-6 py-4">
                            <p>{{ order.customer_name }}</p>
                            <p class="text-xs text-gray-400">{{ order.customer_email }}</p>
                        </td>
                        <td class="px-6 py-4 font-medium">${{ parseFloat(order.total).toFixed(2) }}</td>
                        <td class="px-6 py-4 capitalize text-gray-500">{{ order.fulfillment_type }}</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full px-2 py-1 text-xs font-medium capitalize" :class="statusColors[order.status]">
                                {{ order.status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ new Date(order.created_at).toLocaleDateString() }}</td>
                    </tr>
                </tbody>
            </table>
            <p v-if="!orders.length" class="p-8 text-center text-gray-400">No orders yet.</p>
        </div>
    </AdminLayout>
</template>
