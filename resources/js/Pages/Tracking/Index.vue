<template>
    <AppLayout>
        <section
            class="relative min-h-[calc(100dvh-8.6rem)] p-10 text-white transition-all duration-[1500ms] lg:px-20"
            :style="{
                backgroundImage: `url(${bg1})`,
                backgroundSize: 'cover',
                backgroundPosition: 'center',
            }"
        >
            <div class="absolute inset-0 z-0 bg-black/40"></div>

            <div
                class="relative z-10 mx-auto flex h-full max-w-2xl flex-col justify-center gap-8"
            >
                <!-- Tracking input -->
                <div class="flex items-center gap-3">
                    <input
                        v-model="trackingNumber"
                        placeholder="Enter tracking number"
                        class="focus:ring-blue-400 flex-1 rounded-lg border border-white/30 bg-white/10 px-4 py-2 text-white placeholder-gray-300 focus:outline-none focus:ring-2"
                    />
                    <button
                        @click="trackPackage"
                        class="bg-blue-600 hover:bg-blue-700 rounded-lg px-4 py-2 font-semibold text-white"
                    >
                        Track
                    </button>
                </div>

                <!-- Package details -->
                <div
                    v-if="pkg"
                    class="space-y-4 rounded-lg bg-white/10 p-6 backdrop-blur-md"
                >
                    <h2 class="text-xl font-semibold">
                        Tracking #{{ pkg.tracking_number }}
                    </h2>
                    <p>Recipient: {{ pkg.recipient_name }}</p>
                    <p>Status: {{ pkg.status }}</p>

                    <!-- Locations list -->
                    <div v-if="pkg.locations && pkg.locations.length">
                        <h3 class="mb-3 mt-6 text-lg font-semibold">
                            Current Route
                        </h3>
                        <ul class="space-y-2">
                            <li
                                v-for="(loc, i) in pkg.locations"
                                :key="loc.id"
                                class="flex items-start gap-3"
                            >
                                <div
                                    class="mt-1 h-3 w-3 flex-shrink-0 rounded-full"
                                    :class="
                                        i === 0 ? 'bg-green-400' : 'bg-gray-400'
                                    "
                                ></div>
                                <div>
                                    <p class="font-medium">
                                        {{ loc.message }}
                                    </p>
                                    <p class="text-sm text-gray-300">
                                        {{
                                            new Date(
                                                loc.created_at,
                                            ).toLocaleString()
                                        }}
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div v-else class="italic text-gray-300">
                        No location updates yet.
                    </div>
                </div>

                <div
                    v-else-if="notFound"
                    class="rounded bg-red-600/80 p-3 text-center"
                >
                    No package found with that tracking number.
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup lang="ts">
import bg1 from '@/../../resources/images/1.png';
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Package {
    id: number;
    tracking_number: string;
    recipient_name: string;
    status: string;
    locations?: {
        id: number;
        message: string;
        created_at: string;
    }[];
}

// Props (if coming from Inertia)
const props = defineProps<{
    pkg?: Package | null;
}>();

const trackingNumber = ref(props.pkg?.tracking_number || '');
const pkg = ref(props.pkg || null);
const notFound = ref(false);

function trackPackage() {
    if (!trackingNumber.value.trim()) return;

    router.get(
        `/track/${trackingNumber.value}`,
        {},
        {
            preserveState: true,
            onSuccess: (page) => {
                pkg.value = page.props.pkg as Package;
                notFound.value = !page.props.pkg;
            },
        },
    );
}
</script>
