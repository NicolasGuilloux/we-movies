<template>
  <div v-on:click="$emit('close')" class="bg-opacity-50 bg-black min-w-screen h-screen animated fadeIn faster fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none">
    <div v-on:click.stop v-if="details" class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
      <div class="flex justify-between w-100">
        <div>
          <h2 class="font-sans font-bold break-normal text-gray-700 text-xl">
            {{ details.title }}
          </h2>
          <h3 class="font-sans font-bold break-normal text-gray-500 pb-2 text-lg">
            {{ details.release_date|date('YYYY') }}
          </h3>
        </div>
      </div>

      <p>{{ details.overview }}</p>

      <p v-if="videos.length <= 0" class="my-4">{{ 'movie.details.no_video'|trans }}</p>

      <p class="my-4 text-gray-400 text-sm">
        {{ 'genre.details.vote_average'|trans }} {{ details.vote_average }},
        {{ 'genre.details.vote_count'|trans }} {{ details.vote_count }},
        {{ 'genre.details.original_language'|trans }} {{ details.original_language }},
        {{ 'genre.details.original_title'|trans }} {{ details.original_title }},
        {{ 'genre.details.release_date'|trans }} {{ details.release_date }}
      </p>

      <span v-on:click="$emit('close')" class="cursor-pointer shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mr-4">
        {{ 'modal.close'|trans }}
      </span>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Modal',
  props: {
    movie: {
      type: Object,
      required: true,
    }
  },
  data () {
    return {
      videos: [],
      details: null,
    };
  },
  mounted () {
    axios
        .get('/api/movies/' + this.movie.id + '/details')
        .then(response => {
              this.details = response.data.details;
              this.videos = response.data.videos;
            }
        );
  }
}
</script>
