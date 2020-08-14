<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="1"></v-col>
            <v-col cols="12" md="10">
                <v-card elevation="10">
                    <v-img class="mx-auto white--text align-end justify-center accent" width="100%" height="180px"       
                    >
                        <v-card-title class="white--text" style="padding:0;">
                            <!-- <strong class=" font-weight-black"> Cursos Inscritos </strong>
                            <v-spacer></v-spacer> -->
                            <v-row class="px-5">
                                <v-col cols="12" class="pt-1">
                                    <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Cursos</strong>
                                </v-col>
                                <v-col cols="12" sm="9" md="9" class="align-self-end" >
                                    <v-text-field
                                    v-model="search"
                                    append-icon="mdi-magnify"
                                    label="Buscar"
                                    hide-details
                                    outlined
                                    clearable
                                    dense
                                    solo
                                    rounded
                                    color="secondary"
                                    background-color="white"
                                    ></v-text-field>                                
                                </v-col>                                
                            </v-row>
                    </v-card-title> 
                    </v-img>
                    <v-data-iterator :items="listaInsCursos" :search="search" :sort-by="sortBy.toLowerCase()" class="px-2 py-2" :loading="cargando">
                        <template v-slot:default="props">
                            <v-row>
                                <v-col v-for="item in props.items" :key="item.nomCurso" cols="12" sm="6" md="4" lg="4">
                                    <v-card  class="mx-1" style="background-color:#FFFFFF; border-style:solid; border-color:rgba(0,0,0,0.5);">
                                        <v-container class="pt-0 mt-0 pb-0">
                                            <v-row>
                                                <v-col cols="12" class=" pt-0 pl-0 pr-0 pb-0">
                                                    <v-card-title class="mt-0 pt-0 pl-0 pr-0 " >
                                                        <v-img class="mx-auto white--text align-end justify-center secondary"
                                                                width="100%" height="30px"       
                                                                >
                                                        </v-img>
                                                    </v-card-title>
                                                </v-col>
                                                <v-col cols="12" class=" pt-0 pl-1 pr-0 pb-0">
                                                    <v-card-text class="pt-0 pl-2 pr-0 pb-0 ">
                                                        <div class="text--primary " >
                                                            <p class=" mt-0 mb-1   font-weight-black  text-truncate" style=" font-size: 115%;"  >Nombre: {{ item.nomCurso }}</p>
                                                            <p class="mt-0 mb-1  text-truncate font-weight-black  "  style=" font-size: 115%;"  > Seccion: {{ item.seccion }} </p>
                                                            <p class="mt-0 mb-1  text-truncate font-weight-black  "  style=" font-size: 115%;"  > Plan : {{ item.plan }} </p>
                                                            <p class="mt-0 mb-0  text-truncate font-weight-black  "  style=" font-size: 115%;"   > Año de inscripción: {{ item.anio }} - {{ item.semestre }} </p>
                                                        </div>
                                                    </v-card-text>
                                                </v-col>
                                                <v-col cols="12" class=" pt-1 pl-1 pr-0 pb-2" >
                                                    <v-card-text class="pt-0 pl-2 pr-0 pr-0 pb-0 font-weight-black text-truncate" style=" font-size: 100%;">
                                                        Ayudante/s: 
                                                        <v-btn class="pt-0  pb-0 "  outlined x-small  @click="setAyudantes(item)">
                                                            Ver
                                                        </v-btn>
                                                    </v-card-text>
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

        <v-dialog v-model="dialogAyudantes" :loading="cargando" max-width="500px" >
            <v-card class="mx-auto  pb-5" max-width="500" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Lista Ayudantes</h5>
                </v-card-title>
                <v-data-table
                    :headers="columnasAyudante"
                    :items="ayudantes"
                    hide-default-footer
                >
                    <template v-slot:[`item.opciones`]="{ item }">
                        <v-tooltip bottom color="primary">
                            <template v-slot:activator="{ on }">
                                <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="perfilEstudiante(item)" >
                                    <v-icon  
                                    color="primary"
                                    >
                                    fas fa-external-link-alt
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span><strong>Ver Perfil</strong></span>
                        </v-tooltip>                            
                    </template>
                </v-data-table>
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

    </v-container>
