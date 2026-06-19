<script setup>
import FlashMessage from '@/Components/Shop/FlashMessage.vue';
import ShopLayout from '@/Layouts/ShopLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { Clock, Mail, MapPin, Phone } from 'lucide-vue-next';

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

function submit() {
    form.post(route('contact.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <ShopLayout title="Contact">
        <div class="bg-ube py-12 text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h1 class="font-display text-4xl font-bold">Contact Us</h1>
                <p class="mt-2 text-white/80">We'd love to hear from you</p>
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-2">
                <div>
                    <h2 class="section-title">Get in Touch</h2>
                    <p class="mt-4 text-gray-600">
                        Have a question about our menu, need help with a custom cake order,
                        or want to discuss catering? Send us a message and we'll respond within 24 hours.
                    </p>

                    <ul class="mt-8 space-y-5">
                        <li class="flex items-start gap-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-ube/10">
                                <MapPin class="h-5 w-5 text-ube" />
                            </div>
                            <div>
                                <p class="font-semibold">Location</p>
                                <p class="text-sm text-gray-500">Québec, Canada</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-ube/10">
                                <Phone class="h-5 w-5 text-ube" />
                            </div>
                            <div>
                                <p class="font-semibold">Phone</p>
                                <p class="text-sm text-gray-500">(416) 5555555</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-ube/10">
                                <Mail class="h-5 w-5 text-ube" />
                            </div>
                            <div>
                                <p class="font-semibold">Email</p>
                                <p class="text-sm text-gray-500">nathaliesbakeshop@gmail.com</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-ube/10">
                                <Clock class="h-5 w-5 text-ube" />
                            </div>
                            <div>
                                <p class="font-semibold">Hours</p>
                                <p class="text-sm text-gray-500">Tue–Sat: 8am – 6pm · Sun: 9am – 3pm · Mon: Closed</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="card p-8">
                    <FlashMessage />
                    <form class="space-y-5" @submit.prevent="submit">
                        <div>
                            <label class="mb-1 block text-sm font-medium">Name</label>
                            <input v-model="form.name" type="text" class="input-field" required />
                            <p v-if="form.errors.name" class="mt-1 text-sm text-red-500">{{ form.errors.name }}</p>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Email</label>
                            <input v-model="form.email" type="email" class="input-field" required />
                            <p v-if="form.errors.email" class="mt-1 text-sm text-red-500">{{ form.errors.email }}</p>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Subject</label>
                            <input v-model="form.subject" type="text" class="input-field" required />
                            <p v-if="form.errors.subject" class="mt-1 text-sm text-red-500">{{ form.errors.subject }}</p>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Message</label>
                            <textarea v-model="form.message" rows="5" class="input-field" required />
                            <p v-if="form.errors.message" class="mt-1 text-sm text-red-500">{{ form.errors.message }}</p>
                        </div>
                        <button type="submit" class="btn-primary w-full" :disabled="form.processing">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </ShopLayout>
</template>
