import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)


export default new Vuex.Store({
  state: {
    status:'',
    resultado: null
  },
  mutations: {
    login(state,lista){
      console.log(lista.email);
      console.log(lista.pass);
      let post ={
        "email": lista.email,
        "password": lista.pass,
      };
      var url = 'por definir';
      axios.post(url,post).then((result)=>{
        console.log(result.statusText);
        state.status = result.statusText; 
        state.resultado = result;
      });
    }
  },
  actions: {
  },
  modules: {
  }
})
