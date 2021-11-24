<template>
  <Layout :title="currentGenre.name">
    <MovieCard v-for="movie in movies" :key="movie.id" :movie="movie" />
  </Layout>
</template>

<script>
import Layout from '../layout/Layout';
import MovieCard from '../movie/MovieCard';
import axios from 'axios';

export default {
  name: 'GenreShow',
  components: {
    Layout,
    MovieCard
  },
  props: {
    currentGenre: {
      type: Object,
      required: true,
    }
  },
  data () {
    return {
      movies: []
    };
  },
  mounted () {
    axios
        .get('/api/genres/' + this.currentGenre.id + '/movies')
        .then(response =>
          this.movies = response.data
        );
  }
}
</script>

<style scoped>

</style>
