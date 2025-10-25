<template>
    <div class="sticky top-0 z-50 select-none bg-white" data-nav="true">
        <!-- Top Bar -->
        <div
            class="flex items-center justify-between bg-blue p-10 py-4 text-white lg:px-20"
        >
            <div class="flex items-center gap-3 text-sm">
                <div class="flex items-center gap-2">
                    <AlarmClockMinus class="text-orange-600" size="16" />
                    <span>Mon-Sun: 8am-5pm : Open</span>
                </div>
                <div class="flex items-center gap-2">
                    <Phone class="text-orange-600" size="16" />
                    <span>+1(313)612-7411</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <Link><Facebook :size="16" /></Link>
                <Link><Twitter :size="16" /></Link>
                <Link><Linkedin :size="16" /></Link>
                <Link><Instagram :size="16" /></Link>
            </div>
        </div>

        <!-- Main Nav -->
        <nav
            class="flex w-full items-center justify-between p-8 py-1 lg:px-20 lg:py-2"
        >
            <div class="h-20 w-20">
                <img
                    :src="logo"
                    class="h-full w-full object-contain"
                    alt="Zipgo Logo"
                />
            </div>

            <!-- Desktop Links -->
            <div class="flex justify-between gap-10 max-md:hidden">
                <Link
                    v-for="(item, i) in links"
                    :key="i"
                    :href="item.href"
                    class="text-blue-500 transition-all duration-200 hover:text-gray-500"
                >
                    {{ item.label }}
                </Link>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-5">
                <Link
                    href="/tracking"
                    class="rounded-md bg-orange-600 p-3 text-white transition hover:bg-orange-700"
                >
                    Track Package
                </Link>
                <button @click="toggleMenu" class="md:hidden">
                    <Menu class="text-orange-600" />
                </button>
            </div>
        </nav>

        <!-- Mobile Dropdown -->
        <transition name="fade">
            <div
                v-if="menuOpen"
                class="absolute left-0 z-50 flex w-full flex-col gap-4 bg-white p-6 shadow-md md:hidden"
            >
                <Link
                    v-for="(item, i) in links"
                    :key="i"
                    :href="item.href"
                    class="text-blue-500 text-lg transition-all duration-200 hover:text-orange-600"
                    @click="menuOpen = false"
                >
                    {{ item.label }}
                </Link>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import {
    AlarmClockMinus,
    Facebook,
    Instagram,
    Linkedin,
    Menu,
    Phone,
    Twitter,
} from 'lucide-vue-next';
import { ref } from 'vue';
import logo from '../../../resources/images/logo.png';

const menuOpen = ref(false);

const toggleMenu = () => {
    menuOpen.value = !menuOpen.value;
};

const links = [
    { label: 'Home', href: '/' },
    { label: 'About Us', href: '#about' },
    { label: 'Services', href: '#services' },
    { label: 'FAQ', href: '#faq' },
    { label: 'Contact Us', href: '#contact-us' },
];
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
