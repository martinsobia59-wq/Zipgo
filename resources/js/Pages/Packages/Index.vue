<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

interface Package {
    id: number;
    tracking_number: string;
    recipient_name: string;
    status: string;
    created_at: string;
}

defineProps<{
    packages: Package[];
}>();

function deletePackage(id: number) {
    if (confirm('Are you sure you want to delete this package?')) {
        router.delete(`/packages/${id}`);
    }
}
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
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    New Package
                </Link>
            </div>
        </template>

        <div class="px-6 py-12">
            <div
                class="overflow-x-auto rounded bg-white shadow dark:bg-gray-800"
            >
                <table
                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-4 py-2 text-left text-sm font-semibold"
                            >
                                Tracking #
                            </th>
                            <th
                                class="px-4 py-2 text-left text-sm font-semibold"
                            >
                                Recipient
                            </th>
                            <th
                                class="px-4 py-2 text-left text-sm font-semibold"
                            >
                                Status
                            </th>
                            <th
                                class="px-4 py-2 text-left text-sm font-semibold"
                            >
                                Created
                            </th>
                            <th
                                class="px-4 py-2 text-right text-sm font-semibold"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="pkg in packages"
                            :key="pkg.id"
                            class="border-t border-gray-200 dark:border-gray-700"
                        >
                            <td class="px-4 py-2">
                                <Link
                                    :href="`/packages/${pkg.id}/locations`"
                                    class="text-blue-600 hover:underline"
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
                                    class="mr-3 text-blue-600 hover:underline"
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
                    v-if="!packages.length"
                    class="p-6 text-center text-gray-500"
                >
                    No packages found.
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
