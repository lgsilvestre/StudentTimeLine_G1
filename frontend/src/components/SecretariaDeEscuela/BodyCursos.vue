<template>   
 <v-container>
     <v-row>
        <v-col cols="12" md="1"></v-col>
        <v-col cols="12" md="10">
            <v-card v-if=" this.$store.state.admin == true || this.$store.state.admin == true ">
                <v-img class="mx-auto white--text align-end justify-center" width="100%" height="150px"       
                src="@/assets/Globales/background-panel-08.jpg">
                    <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;">
                        <strong class=" font-weight-black"> Semestres </strong>
                        <v-spacer></v-spacer>
                        <v-btn class="mr-2" fab large bottom left @click="dialogAñadirSemestre =true" >
                             <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                         </v-btn>
                     </v-card-title> 
                </v-img>
                <!-- <v-container> -->
                    <v-row>
                        <v-col v-for="(semestre, index) in listaSemestres" :key="index" cols="12" sm="6" md="4" lg="3" >
                            <v-card class=" ml-2 mr-2"  dark color="#F7FFF7"  style=" border-style:solid; border-color:rgba(0,0,0,0.5);" > 
                                <v-container class="pt-0 mt-0 pb-0 ">
                                    <v-row >
                                        <v-col cols="12" class=" pt-0 pl-0 pr-0 pb-0" >
                                            <v-card-title class="mt-0 pt-0 pl-0 pr-0 " >
                                                <v-img class="mx-auto white--text align-end justify-center "
                                                        width="100%" height="30px"       
                                                        src="@/assets/Globales/background-panel-08.jpg"
                                                        v-show="semestre.semestre == 1">
                                                </v-img>
                                                <v-img class="mx-auto white--text align-end justify-center "
                                                        width="100%" height="30px"       
                                                        src="@/assets/Globales/background-panel-09.jpg"
                                                        v-show="semestre.semestre == 2">
                                                </v-img>
                                                <v-img class="mx-auto white--text align-end justify-center "
                                                        width="100%" height="30px"       
                                                        src="@/assets/Globales/background-panel-10.jpg"
                                                        v-show="semestre.semestre == 3">
                                                </v-img>
                                            </v-card-title>
                                        </v-col>
                                            
                                        <v-col cols="12" class=" pt-0 pl-0 pr-0 pb-0  text-right" >
                                            <v-menu class="text-left " offset-y>
                                                <template   v-slot:activator="{ on, attrs }">
                                                    <v-btn tile  color="primary" small icon v-bind="attrs" v-on="on" >
                                                        <v-icon>fas fa-ellipsis-v</v-icon>
                                                    </v-btn>
                                                </template>
                                                <v-list v-if="semestre.deleted_at == null">
                                                    <v-list-item  v-for="(item, index) in accionesSemestre" :key="index"
                                                    @click="acionesSobreSemestre(item,semestre)" >
                                                        <v-list-item-title>{{ item }}</v-list-item-title>
                                                    </v-list-item>
                                                </v-list>
                                                <v-list v-if="semestre.deleted_at != null">
                                                    <v-list-item  v-for="(item, index) in accionesSemestreEliminado" :key="index"
                                                    @click="acionesSobreSemestre(item,semestre)" >
                                                        <v-list-item-title>{{ item }}</v-list-item-title>
                                                    </v-list-item>
                                                </v-list>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="6"  class=" pt-0 pl-1 pr-0 pb-0 "  >
                                            
                                            
                                            <v-card-text class=" pt-0 pl-2 pr-0 pb-0 " v-if="semestre.deleted_at == null">
                                                <div class="text--primary " >
                                                    <p class="font-weight-black"   @click="calcularRol(semestre)"> {{ semestre.anio }} - {{semestre.semestre}}</p>
                                                </div>
                                            </v-card-text>
                                            <v-card-text class=" pt-0 pl-2 pr-0 pb-0 " v-if="semestre.deleted_at != null">
                                                <div class="text--primary " >
                                                    <p class="font-weight-black"   > {{ semestre.anio }} - {{semestre.semestre}}</p>
                                                </div>
                                            </v-card-text>
                                        </v-col>
                                            
                                            
                                        <!-- </v-col>
                                        <v-col cols="12">
                                            <v-card-text>
                                                <v-btn></v-btn>
                                            </v-card-text>
                                        </v-col> -->
                                    </v-row>
                                </v-container>
                            </v-card>
                        </v-col>
                    </v-row>
                <!-- </v-container> -->

            </v-card>

        </v-col>
        <v-col cols="12" md="1"></v-col>
     </v-row>
        <!-- Dialogo para agregar un semestre -->
     <v-dialog v-model="dialogAñadirSemestre" rtransition="scroll-y-reverse-transition"  persistent max-width="500px">
         <v-card class="mx-auto" max-width="800" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Registrar Semestre</h5>
                </v-card-title>
                <v-card-text class="px-12 mt-5" >
                    <v-form  ref="form" >
                        <v-container>
                            <v-row >
                                <v-col cols="6" >
                                    <strong>Año</strong>
                                </v-col>
                                <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                    <v-text-field  v-model="añoActual" dense
                                        outlined  color="secondary" :disabled="unAnhoVariable"
                                        :rules="rules" type="number"
                                        ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row >
                                <v-col cols="6" >
                                    <strong>Semestre</strong>
                                </v-col>
                                <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                    <v-select
                                        v-model="semestreActual"
                                        :items="listaSemestres_reg"
                                        item-text="sem"
                                        dense
                                        outlined
                                        color="secondary"
                                        ></v-select>
                                </v-col>
                            </v-row>
                            
                        </v-container>
                                  
                        <v-container  style="text-align:right;">
                            <v-btn rounded color="warning" @click="dialogAñadirSemestre=false">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn rounded color="secondary" class="ml-2 mr'5" @click="registrarSemestre()" >
                                <h4 class="white--text">Registrar</h4>
                            </v-btn>
                        </v-container>  
                    </v-form>
                </v-card-text>
            </v-card>
    </v-dialog>
    
    <v-dialog v-model="dialogModificarSemestre" rtransition="scroll-y-reverse-transition"  persistent max-width="500px">
         <v-card class="mx-auto" max-width="800" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Modificar Semestre</h5>
                </v-card-title>
                <v-card-text class="px-12 mt-10" >
                    <v-form  ref="form" >
                        <v-container>
                            <v-row >
                                <v-col cols="6" >
                                    <strong>Año</strong>
                                </v-col>
                                <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                    <v-text-field  v-model="añoActual" dense
                                        outlined  color="secondary" :disabled="unAnhoVariable"
                                        :rules="rules" type="number"
                                        ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row >
                                <v-col cols="6" >
                                    <strong>Semestre</strong>
                                </v-col>
                                <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                    <v-select
                                        v-model="semestreActual"
                                        :items="listaSemestres_reg"
                                        item-text="sem"
                                        dense
                                        outlined
                                        color="secondary"
                                        ></v-select>
                                </v-col>
                            </v-row>
                        </v-container>
                        <v-container  style="text-align:right;">
                            <v-btn rounded color="warning" @click="dialogModificarSemestre=false">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn rounded color="secondary" class="ml-2 mr'5" @click="modificarSemestre()" >
                                <h4 class="white--text">Registrar</h4>
                            </v-btn>
                        </v-container>  
                    </v-form>
                </v-card-text>
            </v-card>
    </v-dialog>
    <!-- dialogo para eliminar un semestre -->
    <v-dialog v-model="dialogEliminarSemestre" ref="form" persistent max-width="450px">
        <v-card class="mx-auto" max-width="450"  >
            <v-card-title
                class="headline primary text--center"
                primary-title
                >
                <h5 class="white--text ">Cerrar Semestre</h5>
                </v-card-title> 
                <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea cerrar el siguiente semestre?</v-card-title>
                <v-card-text>Año : {{ semestreActual_1.anio }}</v-card-text>
                <v-card-text>Semetre : {{ semestreActual_1.semestre }}</v-card-text>
                <div style="text-align:right;">
                    <v-btn rounded color="warning" class=" mb-4 "  @click="dialogEliminarSemestre = false">
                        <h4 class="white--text">Cancelar</h4>
                    </v-btn>
                    <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="eliminarSemestre()">
                        <h4 class="white--text">Eliminar</h4>
                    </v-btn>
                </div> 
        </v-card>
    </v-dialog>

    <!-- dialofo para re-abrir el semestre -->
    <v-dialog v-model="dialogReAbrirSemestre" ref="form" persistent max-width="450px">
        <v-card class="mx-auto" max-width="450"  >
            <v-card-title
                class="headline primary text--center"
                primary-title
                >
                <h5 class="white--text ">Cerrar Semestre</h5>
                </v-card-title> 
                <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea reabrir el siguiente semestre?</v-card-title>
                <v-card-text>Año : {{ semestreActual_1.anio }}</v-card-text>
                <v-card-text>Semetre : {{ semestreActual_1.semestre }}</v-card-text>
                <div style="text-align:right;">
                    <v-btn rounded color="warning" class=" mb-4 "  @click="dialogReAbrirSemestre = false">
                        <h4 class="white--text">Cancelar</h4>
                    </v-btn>
                    <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="reabrirSemestre()">
                        <h4 class="white--text">Aceptar</h4>
                    </v-btn>
                </div> 
        </v-card>
    </v-dialog>
     <!-- Alertas -->

    <!-- Alerta de Error -->

    <v-snackbar v-model="alertaError" :timeout="timeout"
        bottom color= "warning" left class="pb-12"  >
        <v-icon color="white"   
            class="mr-3"                      
        >
        fas fa-exclamation-triangle 
        </v-icon>
    
        <strong> {{textoAlertas }}</strong>
        <v-btn
            icon
            @click="alertaError = false"
            >
            <v-icon     
                color="white"                         
            >
            fas fa-times-circle
            </v-icon>                
        </v-btn>
    </v-snackbar>       

    <!-- Alerta de Exito (success) -->

    <v-snackbar v-model="alertaExito" :timeout="timeout" bottom
        color= "secondary" left class="pb-12"  >
        <v-icon class="mr-3"  color="white" >
            fas fa-info-circle  
        </v-icon>
    
        <strong> {{ textoAlertas }} </strong>

        <v-btn
            icon
            @click="alertaExito = false"
            >
            <v-icon     
                class="mr-3"
                color="white"                         
            >
            fas fa-times-circle
            </v-icon>                
        </v-btn>
    </v-snackbar> 
     
 </v-container>  
