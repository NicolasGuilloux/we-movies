<template>
  <nav class="w-full lg:w-1/5 px-6 text-xl text-gray-800 leading-normal">
    <!--Title-->
    <h1 class="flex items-center font-sans font-bold break-normal text-gray-700 px-2 text-xl my-12 lg:mt-0 md:text-2xl">
      <a href="/">We Movies</a>
    </h1>

    <p class="text-base font-bold py-2 lg:pb-6 text-gray-700">{{ 'nav.title'|trans }}</p>

    <div class="w-full lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 my-2 lg:my-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20"
         style="top:6em;" id="menu-content">
      <ul class="list-reset py-2 md:py-0">
        <li v-for="genre in genres"
            class="py-1 md:my-2 hover:bg-yellow-100 lg:hover:bg-transparent border-l-4 border-transparent"
            :class="{'font-bold border-yellow-600': currentGenreId === genre.id}"
        >
          <a :href="'/genre/' + genre.id"
          class="block pl-4 align-middle text-gray-700 no-underline hover:text-yellow-600">
          <span class="pb-1 md:pb-0 text-sm">{{ genre.name }}</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Nav',
  props: {
    currentGenreId: {
      type: Number,
      required: false
    },
  },
  data () {
    return {
      genres: [],
    };
  },
  mounted () {
    axios
      .get('/api/genres')
        .then(response =>
          this.genres = response.data
        );
  }
}
</script>
