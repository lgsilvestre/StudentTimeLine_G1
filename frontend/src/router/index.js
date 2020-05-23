import Vue from 'vue'
import VueRouter from 'vue-router'
import Inicio from '../views/Inicio.vue'

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
    //Enrutamiento de la vista de RecuperacionContraseña
    path: '/recuperacionContrasena',
    name: 'RecuperacionContrasena',
    component: () => import(/* webpackChunkName: "RecuperacionContraseña" */ '@/views/RecuperacionContrasena.vue')
  },
  
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router