<template>
  <div>
    <v-app-bar
      color="white"
      dense
      elevate-on-scroll 
      :collapse=false
    >
        <!-- Logo Institucional -->
        <v-img            
            src="https://cdn.discordapp.com/attachments/299713523548684288/712751673008717824/logo-pinky.png"
            max-height="100"
            max-width="100"
        ></v-img>
        <v-spacer></v-spacer>

        <!-- Seccion de Categorias -->
        <div class="text-center">
          <v-row>
          <v-col
              justify-center
              v-for="(categoria,i) in categorias"
              :key="i"               
              >
              <v-btn text small>
                {{categoria}}
              </v-btn>

          </v-col>
          </v-row>
        </div>

        <v-spacer></v-spacer>
        <!-- Boton que llamará al panel lateral
         -->
        <v-app-bar-nav-icon></v-app-bar-nav-icon>      

    </v-app-bar>
  </div>
</template>

<script>
/* import Menu from './Menu'; */
  export default {
    components: {
/*         Menu, */
    },
    data () {
      return {
        categorias: [
          'prueba 1',
          'prueba 2',
          'prueba 3',

        ],
      }
    },  
  }
</script>