<script setup>
import AnimateIn from '@/Components/Shop/AnimateIn.vue';
import SafeImage from '@/Components/Shop/SafeImage.vue';
import ShopLayout from '@/Layouts/ShopLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Heart, MapPin, Users } from 'lucide-vue-next';
</script>

<template>
    <ShopLayout title="About Us">
        <div>
            <div class="relative overflow-hidden bg-ube py-16 text-white">
                <div
                    v-motion
                    :initial="{ opacity: 0 }"
                    :enter="{ opacity: 0.15, transition: { duration: 1200 } }"
                    class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,_#E8B86D_0%,_transparent_50%)]"
                />
                <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <AnimateIn when="enter" :y="20">
                        <h1 class="font-display text-4xl font-bold">Our Story</h1>
                        <p class="mt-2 text-white/80">A hobby that became a calling</p>
                    </AnimateIn>
                </div>
            </div>

            <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8">
                <AnimateIn :delay="100">
                    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                        <div class="group overflow-hidden">
                            <SafeImage
                                src="/images/seed/kitchen-story.jpg"
                                alt="Nathalie baking in the kitchen"
                                img-class="h-72 w-full object-cover transition duration-700 group-hover:scale-105"
                            />
                        </div>
                        <div class="p-8 md:p-12">
                            <AnimateIn :delay="150" :y="16">
                                <h2 class="font-display text-2xl font-bold text-charcoal">Welcome to Nathalie's Bakeshop</h2>
                            </AnimateIn>

                            <AnimateIn :delay="250" :y="16">
                                <p class="mt-4 leading-relaxed text-gray-600">
                                    What started as a love for baking quickly grew into a passion for sharing the flavors and traditions of the Philippines. When Nathalie moved to Canada, she brought with her cherished family recipes that had been passed down through generations, recipes filled with memories, culture, and the warmth of home.
                                </p>
                            </AnimateIn>

                            <AnimateIn :delay="350" :y="16">
                                <p class="mt-4 leading-relaxed text-gray-600">
                                    Today, Nathalie's Bakeshop proudly brings authentic Filipino delicacies and handcrafted baked goods to the Filipino-Canadian community across the Greater Toronto Area. From traditional favorites to beautifully customized cakes for birthdays, weddings, and special celebrations, every creation is made with care, quality ingredients, and a touch of Filipino hospitality.

More than just a bakery, Nathalie's Bakeshop is dedicated to creating moments of joy and connection through food, offering a comforting taste of home, one bite at a time.
                                </p>
                            </AnimateIn>

                            <div class="mt-10 grid gap-5 sm:grid-cols-3">
                                <AnimateIn :delay="450" :y="24">
                                    <div class="value-card">
                                        <Heart class="value-icon mx-auto h-8 w-8 text-ube" />
                                        <h3 class="mt-3 font-semibold">Family Recipes</h3>
                                        <p class="mt-1 text-sm text-gray-500">Authentic flavors passed down through generations</p>
                                    </div>
                                </AnimateIn>
                                <AnimateIn :delay="550" :y="24">
                                    <div class="value-card">
                                        <Users class="value-icon mx-auto h-8 w-8 text-ube" />
                                        <h3 class="mt-3 font-semibold">Community First</h3>
                                        <p class="mt-1 text-sm text-gray-500">Proudly serving Filipino families across Canada</p>
                                    </div>
                                </AnimateIn>
                                <AnimateIn :delay="650" :y="24">
                                    <div class="value-card">
                                        <MapPin class="value-icon mx-auto h-8 w-8 text-ube" />
                                        <h3 class="mt-3 font-semibold">Locally Baked</h3>
                                        <p class="mt-1 text-sm text-gray-500">Fresh daily from the kitchen</p>
                                    </div>
                                </AnimateIn>
                            </div>

                            <AnimateIn :delay="750" :y="12">
                                <Link :href="route('menu')" class="btn-primary mt-10 inline-block">
                                    Explore the menu
                                </Link>
                            </AnimateIn>
                        </div>
                    </div>
                </AnimateIn>
            </div>
        </div>
    </ShopLayout>
</template>
