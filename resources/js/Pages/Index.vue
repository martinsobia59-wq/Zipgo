<template>
    <AppLayout>
        <section
            class="relative h-[calc(100dvh-8.6rem)] p-10 text-white transition-all duration-[1500ms] lg:px-20"
            :style="{
                backgroundImage: `url(${currentBg})`,
                backgroundSize: 'cover',
                backgroundPosition: 'center',
            }"
        >
            <!-- Overlay -->
            <div class="absolute inset-0 z-0 bg-black/40"></div>

            <!-- Content -->
            <div
                class="relative z-10 mr-auto flex h-full max-w-lg flex-col justify-center gap-5 overflow-hidden"
            >
                <!-- Animate header and description -->
                <Transition name="slide-fade" mode="out-in">
                    <div :key="index" class="space-y-5">
                        <h1
                            class="mb-4 text-3xl font-black text-white md:text-5xl lg:text-7xl"
                        >
                            {{ items[index].header }}
                        </h1>
                        <p class="text-gray-200">
                            {{ items[index].description }}
                        </p>
                        <div class="flex items-center gap-3">
                            <Link class="bg-orange-600 p-3" href="/tracking"
                                >Track Package</Link
                            >
                            <Link
                                class="bg-white p-3 text-black"
                                href="/contact"
                                >Contact Us</Link
                            >
                        </div>
                    </div>
                </Transition>
                <div class="mt-10 flex items-center gap-2 self-center">
                    <button
                        @click="goToPrevious"
                        class="group rounded-full bg-white p-5 transition-colors duration-300 hover:bg-orange-600"
                    >
                        <MoveRight
                            class="rotate-180 text-red-500 transition-colors duration-300 group-hover:text-white"
                        />
                    </button>
                    <button
                        @click="goToNext"
                        class="group rounded-full bg-white p-5 transition-colors duration-300 hover:bg-orange-600"
                    >
                        <MoveRight
                            class="text-red-500 transition-colors duration-300 group-hover:text-white"
                        />
                    </button>
                </div>
            </div>
        </section>
        <section class="flex flex-col gap-14 bg-[#FEFEFE] p-10 pt-0 lg:px-20">
            <div
                class="z-10 -mt-5 flex flex-col gap-6 rounded-xl border bg-white p-9 shadow"
            >
                <span
                    class="self-start rounded-xl border-x-2 border-b-2 border-orange-600 p-3 text-center font-semibold text-orange-500"
                    >FEATURES</span
                >
                <h3 class="text-3xl font-bold">WHAT WE OFFER</h3>
                <p class="border-l-4 border-orange-500 pl-2">
                    Zipgo Provides the Best and Affordable Logistics, Freight
                    and Cargo Services.
                </p>
                <div
                    ref="offeringRef"
                    class="scrollbar-hidden grid snap-x snap-mandatory auto-cols-[50%] grid-flow-col gap-3 overflow-x-auto scroll-smooth"
                >
                    <div
                        v-for="(offering, idx) in offerings"
                        :key="idx"
                        class="flex snap-start flex-col items-start gap-5"
                    >
                        <component
                            :is="comp(offering.name)"
                            :size="40"
                            class="text-orange-500"
                        ></component>
                        <p class="text-2xl font-bold">{{ offering.name }}</p>
                        <p>{{ offering.description }}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-5 sm:flex-row">
                <img :src="bg3" class="size-[32rem]" alt="" />
                <div class="flex flex-col gap-5 p-2 md:p-9">
                    <span
                        class="self-start rounded-xl border-x-2 border-b-2 border-orange-600 p-3 text-center font-semibold text-orange-500"
                        >We are</span
                    >
                    <h3 class="text-3xl font-bold">
                        Professional Logistics & Cargo Agency
                    </h3>
                    <p class="border-l-4 border-orange-500 pl-2">
                        Our Company is founded on:
                    </p>
                    <div class="flex items-center gap-2 font-bold">
                        <BadgeCheck class="text-orange-500" />
                        Reliability
                    </div>
                    <div class="flex items-center gap-2 font-bold">
                        <BadgeCheck class="text-orange-500" />
                        Swift Delivery
                    </div>
                    <div class="flex items-center gap-2 font-bold">
                        <BadgeCheck class="text-orange-500" />
                        Team Work and
                    </div>
                    <div class="flex items-center gap-2 font-bold">
                        <BadgeCheck class="text-orange-500" />
                        Real-Time Tracking
                    </div>
                </div>
            </div>
            <div class="inline-flex h-1 border-t"></div>
            <div class="flex items-center justify-between">
                <Link
                    href="/about"
                    class="rounded-md bg-orange-600 p-3 text-white transition hover:bg-orange-700"
                    >ABOUT MORE</Link
                >
                <div class="flex items-center gap-2">
                    <img :src="bg4" />
                    <div class="flex flex-col items-center gap-1 divide-y">
                        <img :src="signature" class="h-10 w-14" />
                        <span class="text-sm">CEO, Of Company</span>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="flex flex-col items-center justify-center gap-4 bg-[#FEFEFE] p-10 lg:p-20"
        >
            <span
                class="rounded-xl border-x-2 border-b-2 border-orange-600 p-3 text-center font-semibold text-orange-500"
                >TEAM MEMBERS</span
            >
            <h3 class="text-3xl font-bold">OUR PROFESSIONAL TEAM</h3>
            <p class="">
                These are the Secret Ingredients to our Years of Success.
            </p>
            <div
                ref="teamRef"
                class="scrollbar-hidden grid snap-x snap-mandatory auto-cols-[49%] grid-flow-col gap-2 overflow-x-auto scroll-smooth md:auto-cols-[32%]"
            >
                <div
                    v-for="(member, idx) in teamMembers"
                    :key="idx"
                    class="flex snap-start flex-col items-start overflow-hidden rounded-lg border"
                >
                    <img :src="member.imageURL" />
                    <div
                        class="relative flex w-full flex-col items-center justify-center rounded p-8"
                    >
                        <span
                            class="absolute -top-7 right-4 flex size-14 items-center justify-center rounded-full bg-orange-600/30"
                        >
                            <span
                                class="flex size-[2.5rem] items-center justify-center rounded-full bg-orange-500/60"
                            >
                                <Plus class="text-white"
                            /></span>
                        </span>
                        <p class="text-2xl font-bold">
                            {{ member.name }}
                        </p>
                        <p>{{ member.role }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="flex flex-col items-center justify-center gap-4 bg-[#FEFEFE] p-10 lg:p-20"
        >
            <div
                class="flex h-96 w-full flex-col items-center justify-center gap-3 bg-cover bg-center p-4"
                :style="{
                    backgroundImage: `url(${bg8})`,
                }"
            >
                <span
                    class="self-center rounded-xl border-x-2 border-b-2 border-orange-600 p-3 text-center font-semibold text-orange-500"
                    >LET'S TALK</span
                >
                <h3 class="text-center text-3xl font-bold text-white">
                    YOU NEED ANY HELP? GET FREE CONSULTATION
                </h3>

                <div class="flex items-center gap-5 text-white">
                    <div
                        class="relative flex h-[2.5rem] w-[2.5rem] items-center justify-center"
                    >
                        <span
                            class="absolute my-auto flex size-14 items-center justify-center rounded-full bg-orange-600/30"
                        >
                            <span
                                class="flex size-[2.5rem] items-center justify-center rounded-full bg-orange-500/60"
                            >
                                <Phone class="text-white" :size="20"
                            /></span>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-2xl font-bold">Have any question</p>
                        <p class="text-xl font-bold text-orange-500">
                            24/7 Customer Support
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import {
    BadgeCheck,
    BriefcaseConveyorBelt,
    CarFront,
    MoveRight,
    Phone,
    Plane,
    Plus,
    Ship,
} from 'lucide-vue-next';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

