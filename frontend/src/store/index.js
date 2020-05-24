import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import router from '@/router'
Vue.use(Vuex)


export default new Vuex.Store({
  state: {
    status:'',
    usuario: null,
    RCstatus:null,
    tk:null,
    config:{
      headers:{
        Authorization: ''
      }
    },
  },
  mutations: {
    login(state,lista){//funcion de login
      console.log(lista.email);
      console.log(lista.pass);
      let post ={
        "email": lista.email,
        "password": lista.pass,
      };
      var url = 'http://127.0.0.1:8000/api/v1/auth/login';
      axios.post(url,post).then((result)=>{
        state.usuario = result.data;
        state.tk = 'Bearer '+ state.usuario.token;
        state.config.headers.Authorization = state.tk;
        if (state.usuario.user.rol == "admin") {
          //redireccionamiento hacia el usuario administrador
          router.push({path: '/administrador'});
        } else {
          if (state.usuario.user.rol == "secretaria de escuela") {
            //redireccionamiento hacia el usuario secretaria de escuela
            router.push({path: '/secretariaEscuela'});
          } else {
            if (state.usuario.user.rol == "profesor") {
              //redireccionamiento hacia el usuario profesor
              router.push({path: '/profesor'});
            } else {
              //alerta a usuarios que no estan registrados, esto se solucionara la proxima semana

            }
          }
        }
      });
    },
    unLogin(state){
      //esta funcionalidad se agregara mas adelante cuando el backend tenga lista esta funcionalidad
    },
    registrarUsuario(state,nuevoUsuario){
      console.log(state.tk);
      let post ={
        "foto": null,
        "nombre": nuevoUsuario.nombre,
        "carrera": nuevoUsuario.escuela,
        "rol": nuevoUsuario.rol,
        "email": nuevoUsuario.correo,
        "password": nuevoUsuario.contrasena,
      }
      var url = 'http://127.0.0.1:8000/api/v1/User';
      axios.post(url,post,state.config)
        .then((result)=>{
          console.log(result.statusText);
        });
    },
  },
  actions: {
  },
  modules: {
  }
})