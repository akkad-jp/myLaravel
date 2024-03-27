<script setup>
import { ref, onMounted } from 'vue'

const cardHolderName = ref()
const stripe = ref()
const cardElement = ref()

const props = defineProps({
  'intent': Object,
})

onMounted(() => {
  const publicKey = import.meta.env.VITE_STRIPE_KEY
  stripe.value = window.Stripe(publicKey)

  // クレジットカード情報を登録するフォームを作成する
  const elements = stripe.value.elements()
  cardElement.value = elements.create('card')
  cardElement.value.mount('#card-element')
})

const subscribe = () => {
  const secret = props.intent.client_secret ?? null
  if (secret === null) {
    console.log('secret is null')
    return
  }
  stripe.value.confirmCardSetup(
    secret,
    {
      payment_method: {
        card: cardElement.value,
        billing_details: {
          name: 'Jenny Rosen',
        },
      },
    }
  )
  .then((result) => {
    console.log(result)
  })
  .catch((error) => {
    console.log(error)
  })
}
</script>

<template>
<div>
  <h2>サブスクリプション</h2>
  <div
    id="card-element"
    class="p-4 border border-gray-400 rounded w-96"
  ></div>
  <div class="p-2 border border-gray-400 rounded w-96">
    <input
      id="card-holder-name"
      type="text"
      placeholder="カード名義人"
      v-model="cardHolderName"
    >
    <button
      id="card-button"
      class="px-2 py-1 border"
      @click="subscribe"
    >サブスクリプション</button>
  </div>
</div>
</template>
