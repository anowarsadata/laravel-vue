<script setup lang="ts">
import { ref } from 'vue';

const search = ref('');
const location = ref('');

const emit = defineEmits(['search']);

const performSearch = () => {
    emit('search', { search: search.value, location: location.value });
};
</script>

<template>
  <div class="bg-slate-100 relative">
    <div class="container py-32 text-center flex flex-col gap-8">
      <div class="space-y-4">
        <h1 class="text-3xl lg:text-6xl font-bold">Find your dream job</h1>
        <p class="text-sm lg:text-base text-slate-600">
          Looking for jobs? Browse our latest job openings to view & apply to the best jobs today!
        </p>
      </div>
      <!-- Search -->
      <div>
        <div class="bg-white w-full border rounded-full overflow-hidden border-gray-200 max-w-3xl mx-auto flex items-center">
          <!-- Search input -->
          <div class="flex-1 flex items-center border-r px-4">
            <input v-model="search" @keyup.enter="performSearch" placeholder="Job title, skill, or keyword" class="py-4 px-2 w-full border-none focus:outline-none" type="text">
          </div>
          <!-- Location input -->
          <div class="flex-1 flex items-center px-4">
            <input v-model="location" @keyup.enter="performSearch" placeholder="Location" class="py-4 px-2 w-full border-none focus:outline-none" type="text">
          </div>
          <button @click="performSearch" class="bg-brand px-6 text-sm font-medium py-2 rounded-full text-white mr-3">
            Find jobs
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
