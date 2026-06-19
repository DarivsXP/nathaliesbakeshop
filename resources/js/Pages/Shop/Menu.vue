<script setup>
import AnimateIn from '@/Components/Shop/AnimateIn.vue';
import ProductCard from '@/Components/Shop/ProductCard.vue';
import ShopLayout from '@/Layouts/ShopLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    categories: Array,
    products: Array,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const category = ref(props.filters?.category || '');

function applyFilters() {
    router.get(
        route('menu'),
        {
            search: search.value || undefined,
            category: category.value || undefined,
        },
        { preserveState: true, replace: true },
    );
}

watch(category, applyFilters);
</script>

<template>
    <ShopLayout title="Menu">
        <div>
            <div class="border-b border-ube/10 bg-white py-14">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <AnimateIn when="enter" :y="20">
                        <h1 class="font-display text-3xl font-bold text-charcoal md:text-4xl">Our Menu</h1>
                        <p class="mt-2 max-w-lg text-gray-600">
                            Empanadas, ube pies, cakes, and kakanin — baked fresh, made to order.
                        </p>
                    </AnimateIn>
                </div>
            </div>

            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                <AnimateIn :delay="100">
                    <div class="mb-10 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex flex-wrap gap-2">
                            <button
                                type="button"
                                class="category-pill"
                                :class="!category ? 'category-pill-active' : 'bg-gray-100 text-charcoal'"
                                @click="category = ''"
                            >
                                All
                            </button>
                            <button
                                v-for="cat in categories"
                                :key="cat.id"
                                type="button"
                                class="category-pill"
                                :class="category === cat.slug ? 'category-pill-active' : 'bg-gray-100 text-charcoal'"
                                @click="category = cat.slug"
                            >
                                {{ cat.name }}
                            </button>
                        </div>
                        <form class="flex gap-2" @submit.prevent="applyFilters">
                            <input
                                v-model="search"
                                type="search"
                                placeholder="Search menu..."
                                class="input-field max-w-xs"
                            />
                            <button type="submit" class="btn-primary !px-4">Search</button>
                        </form>
                    </div>
                </AnimateIn>

                <TransitionGroup
                    v-if="products?.length"
                    name="menu-grid"
                    tag="div"
                    class="relative grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                >
                    <div v-for="(product, i) in products" :key="product.id">
                        <ProductCard :product="product" :index="i" show-actions />
                    </div>
                </TransitionGroup>

                <AnimateIn v-else>
                    <div class="rounded-2xl border border-dashed border-gray-200 py-16 text-center">
                        <p class="text-gray-500">No items match your search. Try another category.</p>
                    </div>
                </AnimateIn>
            </div>
        </div>
    </ShopLayout>
</template>
