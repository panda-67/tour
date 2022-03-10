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
        <h2 class="font-semibold text-xl leading-tight">Tours Index</h2>
      </div>
    </template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div v-for="tour in tours.data" :key="tour.id" class="my-2">
        <div class="card bg-base-100 shadow-xl">
          <div class="card-body p-6">
            <h2 class="text-lg font-bold">{{ tour.name }}</h2>
            <p>{{ tour.description }}</p>
            <div class="card-actions justify-start">
              <div class="badge badge-md p-3 badge-info text-gray-100">
                Tour by: {{ tour.users.name }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pb-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <Pagination :links="tours.links" class="my-8 px-8 sm:px-0" />
    </div>
  </BreezeAuthenticatedLayout>
</template>


