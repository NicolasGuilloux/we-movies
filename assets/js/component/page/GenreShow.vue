<template>
  <Layout :title="currentGenre.name">
    <MovieCard v-for="movie in movies" :key="movie.id" :movie="movie" />

    <div class="w-100 text-center mt-8">
      <sliding-pagination
          :current="currentPage"
          :total="totalPages"
          @page-change="pageChangeHandler"
          pagination-component="PageItem"
      ></sliding-pagination>
    </div>
  </Layout>
</template>

<script>
import Layout from '../layout/Layout';
import MovieCard from '../movie/MovieCard';
import SlidingPagination from 'vue-sliding-pagination'
import axios from 'axios';

export default {
  name: 'GenreShow',
  components: {
    Layout,
    SlidingPagination,
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
      movies: [],
      currentPage: 1,
      totalPages: 1,
    };
  },
  mounted () {
    axios
        .get('/api/genres/' + this.currentGenre.id + '/movies')
        .then(response => {
          this.movies = response.data.results;
          this.totalPages = response.data.total_pages;
        });
  },
  methods: {
    pageChangeHandler(selectedPage) {
      this.currentPage = selectedPage;
      this.movies = [];

      axios
          .get('/api/genres/' + this.currentGenre.id + '/movies?page=' + selectedPage)
          .then(response => {
            window.scrollTo(0,0);
            this.movies = response.data.results;
            this.totalPages = response.data.total_pages;
          });
    }
  }
}
</script>

<style scoped>

</style>