import bg1 from '@/../../resources/images/1.png';
import bg2 from '@/../../resources/images/2.png';
import bg3 from '@/../../resources/images/3.jpeg';
import bg4 from '@/../../resources/images/4.png';
import bg5 from '@/../../resources/images/5.png';
import bg6 from '@/../../resources/images/6.png';
import bg7 from '@/../../resources/images/7.png';
import bg8 from '@/../../resources/images/8.png';
import signature from '@/../../resources/images/signature.png';

const items = [
    {
        header: 'Fast Certified & Best World Wide Service',
        description:
            'Get Packages delivered to any location worldwide with Security, Safety and Speedy Delivery Guaranteed along with Real-time Package Tracker.',
        image: bg1,
    },
    {
        header: 'Express Shipping & Cargo Solution',
        description:
            'Representative logistics operator providing full range services in the sphere of customs clearance and transportation worldwide.',
        image: bg2,
    },
];

const offerings = [
    {
        name: 'Land Transport',
        description:
            'Land freight comprises two main modes of transport; road and rail. Rail freight sees goods loaded onto trains..',
    },
    {
        name: 'Air Freight',
        description:
            'We continue to improve our services to guarantee a competent, quick and accurate transportation handling process..',
    },
    {
        name: 'Cargo Storage',
        description:
            'With our flexible warehouse solutions and added services, you will benefit from modern and secured storage facilities worldwide, indoor as well as outdoor.',
    },
    {
        name: 'Ocean Freight',
        description:
            'Providing Perfect Shipping Document (Form M & PAAR), 20 & 40 fit Container shipping by Sea, Groupage Shipping, Customs Clearing.',
    },
];

