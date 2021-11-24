<template>
  <Layout :title="$options.filters.trans('home.title')">
    <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white">
      <p v-html="$options.filters.trans('home.welcome')"></p>
      <p class="mt-4">{{ 'home.explanations'|trans }}</p>
    </div>
  </Layout>
</template>

<script>
import Layout from '../layout/Layout';

export default {
  name: 'Home',
  components: {
    Layout
  }
}
</script>
