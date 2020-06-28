<template>
  <div>
    <v-app-bar
      color="primary"
      
      elevate-on-scroll 
      :collapse=false
    >
        <!-- Logo Institucional -->
        <div class="d-flex align-center">
        <v-img 
            class="shrink mr-2"
            src="@/assets/Globales/utalca.png"
            width="300"
        />
        </div>

        <v-spacer></v-spacer>

        <!-- Boton que abrira las notificaciones-->
        <div class="d-flex align-center">      
          <v-btn class="hola ma-2"  fab depressed small dark color="primary">
            <v-icon color="white">mdi-bell</v-icon>
          </v-btn>      

        <!-- Boton que llamará al panel lateral-->
          <v-btn class="ma-2" fab elevation="3" small dark color="white"
            @click="setDrawelAdmin"
          >
            <v-icon color="primary">mdi-format-list-bulleted</v-icon>
          </v-btn>
        </div>
    </v-app-bar>
  </div>
</template>

<script>
import {mapMutations} from 'vuex';
  export default {
    components: {
    },
    data () {
      return {
      }
    },
    methods:{
      ...mapMutations(['setDrawelAdmin'])
    }
  }
</script>