<template >
  <v-container  fluid  >
      <v-footer    padless absolute="" color="primary" min-width="720px"   >
        <v-btn color="primary white--text mt-3 mr-2 " depressed   @click="urlUniversidad" >Universidad de Talca</v-btn>
        <v-btn color="primary white--text mt-3 mr-2 " depressed   @click="urlContacto">Contacto</v-btn>
        <NosotrosComponent/>
        

        <v-spacer></v-spacer>
            <v-app-bar-nav-icon @click="setDrawelAdmin"></v-app-bar-nav-icon>

            <v-btn class="xs-2 " small icon fab @click="urlFacebook">
                    <v-icon color="white" >{{ icoFacebook }}</v-icon>
            </v-btn>
            <v-btn class="xs-2 ml-10" small  icon fab  @click="urlTwitter">
                <v-icon color="white">{{icoTwitter}}</v-icon>
            </v-btn>
            <v-btn class="xs-2 ml-10" small  icon fab  @click="urlInstagram">     
                <v-icon color="white"> {{ icoInstagram }} </v-icon>
            </v-btn>
            <v-btn class="xs-2 ml-10 mr-10" small   icon fab  @click="urlYoutube">     
                <v-icon color="white"> {{ icoYoutube }} </v-icon>
            </v-btn>
             
      <v-card-text class=" py-2 white--text text-center secondary">
        {{ new Date().getFullYear() }} — <strong> {{ nombrePag }} </strong>
      </v-card-text>
    </v-footer>
  </v-container>
</template>


<script>
import NosotrosComponent from '@/components/Globales/NosotrosComponent.vue';
import {mapMutations} from 'vuex';
export default {
    components:{
        NosotrosComponent
    },
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
        ...mapMutations(['setDrawelAdmin'])
        ,
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
