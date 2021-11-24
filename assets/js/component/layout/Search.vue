<template>
  <div class="">
    <Dropdown
        :options="options"
        v-on:selected="this.selectMovie"
        v-on:filter="this.searchMovie"
        :disabled="false"
        name="search"
        :placeholder="$options.filters.trans('movie.search')">
    </Dropdown>

    <Modal v-if="selectedMovie" @close="selectedMovie = null" :movie="selectedMovie" />
  </div>
</template>

<script>
import axios from 'axios';
import Dropdown from 'vue-simple-search-dropdown';
import Modal from '../movie/Modal'

export default {
  name: 'Search',
  components: {
    Dropdown,
    Modal
  },
  data () {
    return {
      options: [],
      movies: [],
      selectedMovie: null,
    };
  },
  methods: {
    searchMovie: function (search) {
      if (search === '') {
        this.options = [];
        return;
      }

      axios
          .get('/api/movies/search?query=' + search)
          .then(response => {
            this.options = [];
            this.movies = response.data.results;
            this.movies.forEach(movie =>
              this.options.push({id: movie.id, name:  movie.title})
            );
          });
    },
    selectMovie: function (selected) {
      if (selected.id && selected.name) {
        this.selectedMovie = selected;
      }
    },
  }
}
</script>
