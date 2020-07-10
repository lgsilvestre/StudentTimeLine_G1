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
                    cols="12" sm="6" md="4" lg="3" >
                    <!-- @click="obtenerCursosSemestre(semestre)" -->
                    <v-card dark >
                        <div class="d-flex flex-no-wrap justify-space-between">
                            <div>
                                <v-card-title
                                >  Año{{semestre.anio}}</v-card-title>
                                <v-card-subtitle> Semestre {{semestre.semestre}}</v-card-subtitle>
                            </div>

                            <v-btn @click="calcularRol(semestre.id)" color="secondary" fab dark small depressed class="mr-2 mt-2 py-2">
                                <!-- <router-link v-bind:to="calcularRol+semestre.id"> -->
                                    <v-icon color="black">
                                        far fa-arrow-alt-circle-right
                                    </v-icon>
                                <!-- </router-link> -->
                            </v-btn>                        
                        </div>                        
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
                                        <h5 class="white--text ">Registrar Usuario</h5>
                                    </v-card-title>
                                    <v-card-text class="px-12 mt-10" >
                                        <v-form  ref="form" >
                                            
                                            
                                
                                              
                                            <v-container  style="text-align:right;">
                                                <v-btn rounded color="warning" @click="dialogAñadirSemestre=false">
                                                    <h4 class="white--text">Cancelar</h4>
                                                </v-btn>
                                                <v-btn rounded color="secondary" class="ml-2 mr'5"  >
                                                    <h4 class="white--text">Registrar</h4>
                                                </v-btn>
                                            </v-container>  
                                        </v-form>
                                    </v-card-text>
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

            rolActual: '',
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            modal: false,
            menu2: false,
            dialogAñadirSemestre:false,
            listaSemestres:[{id:'',semestre:'',anio:''}],
            listaSemestresAux:[],
            items: [
                {
                color: '#1F7087',
                src: 'https://cdn.vuetifyjs.com/images/cards/foster.jpg',
                title: 'Supermodel',
                artist: 'Foster the People',
                },
                {
                color: '#952175',
                src: 'https://cdn.vuetifyjs.com/images/cards/halcyon.png',
                title: 'Halcyon Days',
                artist: 'Ellie Goulding',
                }],
            listaCursos: [],
            listaCursosAux: [],

            listaInsCursos: [],
            listaInsCursosAux: [],

        
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

        obtenerListaDeSemestres(){
            // this.listaSemestresAux=[
            //     {id:1, semestre:1,anio:2000},
            //     {id:2, semestre:2,anio:2000},
            //     {id:3, semestre:3,anio:2000},
            //     {id:4, semestre:1,anio:2001},
            //     {id:5, semestre:2,anio:2001},
            //     {id:6, semestre:3,anio:2001},
            //     {id:7, semestre:1,anio:2002},
            //     {id:8, semestre:2,anio:2002},
            //     {id:9, semestre:3,anio:2002},
                
            // ]
            // this.listaSemestres= this.listaSemestresAux
            // this.listaSemestresAux = [];
            // var aux;
            // var url = `http://127.0.0.1:8000/api/v1/semestre`;
            // axios.get(url,this.$store.state.config)
            // .then((result)=>{
            //     // console.log("obtener semestres")        
            //     // console.log(result.data.data);
            //     for (let index = 0; index < result.data.data.semestres.length; index++) {
            //         const element = result.data.data.semestres[index];
            //         let semestre = {
            //             id: element.id,
            //             semestre: element.semestre,
            //             anio: element.anio,
            //         };                    
                    
            //         this.listaSemestresAux[index]=semestre;
            //     }
            //     this.listaSemestres = this.listaSemestresAux;
            // }
            // ).catch((error)=>{
            //     console.log(error.response)
            // });


        },
        save (date) {
            this.$refs.menu.save(date)
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