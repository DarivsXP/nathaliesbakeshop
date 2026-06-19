<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FlashMessage from '@/Components/Shop/FlashMessage.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from 'lucide-vue-next';

defineProps({
    products: Array,
});

function destroy(id) {
    if (confirm('Delete this product?')) {
        router.delete(route('admin.products.destroy', id));
    }
}
</script>

<template>
    <AdminLayout>
        <Head title="Products" />
        <div class="flex items-center justify-between">
            <div>
                <h1 class="font-display text-2xl font-bold text-charcoal">Products</h1>
                <p class="text-sm text-gray-500">{{ products.length }} products</p>
            </div>
            <Link :href="route('admin.products.create')" class="btn-primary flex items-center gap-2 !py-2">
                <Plus class="h-4 w-4" /> Add Product
            </Link>
        </div>

        <FlashMessage class="mt-4" />

        <div class="card mt-6 overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-6 py-3">Product</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Price</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr v-for="product in products" :key="product.id" class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img v-if="product.image_url" :src="product.image_url" :alt="product.name" class="h-10 w-10 rounded-lg object-cover" />
                                <div>
                                    <p class="font-medium">{{ product.name }}</p>
                                    <p v-if="product.is_featured" class="text-xs text-gold">Featured</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ product.category?.name }}</td>
                        <td class="px-6 py-4">
                            <span v-if="product.is_inquiry_only" class="text-ube">Inquiry</span>
                            <span v-else>${{ parseFloat(product.price).toFixed(2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="rounded-full px-2 py-1 text-xs font-medium"
                                :class="product.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500'"
                            >
                                {{ product.is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <Link :href="route('admin.products.edit', product.id)" class="rounded-lg p-2 text-gray-400 hover:bg-ube/10 hover:text-ube">
                                    <Pencil class="h-4 w-4" />
                                </Link>
                                <button class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-500" @click="destroy(product.id)">
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
