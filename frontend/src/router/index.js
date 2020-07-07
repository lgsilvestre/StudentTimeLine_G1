import Vue from 'vue'
import VueRouter from 'vue-router'
import Inicio from '../views/Inicio.vue'
import store from '../store';

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
    component: () => import(/* webpackChunkName: "Administrador" */ '@/views/Administrador.vue'),
    meta: {
      requiresAuth: true
    },
    children:[
      {
        //Enrutamiento de la vista del administrador
        path: 'escuela',
        name: 'Escuela',
        component: () => import(/* webpackChunkName: "Administrador" */ '@/components/Administrador/BodyEscuelas.vue'/* ruta exacta por definir dado que no esta aun creada*/),
        meta: {
          admin: true
        },
      },
      {
        //Enrutamiento de la vista del administrador
        path: 'usuarios',
        name: 'Usuarios',
        component: () => import(/* webpackChunkName: "Administrador" */ '@/components/Administrador/BodyListaUsuarios.vue'/* ruta exacta por definir dado que no esta aun creada*/),
        meta: {
          admin: true
        },
      },
      {
        //Enrutamiento de la vista del administrador
        path: 'perfil',
        name: 'perfilAdministrador',
        component: () =>import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/BodyGlobal.vue'),
        meta: {
            admin: true
        },
      },
      {
        //Enrutamiento de la vista del administrador
        path: 'estudiantes',
        name: 'estudiantesAdministrador',
        component: () =>import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantesGlobal.vue'),
        meta: {
            admin: true
        },
      },
      {
         //Enrutamiento de la vista del administrador
        path: 'profesores',
        name: 'profesoresAdministrador',
         component: () => import(/* webpackChunkName: "Administrador" */ '@/components/SecretariaDeEscuela/BodyProfesores.vue'),
        meta: {
          admin: true
        },
      },
      // {
      //   //Enrutamiento de la vista del administrador
      //   path: 'escuela/deshabilitarEscuela',
      //   name: 'deshabilitarEscuela',
      //   component: () => import(/* webpackChunkName: "Administrador" */ '@/views/Administrador.vue'/* ruta exacta por definir dado que no esta aun creada*/)
      //   meta: {
      //     admin: true
      //   },
      // },
      
      // {
      //   //Enrutamiento de la vista crearObservacionAdministrador
      //   path: 'observaciones/crearObservacion',
      //   name: 'crearObservacionAdministrador',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Administrador.vue'/* ruta exacta por definir dado que no esta aun creada*/)
      //   meta: {
      //     admin: true
      //   },
      // },
      // {
      //   //Enrutamiento de la vista listarObservacionesAdministrador
      //   path: 'observaciones/listarObservaciones',
      //   name: 'listarObservacionesAdministradorr',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Administrador.vue'/* ruta exacta por definir dado que no esta aun creada*/)
      //   meta: {
      //     admin: true
      //   },
      // },
      // {
      //   //Enrutamiento de la vista modificarObservacionAdministrador
      //   path: 'observaciones/modificarObservacion',
      //   name: 'modificarObservacionAdministrador',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Administrador.vue'/* ruta exacta por definir dado que no esta aun creada*/)
      //   meta: {
      //     admin: true
      //   },
      // },
      // {
      //   //Enrutamiento de la vista eliminarObservacionAdministrador
      //   path: 'observaciones/eliminarObservacion',
      //   name: 'eliminarObservacionAdministrador',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Administrador.vue'/* ruta exacta por definir dado que no esta aun creada*/)
      //   meta: {
      //     admin: true
      //   },
      // },
      // {
      //   //Enrutamiento de la vista habilitarProfesorAdministrador
      //   path: 'habilitarProfesor',
      //   name: 'habilitarProfesorAdministrador',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Administrador.vue'/* ruta exacta por definir dado que no esta aun creada*/)
      //   meta: {
      //     admin: true
      //   },
      // },
      // {
      //   //Enrutamiento de la vista deshabilitarProfesorAdministrador
      //   path: 'deshabilitarProfesor',
      //   name: 'deshabilitarProfesorAdministrador',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Administrador.vue'/* ruta exacta por definir dado que no esta aun creada*/)
      //   meta: {
      //     admin: true
      //   },
      // },
  
      //{
        //Enrutamiento de la vista cursosAdministrador
       // path: 'cursos',
       // name: 'cursosAdministrador',
        //component: () => import(/* webpackChunkName: "" */ '@/views/Administrador.vue'/* ruta exacta por definir dado que no esta aun creada*/)
        //meta: {
          //admin: true
        //},
      //},
      
      
      
    ]
  },

  {
    //Enrutamiento de la vista del administrador
    path: '/secretariaEscuela',
    name: 'secretariaEscuel',
    component: () => import(/* webpackChunkName: "Administrador" */ '@/views/SecretariaEscuela.vue'),
    meta: {
      requiresAuth: true
    },
    children:[
      {
        //Enrutamiento de la vista del administrador
        path: 'perfil',
        name: 'perfilSecretariaEscuela',
        component: () =>
          import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/BodyGlobal.vue'),
        meta: {
          secretariaEscuela: true
        },
        
      },
      {
        //Enrutamiento de la vista del administrador
        path: 'estudiantes',
        name: 'estudiantesSecretariaEscuela',
        component: () =>import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantesGlobal.vue'),
        meta: {
          secretariaEscuela: true
        },
      },
      
      // {
      //   //Enrutamiento de la vista crearObservacionSecretariaEscuela
      //   path: 'observaciones/crearObservacion',
      //   name: 'crearObservacionSecretariaEscuelar',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     secretariaEscuela: true
      //   },
      // },
      // {
      //   //Enrutamiento de la vista listarObservacionesSecretariaEscuela
      //   path: 'observaciones/listarObservaciones',
      //   name: 'listarObservacionesSecretariaEscuelar',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     secretariaEscuela: true
      //   },
      // },
      // {
      //   //Enrutamiento de la vista modificarObservacionSecretariaEscuela
      //   path: 'observaciones/modificarObservacion',
      //   name: 'modificarObservacionSecretariaEscuela',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     secretariaEscuela: true
      //   },
      // },
      // {
      //   //Enrutamiento de la vista eliminarObservacionSecretariaEscuela
      //   path: 'observaciones/eliminarObservacion',
      //   name: 'eliminarObservacionSecretariaEscuela',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     secretariaEscuela: true
      //   },
      // },
      {
         //Enrutamiento de la vista habilitarProfesorSecretariaEscuela
        path: 'profesores',
        name: 'profesoresSecretariaEscuela',
        component: () => import(/* webpackChunkName: "" */ '@/components/SecretariaDeEscuela/BodyProfesores.vue'),
        meta: {
          secretariaEscuela: true
        },
      },
      // {
      //   //Enrutamiento de la vista deshabilitarProfesorSecretariaEscuela
      //   path: 'deshabilitarProfesor',
      //   name: 'deshabilitarProfesorSecretariaEscuela',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     secretariaEscuela: true
      //   },
      // },

      // {
      //   //Enrutamiento de la vista cursosSecretariaEscuela
      //   path: 'cursos',
      //   name: 'cursosSecretariaEscuela',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     secretariaEscuela: true
      //   },
      // },
      // {
      //   //Enrutamiento de la vista contactarSecretariaEscuela
      //   path: 'contactar',
      //   name: 'contactarSecretariaEscuela',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     secretariaEscuela: true
      //   },
      // },
      
    ],
  },
  {
    //Enrutamiento de la vista del profesor
    path: '/profesor',
    name: 'profesor',
    component: () => import(/* webpackChunkName: "" */ '@/views/Profesor.vue'),
    meta: {
      requiresAuth: true
    },
    children:[
      {
        //Enrutamiento de la vista del administrador
        path: 'perfil',
        name: 'perfilProfesor',
        component: () =>
            import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/BodyGlobal.vue'),
        meta: {
            profesor: true
        },
      },
      {
        //Enrutamiento de la vista del administrador
        path: 'estudiantes',
        name: 'estudiantesProfesor',
        component: () =>import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantesGlobal.vue'),
        meta: {
            profesor: true
        },
      },
      // {
      //   //Enrutamiento de la vista crearObservacionProfesor
      //   path: 'observaciones/crearObservacion',
      //   name: 'crearObservacionProfesor',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Profesor.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     profesor: true
      // },
      // },
      // {
      //   //Enrutamiento de la vista listarObservacionesProfesor
      //   path: 'observaciones/listarObservaciones',
      //   name: 'listarObservacionesProfesor',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Profesor.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     profesor: true
      // },
      // },
      // {
      //   //Enrutamiento de la vista modificarObservacionProfesor
      //   path: 'observaciones/modificarObservacion',
      //   name: 'modificarObservacionProfesor',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Profesor.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     profesor: true
      // },
      // },
      // {
      //   //Enrutamiento de la vista eliminarObservacionProfesor
      //   path: 'observaciones/eliminarObservacion',
      //   name: 'eliminarObservacionProfesor',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Profesor.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     profesor: true
      // },
      // },
      // {
      //   //Enrutamiento de la vista cursosProfesor
      //   path: 'cursos',
      //   name: 'cursosProfesor',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Profesor.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     profesor: true
      // },
      // },
      // {
      //   //Enrutamiento de la vista contactarProfesor
      //   path: 'contactar',
      //   name: 'contactarProfesor',
      //   component: () => import(/* webpackChunkName: "" */ '@/views/Profesor.vue'/* ruta exacta por definir dado que no esta aun creada*/),
      //   meta: {
      //     profesor: true
      // },
      // },
    ],
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
});

router.beforeEach((to,from, next) =>{
  if (to.meta.requiresAuth) {
    if (store.state.admin) {
      next();
    } 
    else if (store.state.secretariaEscuela) {
      next();
    } 
    else if (store.state.profesor) {
      next();
    }
    else {
      next({
        name:'Inicio'
      });
    }
  } else{
    if (to.meta.admin) {
      if (store.state.admin) {
        next();
      } 
    } else if (to.meta.secretariaEscuela) {
      if (store.state.secretariaEscuela) {
        next();
      } 
    } else if (to.meta.profesor) {
      if (store.state.profesor) {
        next();
      } 
    } else {
      console.log('holaaa3');
      next();
    }
  };
});

export default router