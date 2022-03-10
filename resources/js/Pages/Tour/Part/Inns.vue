<template>
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
              <RemoveButton />
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
</template>