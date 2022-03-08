<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, useForm } from "@inertiajs/inertia-vue3";
  import { reactive } from "vue";

  let form = useForm({
    name: Inertia.page.props.tour.name,
  });

  let submit = () => {
    Inertia.patch(route("tour.update", Inertia.page.props.tour), form);
  };

  defineProps({
    tour: Object,
    inns: Object,
    
  });
</script>

<template>
  <Head title="Edit" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">Edit Tour</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="submit">
              <div class="flex flex-col max-w-md justify-around space-y-3">
                <label for="name">Tour Name</label>
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  id="name"
                  class="input input-accent"
                />
                <div
                  v-if="$page.props.errors.name"
                  class="text-sm text-red-700"
                >
                  {{ $page.props.errors.name }}
                </div>
               
                <button type="submit" class="btn btn-sm w-max btn-accent">
                  Update
                </button>
              </div>
            </form>
          </div>
          <!-- <div v-for="inn in inns" :key="inn.id">{{ inn.name }}</div> -->
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>


