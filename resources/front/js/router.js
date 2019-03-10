import Vue from 'vue'
import Router from 'vue-router'
import Home from './components/Home.vue'
import Detail from './components/Detail.vue'
import Category from './components/Category.vue'
Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/detail',
        name: 'detail',
        component: Detail,
    },
    {
      path: '/category',
      name: 'category',
      component: Category,
  },
  ],
  path: '*', redirect: '/'
})
