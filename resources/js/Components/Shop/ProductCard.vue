<script setup>
import SafeImage from '@/Components/Shop/SafeImage.vue';
import { useCartStore } from '@/stores/cart';
import { Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
    index: {
        type: Number,
        default: 0,
    },
    showActions: {
        type: Boolean,
        default: false,
    },
});

const cart = useCartStore();
const added = ref(false);
const selectedVariant = ref(props.product.variants?.[0] ?? null);

watch(
    () => props.product.id,
    () => {
        selectedVariant.value = props.product.variants?.[0] ?? null;
        added.value = false;
    },
);

function defaultVariant() {
    return props.product.variants?.[0] ?? null;
}

function addToCart() {
    if (props.product.is_inquiry_only) return;

    cart.addItem(props.product, 1, selectedVariant.value ?? defaultVariant());
    added.value = true;
    setTimeout(() => {
        added.value = false;
    }, 1500);
}

function buyNow() {
    if (props.product.is_inquiry_only) return;

    cart.addItem(props.product, 1, selectedVariant.value ?? defaultVariant());
    router.visit(route('checkout'));
}
</script>

<template>
    <div
        class="product-card group flex h-full flex-col"
        :style="{ transitionDelay: `${index * 40}ms` }"
    >
        <Link
            :href="route('products.show', product.slug)"
            class="block flex-1"
        >
            <div class="relative aspect-[4/3] overflow-hidden bg-gray-50">
                <SafeImage
                    :src="product.image_url"
                    :alt="product.image_alt || product.name"
                    img-class="product-card-image h-full w-full object-cover"
                />
                <span
                    v-if="product.is_featured"
                    class="absolute left-3 top-3 rounded-full bg-gold px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-charcoal"
                >
                    Popular
                </span>
            </div>
            <div class="p-4 pb-0">
                <p class="text-xs text-gray-400 transition-colors group-hover:text-ube">{{ product.category?.name }}</p>
                <h3 class="mt-0.5 font-display text-base font-semibold text-charcoal transition-colors group-hover:text-ube">
                    {{ product.name }}
                </h3>
                <div class="mt-2">
                    <span v-if="product.is_inquiry_only" class="text-sm font-medium text-ube">Price on request</span>
                    <span v-else class="font-semibold text-charcoal">${{ parseFloat(product.price).toFixed(2) }}</span>
                </div>
            </div>
        </Link>

        <div class="mt-auto p-4 pt-3">
            <template v-if="showActions && product.is_inquiry_only">
                <Link
                    :href="route('custom-cakes.create')"
                    class="btn-primary block w-full py-2 text-center text-xs"
                >
                    Request a quote
                </Link>
            </template>

            <template v-else-if="showActions">
                <div v-if="product.variants?.length" class="mb-2 flex flex-wrap gap-1">
                    <button
                        v-for="variant in product.variants"
                        :key="variant"
                        type="button"
                        class="rounded-md border px-2 py-0.5 text-[11px] font-medium transition"
                        :class="selectedVariant === variant
                            ? 'border-ube bg-ube text-white'
                            : 'border-gray-200 text-gray-600 hover:border-ube'"
                        @click="selectedVariant = variant"
                    >
                        {{ variant }}
                    </button>
                </div>
                <div class="flex gap-2">
                    <button
                        type="button"
                        class="flex-1 rounded-lg border border-ube py-2 text-xs font-semibold text-ube transition hover:bg-ube/5"
                        :class="{ '!border-green-600 !bg-green-50 !text-green-700': added }"
                        @click="addToCart"
                    >
                        {{ added ? 'Added ✓' : 'Add to cart' }}
                    </button>
                    <button
                        type="button"
                        class="btn-primary flex-1 !py-2 text-xs"
                        @click="buyNow"
                    >
                        Buy now
                    </button>
                </div>
            </template>

            <Link
                v-else
                :href="route('products.show', product.slug)"
                class="mt-1 inline-block text-xs font-medium text-ube hover:underline"
            >
                View details &rarr;
            </Link>
        </div>
    </div>
</template>
