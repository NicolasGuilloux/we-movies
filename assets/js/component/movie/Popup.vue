<template>
  <div v-if="modelValue" v-on:click="modelValue = !modelValue" class="bg-grey-300 bg-opacity-25 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none">
    <div class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
      <div class="flex justify-between w-100">
        <div>
          <h2 class="font-sans font-bold break-normal text-gray-700 text-xl">
            {{ movie.title }}
          </h2>
          <h3 class="font-sans font-bold break-normal text-gray-500 pb-2 text-lg">
            {{ movie.release_date|date('YYYY') }}
          </h3>
        </div>
      </div>

      <p>{{ movie.overview }}</p>

      <p class="my-4 text-gray-400 text-sm">
        {{ 'genre.details.vote_average'|trans }} {{ movie.vote_average }},
        {{ 'genre.details.vote_count'|trans }} {{ movie.vote_count }},
        {{ 'genre.details.original_language'|trans }} {{ movie.original_language }},
        {{ 'genre.details.original_title'|trans }} {{ movie.original_title }},
        {{ 'genre.details.release_date'|trans }} {{ movie.release_date }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Popup',
  props: {
    modelValue: {
      type: Boolean,
      required: true,
    },
    movie: {
      type: Object,
      required: true,
    }
  }
}
</script>
