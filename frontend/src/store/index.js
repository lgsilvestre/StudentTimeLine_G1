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
  },
  actions: {
  },
  modules: {
  }
})