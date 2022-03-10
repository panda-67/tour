<script setup>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
  import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<template>
  <Head title="Welcome" />

  <BreezeAuthenticatedLayout>
    <!-- <template #header>
      <h2 class="font-semibold text-xl leading-tight">Welcome</h2>
    </template> -->

    <div class="py-10 min-h-full">
      <div class="max-w-7xl mx-auto sm:px-4">
        <div
          class="bg-white overflow-hidden sm:shadow-lg sm:rounded-lg"
          :class="
            $page.props.auth.user ? 'sm:shadow-teal-400' : 'sm:shadow-fuchsia-600'
          "
        >
          <div class="p-8 bg-white border-b border-gray-200">
            <div class="p-16">
              <h1 class="text-5xl font-black pb-10">
                Welcome! Tours planning.
              </h1>
              <div v-if="$page.props.auth.user">
                <p class="text-3xl font-extrabold mb-8">
                  Let's see your plans.
                </p>
                <Link
                  :href="route('dashboard')"
                  as="button"
                  class="btn btn-accent"
                  >Dashboard</Link
                >
              </div>
              <div v-else>
                <p class="text-3xl font-extrabold mb-8">
                  Let's make some plan.
                </p>
                <div class="space-x-2">
                  <Link
                    :href="route('login')"
                    as="button"
                    class="btn btn-secondary text-base font-semibold"
                  >
                    Log in
                  </Link>

                  <Link
                    :href="route('register')"
                    as="button"
                    class="btn btn-error text-base font-semibold"
                  >
                    Register
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>


