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
        drawelAdmin: false,
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
        // listarUsuario(state) {
        //     // console.log(state.prueba)
        //     var url = 'http://127.0.0.1:8000/api/v1/usuario';
        //     axios.get(url, state.config).then(res => {
        //         this.Usuarios = res.data
        //         console.log(res.data)
        //     })
        // },

                      }
                  }
              }
          });
      },
      unLogin(state){
        //esta funcionalidad se agregara mas adelante cuando el backend tenga lista esta funcionalidad
      },
      
      
      registrarUsuario(state,nuevoUsuario){
        var aux;
        if(nuevoUsuario.role=="Administrador"){
          aux="admin"
        };   
        if(nuevoUsuario.role=="Secretaría de Escuela"){
          aux="secretaria de escuela"
        }; 
        if(nuevoUsuario.role=="Profesor"){
          aux="profesor"
        };
        let post ={
          "foto": null,
          "nombre": nuevoUsuario.nombre,
          "escuela": nuevoUsuario.escuela,
          "role": aux,  
          "email": nuevoUsuario.correo,
          "password": nuevoUsuario.contrasena,
        }
        var url = 'http://127.0.0.1:8000/api/v1/usuario';
        console.log(post);
        axios.post(url,post,state.config)
          .then((result)=>{
            console.log(result.statusText);
          });
      },
      updateDatosUsuarioPerfil(state,datosUsuario){
        console.log(state.tk);
        let put ={
          "nombre": datosUsuario.nombre,
          "escuela": null,
          "role": null,
          "foto": null,
          "email": datosUsuario.correo,
          "password": datosUsuario.contrasena,
        }
        var url = 'http://127.0.0.1:8000/api/v1/usuario/'+state.usuario.data.user.id;
        console.log(state.config);
        axios.put(url,put,state.config)
          .then((result)=>{
            console.log(result.statusText);
          });
      },
      setDrawelAdmin(state) {
        state.drawelAdmin = !state.drawelAdmin;
        console.log('pucha');
      },
     
  },

                    state.admin = true;
                    router.push({ path: '/administrador' });
                } else {
                    if (state.usuario.user.rol == "secretaria de escuela") {
                        //redireccionamiento hacia el usuario secretaria de escuela
                        router.push({ path: '/secretariaEscuela' });
                    } else {
                        if (state.usuario.user.rol == "profesor") {
                            //redireccionamiento hacia el usuario profesor
                            router.push({ path: '/profesor' });
                        } else {
                            //alerta a usuarios que no estan registrados, esto se solucionara la proxima semana

                        }
                    }
                }
            });
        },
        unLogin(state) {
            //esta funcionalidad se agregara mas adelante cuando el backend tenga lista esta funcionalidad
        },


        registrarUsuario(state, nuevoUsuario) {
            console.log(state.tk);
            let post = {
                "foto": null,
                "nombre": nuevoUsuario.nombre,
                "carrera": nuevoUsuario.escuela,
                "rol": nuevoUsuario.rol,
                "email": nuevoUsuario.correo,
                "password": nuevoUsuario.contrasena,
            }
            var url = 'http://127.0.0.1:8000/api/v1/User';
            console.log(state.config);
            axios.post(url, post, state.config)
                .then((result) => {
                    console.log(result.statusText);
                });
        },
        updateDatosUsuarioPerfil(state, datosUsuario) {
            console.log(state.tk);
            console.log(datosUsuario);
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
            state.drawelAdmin = !state.drawelAdmin;
            console.log('pucha');
        },

    },

    actions: {},
    modules: {}
})