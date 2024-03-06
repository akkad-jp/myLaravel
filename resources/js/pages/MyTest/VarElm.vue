<script>
export default {
  name: 'VarElm'
}
</script>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  item: Object,
})

const title = computed(() => {
  if (props.item === undefined || props.item.title === undefined) {
    return ''
  }
  return props.item.title ?? '--' }
)
const value = computed(() => {
  if (props.item === undefined || props.item.value === undefined) {
    return '(undefined)'
  }
  return props.item.value ?? '(null)'
})
</script>

<template>
<b>{{ title ?? '--' }}</b>:
<div v-if="Array.isArray(value) || typeof value === 'object'">
  <ul>
    <li v-for="(v, k) in value" :key="k">
      <VarElm :item="{ title: k, value: v }"></VarElm>
    </li>
  </ul>
</div>
<span v-else>{{ value }}</span>
</template>
