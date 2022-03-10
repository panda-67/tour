<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import RemoveButton from "@/Components/RemoveButton.vue";
  import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
  import { Inertia } from "@inertiajs/inertia";
  import { reactive } from "vue";

  defineProps({
    users: Object,
    inns: Object,
  });

  let form = useForm({
    name: null,
    description: null,
  });

  let submit = () => {
    Inertia.post(route("tour.store"), form, {
      onFinish: () => form.reset(),
      preserveScroll: true,
    });
  };
</script>

<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex space-x-2 items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Dashboard
        </h2>
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
          <!-- The button to open modal -->
          <label
            for="my-modal"
            class="btn btn-sm btn-ghost text-accent capitalize"
            >Create Tour</label
          >
          <!-- <Link
            :href="route('tour.create')"
            as="button"
            class="btn btn-sm btn-ghost text-accent capitalize"
          >
            Create New
          </Link> -->
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
              <p>{{ tour.description }}</p>
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
                  preserve-scroll
                >
                  <RemoveButton
                    class="text-black hover:bg-red-600 border-none"
                  />
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <input type="checkbox" id="my-modal" class="modal-toggle" />
      <div class="modal h-full">
        <div class="modal-box">
          <h3 class="font-bold text-lg p-2 mb-2">Create new Tour!</h3>
          <div class="px-2 bg-white">
            <form @submit.prevent="submit">
              <div class="flex flex-col max-w-md justify-around space-y-3">
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  id="name"
                  placeholder="Tour name"
                  class="input input-accent"
                />
                <textarea
                  v-model="form.description"
                  type=""
                  name="description"
                  id="description"
                  placeholder="Tour description"
                  class="textarea textarea-accent"
                />
                <div class="modal-action items-center justify-between">
                  <div class="h-8">
                    <div
                      v-if="$page.props.flash.message"
                      class="alert text-accent -mt-2 alert-sm w-max"
                    >
                      {{ $page.props.flash.message }}
                    </div>
                    <div
                      v-if="$page.props.errors.name"
                      class="text-sm text-red-700 pl-2"
                    >
                      {{ $page.props.errors.name }}
                    </div>
                  </div>
                  <div class="space-x-2">
                    <label for="my-modal" class="btn btn-sm btn-success">
                      Back
                    </label>
                    <button type="submit" class="btn btn-sm btn-accent">
                      Save
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End modal -->
    </div>
  </BreezeAuthenticatedLayout>
</template>