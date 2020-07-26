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
            class="shrink mr-2 d-none d-sm-flex"
            src="@/assets/Globales/utalca.png"
            width="300"
        />
        <v-img 
            class="shrink mr-2 d-flex d-sm-none"
            src="@/assets/Globales/utalca2.png"
            width="45"
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
            @click="drawel"
            >
            <v-icon color="primary" 
            :class="icono== true ? 'd-flex':'d-none'"
            >fas fa-list-ul</v-icon>
            <v-icon color="primary" 
            :class="icono== true ? 'd-none':'d-flex'"
            >fas fa-ellipsis-v</v-icon>
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
        icono:false,
      }
    },
    methods:{
      drawel(){
        //console.log(this.$vuetify.breakpoint.name );
        if(this.$vuetify.breakpoint.name == 'sm' || this.$vuetify.breakpoint.name == 'xs'){
            this.$store.state.drawers.drawer = !this.$store.state.drawers.drawer;
            this.$store.state.drawers.miniVarianteAdm = false;
            console.log(this.icono);
            this.icono=true;
        }
        else{
            this.$store.state.drawers.drawer = true;
            this.$store.state.drawers.miniVarianteAdm = !this.$store.state.drawers.miniVarianteAdm;
            this.$store.state.drawerProfesor = !this.$store.state.drawerProfesor;     
            this.icono=this.$store.state.drawerProfesor;

        }
      },
    }
  }
</script>