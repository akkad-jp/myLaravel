<script setup>
import { ref, onMounted } from 'vue'

const message = ref()
onMounted(() => {
  message.value = 'index'
})
</script>

<template>
  <div>
    {{ message }}
    <div><router-link :to="{ name: 'myTest'}">myTest</router-link></div>
    <div><router-link to="/api/documentation">Swagger</router-link></div>
  </div>
</template>
