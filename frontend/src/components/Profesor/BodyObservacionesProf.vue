<template>
    <v-container>
        <v-row>
        <v-col cols="1" sm="1"></v-col>
        <v-col cols="10" sm="10">
            <v-card class="justify-center mt-2">
                <v-img  class="mx-auto white--text align-end justify-center"
                width="100%" height="180px"  src="@/assets/Globales/fondo3.jpg">
                    <v-card-title class="white--text" style="padding:0;">
                        <v-row class="px-5"> 
                            <v-col cols="12" class="pt-1">
                                <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >
                                    Observaciones</strong>
                            </v-col> 

                        </v-row>

                    </v-card-title>
                </v-img>

            </v-card>
        </v-col>
        <v-col cols="1" sm="1"></v-col>
        </v-row>
    </v-container>    
</template>

<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
export default {
    data() {
        return {
            listaObservaciones:[{id:''},{ayudante:''},{estudiante:''},{curso:''},{categoria:''},
            {descripcion:''}]
            
        }
    },
    beforeMount() {
        this.ObtenerObservacionesDeUnProfesor();
    },
    methods: {
        ObtenerObservacionesDeUnProfesor(){
        
        }
    },
    
}
</script>