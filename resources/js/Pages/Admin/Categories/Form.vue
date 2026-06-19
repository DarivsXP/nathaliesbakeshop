<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    category: Object,
});

const isEdit = computed(() => !!props.category);

const form = useForm({
    name: props.category?.name ?? '',
    description: props.category?.description ?? '',
    sort_order: props.category?.sort_order ?? 0,
});

function submit() {
    if (isEdit.value) {
        form.put(route('admin.categories.update', props.category.id));
    } else {
        form.post(route('admin.categories.store'));
    }
}
</script>

<template>
    <AdminLayout>
        <Head :title="isEdit ? 'Edit Category' : 'Add Category'" />
        <div class="mb-6">
            <Link :href="route('admin.categories.index')" class="text-sm text-ube hover:underline">&larr; Back to categories</Link>
            <h1 class="mt-2 font-display text-2xl font-bold text-charcoal">{{ isEdit ? 'Edit Category' : 'Add Category' }}</h1>
        </div>

        <form class="card max-w-lg space-y-5 p-8" @submit.prevent="submit">
            <div>
                <label class="mb-1 block text-sm font-medium">Name</label>
                <input v-model="form.name" type="text" class="input-field" required />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Description</label>
                <textarea v-model="form.description" rows="3" class="input-field" />
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Sort Order</label>
                <input v-model="form.sort_order" type="number" min="0" class="input-field" />
            </div>
            <button type="submit" class="btn-primary" :disabled="form.processing">
                {{ isEdit ? 'Update Category' : 'Create Category' }}
            </button>
        </form>
    </AdminLayout>
</template>
