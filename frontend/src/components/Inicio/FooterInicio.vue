<template>
  <v-footer dark padless absolute>
    <v-card class="flex" flat tile>
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
                    <v-icon color="white" >{{icoFacebook}}</v-icon>
            </v-btn>
            <v-btn   icon fab  @click="urlTwitter">
                <v-icon color="white">{{icoTwitter}}</v-icon>
            </v-btn>
            <v-btn   icon fab  @click="urlInstagram">     
                <v-icon color="white">{{icoInstagram}}</v-icon>
            </v-btn>
            <v-btn class="mr-5"  icon fab  @click="urlYoutube">     
                <v-icon color="white">{{icoYoutube}}</v-icon>
            </v-btn>
      </v-card-title>

      <v-card-text class=" py-2 white--text text-center secondary">
        {{ new Date().getFullYear() }} — <strong> {{ nombrePag }} </strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>


<script>
export default {
  data() {
        return {
            icoFacebook:'mdi-facebook',
            icoTwitter:'mdi-twitter',
            icoInstagram: 'mdi-instagram',
            icoYoutube:'mdi-youtube',
            nombrePag:'La Calila y los Mojojojo',
        }
    },
    methods:{
        urlFacebook(){
            window.open("https://www.facebook.com/utalca/", '_blank');
        },
        urlTwitter(){
            window.open("https://twitter.com/utalca", '_blank');
        },
        urlInstagram(){
            window.open("https://www.instagram.com/utalca/", '_blank');
        },
        urlYoutube(){
            window.open("https://www.youtube.com/channel/UCoH9MLoWd9f5mFbSBaa_X9Q", '_blank');
        },
        urlContacto(){
            window.open("https://www.utalca.cl/contacto/", '_blank');
        },
        urlUniversidad(){
            window.open("https://www.utalca.cl/universidad/", '_blank');
        }
    }
}
</script>
