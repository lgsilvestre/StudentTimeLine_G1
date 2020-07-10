<template>   
 <v-container>
     <!-- fila para el toolbar -->
     <v-row>
         <v-col cols="12" >
             <v-card flat   >
                 <v-img class="mx-auto white--text align-end justify-center"
                        width="100%" height="150px"       
                        src="@/assets/Globales/background-panel-08.jpg">
                        <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;">
                            <strong > Semestres </strong>
                            <v-spacer></v-spacer>
                            <v-btn class="mr-2" fab large bottom left @click="dialogAñadirSemestre =true" >
                                <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                             </v-btn>
                        </v-card-title>

                 </v-img>
             </v-card>
         </v-col>
         <v-col cols="12">
             <v-card class="mx-auto" >
            <v-container>
                <v-row >
                    <v-col
                    v-for="(semestre, index) in listaSemestres" :key="index"
                    cols="12" sm="6" md="4" lg="3">
                    <!-- @click="obtenerCursosSemestre(semestre)" -->
                    <v-card dark style="background-color:#4ECDC4; border-style:solid; border-color:rgba(0,0,0,0.); "
                    @click="calcularRol(semestre.id)" >
                        <!-- <v-img
                            class="mx-auto white--text align-end justify-center"
                            width="100%"
                            height="100px"
                            
                            src="@/assets/Globales/background-panel-09.jpg"
                        > -->
                            <div class="d-flex flex-no-wrap justify-space-between">
                                <div>
                                    <v-card-title
                                    class="black--text"
                                    > Año {{ semestre.anio }} </v-card-title>

                                    <v-card-subtitle> Semestre {{semestre.semestre}}</v-card-subtitle>
                                </div>
                            
                            </div>
                        <!-- </v-img> -->                       
                    </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>

         </v-col>
     </v-row>
<v-dialog v-model="dialogAñadirSemestre" ref="form" persistent max-width="450px">
         <v-card class="mx-auto" max-width="800" shaped >
                                    <v-card-title class="headline primary text--center" primary-title >
                                        <h5 class="white--text ">Registrar Semestre</h5>
                                    </v-card-title>
                                    <v-card-text class="px-12 mt-10" >
                                        <v-form  ref="form" >
                                            <v-container>
                                                <v-row >
                                                    <v-col cols="6" >
                                                        <strong>Semestre</strong>
                                                    </v-col>
                                                    <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                                        <v-text-field
                                                            v-model="añoActual"
                                                            dense
                                                            outlined
                                                            color="secondary"
                                                            :disabled="unAnhoVariable"
                                                            :rules="rules"
                                                            type="number"
                                                            ></v-text-field>
                                                    </v-col>
                                                </v-row>
                                                <v-row >
                                                    <v-col cols="6" >
                                                        <strong>año</strong>
                                                    </v-col>
                                                    <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                                                        <v-text-field
                                                        v-model="semestreActual"
                                                            dense
                                                            outlined
                                                            color="secondary"
                                                            :disabled="unAnhoVariable"
                                                            :rules="rules_2"
                                                            type="number"
                                                            ></v-text-field>
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

            rolActual: '',
            alertaError: false,
            alertaExito: false,
            textoAlertas: '',
            timeout: 6000,
            date: new Date().toISOString().substr(0, 10),
            dialogAñadirSemestre:false,
            listaSemestres:[{id:'',semestre:'',anio:''}],
            listaSemestresAux:[],
            unAnhoVariable: false,
            añoActual: new Date().getFullYear(),
            semestreActual: 1,
            rules: [
                value => !!value || 'Requerido',
                value => value <= new Date().getFullYear()|| 'El año no debe ser mayor al actual',
                value => value >= 1981 || 'El año no debe ser menor a 1981',
                ],
            rules_2: [
                value => !!value || 'Requerido',
                value => value <= 3|| 'El semestre debe ser menor a 3',
                value => value >= 1 || 'El semestre debe ser mayor a 1',
                ]
        
        }
    },
    watch: {
      menu (val) {
        val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
      },
    },
    created(){
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
                for (let index = 0; index < result.data.data.semestres.length; index++) {
                    const element = result.data.data.semestres[index];
                    let semestre = {
                        id: element.id,
                        semestre: element.semestre,
                        anio: element.anio,
                    }; 
                    
                    this.listaSemestresAux[index]=semestre;
                }
                this.listaSemestres = this.listaSemestresAux;
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
                                // mensaje= error.response.data.message;
                                // añadir alerta
                                break;
                            
                                break;
                        }
                    }
                }
            });


        },
        registrarSemestre(){
            var año_Aux = new Date().getFullYear()
            if(this.añoActual <= año_Aux && this.añoActual>= 1981 && this.semestreActual>=1 && this.semestreActual <= 3){
                let post = {
                    "semestre": this.semestreActual,
                    "anio": this.añoActual,
                }
                var url = 'http://127.0.0.1:8000/api/v1/semestre ';
            axios.post(url, post, this.$store.state.config)
            .then((result) => {
                 console.log(result);
                this.dialogAñadirSemestre = false;
                this.añoActual= new Date().getFullYear();
                this.semestreActual= 1;
                this.textoAlertas = "Se creó el semestre con exito."
                this.alertaExito=true;
                this.obtenerListaDeSemestres(); 
            }).catch((error)=>{
                
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al modificar el usuario, intente mas tarde."
                     this.alertaError = true;  
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 301){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;      
                        }
                        if(error.response.data.code == 302){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = "El semestre ya esta registrado";
                            this.alertaError = true;      
                        }
                    }
                }                
            });
            

            }


        },
        obtenerCursosSemestre(item){            
            // this.listaInsCursosAux = [];
            // var aux;
            // var url = `http://127.0.0.1:8000/api/v1/instanciaCurso/${item.id}`;
            // axios.get(url,this.$store.state.config)
            // .then((result)=>{
            //     console.log("obtener cursos") 
            //     console.log(result.data.data.insCurso)               
            //     for (let index = 0; index < result.data.data.insCursos.length; index++) {
            //         const element = result.data.data.insCursos[index];                    
            //         let insCurso = {
            //             id: element.id,
            //             nombre: element.nombre, 
            //             escuela: element.nombre_escuela,
            //             plan: element.plan,
            //         };                
                    
            //         this.listaInsCursosAux[index]=insCurso;
            //     }
            //     this.listaInsCursos = this.listaInsCursosAux;                
            // }
            // ).catch((error)=>{
            //     console.log(error.response)
            // });
            this.listaInsCursosAux = [];
            var aux;
            var url = `http://127.0.0.1:8000/api/v1/curso`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for( let index=0; index < result.data.data.cursos.length; index++){
                    const element = result.data.data.cursos[index];
                    let curso = {
                        id: element.id,
                        nombre: element.nombre,
                        plan: element.plan,
                        descripcion: element.descripcion,
                        escuela: element.escuela,
                    };
                     this.listaInsCursosAux[index]=curso;
                }
                this.listaInsCursos = this.listaInsCursosAux;     
                console.log(this.listaInsCursos);
            }
            ).catch((error)=>{
                console.log(error.response)
            });
        },
    },
    

}
</script>