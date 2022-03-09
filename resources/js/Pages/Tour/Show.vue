<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { computed } from "vue";

  let form = useForm({
    inn: null,
  });

  let submit = () => {
    Inertia.post(route("inn.add", Inertia.page.props.tour), form, {
      onFinish: () => form.reset(),
      preserveScroll: true,
    });
  };

  defineProps({
    selectInns: Object,
    inns: Object,
    tour: Object,
  });
</script>

<template>
  <Head title="Show" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ tour.name }}
      </h2>
    </template>
    <div class="pt-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <label for="inn" class="label">
          <span class="label-text">Pick the best inn in town</span>
        </label>
        <form @submit.prevent="submit" class="flex">
          <div class="form-control w-full max-w-xs">
            <select
              v-model="form.inn"
              name="inn"
              class="select select-accent select-bordered max-w-md"
            >
              <option
                v-for="selectedinn in selectInns"
                :key="selectedinn.id"
                :value="selectedinn.id"
              >
                {{ selectedinn.name }}
              </option>
            </select>
          </div>
          <button type="submit" class="btn ml-2 btn-accent">Add</button>
        </form>
        <div v-if="$page.props.errors.inn" class="mt-2 text-sm text-red-700">
          {{ $page.props.errors.inn }}
        </div>
      </div>
    </div>

    <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="mx-1 px-3 my-3 min-h-6">
            <div
              v-for="inn in inns"
              :key="inn.id"
              class="my-4 flex items-center space-x-2 max-w-lg"
            >
              <Link
                :href="route('inn.remove', [inn, tour])"
                method="post"
                as="button"
                preserve-scroll
              >
                <svg
                  viewBox="0 0 197.516 197.516"
                  style="enable-background: new 0 0 197.516 197.516"
                  xml:space="preserve"
                  class="
                    fill-current
                    h-7
                    p-1
                    border
                    rounded-md
                    hover:bg-gray-500 hover:text-gray-100
                    text-gray-500
                  "
                >
                  <path
                    d="M68.758,170.083V72.649h15v97.434H68.758z M128.758,72.649h-15v97.434h15V72.649z M140.539,0v12.631h34.885v47.746h-10.525  v137.139H32.617V60.377H22.092V12.631h34.883V0H140.539z M149.898,60.377H47.617v122.139h102.281V60.377z M125.539,27.631V15H71.975  v12.631H37.092v17.585h123.332V27.631H125.539z"
                  />
                </svg>
              </Link>
              <div class="flex justify-between w-full">
                <p>{{ inn.name }}</p>
                <p>{{ inn.price }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
