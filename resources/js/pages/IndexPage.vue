<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div>
    Index Page
  </div>
  <div>
    <Link :href="route('mytest.index')">MyTest</Link>
  </div>
</template>
