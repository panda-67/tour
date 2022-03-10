<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

  let form = useForm({
    inn: null,
  });

  let travelform = useForm({
    travel: null,
  });

  let submit = () => {
    Inertia.post(route("inn.add", Inertia.page.props.tour), form, {
      onFinish: () => form.reset(),
      preserveScroll: true,
    });
  };

  let submitTravel = () => {
    Inertia.post(route("travel.add", Inertia.page.props.tour), travelform, {
      onFinish: () => travelform.reset(),
      preserveScroll: true,
    });
  };

  const formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 2,
  });

  defineProps({
    tour: Object,
    
    selectInns: Object,
    inns: Object,
    sumInns: Object,

    selectTravels: Object,
    travels: Object,
    sumTravels: Object,
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
    <div>
      <div>
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
            <div
              v-if="$page.props.errors.inn"
              class="mt-2 text-sm text-red-700"
            >
              {{ $page.props.errors.inn }}
            </div>
          </div>
        </div>

        <div class="py-8">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="mx-1 px-3 my-3 min-h-6">
                <div class="ml-12">
                  Total for Inns = {{ formatter.format(sumInns) }}
                </div>
                <div
                  v-for="(inn, index) in inns"
                  :key="inn.id"
                  class="my-4 flex items-center space-x-2 max-w-lg"
                >
                  <Link
                    :href="route('inn.remove', [inn, tour])"
                    method="post"
                    as="button"
                    preserve-scroll
                  >
                    <RemoveButton />
                  </Link>
                  <div class="px-2">{{ index + 1 }}</div>
                  <div class="flex justify-between w-full">
                    <p>{{ inn.name }}</p>
                    <p>{{ formatter.format(inn.price) }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="pt-6">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <label for="travel" class="label">
              <span class="label-text">Pick the best travel in town</span>
            </label>
            <form @submit.prevent="submitTravel" class="flex">
              <div class="form-control w-full max-w-xs">
                <select
                  v-model="travelform.travel"
                  name="travel"
                  class="select select-accent select-bordered max-w-md"
                >
                  <option
                    v-for="selectedtravel in selectTravels"
                    :key="selectedtravel.id"
                    :value="selectedtravel.id"
                  >
                    {{ selectedtravel.name }}
                  </option>
                </select>
              </div>
              <button type="submitTravel" class="btn ml-2 btn-accent">Add</button>
            </form>
            <div
              v-if="$page.props.errors.travel"
              class="mt-2 text-sm text-red-700"
            >
              {{ $page.props.errors.travel }}
            </div>
          </div>
        </div>

        <div class="py-8">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="mx-1 px-3 my-3 min-h-6">
                <div class="ml-12">
                  Total for Travels = {{ formatter.format(sumTravels) }}
                </div>
                <div
                  v-for="(travel, index) in travels"
                  :key="travel.id"
                  class="my-4 flex items-center space-x-2 max-w-2xl"
                >
                  <Link
                    :href="route('travel.remove', [travel, tour])"
                    method="post"
                    preserve-scroll
                  >
                    <RemoveButton />
                  </Link>
                  <div class="px-2">{{ index + 1 }}</div>
                  <div class="flex justify-between w-full">
                    <p>{{ travel.name }}</p>
                    <p>{{ formatter.format(travel.price) }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

