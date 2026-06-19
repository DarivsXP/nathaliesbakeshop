import { defineStore } from 'pinia';
import { computed, ref, watch } from 'vue';

const STORAGE_KEY = 'nathalies-cart';

function loadCart() {
    try {
        const stored = localStorage.getItem(STORAGE_KEY);
        return stored ? JSON.parse(stored) : [];
    } catch {
        return [];
    }
}

export const useCartStore = defineStore('cart', () => {
    const items = ref(loadCart());
    const justAdded = ref(false);

    watch(
        items,
        (value) => {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(value));
        },
        { deep: true },
    );

    const itemCount = computed(() =>
        items.value.reduce((sum, item) => sum + item.quantity, 0),
    );

    const subtotal = computed(() =>
        items.value.reduce((sum, item) => sum + item.price * item.quantity, 0),
    );

    function addItem(product, quantity = 1, variant = null) {
        const existing = items.value.find(
            (item) => item.productId === product.id && item.variant === variant,
        );

        if (existing) {
            existing.quantity += quantity;
        } else {
            items.value.push({
                productId: product.id,
                name: product.name,
                slug: product.slug,
                price: parseFloat(product.price),
                image: product.image_url,
                quantity,
                variant,
            });
        }

        justAdded.value = true;
        setTimeout(() => {
            justAdded.value = false;
        }, 400);
    }

    function updateQuantity(productId, variant, quantity) {
        const item = items.value.find(
            (i) => i.productId === productId && i.variant === variant,
        );
        if (item) {
            item.quantity = Math.max(1, quantity);
        }
    }

    function removeItem(productId, variant) {
        items.value = items.value.filter(
            (i) => !(i.productId === productId && i.variant === variant),
        );
    }

    function clear() {
        items.value = [];
    }

    function toOrderPayload() {
        return items.value.map((item) => ({
            product_id: item.productId,
            quantity: item.quantity,
            variant: item.variant,
        }));
    }

    return {
        items,
        justAdded,
        itemCount,
        subtotal,
        addItem,
        updateQuantity,
        removeItem,
        clear,
        toOrderPayload,
    };
});
