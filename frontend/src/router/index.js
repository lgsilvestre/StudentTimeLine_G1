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
        path: '/ReinicioContraseña/:codigo',
        name: 'ReinicioContraseña',
        component: () =>
            import ( /* webpackChunkName: "ReinicioContraseña" */ '@/views/ReinicioContraseña.vue'),
    },
    {
        //Enrutamiento de la vista del administrador
        path: '/administrador',
        name: 'Administrador',
        component: () =>
            import ( /* webpackChunkName: "Administrador" */ '@/views/Administrador.vue'),
        meta: {
            requiresAuth: true
        },
        children: [{
                //Enrutamiento de la vista del administrador
                path: 'escuela',
                name: 'Escuela',
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Administrador/BodyEscuelas.vue' /* ruta exacta por definir dado que no esta aun creada*/ ),
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
        path: ':enrutamiento/id=:id',
        name: 'estudiantesPerfilAdministrador',
        component: () =>import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantePerfil.vue'),
        meta: {
            admin: true
        },
      },
      {
        //Enrutamiento de la vista del administrador
        path: 'semestres/:enrutamiento/id=:id',
        name: 'estudiantesPerfilAdministrador2',
        component: () =>import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantePerfil.vue'),
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
      {
        //Enrutamiento de la vista del administrador
        path: 'registros',
        name: 'registrosAdministrador',
        component: () =>import ( /* webpackChunkName: "Administrador" */ '@/components/Administrador/Registros.vue'),
        meta: {
            admin: true
        },
      },
            {
                //Enrutamiento de la vista cursosAdministrador
                path: 'semestres',
                name: 'cursosAdministrador',
                component: () =>
                    import ( /* webpackChunkName: "" */ '@/components/SecretariaDeEscuela/BodyCursos.vue'),
                meta: {
                    admin: true
                },
            },
            {
                //Enrutamiento de la vista cursosAdministrador
                path: 'semestres/:id',
                name: 'insCursosAdministrador',
                component: () =>
                    import ( /* webpackChunkName: "" */ '@/components/SecretariaDeEscuela/BodyInsCurso.vue'),
                meta: {
                    admin: true
                },
            },
            {
                //Enrutamiento de la vista cursosAdministrador
                path: 'observaciones',
                name: 'observacionesAdministrador',
                component: () =>
                    import ( /* webpackChunkName: "" */ '@/components/Globales/ObservacionesGlobal.vue'),
                meta: {
                    admin: true
                },
            },


        ]
    },

    {
        //Enrutamiento de la vista del administrador
        path: '/secretariaEscuela',
        name: 'secretariaEscuel',
        component: () =>
            import ( /* webpackChunkName: "Administrador" */ '@/views/SecretariaEscuela.vue'),
        meta: {
            requiresAuth: true
        },
        children: [{
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
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantesGlobal.vue'),
                meta: {
                    secretariaEscuela: true
                },
            },
            {
                //Enrutamiento de la vista del administrador
                path: ':enrutamiento/id=:id',
                name: 'estudiantesPerfilSecretariaEscuela',
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantePerfil.vue'),
                meta: {
                    secretariaEscuela: true
                },
            },
            {
                //Enrutamiento de la vista del administrador
                path: 'semestres/:enrutamiento/id=:id',
                name: 'estudiantesPerfilSecretariaEscuela2',
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantePerfil.vue'),
                meta: {
                    secretariaEscuela: true
                },
            },
            {
                //Enrutamiento de la vista habilitarProfesorSecretariaEscuela
                path: 'profesores',
                name: 'profesoresSecretariaEscuela',
                component: () =>
                    import ( /* webpackChunkName: "" */ '@/components/SecretariaDeEscuela/BodyProfesores.vue'),
                meta: {
                    secretariaEscuela: true
                },
            },
            {
                //Enrutamiento de la vista cursosAdministrador
                path: 'semestres',
                name: 'cursosSecretariaEscuela',
                component: () =>
                    import ( /* webpackChunkName: "" */ '@/components/SecretariaDeEscuela/BodyCursos.vue'),
                meta: {
                    secretariaEscuela: true
                },
            },
            {
                //Enrutamiento de la vista cursosAdministrador
                path: 'semestres/:id',
                name: 'insCursosSecretariaEscuela',
                component: () =>
                    import ( /* webpackChunkName: "" */ '@/components/SecretariaDeEscuela/BodyInsCurso.vue'),
                meta: {
                    secretariaEscuela: true
                },
            },
            {
                //Enrutamiento de la vista cursosAdministrador
                path: 'observaciones',
                name: 'observacionesSecretariaEscuela',
                component: () =>
                    import ( /* webpackChunkName: "" */ '@/components/Globales/ObservacionesGlobal.vue'),
                meta: {
                    secretariaEscuela: true
                },
            },
        ]},
    {
        //Enrutamiento de la vista del profesor
        path: '/profesor',
        name: 'profesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue'),
        meta: {
            requiresAuth: true
        },
        children: [{
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
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantesGlobal.vue'),
                meta: {
                    profesor: true
                },
            },
            {
                //Enrutamiento de la vista del administrador
                path: ':enrutamiento/id=:id',
                name: 'estudiantesPerfilProfesor',
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/EstudiantePerfil.vue'),
                meta: {
                    profesor: true
                },
            },
            {
                //Enrutamiento de la vista del administrador
                path: 'cursos',
                name: 'cursosProfesor',
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Profesor/BodyCursosProfesor.vue'),
                meta: {
                    profesor: true
                },
            },
            {
                //Enrutamiento de la vista cursosAdministrador
                path: 'observaciones',
                name: 'observacionesProfesor',
                component: () =>
                    import ( /* webpackChunkName: "" */ '@/components/Globales/ObservacionesGlobal.vue'),
                meta: {
                    profesor: true
                },
            },
        ],
    },
    {
        //Enrutamiento de la vista de RecuperacionContraseña
        path: '/recuperacionContrasena',
        name: 'RecuperacionContrasena',
        component: () =>
            import ( /* webpackChunkName: "RecuperacionContraseña" */ '@/views/RecuperacionContrasena.vue')
    },

]



const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        if (store.state.admin) {
            next();
        } else if (store.state.secretariaEscuela) {
            next();
        } else if (store.state.profesor) {
            next();
        } else {
            next({
                name: 'Inicio'
            });
        }
    } else {
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
            next();
        }
    };
});

export default router