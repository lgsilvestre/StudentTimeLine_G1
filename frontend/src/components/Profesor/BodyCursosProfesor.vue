<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="1"></v-col>
            <v-col cols="12" md="10">
                <v-card>
                    <v-img class="mx-auto white--text align-end justify-center" width="100%" height="150px"       
                    src="@/assets/Globales/background-panel-08.jpg">
                        <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;">
                            <strong class=" font-weight-black"> Cursos Inscritos </strong>
                            <v-spacer></v-spacer>
                            <!-- <v-btn class="mr-2" fab large bottom left @click="dialogAñadirSemestre =true" >
                                <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                            </v-btn> -->
                     </v-card-title> 
                    </v-img>
                    <v-row>
                        <v-col v-for="(curso, index) in listaInsCursos" :key="index" cols="12" sm="6" md="4" lg="4">
                            <v-card class=" ml-2 mr-2"  dark color="#F7FFF7"  style=" border-style:solid; border-color:rgba(0,0,0,0.5);"
                           >
                                <v-container class="pt-0 mt-0 pb-0">
                                    <v-row>
                                        <v-col cols="12" class=" pt-0 pl-0 pr-0 pb-0">
                                            <v-card-title class="mt-0 pt-0 pl-0 pr-0 " >
                                                <v-img class="mx-auto white--text align-end justify-center "
                                                        width="100%" height="30px"       
                                                        src="@/assets/Globales/background-panel-08.jpg" >
                                                </v-img>
                                            </v-card-title>
                                        </v-col>
                                        <v-col cols="12" class=" pt-0 pl-0 pr-0 pb-0  text-left">
                                            
                                             <v-card-text class=" pt-0 pl-5 pr-0 pb-0 ">
                                                <div class="text--primary " >
                                                    <p class="font-weight-black text-truncate   pt-0  pb-0 mt-0 mb-0"   >Nombre: {{ curso.nomCurso }}</p>
                                                    <p class="font-weight-black pt-0 pb-0 mt-0 mb-0"   > Seccion: {{ curso.seccion }} </p>
                                                    <p class="font-weight-black pt-0  pb-0 mt-0 mb-0"   > Plan : {{ curso.plan }} </p>
                                                    <p class="font-weight-black pt-0 pb-0 mt-0 mb-1"   > Año de inscripción: {{ curso.anio }} - {{ curso.semestre }} </p>
                                                </div>
                                            </v-card-text>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card>

                        </v-col>
                    </v-row>
                </v-card>
            </v-col>
            <v-col cols="12" md="1"></v-col>
        </v-row>
    </v-container>
</template>
<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
export default {
    
    data() {
        return {
            listaInsCursosAux:[],
            listaInsCursos:[{id:''},{anio:''},{semestre:''},{seccion:''},{nomCurso:''},{plan:''},{escuela:''}]
        }
    },
    beforeMount(){
        /**
         * Obtenemos la lista de todos los semestres antes de montar la vista.
         */
        this.obtenerListaInstanciaCursos();        
    },
    methods: {
        obtenerListaInstanciaCursos(){
            this.listaInsCursosAux = [];
            var aux;    
            var url = `http://127.0.0.1:8000/api/v1/profesorConCurso/${this.$store.state.usuario.usuario.id}`;
            console.log(url)
            axios.get(url,this.$store.state.config)
            .then((result)=>{   
                console.log(result)
                for (let index = 0; index < result.data.data.cursos.length; index++) {
                    const element = result.data.data.cursos[index]; 
                    console.log(element)    
                    let insCurso = {
                        id: element.id,
                        anio:element.anio,
                        semestre: element.semestre,
                        seccion:element.seccion,
                        nomCurso: element.curso,
                        plan:element.get_curso.get_curso.plan,
                        // escuela: element.get_curso.get_curso
                    }; 
                    this.listaInsCursosAux[index]=insCurso;                                                         
                }
                this.listaInsCursos = this.listaInsCursosAux;  
            }
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.cargando = false;
                    this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 401){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }  
                        if(error.response.data.code == 402){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = "Error al obtener los cursos del profesor";
                            this.alertaError = true;                            
                        }                      
                    }
                }
            });
        }
    },
}
</script>