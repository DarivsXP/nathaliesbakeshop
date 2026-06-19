<script setup>
import AnimateIn from '@/Components/Shop/AnimateIn.vue';
import ProductCard from '@/Components/Shop/ProductCard.vue';
import SafeImage from '@/Components/Shop/SafeImage.vue';
import ShopLayout from '@/Layouts/ShopLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    featuredProducts: Array,
    heroImage: String,
});
</script>

<template>
    <ShopLayout title="Home">
        <div>
            <!-- Hero -->
            <section class="relative overflow-hidden bg-charcoal">
                <SafeImage
                    :src="heroImage"
                    alt="Fresh baked goods"
                    img-class="hero-ken-burns absolute inset-0 h-full w-full object-cover opacity-45"
                />
                <div class="absolute inset-0 bg-gradient-to-r from-charcoal/95 via-charcoal/70 to-charcoal/40" />

                <div class="relative mx-auto flex min-h-[80vh] max-w-7xl items-center px-4 py-20 sm:px-6 lg:px-8">
                    <div class="max-w-xl">
                        <AnimateIn when="enter" :delay="0" :y="16">
                            <p class="text-sm font-medium tracking-wide text-gold">Greater Toronto Area</p>
                        </AnimateIn>
                        <AnimateIn when="enter" :delay="100" :y="24">
                            <h1 class="mt-2 font-display text-4xl font-bold leading-tight text-white md:text-5xl lg:text-6xl">
                                Filipino flavors,<br />
                                <span class="text-gold">baked with love</span>
                            </h1>
                        </AnimateIn>
                        <AnimateIn when="enter" :delay="220" :y="20">
                            <p class="mt-5 text-lg leading-relaxed text-white/85">
                                Hand-folded empanadas, ube buko pies, and cakes for your celebrations —
                                recipes from home, baked here in Canada.
                            </p>
                        </AnimateIn>
                        <AnimateIn when="enter" :delay="340" :y="16">
                            <div class="mt-8 flex flex-wrap gap-3">
                                <Link :href="route('menu')" class="btn-gold">View menu</Link>
                                <Link
                                    :href="route('custom-cakes.create')"
                                    class="btn-secondary !border-white/50 !text-white hover:!bg-white hover:!text-charcoal"
                                >
                                    Custom cakes
                                </Link>
                            </div>
                        </AnimateIn>
                    </div>

                    <AnimateIn when="enter" :delay="200" :scale="0.85" class="hidden lg:block">
                        <img
                            src="/logo.png"
                            alt="Nathalie's Bakeshop"
                            class="h-52 w-52 rounded-full object-cover shadow-2xl ring-4 ring-gold/40 xl:h-64 xl:w-64"
                            v-motion
                            :hover="{ scale: 1.05, rotate: 2, transition: { type: 'spring', stiffness: 200 } }"
                        />
                    </AnimateIn>
                </div>

                <div class="absolute bottom-8 left-1/2 hidden -translate-x-1/2 md:block">
                    <div class="scroll-hint flex flex-col items-center gap-1 text-white/50">
                        <span class="text-[10px] uppercase tracking-widest">Scroll</span>
                        <div class="h-8 w-px bg-white/30" />
                    </div>
                </div>
            </section>

            <!-- Featured -->
            <section class="py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <AnimateIn>
                        <div class="mb-10 flex items-end justify-between">
                            <div>
                                <h2 class="section-title">Popular picks</h2>
                                <p class="mt-1 text-sm text-gray-500">What our regulars order most</p>
                            </div>
                            <Link :href="route('menu')" class="text-sm font-medium text-ube transition hover:translate-x-1">
                                Full menu &rarr;
                            </Link>
                        </div>
                    </AnimateIn>
                    <div v-if="featuredProducts?.length" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <AnimateIn
                            v-for="(product, i) in featuredProducts"
                            :key="product.id"
                            :delay="i * 80"
                            :y="32"
                        >
                            <ProductCard :product="product" :index="i" />
                        </AnimateIn>
                    </div>
                </div>
            </section>

            <!-- About teaser -->
            <section class="border-t border-gray-100 bg-white py-16">
                <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
                    <AnimateIn :x="-30">
                        <div class="group overflow-hidden rounded-2xl shadow-md">
                            <SafeImage
                                src="/images/seed/kitchen-story.jpg"
                                alt="Baking in the kitchen"
                                img-class="w-full object-cover transition duration-700 group-hover:scale-105"
                            />
                        </div>
                    </AnimateIn>
                    <AnimateIn :delay="150" :x="30">
                        <div>
                            <h2 class="font-display text-2xl font-bold text-charcoal">From hobby to heart</h2>
                            <p class="mt-4 leading-relaxed text-gray-600">
                                It began as weekend baking — a creative outlet, a way to unwind. But every batch
                                drew more compliments, more requests, and more joy. What started as a hobby became
                                a passion, and now Nathalie's Bakeshop serves the Filipino community across the GTA
                                with the same love that started it all.
                            </p>
                            <Link :href="route('about')" class="btn-primary mt-6 inline-block">Read our story</Link>
                        </div>
                    </AnimateIn>
                </div>
            </section>
        </div>
    </ShopLayout>
</template>
