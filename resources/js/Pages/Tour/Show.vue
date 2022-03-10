<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import { Inertia } from "@inertiajs/inertia";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

  defineProps({
    tour: Object,
    sumTour: Number,

    selectInns: Object,
    inns: Object,
    sumInns: Object,

    selectTravels: Object,
    travels: Object,
    sumTravels: Object,
  });

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
</script>

<template>
  <Head title="Show" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl leading-tight">
        {{ tour.name }}
      </h2>
      <h2 class="inline-flex items-center">
        Total for Tour
        <span class="font-bold text-lg ml-2">{{
          formatter.format(sumTour)
        }}</span>
      </h2>
    </template>
    <div class="flex flex-col md:flex-row md:space-x-2 lg:px-4 lg:justify-evenly text-sm md:text-base">
      <div>
        <div class="pt-4 px-4">
          <div class="max-w-7xl mx-auto">
            <label for="inn" class="label">
              <span class="label-text text-lg font-semibold">Pick the best inn in town</span>
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
          <div class="max-w-7xl mx-auto">
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
                    class="delete-link"
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
        <div class="pt-4 px-4">
          <div class="max-w-7xl mx-auto">
            <label for="travel" class="label">
              <span class="label-text text-lg font-semibold">Pick the best travel in town</span>
            </label>
            <form @submit.prevent="submitTravel" class="flex">
              <div class="form-control max-w-xs">
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
              <button type="submit" class="btn ml-2 btn-accent">
                Add
              </button>
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
          <div class="max-w-7xl mx-auto">
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
                    as="button"
                    preserve-scroll
                    class="delete"
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

