<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    jobs: Array
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Hero Section with Job Search -->
        <Hero :jobs="jobs" />

        <!-- Job List -->
        <div class="bg-white">
            <div class="container py-5">
                <h2 class="text-2xl font-semibold mb-4">Latest Job Openings</h2>
                <div v-if="jobs.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="job in jobs" :key="job.id" class="p-6 bg-white shadow rounded-lg">
                        <h3 class="text-lg font-bold text-gray-800">{{ job.title }}</h3>
                        <p class="text-sm text-gray-600">{{ job.description }}</p>
                        <div class="mt-2 text-sm text-gray-700">
                            <span class="font-semibold">Company:</span> {{ job.company_name }}
                        </div>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span v-for="skill in job.skills" :key="skill.id"
                                class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                {{ skill.name }}
                            </span>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-blue-500 hover:underline text-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <p v-else class="text-gray-500">No jobs available at the moment.</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
