<template>
  <v-footer
    dark
    padless
  >
    <v-card
      class="flex"
      flat
      tile
    >
      <v-card-title class="primary">
        <v-btn color="primary white--text mt-3 mr-2 " depressed="true" flat @click="urlUniversidad" >Universidad de Talca</v-btn>
        <v-btn color="primary white--text mt-3 mr-2 " depressed="true" flat @click="urlContacto">Contacto</v-btn>
        <v-btn color="primary white--text mt-3  mr-2" depressed="true"  flat  @click="nosotros">Nosotros</v-btn>

        <v-spacer></v-spacer>

        <v-card-title class="primary">
            <strong class="subheading">Siguenos!</strong>

            <v-spacer></v-spacer>

            </v-card-title>

            <v-btn  icon fab @click="urlFacebook">
                    <v-icon color="white" >mdi-facebook</v-icon>
            </v-btn>
            <v-btn   icon fab  @click="urlTwitter">
                <v-icon color="white">mdi-twitter</v-icon>
            </v-btn>
            <v-btn   icon fab  @click="urlInstagram">     
                <v-icon color="white">mdi-instagram</v-icon>
            </v-btn>
            <v-btn class="mr-5"  icon fab  @click="urlInstagram">     
                <v-icon color="white">mdi-youtube</v-icon>
            </v-btn>
      </v-card-title>

      <v-card-text class=" py-2 white--text text-center secondary">
        {{ new Date().getFullYear() }} — <strong>La Calila y los Mojojojo</strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>


<script>
export default {
    methods:{
        urlFacebook(){
            console.log('desde redireccionar')
            window.location.href = "https://www.facebook.com/utalca/"
        },
        urlTwitter(){
            console.log('desde redireccionar')
            window.location.href = "https://twitter.com/utalca"
        },
        urlInstagram(){
            console.log('desde redireccionar')
            window.location.href = "https://www.instagram.com/utalca/"
        },
        urlInstagram(){
            console.log('desde redireccionar')
            window.location.href = "https://www.youtube.com/channel/UCoH9MLoWd9f5mFbSBaa_X9Q"
        },
        urlContacto(){
            console.log('desde redireccionar')
            window.location.href = "https://www.utalca.cl/contacto/"
        },
        urlUniversidad(){
            console.log('desde redireccionar')
            window.location.href = "https://www.utalca.cl/universidad/"
        }
    }
}
</script>
