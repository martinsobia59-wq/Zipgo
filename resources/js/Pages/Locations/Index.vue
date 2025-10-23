<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    package: {
        id: number;
        tracking_number: string;
        recipient_name: string;
        locations: {
            id: number;
            message: string;
            created_at: string;
        }[];
    };
}>();

const form = useForm({
    message: '',
});

function deleteLocation(locationId: number) {
    if (confirm('Are you sure you want to delete this location?')) {
        router.delete(
            route('packages.locations.destroy', [props.package.id, locationId]),
        );
    }
}

function addLocation() {
    if (!form.message.trim()) return;
    form.post(`/packages/${props.package.id}/locations`, {
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <Head :title="`Package ${props.package.tracking_number}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-gray-200"
                >
                    {{ props.package.tracking_number }} —
                    {{ props.package.recipient_name }}
                </h2>
                <Link
                    href="/packages"
                    class="rounded bg-gray-600 px-3 py-1 text-white hover:bg-gray-700"
                >
                    Back
                </Link>
            </div>
        </template>

        <div class="px-6 py-12">
            <div
                class="mx-auto max-w-2xl rounded bg-white p-6 shadow dark:bg-gray-800"
            >
                <form @submit.prevent="addLocation" class="mb-6 flex gap-3">
                    <input
                        v-model="form.message"
                        type="text"
                        placeholder="Enter new location message..."
                        class="flex-1 rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring focus:ring-blue-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                    />
                    <button
                        type="submit"
                        class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                        :disabled="form.processing"
                    >
                        Add
                    </button>
                </form>

                <div v-if="props.package.locations.length">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li
                            v-for="loc in props.package.locations"
                            :key="loc.id"
                            class="flex w-full items-center justify-between py-3"
                        >
                            <div class="">
                                <div class="text-gray-800 dark:text-gray-100">
                                    {{ loc.message }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{
                                        new Date(
                                            loc.created_at,
                                        ).toLocaleString()
                                    }}
                                </div>
                            </div>
                            <div class="text-gray-800 dark:text-gray-100">
                                <button
                                    class="text-red-600 hover:underline"
                                    @click="deleteLocation(loc.id)"
                                >
                                    Delete
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>

                <div
                    v-else
                    class="p-6 text-center text-gray-500 dark:text-gray-400"
                >
                    No location updates yet.
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
