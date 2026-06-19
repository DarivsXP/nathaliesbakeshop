<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Cake, ClipboardList, Package, ShoppingCart } from 'lucide-vue-next';

defineProps({
    stats: Object,
    recentOrders: Array,
    recentInquiries: Array,
});
</script>

<template>
    <AdminLayout>
        <Head title="Admin Dashboard" />
        <h1 class="font-display text-2xl font-bold text-charcoal">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500">Welcome back to Nathalie's Bakeshop admin</p>

        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Today's Orders</p>
                        <p class="mt-1 text-3xl font-bold text-charcoal">{{ stats.todayOrders }}</p>
                    </div>
                    <ShoppingCart class="h-8 w-8 text-ube" />
                </div>
            </div>
            <div class="card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Pending Orders</p>
                        <p class="mt-1 text-3xl font-bold text-charcoal">{{ stats.pendingOrders }}</p>
                    </div>
                    <ClipboardList class="h-8 w-8 text-gold" />
                </div>
            </div>
            <div class="card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">New Inquiries</p>
                        <p class="mt-1 text-3xl font-bold text-charcoal">{{ stats.newInquiries }}</p>
                    </div>
                    <Cake class="h-8 w-8 text-ube" />
                </div>
            </div>
            <div class="card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Active Products</p>
                        <p class="mt-1 text-3xl font-bold text-charcoal">{{ stats.totalProducts }}</p>
                    </div>
                    <Package class="h-8 w-8 text-ube" />
                </div>
            </div>
        </div>

        <div class="mt-8 grid gap-8 lg:grid-cols-2">
            <div class="card p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-semibold text-charcoal">Recent Orders</h2>
                    <Link :href="route('admin.orders.index')" class="text-sm text-ube hover:underline">View all</Link>
                </div>
                <div v-if="recentOrders.length" class="space-y-3">
                    <Link
                        v-for="order in recentOrders"
                        :key="order.id"
                        :href="route('admin.orders.show', order.id)"
                        class="flex items-center justify-between rounded-lg bg-gray-50 px-4 py-3 transition hover:bg-ube/5"
                    >
                        <div>
                            <p class="text-sm font-medium">{{ order.order_number }}</p>
                            <p class="text-xs text-gray-500">{{ order.customer_name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold">${{ parseFloat(order.total).toFixed(2) }}</p>
                            <span class="text-xs capitalize text-ube">{{ order.status }}</span>
                        </div>
                    </Link>
                </div>
                <p v-else class="text-sm text-gray-400">No orders yet.</p>
            </div>

            <div class="card p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-semibold text-charcoal">Recent Inquiries</h2>
                    <Link :href="route('admin.inquiries.index')" class="text-sm text-ube hover:underline">View all</Link>
                </div>
                <div v-if="recentInquiries.length" class="space-y-3">
                    <Link
                        v-for="inquiry in recentInquiries"
                        :key="inquiry.id"
                        :href="route('admin.inquiries.show', inquiry.id)"
                        class="flex items-center justify-between rounded-lg bg-gray-50 px-4 py-3 transition hover:bg-ube/5"
                    >
                        <div>
                            <p class="text-sm font-medium">{{ inquiry.customer_name }}</p>
                            <p class="text-xs text-gray-500">{{ inquiry.flavor }} · {{ inquiry.servings }} servings</p>
                        </div>
                        <span class="text-xs capitalize text-ube">{{ inquiry.status }}</span>
                    </Link>
                </div>
                <p v-else class="text-sm text-gray-400">No inquiries yet.</p>
            </div>
        </div>
    </AdminLayout>
</template>
