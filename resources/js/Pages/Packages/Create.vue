<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    recipient_name: '',
    address: '',
    status: 'Pending',
});

function submit() {
    form.post(route('packages.store'));
}
</script>

<template>
    <Head title="Create Package" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-gray-200"
                >
                    Create Package
                </h2>
                <Link
                    href="/packages"
                    class="rounded bg-gray-600 px-3 py-1 text-white hover:bg-gray-700"
                >
                    Back
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Recipient Name
                            </label>
                            <input
                                v-model="form.recipient_name"
                                type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            />
                            <span
                                v-if="form.errors.recipient_name"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.recipient_name }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Address
                            </label>
                            <textarea
                                v-model="form.address"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            ></textarea>
                            <span
                                v-if="form.errors.address"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.address }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Status
                            </label>
                            <select
                                v-model="form.status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            >
                                <option value="Pending">Pending</option>
                                <option value="In Transit">In Transit</option>
                                <option value="Delivered">Delivered</option>
                            </select>
                            <span
                                v-if="form.errors.status"
                                class="text-sm text-red-500"
                            >
                                {{ form.errors.status }}
                            </span>
                        </div>

                        <button
                            type="submit"
                            class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
                            :disabled="form.processing"
                        >
                            Save Package
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