</template>
<script>
import { mapState, mapMutations } from 'vuex'
import axios from 'axios'
export default {
    
    data() {
        return {
            listaInsCursosAux:[],
            listaInsCursos:[{id:''},{anio:''},{semestre:''},{seccion:''},{nomCurso:''},{plan:''},{escuela:''},{ayudantes:[]}],
            cargando: true,
            search: '',
            sortBy:'nomCurso',
            dialogAyudantes: false,
            ayudantes: [],
            ayudantesAux: [],

            timeout: 6000,
            textoAlertas: '',
            alertaError: false,
            columnasAyudante:[
                { text: 'Matricula', value: 'matricula',align: 'center'},
                { text: 'Nombre Completo', value: 'nombre'},
                {text:'Ir', value:'opciones',align: 'center', sortable: false,},
            ],
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
            var url = this.$store.state.rutaDinamica +`api/v1/profesorConCurso/${this.$store.state.usuario.usuario.id}`;
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
                        idCurso: element.idInstanciaCurso,
                        // escuela: element.get_curso.get_curso
                    }; 
                    //console.log(index);
                    this.listaInsCursosAux[index]=insCurso;                                                         
                }
                this.listaInsCursos = this.listaInsCursosAux;  
                this.setDialogAyudantes(); 
                this.cargando= false;
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
                            //console.log(error.response.data.code +' '+ error.response.data.message);
                            //console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }  
                        if(error.response.data.code == 402){
                            //console.log(error.response.data.code +' '+ error.response.data.message);
                            //console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }
                        else{
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;   
                        }                      
                    }
                }
            });
        },

        obtenerListaAyudantes(id,pos){                                    
            var aux;    
            var url = this.$store.state.rutaDinamica+`api/v1/ayudanteCurso/`+id;
            axios.get(url,this.$store.state.config)
            .then((result)=>{      
                //console.log(result);                
                for (let index = 0; index < result.data.data.ayudantesCurso.length; index++) {
                    
                    const element = result.data.data.ayudantesCurso[index]; 
                    let estudiante = {
                        id: element.get_estudiante.id,
                        nombre: element.estudiante,
                        matricula: element.get_estudiante.matricula,
                    };                     
                    this.ayudantesAux[index]=estudiante;   
                    
                }
                if(result.data.data.ayudantesCurso.length == 0)                                         {
                    this.listaInsCursos[pos].ayudantes = [];
                }
                else{
                    this.ayudantes = this.ayudantesAux;                   
                    this.listaInsCursos[pos].ayudantes = this.ayudantes;
                    this.ayudantes = [];
                    this.ayudantesAux= [];
                    this.cargando = false;                    
                }
                
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
                            //console.log(error.response.data.code +' '+ error.response.data.message);
                            //console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }
                        else{
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;   
                        }                   
                    }
                }
            });
        },

        setAyudantes(item){                        
            this.ayudantes = item.ayudantes;
            this.dialogAyudantes = true;
        },
        
        setDialogAyudantes(){        
            for (let index = 0; index < this.listaInsCursos.length; index++){
                this.obtenerListaAyudantes(this.listaInsCursos[index].idCurso,index);
            }
        },

        perfilEstudiante(item){
            this.$store.state.perfilEstudiante = item;
            var enrutamiento ="cursos";
            if (this.$store.state.usuario.usuario.rol == "admin") {
                this.$router.push({path:'/administrador/'+enrutamiento+'/id='+item.id});
            } else {
                if (this.$store.state.usuario.usuario.rol == "secretaria de escuela") {
                    this.$router.push({path:'/secretariaEscuela/'+enrutamiento+'/id='+item.id});
                } else {
                    if (this.$store.state.usuario.usuario.rol == "profesor") {
                        this.$router.push({path:'/profesor/'+enrutamiento+'/id='+item.id});
                    }
                }
            }
        },
    },
}
</script>