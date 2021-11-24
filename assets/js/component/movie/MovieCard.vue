<template>
  <div class="p-8 mt-6 w-100 leading-normal rounded shadow bg-white">
    <div class="flex mb-8 w-100" v-on:click="isModalVisible = !isModalVisible">
      <img :src="'https://image.tmdb.org/t/p/w500' + movie.poster_path"
           alt="movie.name poster"
           class="h-40 pr-8"
           v-if="movie.poster_path" />

      <div class="w-100 flex-grow">
        <div class="flex justify-between w-100">
          <div>
            <h2 class="font-sans font-bold break-normal text-gray-700 text-xl">
              {{ movie.title }}
            </h2>
            <h3 class="font-sans font-bold break-normal text-gray-500 pb-2 text-lg">
              {{ movie.release_date|date('YYYY') }}
            </h3>
          </div>

          <PercentWidget :percent="movie.vote_average * 10" />
        </div>

        <p>{{ movie.overview }}</p>

        <p class="my-4 text-gray-400 text-sm">
          {{ 'genre.details.original_language'|trans }} {{ movie.original_language }},
          {{ 'genre.details.original_title'|trans }} {{ movie.original_title }},
          {{ 'genre.details.release_date'|trans }} {{ movie.release_date }},
          {{ 'genre.details.vote_count'|trans }} {{ movie.vote_count }}
        </p>
      </div>
    </div>

    <a class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
       :href="'https://www.themoviedb.org/movie/' + movie.id"
       target="_blank"
    >
      {{ 'genre.details_button'|trans }}
    </a>

    <Popup v-model="isModalVisible" :model-value="isModalVisible" :movie="movie" />
  </div>
</template>

<script>
import PercentWidget from '../widget/PercentWidget';
import Popup from './Popup';

export default {
  name: 'MovieCard',
  components: {
    PercentWidget,
    Popup
  },
  props: {
    movie: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      isModalVisible: false,
    }
  }
}
</script>
