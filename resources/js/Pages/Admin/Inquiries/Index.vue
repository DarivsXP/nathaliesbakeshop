<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    inquiries: Array,
});

const statusColors = {
    new: 'bg-blue-100 text-blue-700',
    quoted: 'bg-yellow-100 text-yellow-700',
    accepted: 'bg-green-100 text-green-700',
    declined: 'bg-red-100 text-red-700',
};
</script>

<template>
    <AdminLayout>
        <Head title="Custom Cake Inquiries" />
        <h1 class="font-display text-2xl font-bold text-charcoal">Custom Cake Inquiries</h1>

        <div class="card mt-6 overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-6 py-3">Customer</th>
                        <th class="px-6 py-3">Event Date</th>
                        <th class="px-6 py-3">Flavor</th>
                        <th class="px-6 py-3">Servings</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr v-for="inquiry in inquiries" :key="inquiry.id" class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <Link :href="route('admin.inquiries.show', inquiry.id)" class="font-medium text-ube hover:underline">
                                {{ inquiry.customer_name }}
                            </Link>
                            <p class="text-xs text-gray-400">{{ inquiry.customer_email }}</p>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ new Date(inquiry.event_date).toLocaleDateString() }}</td>
                        <td class="px-6 py-4">{{ inquiry.flavor }}</td>
                        <td class="px-6 py-4">{{ inquiry.servings }}</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full px-2 py-1 text-xs font-medium capitalize" :class="statusColors[inquiry.status]">
                                {{ inquiry.status }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p v-if="!inquiries.length" class="p-8 text-center text-gray-400">No inquiries yet.</p>
        </div>
    </AdminLayout>
</template>
