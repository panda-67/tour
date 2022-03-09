<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

  defineProps({
    users: Object,
  });
</script>

<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex space-x-2 items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Dashboard
        </h2>
        <div v-if="$page.props.flash.message" class="alert alert-sm w-max">
          {{ $page.props.flash.message }}
        </div>
      </div>
    </template>

    <div class="py-12 space-y-3">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="
            bg-white
            overflow-hidden
            shadow-sm
            sm:rounded-lg
            flex
            justify-between
            items-center
            px-4
          "
        >
          <div class="p-4 bg-white border-b border-gray-200">
            Tour Plan by <span class="font-bold">{{ users.name }}</span>
          </div>
          <Link
            :href="route('tour.create')"
            as="button"
            class="btn btn-sm btn-ghost text-accent capitalize"
          >
            Create New
          </Link>
        </div>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div v-for="tour in users.tours" :key="tour.id" class="my-2">
          <div class="card bg-base-100 shadow-xl">
            <div class="card-body p-6">
              <Link
                :href="route('tour.show', tour)"
                as="button"
                type="button"
                class="
                  text-left
                  hover:text-blue-600
                  font-bold
                  border-b
                  pb-2
                  border-accent
                "
              >
                {{ tour.name }}
              </Link>
              <p>If a dog chews shoes whose shoes does he choose?</p>
              <div class="card-actions justify-start">
                <Link
                  :href="route('tour.show', tour)"
                  as="button"
                  type="button"
                  class="btn btn-sm btn-info"
                >
                  Manage
                </Link>
                <Link
                  :href="route('tour.edit', tour)"
                  as="button"
                  type="button"
                  class="btn btn-sm btn-success"
                >
                  Edit
                </Link>
                <Link
                  :href="route('tour.destroy', tour)"
                  method="delete"
                  as="button"
                  type="button"
                  class="btn btn-sm btn-warning"
                  preserve-scroll
                >
                  Delete
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
