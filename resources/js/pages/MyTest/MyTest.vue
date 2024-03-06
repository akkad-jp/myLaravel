<script setup>
import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import axios from 'axios'

const message = ref()

onMounted(() => {
  message.value = 'index'
  axios.get('/api/v1/mytest')
  .then((response) => {
    message.value = 'response = '
    Object.keys(response.data).forEach((key) => {
      message.value = `${message.value} (${key} => ${response.data[key]})`
    })
  })
  .catch((error) => {
    console.log(error)
  })
})
</script>

<template>
<div>
  MyTest
  <div>{{ message }}</div>
  <Link :href="router('index')">index</Link>
</div>
</template>
