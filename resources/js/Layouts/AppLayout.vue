<template>
    <div class="flex min-h-screen flex-col">
        <!-- Header -->
        <AppHeader />

        <!-- Page content -->
        <main class="flex-1">
            <slot />
        </main>

        <!-- Footer -->
        <AppFooter />
    </div>
</template>

<script setup lang="ts">
import AppFooter from '@/Components/AppFooter.vue';
import AppHeader from '@/Components/AppHeader.vue';
</script>
