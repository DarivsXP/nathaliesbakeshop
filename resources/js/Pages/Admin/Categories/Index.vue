<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FlashMessage from '@/Components/Shop/FlashMessage.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from 'lucide-vue-next';

defineProps({
    categories: Array,
});

function destroy(id) {
    if (confirm('Delete this category? Products in this category will also be deleted.')) {
        router.delete(route('admin.categories.destroy', id));
    }
}
</script>

<template>
    <AdminLayout>
        <Head title="Categories" />
        <div class="flex items-center justify-between">
            <h1 class="font-display text-2xl font-bold text-charcoal">Categories</h1>
            <Link :href="route('admin.categories.create')" class="btn-primary flex items-center gap-2 !py-2">
                <Plus class="h-4 w-4" /> Add Category
            </Link>
        </div>

        <FlashMessage class="mt-4" />

        <div class="card mt-6 overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Slug</th>
                        <th class="px-6 py-3">Products</th>
                        <th class="px-6 py-3">Sort</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr v-for="category in categories" :key="category.id" class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ category.name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ category.slug }}</td>
                        <td class="px-6 py-4">{{ category.products_count }}</td>
                        <td class="px-6 py-4">{{ category.sort_order }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <Link :href="route('admin.categories.edit', category.id)" class="rounded-lg p-2 text-gray-400 hover:bg-ube/10 hover:text-ube">
                                    <Pencil class="h-4 w-4" />
                                </Link>
                                <button class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-500" @click="destroy(category.id)">
                                    <Trash2 class="h-4 w-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
