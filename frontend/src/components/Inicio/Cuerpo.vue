<template>
    <div >        
        <v-container class="align-center my-5" >
            <v-img  src="@/assets/Inicio/bannerInicio.png"
            ></v-img>
        </v-container>

        <v-container fluid justify-center >
            <!-- Cards de Datos -->
            <v-row  align="center" justify="center">
                <!-- Card para Datos Profesores -->
                <v-col >
                    <v-hover v-slot:default="{ hover }">
                        <v-card
                        class="d-flex flex-wrap mx-auto my-auto"
                        max-width="400"
                        max-height="200px"
                        >
                        <!-- Imagen del Card -->
                        <v-img
                            class="white--text align-end"
                            height="200px"
                            src="@/assets/Inicio/profesores.jpg"
                        >
                        <!-- v-card-title>70 Profesores</v-card-title> -->
                            <v-expand-transition>
                            <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-2 white--text "
                                style="height: 100%;"
                            >
                            {{numeroProfesores}} Profesores                           
                            </div>
                            </v-expand-transition>
                            
                        </v-img>
                        </v-card>
                    </v-hover>

                </v-col>

                <!-- Card para Datos Observaciones -->
                <v-col >
                    <v-hover v-slot:default="{ hover }">
                        <v-card 
                        class="d-flex flex-wrap mx-auto my-auto"
                        max-width="400"
                        max-height="200px"
                        >
                        <!-- Imagen del Card -->
                        <v-img
                            class="white--text align-end"
                            height="200px"
                            src="@/assets/Inicio/observaciones.jpg"
                        >
                            <v-expand-transition>
                                <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-2 white--text "
                                style="height: 100%;"
                                >
                                {{numeroObservaciones}} Observaciones
                                </div>
                            </v-expand-transition>
                        </v-img>

                        </v-card>
                    </v-hover>
                </v-col>


                <!-- Card para Datos Carreras -->
                <v-col >
                    <v-hover v-slot:default="{ hover }">
                        <v-card
                        class="d-flex flex-wrap mx-auto my-auto"
                        max-width="400"
                        max-height="200px"
                        >
                        <!-- Imagen del Card -->
                        <v-img
                            class="white--text align-end"
                            height="200px"
                            src="@/assets/Inicio/carreras.jpg"
                        >
                        <v-expand-transition>
                                <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-2 white--text "
                                style="height: 100%;"
                                >
                                {{numeroCarreras}} Carreras
                                </div>
                            </v-expand-transition>
                        </v-img>
                        </v-card>
                    </v-hover>      

                </v-col>

                <!-- Card para Datos Estudiantes -->
                <v-col >
                    <v-hover v-slot:default="{ hover }">
                        <v-card
                        class="d-flex flex-wrap mx-auto my-auto"
                        max-width="400"
                        max-height="200px"
                        >
                    <!-- Imagen del Card -->
                            <v-img
                                class="white--text align-end"
                                height="200px"
                                src="@/assets/Inicio/estudiantes.jpg"
                            >
                                <v-expand-transition>
                                <div
                                v-if="hover"
                                class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-2 white--text "
                                style="height: 100%;"
                                >
                                {{numeroEstudiantes}} Estudiantes
                                </div>
                                </v-expand-transition>
                            </v-img>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>

        </v-container>
    </div>
</template>

<script>
import { mapState } from 'vuex'
import axios from 'axios'
export default {
    name: 'Cuerpo',
    
    data: () => ({
      sheet: false,
      numeroProfesores: '',
      numeroObservaciones: '',
      numeroCarreras: '',
      numeroEstudiantes: '',
    }),
    beforeMount() {
        this.obtenerDatos();
    },
    methods:{
        
        obtenerDatos(){            
            var url = this.$store.state.rutaDinamica + 'api/v1/datos';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                this.numeroProfesores= result.data.data.profesores;
                this.numeroObservaciones= result.data.data.observaciones;
                this.numeroCarreras= result.data.data.escuelas;
                this.numeroEstudiantes= result.data.data.estudiantes;
            }
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.cargando = false;
                    this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                }
            });
        },

    },
    computed:{
        ...mapState(['numProfesores','numObservaciones','numCarreras','numEstudiantes']), 
    },

}
</script>

<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: .5;
  position: absolute;
  width: 100%;
}
</style>