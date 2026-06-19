<script setup>
import AnimateIn from '@/Components/Shop/AnimateIn.vue';
import ProductCard from '@/Components/Shop/ProductCard.vue';
import SafeImage from '@/Components/Shop/SafeImage.vue';
import ShopLayout from '@/Layouts/ShopLayout.vue';
import { useCartStore } from '@/stores/cart';
import { Link } from '@inertiajs/vue3';
import { Minus, Plus, ShoppingBag } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps({
    product: Object,
    relatedProducts: Array,
});

const cart = useCartStore();
const quantity = ref(1);
const selectedVariant = ref(props.product.variants?.[0] ?? null);
const added = ref(false);

function addToCart() {
    if (props.product.is_inquiry_only) return;
    cart.addItem(props.product, quantity.value, selectedVariant.value);
    added.value = true;
    setTimeout(() => { added.value = false; }, 1500);
}
</script>

<template>
    <ShopLayout :title="product.name">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <nav class="mb-6 text-sm text-gray-400">
                <Link :href="route('menu')" class="hover:text-ube">Menu</Link>
                <span class="mx-2">/</span>
                <span>{{ product.name }}</span>
            </nav>

            <div class="grid gap-10 lg:grid-cols-2">
                <AnimateIn :x="-24">
                    <div
                        class="overflow-hidden rounded-xl border border-gray-100 bg-gray-50"
                        v-motion
                        :hover="{ scale: 1.02, transition: { type: 'spring', stiffness: 200 } }"
                    >
                        <SafeImage
                            :src="product.image_url"
                            :alt="product.image_alt || product.name"
                            img-class="aspect-square w-full object-cover"
                        />
                    </div>
                </AnimateIn>

                <AnimateIn :delay="120" :x="24">
                    <p class="text-sm text-gray-400">{{ product.category?.name }}</p>
                    <h1 class="mt-1 font-display text-3xl font-bold">{{ product.name }}</h1>
                    <p class="mt-4 text-gray-600 leading-relaxed">{{ product.description }}</p>

                    <p v-if="!product.is_inquiry_only" class="mt-5 text-2xl font-bold text-ube">
                        ${{ parseFloat(product.price).toFixed(2) }}
                    </p>

                    <div v-if="product.variants?.length" class="mt-6">
                        <p class="mb-2 text-sm font-medium">Size / option</p>
                        <div class="flex flex-wrap gap-2">
                            <button
                                v-for="variant in product.variants"
                                :key="variant"
                                type="button"
                                class="rounded-lg border px-4 py-2 text-sm transition"
                                :class="selectedVariant === variant ? 'border-ube bg-ube text-white' : 'border-gray-200 hover:border-ube'"
                                @click="selectedVariant = variant"
                            >
                                {{ variant }}
                            </button>
                        </div>
                    </div>

                    <div v-if="product.is_inquiry_only" class="mt-8">
                        <Link :href="route('custom-cakes.create')" class="btn-primary">Request a quote</Link>
                    </div>

                    <div v-else class="mt-8 flex items-center gap-4">
                        <div class="flex items-center rounded-lg border border-gray-200">
                            <button type="button" class="px-3 py-2" @click="quantity = Math.max(1, quantity - 1)">
                                <Minus class="h-4 w-4" />
                            </button>
                            <span class="w-8 text-center font-medium">{{ quantity }}</span>
                            <button type="button" class="px-3 py-2" @click="quantity++">
                                <Plus class="h-4 w-4" />
                            </button>
                        </div>
                        <button
                            type="button"
                            class="btn-primary flex items-center gap-2"
                            :class="{ '!bg-green-700': added }"
                            @click="addToCart"
                        >
                            <ShoppingBag class="h-4 w-4" />
                            {{ added ? 'Added' : 'Add to cart' }}
                        </button>
                    </div>
                </AnimateIn>
            </div>

            <section v-if="relatedProducts?.length" class="mt-14 border-t border-gray-100 pt-12">
                <AnimateIn>
                    <h2 class="font-display text-xl font-semibold">Goes well with</h2>
                </AnimateIn>
                <div class="mt-5 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <AnimateIn v-for="(related, i) in relatedProducts" :key="related.id" :delay="i * 70">
                        <ProductCard :product="related" :index="i" />
                    </AnimateIn>
                </div>
            </section>
        </div>
    </ShopLayout>
</template>
