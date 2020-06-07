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
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Administrador/BodyListaUsuarios.vue' /* ruta exacta por definir dado que no esta aun creada*/ ),
                meta: {
                    admin: true
                },
            },
            {
                //Enrutamiento de la vista del administrador
                path: 'usuario/crearUsuario',
                name: 'crearUsuario',
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Administrador/RegistroUsuarios/BodyRegistroUsuarios.vue'),
                meta: {
                    admin: true
                },
            },
            {
                //Enrutamiento de la vista del administrador
                path: 'perfil',
                name: 'perfilAdministrador',
                component: () =>
                    import ( /* webpackChunkName: "Administrador" */ '@/components/Globales/BodyGlobal.vue'),
                meta: {
                    admin: true
                },
            },
        ]
    },
    //enrutamiento de las subrutas del administrador

    {
        //Enrutamiento de la vista del administrador
        path: '/administrador/escuelas',
        name: 'listarEscuela',
        component: () =>
            import ( /* webpackChunkName: "Administrador" */ '@/components/Administrador/BodyEscuelas.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista del administrador
        path: '/administrador/escuela/habilitarEscuela',
        name: 'habilitarEscuela',
        component: () =>
            import ( /* webpackChunkName: "Administrador" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista del administrador
        path: '/administrador/escuela/deshabilitarEscuela',
        name: 'deshabilitarEscuela',
        component: () =>
            import ( /* webpackChunkName: "Administrador" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },

    {
        //Enrutamiento de la vista del administrador
        path: '/administrador/usuario/listarUsuarios',
        name: 'listarUsuario',
        component: () =>
            import ( /* webpackChunkName: "Administrador" */ '@/components/Administrador/BodyListaUsuarios.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista del administrador
        path: '/administrador/usuario/modificarUsuario',
        name: 'modificarUsuario',
        component: () =>
            import ( /* webpackChunkName: "Administrador" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista del administrador
        path: '/administrador/usuario/eliminarUsuario',
        name: 'eliminarUsuario',
        component: () =>
            import ( /* webpackChunkName: "Administrador" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista listaEstudiantesAdministrador
        path: '/administrador/listarEstudiantes',
        name: 'listaEstudianteAdministrador',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista crearObservacionAdministrador
        path: '/administrador/observaciones/crearObservacion',
        name: 'crearObservacionAdministrador',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista listarObservacionesAdministrador
        path: '/administrador/observaciones/listarObservaciones',
        name: 'listarObservacionesAdministradorr',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista modificarObservacionAdministrador
        path: '/administrador/observaciones/modificarObservacion',
        name: 'modificarObservacionAdministrador',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista eliminarObservacionAdministrador
        path: '/administrador/observaciones/eliminarObservacion',
        name: 'eliminarObservacionAdministrador',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista habilitarProfesorAdministrador
        path: '/administrador/profesores/habilitarProfesor',
        name: 'habilitarProfesorAdministrador',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista deshabilitarProfesorAdministrador
        path: '/administrador/profesores/deshabilitarProfesor',
        name: 'deshabilitarProfesorAdministrador',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },

    {
        //Enrutamiento de la vista cursosAdministrador
        path: '/administrador/cursos',
        name: 'cursosAdministrador',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Administrador.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista del profesor
        path: '/profesor',
        name: 'Profesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue')
    },
    //enrutamiento de las subrutas del profesor
    {
        //Enrutamiento de la vista perfilProfesor
        path: '/profesor/perfil',
        name: 'perfilProfesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista listaEstudiantesProfesor
        path: '/profesor/listarEstudiantes',
        name: 'listaEstudiantesProfesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista crearObservacionProfesor
        path: '/profesor/observaciones/crearObservacion',
        name: 'crearObservacionProfesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista listarObservacionesProfesor
        path: '/profesor/observaciones/listarObservaciones',
        name: 'listarObservacionesProfesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista modificarObservacionProfesor
        path: '/profesor/observaciones/modificarObservacion',
        name: 'modificarObservacionProfesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista eliminarObservacionProfesor
        path: '/profesor/observaciones/eliminarObservacion',
        name: 'eliminarObservacionProfesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista cursosProfesor
        path: '/profesor/cursos',
        name: 'cursosProfesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista contactarProfesor
        path: '/profesor/contactar',
        name: 'contactarProfesor',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/Profesor.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista secretaria de escuela
        path: '/secretariaEscuela',
        name: 'SecretariaEscuela',
        component: () =>
            import ( /* webpackChunkName: "SecretariaEscuela" */ '@/views/SecretariaEscuela.vue')
    },
    //enrutamiento de las subrutas de secreteria de escuela
    {
        //Enrutamiento de la vista perfilSecretariaEscuela
        path: '/secretariaEscuela/perfil',
        name: 'perfilSecretariaEscuela',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista listaEstudiantesSecretariaEscuela
        path: '/secretariaEscuela/listarEstudiantes',
        name: 'listaEstudianteSecretariaEscuela',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista crearObservacionSecretariaEscuela
        path: '/secretariaEscuela/observaciones/crearObservacion',
        name: 'crearObservacionSecretariaEscuelar',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista listarObservacionesSecretariaEscuela
        path: '/secretariaEscuela/observaciones/listarObservaciones',
        name: 'listarObservacionesSecretariaEscuelar',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista modificarObservacionSecretariaEscuela
        path: '/secretariaEscuela/observaciones/modificarObservacion',
        name: 'modificarObservacionSecretariaEscuela',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista eliminarObservacionSecretariaEscuela
        path: '/secretariaEscuela/observaciones/eliminarObservacion',
        name: 'eliminarObservacionSecretariaEscuela',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista habilitarProfesorSecretariaEscuela
        path: '/secretariaEscuela/profesores/habilitarProfesor',
        name: 'habilitarProfesorSecretariaEscuela',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista deshabilitarProfesorSecretariaEscuela
        path: '/secretariaEscuela/profesores/deshabilitarProfesor',
        name: 'deshabilitarProfesorSecretariaEscuela',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },

    {
        //Enrutamiento de la vista cursosSecretariaEscuela
        path: '/SecretariaEscuela/cursos',
        name: 'cursosSecretariaEscuela',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
    },
    {
        //Enrutamiento de la vista contactarSecretariaEscuela
        path: '/secretariaEscuela/contactar',
        name: 'contactarSecretariaEscuela',
        component: () =>
            import ( /* webpackChunkName: "" */ '@/views/SecretariaEscuela.vue' /* ruta exacta por definir dado que no esta aun creada*/ )
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
        } else {
            next({
                name: 'Inicio'
            });
        }
    } else {
        if (to.meta.admin) {
            if (store.state.admin) {
                console.log('holaaa');
                next();
            } else {
                console.log('holaaa2');
                next({
                    name: 'Inicio'
                });
            }
        } else {
            console.log('holaaa3');
            next();
        };
    };

});

export default router