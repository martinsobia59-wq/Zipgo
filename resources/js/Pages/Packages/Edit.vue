<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Package {
    id: number;
    tracking_number: string;
    recipient_name: string;
    status: string;
}

const props = defineProps<{ package: Package }>();

const form = ref({
    recipient_name: props.package.recipient_name,
    status: props.package.status,
});

function updatePackage() {
    router.put(`/packages/${props.package.id}`, form.value);
}
</script>

<template>
    <Head title="Edit Package" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-gray-200"
                >
                    Edit Package
                </h2>
                <Link
                    href="/packages"
                    class="rounded bg-gray-600 px-3 py-1 text-white hover:bg-gray-700"
                >
                    Back
                </Link>
            </div>
        </template>

        <div
            class="mx-auto mt-10 max-w-2xl rounded bg-white p-8 shadow dark:bg-gray-800"
        >
            <form @submit.prevent="updatePackage" class="space-y-6">
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                    >
                        Tracking Number
                    </label>
                    <input
                        type="text"
                        :value="props.package.tracking_number"
                        disabled
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                    />
                </div>

                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                    >
                        Recipient Name
                    </label>
                    <input
                        v-model="form.recipient_name"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                    />
                </div>

                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                    >
                        Status
                    </label>
                    <select
                        v-model="form.status"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                    >
                        <option>Pending</option>
                        <option>In Transit</option>
                        <option>Delivered</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                    >
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
