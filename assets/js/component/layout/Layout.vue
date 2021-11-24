<template>
    <div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-16">
      <!-- Left navigation panel -->
      <Nav :current-genre-id="currentGenreId"/>

      <section class="w-full lg:w-4/5">
        <div class="flex justify-between">
          <div>
            <!-- Title -->
            <h1 v-if="title" class="flex items-center font-sans font-bold break-normal text-gray-700 px-2 text-xl mt-12 lg:mt-0 md:text-2xl">
              {{ title }}
            </h1>
          </div>

          <!-- Right search -->
          <Search />
        </div>

        <!-- Divider -->
        <hr v-if="title" class="bg-gray-300 my-12" />

        <slot></slot>
      </section>
    </div>
</template>

<script>
import Nav from './Nav';
import Search from './Search'

export default {
  name: 'Layout',
  components: {
    Search,
    Nav
  },
  props: {
    title: {
      type: String,
      required: false
    },
    currentGenreId: {
      type: Number,
      required: false
    },
  }
}
</script>
