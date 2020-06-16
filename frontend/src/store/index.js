import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import router from '@/router'
Vue.use(Vuex)


export default new Vuex.Store({
    state: {
        status: '',
        usuario: null,
        RCstatus: null,
        tk: null,
        // pongan aca las variables para todos los drawer
        drawers: {
            drawer: true,
            miniVarianteAdm: false,

        },
        admin: false,
        profesor: false,
        secretariaEscuela: false,

        numProfesores: 70,
        numObservaciones: 69,
        numCarreras: 7,
        numEstudiantes: 1234,

        config: {
            headers: {
                Authorization: ''
            }
        },

    },
  
    mutations: {
        login(state, lista,methods) { //funcion de login
        let post = {
            "email": lista.email,
            "password": lista.pass,
        };
        var url = 'http://127.0.0.1:8000/api/v1/auth/login';
        axios.post(url, post).then((result) => {
            state.usuario = result.data;
            state.tk = 'Bearer '+ state.usuario.token;
            state.config.headers.Authorization = state.tk;
            if (state.usuario.user.rol == "admin") {
                //redireccionamiento hacia el usuario administrador
                
                state.admin=true;
                router.push({ path: '/administrador' });
            } else {
                if (state.usuario.user.rol == "secretaria de escuela") {
                    //redireccionamiento hacia el usuario secretaria de escuela
                    state.secretariaEscuela=true;
                    router.push({ path: '/secretariaEscuela' });
                } else {
                    if (state.usuario.user.rol == "profesor") {
                        //redireccionamiento hacia el usuario profesor
                        state.profesor=true;
                        router.push({ path: '/profesor' });
                    } else {
                        //alerta a usuarios que no estan registrados, esto se solucionara la proxima semana

                    }
                }
            }
        });
        },
        unLogin(state){
            //esta funcionalidad se agregara mas adelante cuando el backend tenga lista esta funcionalidad
            var url = 'http://127.0.0.1:8000/api/v1/auth/logout';
            axios.get(url,state.config)
            .then((result)=>{
                console.log(result);
            if (result.statusText=='OK') {
                state.status='';
                state.usuario= null;
                state.RCstatus=null;
                state.tk=null;
                state.drawelAdmin= false;
                state.admin= false;
                state.profesor= false;
                state.secretariaEscuela= false;
                state.numProfesores= 70;
                state.numObservaciones= 69;
                state.numCarreras= 7;
                state.numEstudiantes= 1234;
                state.config.headers.Authorization='';
                router.push({ path: '/' });
            }
            });
        },
        
        registrarUsuario(state, nuevoUsuario) {
            var aux;
            if (nuevoUsuario.role == "Administrador") {
                aux = "admin"
            };
            if (nuevoUsuario.role == "Secretaría de Escuela") {
                aux = "secretaria de escuela"
            };
            if (nuevoUsuario.role == "Profesor") {
                aux = "profesor"
            };
            let post = {
                "foto": null,
                "nombre": nuevoUsuario.nombre,
                "escuela": nuevoUsuario.escuela,
                "role": aux,
                "email": nuevoUsuario.correo,
                "password": nuevoUsuario.contrasena,
            }
            var url = 'http://127.0.0.1:8000/api/v1/usuario';
            // console.log(state.config);
            console.log(url)
            console.log(post)
            axios.post(url, post, state.config)
                .then((result) => {
                    console.log(result.statusText);
                });
        },
        updateDatosUsuarioPerfil(state, datosUsuario) {
            console.log(state.tk);
            let put = {
                "nombre": datosUsuario.nombre,
                "escuela": null,
                "rol": null,
                "foto": null,
                "email": datosUsuario.correo,
                "password": datosUsuario.contrasena,
            }
            var url = 'http://127.0.0.1:8000/api/v1/usuario/' + state.usuario.data.user.id;
            console.log(state.config);
            axios.put(url, put, state.config)
                .then((result) => {
                    console.log(result.statusText);
                });
        },
        setDrawelAdmin(state) {
            state.drawers.miniVarianteAdm = !state.drawers.miniVarianteAdm;
            // console.log('pucha : ' + state.drawelAdmin);
        },
    },
    methods:{

    },
    actions: {
    },
    modules: {
    }
})