const teamMembers = [
    { name: 'Mishel Marsh', role: 'Director', imageURL: bg5 },
    { name: 'John Doe', role: 'Supervisor', imageURL: bg6 },
    { name: 'Jane Smith', role: 'Coordinator', imageURL: bg7 },
];

const index = ref(0);
const currentBg = ref(items[index.value].image);

const images = items.map((item) => item.image);
const offeringRef = ref<HTMLElement | null>(null);
const teamRef = ref<HTMLElement | null>(null);

let heroImageInterval: ReturnType<typeof setInterval>;
let scrollInterval: ReturnType<typeof setInterval>;

const goToNext = () => {
    index.value = (index.value + 1) % images.length;
    currentBg.value = images[index.value];
};

const goToPrevious = () => {
    index.value = (index.value - 1 + images.length) % images.length;
    currentBg.value = images[index.value];
};

const comp = computed(() => (offeringName: string) => {
    switch (offeringName) {
        case 'Ocean Freight':
            return Ship;
        case 'Air Freight':
            return Plane;
        case 'Land Transport':
            return CarFront;
        case 'Cargo Storage':
            return BriefcaseConveyorBelt;
        default:
            return '';
    }
});

// --- Infinite horizontal scrolling helper ---
const scrollHorizontally = (el: HTMLElement | null, index: number) => {
    if (!el) return;

    const children = el.children;
    if (!children.length) return;

    const child = children[index] as HTMLElement;
    if (!child) return;

    const shift =
        child.offsetWidth + parseFloat(getComputedStyle(el).gap || '0');

    // When at end, scroll back to start instantly
    if (index === 0) {
        el.scrollTo({ left: 0, behavior: 'auto' });
    } else {
        el.scrollBy({ left: shift, behavior: 'smooth' });
    }
};

// --- Main mount logic ---
onMounted(() => {
    // Rotate hero images
    heroImageInterval = setInterval(goToNext, 9000);

    // Track scroll indices per section
    let offeringIdx = 0;
    let teamIdx = 0;

    const scrollSpeed = 5000;

    scrollInterval = setInterval(() => {
        const offeringEl = offeringRef.value;
        const teamEl = teamRef.value;

        scrollHorizontally(offeringEl, offeringIdx);
        scrollHorizontally(teamEl, teamIdx);

        offeringIdx = (offeringIdx + 1) % (offeringEl?.children.length || 1);
        teamIdx = (teamIdx + 1) % (teamEl?.children.length || 1);
    }, scrollSpeed);
});

onBeforeUnmount(() => {
    clearInterval(heroImageInterval);
    clearInterval(scrollInterval);
});
</script>

<style scoped>
/* Transition for text sliding from left and fading in */
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 1.1s ease;
}

.slide-fade-enter-from {
    opacity: 0;
    transform: translateX(-10px);
}
.slide-fade-leave-to {
    opacity: 0;
    transform: translateX(10px);
}
</style>
