<template>
    <footer class="flex flex-col bg-blue/90 text-white">
        <section
            class="grid grid-cols-1 gap-7 p-10 py-6 md:grid-cols-2 md:flex-row lg:grid-cols-4 lg:px-20"
        >
            <div class="flex flex-col gap-3">
                <img :src="logo" alt="" class="size-20 md:size-40" />
                <p>
                    Representative logistic operator providing full range of
                    service in the sphere of customs clearance and transportaion
                    worldwide.
                </p>
                <div class="flex items-center gap-3">
                    <Link>
                        <Facebook :size="16" />
                    </Link>
                    <Link><Twitter :size="16" /></Link>
                    <Link><Linkedin :size="16" /></Link>
                    <Link><Instagram :size="16" /></Link>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <h3 class="text-2xl font-semibold underline">USEFUL LINKS</h3>
                <Link href="#about" class="flex items-center gap-2">
                    <MoveRight /> About Us</Link
                >
                <Link href="#services" class="flex items-center gap-2">
                    <MoveRight /> Services</Link
                >
                <Link class="flex items-center gap-2">
                    <MoveRight /> Contact Us</Link
                >
            </div>
            <div class="flex flex-col gap-4">
                <h3 class="text-2xl font-semibold underline">USEFUL LINKS</h3>
                <Link class="flex items-center gap-2">
                    <MoveRight /> Air Freight</Link
                >
                <Link class="flex items-center gap-2">
                    <MoveRight /> Ocean Freight</Link
                >
                <Link class="flex items-center gap-2">
                    <MoveRight /> Railway Freight</Link
                >
                <Link class="flex items-center gap-2">
                    <MoveRight /> Warehousing</Link
                >
                <Link class="flex items-center gap-2">
                    <MoveRight /> Distribution</Link
                >
            </div>
            <div class="flex flex-col gap-4">
                <h3 class="text-2xl font-semibold underline">SUBSCRIBE NOW</h3>
                <p>
                    Join our Newsletter and Receive Updates about Our Packages.
                </p>
                <div class="flex items-center">
                    <input
                        type="email"
                        class="border-none text-black focus:outline-none focus:ring-0"
                        placeholder="Email address"
                    />
                    <button class="h-full bg-orange-600 p-2 px-3">
                        <Send />
                    </button>
                </div>
            </div>
        </section>
        <section
            class="flex w-full flex-col items-center justify-between bg-[#161922] p-4 text-white md:flex-row"
        >
            <p>
                Copyright 2025 By <span class="text-orange-500">Zipgo</span>,
                All rights reserved.
            </p>
            <p>Terms & Condition | Privacy & Policy</p>
        </section>
    </footer>
</template>

<script setup lang="ts">
import logo from '../../../resources/images/logo.png';

import { Link } from '@inertiajs/vue3';
import {
    Facebook,
    Instagram,
    Linkedin,
    MoveRight,
    Send,
    Twitter,
} from 'lucide-vue-next';
</script>
