<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    product: Object,
    categories: Array,
});

const isEdit = computed(() => !!props.product);

const form = useForm({
    category_id: props.product?.category_id ?? props.categories[0]?.id ?? '',
    name: props.product?.name ?? '',
    description: props.product?.description ?? '',
    price: props.product?.price ?? 0,
    variants: props.product?.variants ?? [],
    image_alt: props.product?.image_alt ?? '',
    is_featured: props.product?.is_featured ?? false,
    is_active: props.product?.is_active ?? true,
    is_inquiry_only: props.product?.is_inquiry_only ?? false,
    image: null,
});

const variantInput = computed({
    get: () => (form.variants || []).join(', '),
    set: (val) => {
        form.variants = val ? val.split(',').map((v) => v.trim()).filter(Boolean) : [];
    },
});

function submit() {
    if (isEdit.value) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.products.update', props.product.id), {
            forceFormData: true,
        });
    } else {
        form.post(route('admin.products.store'), { forceFormData: true });
    }
}
</script>

<template>
    <AdminLayout>
        <Head :title="isEdit ? 'Edit Product' : 'Add Product'" />
        <div class="mb-6">
            <Link :href="route('admin.products.index')" class="text-sm text-ube hover:underline">&larr; Back to products</Link>
            <h1 class="mt-2 font-display text-2xl font-bold text-charcoal">{{ isEdit ? 'Edit Product' : 'Add Product' }}</h1>
        </div>

        <form class="card max-w-2xl space-y-5 p-8" @submit.prevent="submit">
            <div>
                <label class="mb-1 block text-sm font-medium">Category</label>
                <select v-model="form.category_id" class="input-field" required>
                    <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                </select>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Name</label>
                <input v-model="form.name" type="text" class="input-field" required />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Description</label>
                <textarea v-model="form.description" rows="4" class="input-field" required />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Price (CAD)</label>
                <input v-model="form.price" type="number" step="0.01" min="0" class="input-field" />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Variants (comma-separated)</label>
                <input v-model="variantInput" type="text" class="input-field" placeholder="e.g. Whole 9&quot;, Slice" />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Image Alt Text</label>
                <input v-model="form.image_alt" type="text" class="input-field" />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Product Image</label>
                <input type="file" accept="image/*" class="input-field" @input="form.image = $event.target.files[0]" />
                <img v-if="product?.image_url && !form.image" :src="product.image_url" :alt="product.name" class="mt-2 h-24 rounded-lg object-cover" />
            </div>
            <div class="flex flex-wrap gap-6">
                <label class="flex items-center gap-2 text-sm">
                    <input v-model="form.is_featured" type="checkbox" class="rounded text-ube focus:ring-ube" />
                    Featured
                </label>
                <label class="flex items-center gap-2 text-sm">
                    <input v-model="form.is_active" type="checkbox" class="rounded text-ube focus:ring-ube" />
                    Active
                </label>
                <label class="flex items-center gap-2 text-sm">
                    <input v-model="form.is_inquiry_only" type="checkbox" class="rounded text-ube focus:ring-ube" />
                    Inquiry only (no cart)
                </label>
            </div>
            <button type="submit" class="btn-primary" :disabled="form.processing">
                {{ isEdit ? 'Update Product' : 'Create Product' }}
            </button>
        </form>
    </AdminLayout>
</template>
