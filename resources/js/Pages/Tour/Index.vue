<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import Pagination from "@/Layouts/Pagination.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";

  defineProps({
    tours: Object,
  });
</script>

<template>
  <Head title="Index" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex space-x-4">
        <h2 class="font-semibold text-xl leading-tight">Tour</h2>        
      </div>
    </template>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div v-for="tour in tours.data" :key="tour.id">
              <div>{{ tour.name }}</div>
              <div class="badge badge-ghost badge-sm">
                By: {{ tour.users.name }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <Pagination :links="tours.links" class="mx-3 px-5" />
  </BreezeAuthenticatedLayout>
</template>


