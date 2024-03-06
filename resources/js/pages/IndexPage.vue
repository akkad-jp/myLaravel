<script setup>
import { Link } from '@inertiajs/vue3'
import VarElm from '@/Pages/MyTest/VarElm.vue'

const props = defineProps({
  message: String,
  user: Object,
})
</script>

<template>
<div>
  <h1>Index Page</h1>
  <div>{{ props.message }}</div>
  <ul>
    <li><Link :href="route('mytest.index')" class="mytest-link">MyTest</Link></li>
    <li><a href="./login" class="mytest-link">Login</a></li>
    <li><a href="./logout" class="mytest-link">Logout</a></li>
    <li><Link href="./private" class="mytest-link">private</Link></li>
    <li><Link href="./scope" class="mytest-link">scope</Link></li>
    <li><Link href="./colors" class="mytest-link">colors</Link></li>
  </ul>

  <h2>Auth0</h2>
  <VarElm :item="{ title: 'user', value: props.user }"></VarElm>
</div>
</template>
