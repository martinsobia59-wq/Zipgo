<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight, Filter } from 'lucide-vue-next';
import { computed, ref, watch } from 'vue';

interface Package {
    id: number;
    tracking_number: string;
    recipient_name: string;
    status: string;
    created_at: string;
}

const props = defineProps<{
    packages: {
        data: Package[];
        links: { label: string; url: string | null; active: boolean }[];
    };
    filters: {
        search?: string;
        status?: string;
        sort?: string;
        direction?: string;
    };
}>();

const search = ref(props.filters.search || '');
const status = ref(props.filters.status || '');
const sort = ref(props.filters.sort || 'created_at');
const direction = ref(props.filters.direction || 'desc');

function updateFilters() {
    router.get(
        '/packages',
        {
            search: search.value,
            status: status.value,
            sort: sort.value,
            direction: direction.value,
        },
        { preserveState: true, replace: true },
    );
}

// Debounce search
let timeout: number | undefined;
watch(search, () => {
    clearTimeout(timeout);
    timeout = window.setTimeout(updateFilters, 400);
});

function deletePackage(id: number) {
    if (confirm('Are you sure you want to delete this package?')) {
        router.delete(`/packages/${id}`);
    }
}

function resetFilters() {
    search.value = '';
    status.value = '';
    sort.value = 'created_at';
    direction.value = 'desc';
    updateFilters();
}

// Computed: detect if filters are active
const filtersActive = computed(() => {
    return (
        search.value.trim() !== '' ||
        status.value !== '' ||
        sort.value !== 'created_at' ||
        direction.value !== 'desc'
    );
});
</script>

<template>
    <Head title="Packages" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-gray-200"
                >
                    Packages
                </h2>
                <Link
                    href="/packages/create"
                    class="bg-blue-600 hover:bg-blue-700 rounded px-4 py-2 text-white"
                >
                    New Package
                </Link>
            </div>
        </template>

        <div class="space-y-6 px-6 py-12">
            <!-- Search / Filter controls -->
            <div class="flex flex-wrap items-center gap-3">
                <input
                    v-model="search"
                    type="text"
                    placeholder="Search tracking or recipient..."
                    class="rounded border border-white/10 px-3 py-2 focus:ring-0 dark:bg-gray-800 dark:text-white"
                />

                <select
                    v-model="status"
                    @change="updateFilters"
                    class="rounded border border-white/10 px-3 py-2 dark:bg-gray-800 dark:text-white"
                >
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="in_transit">In Transit</option>
                    <option value="delivered">Delivered</option>
                </select>

                <select
                    v-model="sort"
                    @change="updateFilters"
                    class="rounded border border-white/10 px-3 py-2 dark:bg-gray-800 dark:text-white"
                >
                    <option value="created_at">Created</option>
                    <option value="tracking_number">Tracking #</option>
                    <option value="recipient_name">Recipient</option>
                </select>

                <button
                    @click="
                        direction = direction === 'asc' ? 'desc' : 'asc';
                        updateFilters();
                    "
                    class="rounded border border-white/10 px-3 py-2 dark:bg-gray-800 dark:text-white"
                >
                    {{ direction === 'asc' ? '↑ Asc' : '↓ Desc' }}
                </button>

                <!-- Reset button with active indicator -->
                <button
                    @click="resetFilters"
                    class="ml-auto flex items-center gap-1 text-sm text-gray-500 hover:underline"
                >
                    <Filter
                        v-if="filtersActive"
                        class="text-blue-500 h-4 w-4"
                    />
                    <span>{{
                        filtersActive ? 'Filters Applied' : 'Reset'
                    }}</span>
                </button>
            </div>

            <!-- Table -->
            <div
                class="overflow-x-auto rounded bg-white shadow dark:bg-gray-800"
            >
                <table
                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr class="text-lg font-semibold text-white">
                            <th class="px-4 py-2 text-left">Tracking #</th>
                            <th class="px-4 py-2 text-left">Recipient</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Created</th>
                            <th class="px-4 py-2 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody v-if="packages.data.length">
                        <tr
                            v-for="pkg in packages.data"
                            :key="pkg.id"
                            class="border-t border-gray-200 text-white dark:border-gray-700"
                        >
                            <td class="px-4 py-2">
                                <Link
                                    :href="`/packages/${pkg.id}/locations`"
                                    class="text-blue-600 underline"
                                >
                                    {{ pkg.tracking_number }}
                                </Link>
                            </td>
                            <td class="px-4 py-2">{{ pkg.recipient_name }}</td>
                            <td class="px-4 py-2">{{ pkg.status }}</td>
                            <td class="px-4 py-2">
                                {{
                                    new Date(
                                        pkg.created_at,
                                    ).toLocaleDateString()
                                }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                <Link
                                    :href="`/packages/${pkg.id}/edit`"
                                    class="text-blue-600 mr-3 hover:underline"
                                >
                                    Edit
                                </Link>
                                <button
                                    class="text-red-600 hover:underline"
                                    @click="deletePackage(pkg.id)"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div
                    v-if="!packages.data.length"
                    class="p-6 text-center text-gray-500"
                >
                    No packages found.
                </div>

                <div
                    class="flex flex-wrap justify-center gap-1 border-t border-gray-200 p-6 dark:border-gray-700"
                >
                    <Link
                        v-for="link in packages.links"
                        :key="link.label"
                        :href="link.url || '#'"
                        class="flex items-center gap-1 rounded px-3 py-1 text-sm"
                        :class="{
                            'bg-blue-600 text-white': link.active,
                            'cursor-not-allowed text-gray-400': !link.url,
                            'hover:bg-gray-200 dark:hover:bg-gray-700':
                                link.url,
                        }"
                    >
                        <template v-if="link.label.includes('Previous')">
                            <ChevronLeft class="h-4 w-4" />
                        </template>
                        <template v-else-if="link.label.includes('Next')">
                            <ChevronRight class="h-4 w-4" />
                        </template>
                        <template v-else>
                            {{ link.label }}
                        </template>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