</template>

<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
export default {
    data() {
        return {
            /**Variables para los dialogos */
            dialogEliminarSemestre:false,
            dialogModificarSemestre:false,
            dialogAñadirSemestre:false,
            dialogReAbrirSemestre:false,
            /**Variables para las alertas */
            alertaError: false,
            alertaExito: false,
            textoAlertas: '',
            timeout: 6000,
            /**Variables para trabjar con los cursos */
            listaInstanciasCursos:[{id:''},{semestre:''},{curso:''},{nomCurso:''},{seccion:''}],
            listaInstanciasCursosAux:[],
        
        }
    },
    beforeMount(){
        /**
         * Obtenemos la lista de todos los semestres antes de montar la vista.
         */
        this.obtenerListaDeSemestres();        
    },
    methods: {
        ...mapMutations(['calcularRol']),
        /**
         * Obtiene la lista de todos los 
         *   semestres registrados en la base de datos
         */
        obtenerListaDeSemestres(){
             this.listaSemestresAux = [];
            var aux;
            var url = 'http://127.0.0.1:8000/api/v1/semestre';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                if (result.data.success==true){
                    for (let index = 0; index < result.data.data.semestres.length; index++) {
                        const element = result.data.data.semestres[index];
                        //console.log(element)
                        let semestre = {
                            id: element.id,
                            semestre: element.semestre,
                            anio: element.anio,
                            deleted_at: element.deleted_at 
                        }; 
                        this.listaSemestresAux[index]=semestre;
                    }
                    this.listaSemestres = this.listaSemestresAux;
                }
            }
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error);
                    // state.mensajeErrorLogin= 'Error al comunicarse con el servidor, intente más tarde';
                } else {
                    if (error.response.data.success == false) {
                        switch (error.response.data.code) {
                            case 101:
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
                                mensaje= error.response.data.message;
                                this.textoAlertas = mensaje;
                                this.alertaError = true;  
                                break;
                            
                                break;
                        }
                    }
                }
            });


        },
        /**
         * Registra la información de un semestre en la base de datos.
         */

    },
    

}
</script>