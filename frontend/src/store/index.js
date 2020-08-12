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
        drawerProfesor: false,
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
        config2: {
            responseType: 'blob',
            headers: {
                Authorization: '',
            },
        },
        cargaLogin: false,
        verificacionLogin: false,
        mensajeErrorLogin: '',
        perfilEstudiante: '',
        infoSemestre: null,
        rutaDinamica: 'http://127.0.0.1:8000/',
    },
    mutations: {
        calcularRol(state, nuevoSemestre) {
            this.infoSemestre = nuevoSemestre
            state.infoSemestre = this.infoSemestre;
            nuevoSemestre
            if (state.admin) {
                router.push({ path: '/administrador/cursos/' + this.infoSemestre.anio + '-' + this.infoSemestre.semestre });
            } else if (state.profesor) {
                router.push({ path: '/profesor/cursos/' + this.infoSemestre.anio + '-' + this.infoSemestre.semestre });
            } else {
                router.push({ path: '/secretariaEscuela/cursos/' + this.infoSemestre.anio + '-' + this.infoSemestre.semestre });
            }
        },
        calcularRolVuelta(state) {
            if (state.admin) {
                router.push({ path: '/administrador/cursos/' });
            } else if (state.profesor) {
                router.push({ path: '/profesor/cursos/' });
            } else {
                router.push({ path: '/secretariaEscuela/cursos/' });
            }
        },
        login(state, lista, methods) { //funcion de login
            state.cargaLogin = true;
            state.verificacionLogin = false;
            let post = {
                "email": lista.email,
                "password": lista.pass,
            };
            var url = state.rutaDinamica+'api/v1/auth/login';
            axios.post(url, post)
                .then((result) => {
                    //console.log(result.data.data);
                    state.usuario = result.data.data;
                    state.tk = 'Bearer ' + state.usuario.token;
                    state.config.headers.Authorization = state.tk;
                    state.config2.headers.Authorization = state.tk;
                    if (state.usuario.usuario.rol == "admin") {
                        //redireccionamiento hacia el usuario administrador
                        state.admin = true;
                        state.cargaLogin = false;
                        router.push({ path: '/administrador/registros' });
                    } else {
                        if (state.usuario.usuario.rol == "secretaria de escuela") {
                            //redireccionamiento hacia el usuario secretaria de escuela
                            state.secretariaEscuela = true;
                            state.cargaLogin = false;
                            router.push({ path: '/secretariaEscuela' });
                        } else {
                            if (state.usuario.usuario.rol == "profesor") {
                                //redireccionamiento hacia el usuario profesor
                                state.profesor = true;
                                state.cargaLogin = false;
                                router.push({ path: '/profesor' });
                            }
                        }
                    }
                })
                .catch((error) => {
                    if (error.message == 'Network Error') {
                        //console.log(error);
                        state.verificacionLogin = true;
                        state.cargaLogin = false;
                        state.mensajeErrorLogin = 'Error al comunicarse con el servidor, intente más tarde';
                    } else {
                        if (error.response.data.success == false) {
                            switch (error.response.data.code) {
                                case 2:
                                    //console.log(error.response.data.code + ' ' + error.response.data.message);
                                    //console.log(error.response.data);
                                    state.verificacionLogin = true;
                                    state.cargaLogin = false;
                                    state.mensajeErrorLogin = error.response.data.message;
                                    break;
                                case 3:
                                    //console.log(error.response.data.code + ' ' + error.response.data.message);
                                    //console.log(error.response.data);
                                    state.verificacionLogin = true;
                                    state.cargaLogin = false;
                                    state.mensajeErrorLogin = error.response.data.message;
                                    break;
                                case 4:
                                    //console.log(error.response.data.code + ' ' + error.response.data.message);
                                    //console.log(error.response.data);
                                    state.verificacionLogin = true;
                                    state.cargaLogin = false;
                                    state.mensajeErrorLogin = error.response.data.message;
                                    break;
                                default:
                                    break;
                            }
                        }
                    }
                });
        },
        unLogin(state) {
            var url = state.rutaDinamica+'api/v1/auth/logout';
            axios.get(url, state.config)
                .then((result) => {
                    console.log(result);
                    if (result.statusText == 'OK') {
                        state.status = '';
                        state.usuario = null;
                        state.RCstatus = null;
                        state.tk = null;
                        state.drawelAdmin = false;
                        state.admin = false;
                        state.profesor = false;
                        state.secretariaEscuela = false;
                        state.numProfesores = 70;
                        state.numObservaciones = 69;
                        state.numCarreras = 7;
                        state.numEstudiantes = 1234;
                        state.config.headers.Authorization = '';
                        state.config2.headers.Authorization = '';
                        router.push({ path: '/' });
                    }
                })
                .catch((error) => {
                    if (error.message == 'Network Error') {
                        console.log(error);
                        console.log('Error al comunicarse con el servidor, intente más tarde');
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
            var url =  state.rutaDinamica+'api/v1/usuario';
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
            var url =  state.rutaDinamica+'api/v1/usuario/' + state.usuario.data.user.id;
            console.log(state.config);
            axios.put(url, put, state.config)
                .then((result) => {
                    console.log(result.statusText);
                });
        },
        // guardarPerfil() {
        //     //this.state
        // }

    },
    methods: {
    },
    actions: {},
    modules: {}
})