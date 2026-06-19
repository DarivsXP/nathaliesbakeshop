<script setup>
import AnimateIn from '@/Components/Shop/AnimateIn.vue';
import FlashMessage from '@/Components/Shop/FlashMessage.vue';
import ProductCard from '@/Components/Shop/ProductCard.vue';
import ShopLayout from '@/Layouts/ShopLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    sampleCakes: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    customer_name: '',
    customer_email: '',
    customer_phone: '',
    event_date: '',
    servings: '',
    flavor: '',
    design_notes: '',
    reference_image: null,
});

const preview = ref(null);

function onFileChange(event) {
    const file = event.target.files[0];
    form.reference_image = file;
    preview.value = file ? URL.createObjectURL(file) : null;
}

function submit() {
    form.post(route('custom-cakes.store'), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            preview.value = null;
        },
    });
}
</script>

<template>
    <ShopLayout title="Custom Cakes">
        <div>
            <div class="border-b border-ube/10 bg-white py-14">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <AnimateIn when="enter">
                        <h1 class="font-display text-3xl font-bold text-charcoal md:text-4xl">Custom Cakes</h1>
                        <p class="mt-2 max-w-xl text-gray-600">
                            Birthdays, debuts, weddings, baptisms — tell us your date and vision, and we'll send a quote within 48 hours.
                        </p>
                    </AnimateIn>
                </div>
            </div>

            <section v-if="sampleCakes.length" class="border-b border-gray-100 bg-cream py-12">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <AnimateIn>
                        <h2 class="font-display text-xl font-semibold text-charcoal">Sample designs</h2>
                        <p class="mt-1 text-sm text-gray-500">A few cakes we've made — yours can be completely custom.</p>
                    </AnimateIn>
                    <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <AnimateIn v-for="(cake, i) in sampleCakes" :key="cake.id" :delay="i * 90">
                            <ProductCard :product="cake" :index="i" />
                        </AnimateIn>
                    </div>
                </div>
            </section>

            <div class="mx-auto max-w-2xl px-4 py-12 sm:px-6 lg:px-8">
                <AnimateIn :delay="100">
                <div class="mb-6 rounded-xl bg-ube/5 p-5 text-sm text-gray-600">
                    <strong class="text-charcoal">How it works:</strong>
                    fill out the form below, we'll reply with a quote. A 50% deposit holds your date.
                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
                    <FlashMessage />
                    <form class="space-y-5" @submit.prevent="submit">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-1 block text-sm font-medium">Your name</label>
                                <input v-model="form.customer_name" type="text" class="input-field" required />
                                <p v-if="form.errors.customer_name" class="mt-1 text-sm text-red-500">{{ form.errors.customer_name }}</p>
                            </div>
                            <div>
                                <label class="mb-1 block text-sm font-medium">Phone</label>
                                <input v-model="form.customer_phone" type="tel" class="input-field" required />
                                <p v-if="form.errors.customer_phone" class="mt-1 text-sm text-red-500">{{ form.errors.customer_phone }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Email</label>
                            <input v-model="form.customer_email" type="email" class="input-field" required />
                            <p v-if="form.errors.customer_email" class="mt-1 text-sm text-red-500">{{ form.errors.customer_email }}</p>
                        </div>
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-1 block text-sm font-medium">Event date</label>
                                <input v-model="form.event_date" type="date" class="input-field" required />
                                <p v-if="form.errors.event_date" class="mt-1 text-sm text-red-500">{{ form.errors.event_date }}</p>
                            </div>
                            <div>
                                <label class="mb-1 block text-sm font-medium">Servings</label>
                                <input v-model="form.servings" type="number" min="1" class="input-field" required />
                                <p v-if="form.errors.servings" class="mt-1 text-sm text-red-500">{{ form.errors.servings }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Flavor</label>
                            <input v-model="form.flavor" type="text" class="input-field" placeholder="Ube, mango, chocolate, red velvet..." required />
                            <p v-if="form.errors.flavor" class="mt-1 text-sm text-red-500">{{ form.errors.flavor }}</p>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Design notes</label>
                            <textarea
                                v-model="form.design_notes"
                                rows="4"
                                class="input-field"
                                placeholder="Theme, colors, topper ideas, allergies..."
                            />
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Reference photo (optional)</label>
                            <input
                                type="file"
                                accept="image/*"
                                class="input-field file:mr-3 file:rounded-lg file:border-0 file:bg-ube/10 file:px-3 file:py-1 file:text-sm file:font-medium file:text-ube"
                                @change="onFileChange"
                            />
                            <img v-if="preview" :src="preview" alt="Your reference" class="mt-3 max-h-40 rounded-lg object-cover" />
                        </div>
                        <button type="submit" class="btn-primary w-full" :disabled="form.processing">
                            Send inquiry
                        </button>
                    </form>
                </div>

                <p class="mt-6 text-center text-sm text-gray-500">
                    Prefer to browse first?
                    <Link :href="route('menu')" class="font-medium text-ube hover:underline">See the full menu</Link>
                </p>
                </AnimateIn>
            </div>
        </div>
    </ShopLayout>
</template>
