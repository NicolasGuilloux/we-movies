<template>
  <div class="inline-flex items-center justify-center overflow-hidden rounded-full -mt-4 -mr-4">
    <!-- Building a Progress Ring: https://css-tricks.com/building-progress-ring-quickly/ -->
    <svg class="w-20 h-20">
      <circle
          class="text-gray-300"
          stroke-width="5"
          stroke="currentColor"
          fill="transparent"
          r="20"
          cx="40"
          cy="40"
      />
      <circle
          class="text-blue-600"
          stroke-width="5"
          :stroke-dasharray="circumference"
          :stroke-dashoffset="(1 - percent / 100) * circumference"
          stroke-linecap="round"
          stroke="currentColor"
          fill="transparent"
          r="20"
          cx="40"
          cy="40"
      />
    </svg>
    <span class="absolute text-sm text-blue-700">{{ percent }}%</span>
  </div>
</template>

<script>
export default {
  name: 'PercentWidget',
  props: {
    percent: { type: Number },
  },
  data () {
    return {
      circumference: 20 * 2 * Math.PI,
    }
  },
}
</script>
