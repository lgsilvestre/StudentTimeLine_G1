<template>
    <v-container  fluid >
        <div class="py-1"  style="text-align:left;">
            <v-btn
            color="secondary"
            rounded
            small
            @click="volverEstudiantes"
            >
            volver<i class="fas fa-undo-alt pl-2"></i>
            
            </v-btn>
        </div>
        <v-row >
            <v-col  cols="12" md="5" xl="4">
                <v-card elevation="1" > 
                    <v-img
                        class="mx-auto white--text align-end justify-center"
                        width="100%"
                        src="@/assets/Globales/fondo.jpg"
                    >
                    <v-card-title
                    class="headline  text--center"
                    primary-title>
                        <div class="difuminado">
                            <strong class="white--text letra">Estudiante</strong>
                        </div>
                        <v-spacer></v-spacer>
                        <v-avatar :size="$vuetify.breakpoint.smAndDown ? 100 : 120" class="borde mt">
                            <img
                                src="@/assets/Globales/estudiante4.png"
                            > 
                        </v-avatar>
                    </v-card-title>
                    </v-img>
                    <v-divider></v-divider>
                    <v-row class="px-5 mt-5">
                        <v-col cols="3">
                            <h5>Matricula</h5> 
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{perfilEstudiante.matricula}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Rut</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{perfilEstudiante.rut}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Nombre</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.nombre_completo}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Correo</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.correo}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Ingreso</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.anho_ingreso}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Situacion academica</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.situacion_academica}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3" class="pb-5">
                            <h5 >Escuela</h5>
                        </v-col>
                        <v-col cols="1" class="pb-5">
                            <h5 >:</h5>
                        </v-col >
                        <v-col class="pb-5" :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.escuela}}</h5>
                        </v-col>
                    </v-row>
                    <div class="pb-5"  style="text-align:center;">
                        <v-btn
                        color="secondary"
                        rounded
                        @click="editarEstudiante"
                        >Editar</v-btn>
                    </div>
                    
                </v-card>
            </v-col>
            <v-col cols="12" md="7" xl="8">
                <v-row>
                    <v-col cols="0" sm="0" md="1"> 

                    </v-col>
                    <v-col cols="12" sm="12" md="10" style="margin-top:0;padding-top:0;" >
                        <v-card height="200"> 
                                <v-row>
                                    <v-col cols="5" style="margin-top:0;padding-top:0;">
                                        <v-card-title
                                
                                        class="headline text--center primary" 
                                        primary-title>
                                            <div >
                                                <strong class=" white--text" >Observaciones</strong>
                                            </div>
                                            <v-spacer></v-spacer>
                                            <v-btn
                                            elevation="2"
                                            fab
                                            
                                            bottom
                                            left
                                            color="warning"
                                            >
                                                <v-icon class="mx-2" color="white">fas fa-plus</v-icon>
                                            </v-btn>
                                        </v-card-title>
                                    </v-col>
                                    <v-col cols="7">
                                        <v-row justify="center" align="center">  
                                            <div id="chart" >
                                                <apexchart type="donut" :options="chartOptions" :series="series" width="300"></apexchart>
                                            </div>
                                        </v-row>   
                                    </v-col>
                                </v-row>
                                
                                <v-container fluid style="margin:0;padding:0;" >
                                    
                                    
                                </v-container>
                                
                            
                        </v-card>
                        <template>
                            <v-timeline  align-top dense>
                                <v-timeline-item
                                v-for="(item, i) in items"
                                :key="i"
                                :color="item.color"
                                :icon="item.icon"
                                fill-dot
                                dense
                                
                                >
                                <v-card
                                    :color="item.color"
                                    dark
                                >
                                    <v-card-title class="title">Lorem Ipsum Dolor</v-card-title>
                                    <v-card-text class="white text--primary">
                                    <p>Lorem ipsum dolor sit amet, no nam oblique veritus. Commune scaevola imperdiet nec ut, sed euismod convenire principes at. Est et nobis iisque percipit, an vim zril disputando voluptatibus, vix an salutandi sententiae.</p>
                                    <v-btn
                                        :color="item.color"
                                        class="mx-0"
                                        outlined
                                    >
                                        Button
                                    </v-btn>
                                    </v-card-text>
                                </v-card>
                                </v-timeline-item>
                            </v-timeline>
                        </template>
                    </v-col>
                    <v-col cols="0" sm="0" md="1">

                    </v-col>
                </v-row>
            </v-col>
        </v-row>
        <!-- Alertas -->
        <!-- alerta de exito de la modificacion -->
        <v-snackbar v-model="alertAcept" :timeout=delay
        bottom color="secondary" left class="mb-1 pb-12 pr-0 mr-0" >
            <div>
                <v-icon color="white" class="mr-2">
                    fas fa-check-circle
                </v-icon>
                <strong>{{textoAcept}}</strong>
            </div>
            <v-btn color="white" elevation="0" x-small
            fab @click="alertAcept = ! alertAcept" > 
                <v-icon color="secondary">fas fa-times</v-icon>
            </v-btn>
        </v-snackbar>
        <!-- alerta de error en la modificacion -->
        <v-snackbar v-model="alertError" :timeout=delay bottom
        color="secondary" left class="mb-1 pb-12 pr-0 mr-0">
            <div>
                <v-icon color="white" class="mr-2">
                    fas fa-exclamation-triangle
                </v-icon>
                <strong>{{textoError}}</strong>
            </div>
            
            <v-btn color="white" elevation="0" x-small
            fab @click="alertError = ! alertError" > 
                <v-icon color="secondary">fas fa-times</v-icon>
            </v-btn>
        </v-snackbar>
    </v-container> 
</template>

<script>
import { mapState,mapMutations } from 'vuex'
import axios from 'axios'
import ApexCharts from 'apexcharts'
export default {
    data() {
        return {
            alertError: false,
            textoError: '',
            alertAcept: false,
            textoAcept: '',
            delay: 4000,
            mostrar: false, 
            items: [
            {
            color: 'red lighten-2',
            icon: 'mdi-star',
            },
            {
            color: 'purple darken-1',
            icon: 'mdi-book-variant',
            },
            {
            color: 'green lighten-1',
            icon: 'mdi-airballoon',
            },
            {
            color: 'indigo',
            icon: 'mdi-buffer',
            },
            
            ],
            series: [1, 1, 1, 1],
            chartOptions: {
                chart: {
                type: 'donut',
                },
                colors: ['#4ECDC4', '#FF6B6B', '#FFE66D', '#2196F3'],
                labels: ["Positiva", "Negativa", "Informativa", "Otro"],
               
            },

        }
    },
    computed:{
        ...mapState(['perfilEstudiante']), 
        
    },
    methods:{
        /**
         * Convierte la imagen cargada a base 64.
         */
        convertirImagen(e){
            this.imagenMiniatura=null;
            if(e != null){
                let image =e;
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.imagenMiniatura=e.target.result;
                }
            }  
        },
        volverEstudiantes(){
            this.$router.push({path:'/administrador/estudiantes'});
        },
        editarEstudiante(){
            console.log(this.$vuetify.breakpoint);
        },
        
    }
}
</script>
<style scoped>
    .difuminado{
        text-shadow: #555 2px 2px 3px;
    }
    .letra{
        font-size: 125%;
    }
    .borde {
        color:#fff;
        background-color: rgba(0,0,0,0.6);
        border-style: solid; 
        border-color: color;
    }
</style>