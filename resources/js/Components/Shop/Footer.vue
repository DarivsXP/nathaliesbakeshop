<script setup>
import BrandLogo from '@/Components/Shop/BrandLogo.vue';
import { Link } from '@inertiajs/vue3';
import { Facebook, Instagram, Mail, MapPin } from 'lucide-vue-next';
</script>

<template>
    <footer class="relative overflow-hidden bg-charcoal text-white">
        <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-ube/20 blur-3xl" />
        <div class="pointer-events-none absolute -bottom-10 -left-10 h-48 w-48 rounded-full bg-gold/10 blur-3xl" />

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid gap-10 md:grid-cols-3">
                <div>
                    <BrandLogo size="lg" :show-text="false" />
                    <h3 class="mt-4 font-display text-xl font-bold text-gold">Nathalie's Bakeshop</h3>
                    <p class="mt-3 text-sm leading-relaxed text-white/70">
                        Handcrafted Filipino delicacies and custom celebration cakes,
                        baked with love for the Filipino-Canadian community.
                    </p>
                </div>

                <div>
                    <h4 class="mb-4 font-semibold text-gold">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-white/70">
                        <li><Link :href="route('menu')" class="transition hover:translate-x-1 hover:text-white inline-block">Our Menu</Link></li>
                        <li><Link :href="route('custom-cakes.create')" class="transition hover:translate-x-1 hover:text-white inline-block">Custom Cakes</Link></li>
                        <li><Link :href="route('about')" class="transition hover:translate-x-1 hover:text-white inline-block">Our Story</Link></li>
                        <li><Link :href="route('contact')" class="transition hover:translate-x-1 hover:text-white inline-block">Contact Us</Link></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4 font-semibold text-gold">Get in Touch</h4>
                    <ul class="space-y-3 text-sm text-white/70">
                        <li class="flex items-start gap-2">
                            <MapPin class="mt-0.5 h-4 w-4 flex-shrink-0 text-gold" />
                            Québec, Canada
                        </li>
                        <li class="flex items-center gap-2">
                            <Mail class="h-4 w-4 text-gold" />
                            <a href="mailto:nathaliesbakeshop@gmail.com" class="transition hover:text-white">
                                nathaliesbakeshop@gmail.com
                            </a>
                        </li>
                    </ul>
                    <div class="mt-4 flex gap-3">
                        <a href="#" class="rounded-full bg-white/10 p-2 transition hover:scale-110 hover:bg-ube">
                            <Instagram class="h-4 w-4" />
                        </a>
                        <a href="#" class="rounded-full bg-white/10 p-2 transition hover:scale-110 hover:bg-ube">
                            <Facebook class="h-4 w-4" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-10 border-t border-white/10 pt-6 text-center text-xs text-white/50">
                &copy; {{ new Date().getFullYear() }} Nathalie's Bakeshop. All rights reserved.
            </div>
        </div>
    </footer>
</template>
