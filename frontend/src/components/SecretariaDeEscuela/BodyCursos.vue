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
                    <v-card dark >
                        <div class="d-flex flex-no-wrap justify-space-between">
                            <div>
                                <v-card-title
                                
                                > Año {{ semestre.anio }} </v-card-title>

                                <v-card-subtitle> Semestre {{semestre.semestre}}</v-card-subtitle>
                            </div>
                        
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
export default {
    data() {
        return {
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
                }]
        
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
        obtenerListaDeSemestres(){
            this.listaSemestresAux=[
                {id:1, semestre:1,anio:2000},
                {id:2, semestre:2,anio:2000},
                {id:3, semestre:3,anio:2000},
                {id:4, semestre:1,anio:2001},
                {id:5, semestre:2,anio:2001},
                {id:6, semestre:3,anio:2001},
                {id:7, semestre:1,anio:2002},
                {id:8, semestre:2,anio:2002},
                {id:9, semestre:3,anio:2002},
                
            ]
            this.listaSemestres= this.listaSemestresAux

        },
         save (date) {
        this.$refs.menu.save(date)
      },
      
    },
    

}
</script>