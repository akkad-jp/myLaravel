<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  hoge: {
    type: String,
    default: '',
  }
})
</script>

<template>
<div>
  <h2>MyTest</h2>
  <div>
    <Link href="/" class="mytest-link">Index</Link>
  </div>
  <div>
    {{ props.hoge }}
  </div>
</div>
</template>
