import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'index',
    component: () => import('@/pages/IndexPage.vue'),
  },
]

const testRoutes = [
  {
    path: '/myTest',
    name: 'myTest',
    component: () => import('@/pages/MyTest/MyTest.vue')
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes: [ ...routes, ...testRoutes ],
})

export default router
