<template>
    <div >        
        <v-container class="align-center my-5" >
            <v-img  src="https://cdn.discordapp.com/attachments/299713523548684288/711815514380435466/banner.png"></v-img>
        </v-container>

        <v-container fluid justify-center >
            <!-- Cards de Datos -->
            <v-row v-resize="onResize" align="center" justify="center">
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
                        src="https://www.utalca.cl/content/uploads/2019/09/6-1-1-.jpg"
                    >
                    <!-- v-card-title>70 Profesores</v-card-title> -->
                        <v-expand-transition>
                        <div
                            v-if="hover"
                            class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-2 white--text "
                            style="height: 100%;"
                        >
                            70 Profesores
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
                    src="https://globalmediarocks.s3-us-west-1.amazonaws.com/uploads/61673a31-9adf-4153-9164-8ae056243c91/ASF.jpg"
                >
                    <v-expand-transition>
                        <div
                        v-if="hover"
                        class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-2 white--text "
                        style="height: 100%;"
                        >
                        69 Observaciones
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
                    src="https://www.utalca.cl/content/uploads/2019/04/fac-ing-tec-feb.jpg"
                >
                <v-expand-transition>
                        <div
                        v-if="hover"
                        class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-2 white--text "
                        style="height: 100%;"
                        >
                        7 Carreras
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
                        src="http://www.ingenieria.utalca.cl/Repositorio/qAYsTOUtPWWsOIDOoIOmR02azDYCW1/campus2.JPG"
                    >
                        <v-expand-transition>
                        <div
                        v-if="hover"
                        class="d-flex transition-fast-in-fast-out black darken-2 v-card--reveal display-2 white--text "
                        style="height: 100%;"
                        >
                        1234 Estudiantes
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
export default {
    name: 'Cuerpo',
    
    data: () => ({
      sheet: false,
    }),
    methods:{
        
    },
    computed:{

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