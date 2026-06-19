<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FlashMessage from '@/Components/Shop/FlashMessage.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    inquiry: Object,
});

const form = useForm({
    status: props.inquiry.status,
});

function submit() {
    form.patch(route('admin.inquiries.update', props.inquiry.id));
}
</script>

<template>
    <AdminLayout>
        <Head title="Inquiry Details" />
        <Link :href="route('admin.inquiries.index')" class="text-sm text-ube hover:underline">&larr; Back to inquiries</Link>
        <h1 class="mt-2 font-display text-2xl font-bold text-charcoal">Inquiry from {{ inquiry.customer_name }}</h1>

        <FlashMessage class="mt-4" />

        <div class="mt-6 grid gap-6 lg:grid-cols-2">
            <div class="card p-6">
                <h2 class="font-semibold">Details</h2>
                <dl class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Email</dt><dd>{{ inquiry.customer_email }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Phone</dt><dd>{{ inquiry.customer_phone }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Event Date</dt><dd>{{ new Date(inquiry.event_date).toLocaleDateString() }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Servings</dt><dd>{{ inquiry.servings }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Flavor</dt><dd>{{ inquiry.flavor }}</dd></div>
                </dl>
                <div v-if="inquiry.design_notes" class="mt-4">
                    <p class="text-sm text-gray-500">Design Notes</p>
                    <p class="mt-1 text-sm">{{ inquiry.design_notes }}</p>
                </div>
                <div v-if="inquiry.image_path" class="mt-4">
                    <p class="mb-2 text-sm text-gray-500">Reference Image</p>
                    <img :src="`/storage/${inquiry.image_path}`" alt="Reference" class="h-48 rounded-xl object-cover" />
                </div>
            </div>

            <div class="card p-6">
                <h2 class="font-semibold">Update Status</h2>
                <form class="mt-4 space-y-4" @submit.prevent="submit">
                    <select v-model="form.status" class="input-field">
                        <option value="new">New</option>
                        <option value="quoted">Quoted</option>
                        <option value="accepted">Accepted</option>
                        <option value="declined">Declined</option>
                    </select>
                    <button type="submit" class="btn-primary" :disabled="form.processing">Update Status</button>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
