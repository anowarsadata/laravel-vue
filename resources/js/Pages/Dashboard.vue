<script setup lang="ts">
import { ref, watch } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Briefcase, IndianRupee, FileText, MapPin } from 'lucide-vue-next';

const page = usePage();
const jobs = ref(page.props.jobs);
const filters = ref({
  search: page.props.filters.search || '',
  location: page.props.filters.location || ''
});

// Watch for job updates after search
watch(() => page.props.jobs, (newJobs) => {
  jobs.value = newJobs;
});

// Handle search from Hero.vue
const handleSearch = (newFilters: { search: string; location: string }) => {
  filters.value = newFilters;
  router.get('/dashboard', newFilters, { preserveState: true });
};

// Pagination Handling
const goToPage = (pageNumber: number) => {
  router.get('/dashboard', { 
    search: filters.value.search, 
    location: filters.value.location,
    page: pageNumber
  }, { preserveState: true });
};

// Function to calculate relative time
const timeSince = (timestamp: string) => {
  const postTime = new Date(timestamp);
  const now = new Date();
  const diffInMinutes = Math.floor((now.getTime() - postTime.getTime()) / 60000);
  if (diffInMinutes < 1) return "Less than a minute";
  if (diffInMinutes < 60) return `${diffInMinutes} minutes ago`;
  if (diffInMinutes < 1440) return `${Math.floor(diffInMinutes / 60)} hours ago`;
  return `${Math.floor(diffInMinutes / 1440)} days ago`;
};
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <!-- Hero Section (Search Form) -->
    <Hero @search="handleSearch" />

    <!-- Job Listings -->
    <div class="container mx-auto px-4 py-10">
      <div v-if="jobs.data.length > 0">
        <div class="grid md:grid-cols-2 gap-6">
          <div v-for="job in jobs.data" :key="job.id" class="bg-white p-6 rounded-xl shadow-md border flex flex-col">
            <div class="flex items-center gap-4">
              <img :src="`/storage/${job.company_logo}`" alt="Company Logo" class="w-12 h-12 rounded-full">
              <div>
                <h2 class="text-lg font-bold text-gray-800">{{ job.title }}</h2>
                <p class="text-sm text-gray-500">{{ job.company_name }}</p>
              </div>
            </div>

            <!-- Job Details (Experience, Salary, Location) -->
            <div class="mt-4 flex flex-wrap gap-4 text-gray-600 text-sm">
              <div class="flex items-center gap-1"><Briefcase size="16" /> {{ job.experience }} Yrs</div>
              <div class="flex items-center gap-1"><IndianRupee size="16" /> {{ job.salary }}</div>
              <div v-if="job.location" class="flex items-center gap-1"><MapPin size="16" /> {{ job.location }}</div>
            </div>

            <!-- Job Description -->
            <div class="mt-4 text-gray-600 text-sm flex items-start gap-2">
              <FileText size="16" class="mt-1" />
              <p>{{ job.description.substring(0, 120) }}...</p>
            </div>

            <!-- Skills -->
            <div class="mt-3 flex flex-wrap gap-2">
              <span v-for="(skill, index) in job.skills" :key="skill.id" class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-xs">
                {{ skill.name }}
              </span>
            </div>

            <!-- Job Tags (Remote, Full-Time, etc.) -->
            <div class="mt-4 flex flex-wrap gap-2">
              <span v-for="(tag, index) in job.tags" :key="index" class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs">
                {{ tag }}
              </span>
            </div>

            <!-- Time Since Posting -->
            <div class="mt-4 text-gray-500 text-xs text-right">
              {{ timeSince(job.created_at) }}
            </div>
          </div>
        </div>

        <!-- Pagination Controls -->
        <div v-if="jobs.last_page > 1" class="flex justify-center gap-4 mt-6">
          <button v-if="jobs.current_page > 1" @click="goToPage(jobs.current_page - 1)" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow hover:bg-gray-400">
            Previous
          </button>
          <span class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">{{ jobs.current_page }} / {{ jobs.last_page }}</span>
          <button v-if="jobs.current_page < jobs.last_page" @click="goToPage(jobs.current_page + 1)" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow hover:bg-gray-400">
            Next
          </button>
        </div>
      </div>
      <p v-else class="text-center text-gray-500 text-lg mt-10">No jobs found</p>
    </div>
  </AuthenticatedLayout>
</template>
