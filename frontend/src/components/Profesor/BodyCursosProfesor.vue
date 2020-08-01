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
                    <v-data-iterator :items="listaInsCursos"  :sort-by="sortBy.toLowerCase()" class="px-2 py-2" :loading="cargando">
                         <template v-slot:default="props">
                            <v-row>
                                <v-col v-for="item in props.items" :key="item.nomCurso" cols="12" sm="6" md="4" lg="4">
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
                                                            <p class="font-weight-black text-truncate   pt-0  pb-0 mt-0 mb-0"   >Nombre: {{ item.nomCurso }}</p>
                                                            <p class="font-weight-black pt-0 pb-0 mt-0 mb-0"   > Seccion: {{ item.seccion }} </p>
                                                            <p class="font-weight-black pt-0  pb-0 mt-0 mb-0"   > Plan : {{ item.plan }} </p>
                                                            <p class="font-weight-black pt-0 pb-0 mt-0 mb-1"   > Año de inscripción: {{ item.anio }} - {{ item.semestre }} </p>
                                                        </div>
                                                    </v-card-text>
                                                </v-col>
                                                <v-col cols="12" class=" mb-1 pt-0 pl-0 pr-0 pb-0  text-right">
                                                    <v-tooltip bottom color="primary">
                                                        <template v-slot:activator="{ on }">
                                                            <v-btn color="white" text icon class="mr-2 py-2" v-on="on" @click="dialogAyudantes=true">
                                                                <v-icon color="primary">
                                                                    fas fa-user-friends
                                                                </v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <span><strong>Mostrar Ayudantes</strong></span>
                                                    </v-tooltip>    
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-card>

                                </v-col>
                            </v-row>
                        </template>
                    </v-data-iterator>
                </v-card>
            </v-col>
            <v-col cols="12" md="1"></v-col>
        </v-row>

        <v-dialog v-model="dialogAyudantes"  :loading="cargando" max-width="500px" >
            <v-card class="mx-auto" max-width="500" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Lista Ayudantes</h5>
                </v-card-title>
                <v-container class="px-5">    
                        <v-col cols="12" md="11" v-for="ayudante in ayudantes" :key="ayudante.id">
                            <v-row> 
                                <v-col cols="12" md="11">
                                    <h4> {{ayudante.nombre}}</h4>
                                </v-col>                                
                                <v-col cols="12" md="1">
                                    <v-tooltip bottom color="primary">
                                        <template v-slot:activator="{ on }">
                                            <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="perfilEstudiante(ayudante)">
                                                <v-icon  
                                                color="primary"
                                                >
                                                fas fa-external-link-alt
                                                </v-icon>
                                            </v-btn>
                                        </template>
                                        <span><strong>Ver Perfil</strong></span>
                                    </v-tooltip>  
                                </v-col>
                            </v-row>      
                            <v-divider></v-divider>    
                        </v-col>
                            
                        
                </v-container>            
            </v-card>
        </v-dialog> 

    </v-container>
</template>
<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
export default {
    
    data() {
        return {
            listaInsCursosAux:[],
            listaInsCursos:[{id:''},{anio:''},{semestre:''},{seccion:''},{nomCurso:''},{plan:''},{escuela:''}],
            cargando: true,
            sortBy:'nomCurso',
            dialogAyudantes: false,
            ayudantes: [],
            ayudantesAux: [],
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
            this.listaInsCursos =[];
            var url = `http://127.0.0.1:8000/api/v1/profesorConCurso/${this.$store.state.usuario.usuario.id}`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{   
                for (let index = 0; index < result.data.data.cursos.length; index++) {
                    const element = result.data.data.cursos[index]; 
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
                this.setDialogAyudantes(); 
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
        },

        obtenerListaAyudantes(id){
            this.ayudantes = [];
            this.ayudantesAux = [];
            var aux;    
            var url = `http://127.0.0.1:8000/api/v1/ayudanteCurso/`+id;
            axios.get(url,this.$store.state.config)
            .then((result)=>{   
                console.log(result);
                for (let index = 0; index < result.data.data.ayudantesCurso.length; index++) {
                    const element = result.data.data.ayudantesCurso[index]; 
                    let estudiante = {
                        id: element.get_estudiante.id,
                        nombre: element.estudiante,
                    }; 
                    this.ayudantesAux[index]=estudiante;                                                         
                }
                this.ayudantes = this.ayudantesAux;  
                this.cargando = false;
            }
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.cargando = false;
                    this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 101){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }                   
                    }
                }
            });
        },
        
        setDialogAyudantes(){        
            for (let index = 0; index < this.listaInsCursos.length; index++){
                this.obtenerListaAyudantes(this.listaInsCursos[index].id);
            }
        },

        perfilEstudiante(item){
            this.$store.state.perfilEstudiante = item;
            if (this.$store.state.usuario.usuario.rol == "admin") {
                this.$router.push({path:'/administrador/estudiantes/id='+item.id});
            } else {
                if (this.$store.state.usuario.usuario.rol == "secretaria de escuela") {
                    this.$router.push({path:'/secretariaEscuela/estudiantes/id='+item.id});
                } else {
                    if (this.$store.state.usuario.usuario.rol == "profesor") {
                        this.$router.push({path:'/profesor/estudiantes/id='+item.id});
                    }
                }
            }
        },
    },
}
</script>