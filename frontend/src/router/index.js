import Vue from 'vue'
import VueRouter from 'vue-router'
import Inicio from '../views/Inicio.vue'
import General from '../views/General.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Inicio',
    component: Inicio
  },
  {
    //Enrutamiento de la vista del administrador
    path: '/administrador',
    name: 'Administrador',
    component: () => import(/* webpackChunkName: "Administrador" */ '@/views/Administrador.vue')
  },
  {
    //Enrutamiento de la vista del administrador
    path: '/profesor',
    name: 'Profesor',
    component: () => import(/* webpackChunkName: "Profesor" */ '@/views/Profesor.vue')
  },
  {
    //Enrutamiento de la vista del administrador
    path: '/secretariaEscuela',
    name: 'SecretariaEscuela',
    component: () => import(/* webpackChunkName: "SecretariaEscuela" */ '@/views/SecretariaEscuela.vue')
  },
  {
    path: '/prueba',
    name: 'Prueba',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '@/views/prueba.vue')
  },
  {
      path: '/control',
      name: 'control',
      component: () =>
          import ( /* webpackChunkName: "control" */ '../views/control.vue')
  },
    {
        path: '/global',
        name: 'global',
        component: () =>
            import ( /* webpackChunkName: "general" */ '../views/General.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router