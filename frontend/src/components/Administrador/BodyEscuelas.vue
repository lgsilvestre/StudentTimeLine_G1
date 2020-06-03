<template>
  <v-container>
      <v-row >
          <v-col cols="12" md="3">
          </v-col>
          <v-col cols="12" md="6">
              <v-card>
                  <v-img
                    class="mx-auto white--text align-end justify-center"
                    width="100%"
                    height="180px"
                    src="@/assets/Globales/fondo.jpg"
                    
                  >
                    <v-card-title class="white--text" style="font-size: 200%;text-shadow: #555 2px 2px 3px;"> 
                        <v-icon class="px-3" color="white" size="30">fas fa-school</v-icon>
                        <strong> Escuelas</strong>
                        <v-spacer>
                        </v-spacer>
                        
                        <v-dialog v-model="dialog" persistent max-width="500px">
                          <template v-slot:activator="{ on }">
                              <v-btn
                              fab
                              large
                              bottom
                              left
                              v-on="on"
                              >
                                  <v-icon class="mx-2" color="red">fas fa-plus</v-icon>
                              </v-btn>
                          </template>
                          <v-card elevation="1" shaped>
                              <v-card-title
                              class="headline primary text--center"
                              primary-title
                              >
                              <h5 class="white--text ">Crear una escuela</h5>
                              </v-card-title>
                                <v-form>
                                  <v-container class="px-10 pt-10">
                                      <v-text-field 
                                          label="Nombre de la escuela"
                                          outlined
                                          color="secondary"
                                          prepend-inner-icon="fas fa-scroll"
                                          
                                      ></v-text-field>
                                      <v-text-field 
                                          label="Codigo de carrera"
                                          outlined
                                          color="secondary"
                                          prepend-inner-icon="fas fa-hashtag"
                                      ></v-text-field>
                                  </v-container>
                                  <v-container class="px-10" style="text-align:right;">
                                    <v-btn rounded color="red" @click="dialog = false">
                                      <h4 class="white--text">Cancelar</h4>
                                    </v-btn>
                                    <v-btn rounded color="primary" class="ml-2" @click="dialog = false">
                                      <h4 class="white--text">Guardar</h4>
                                    </v-btn>
                                  </v-container>
                              </v-form> 
                          </v-card>
                        
                        </v-dialog>
                    </v-card-title>
                  </v-img>

    
                <v-data-table
                    :headers="headers"
                    :items="dessertsEscuelas"
                    class="elevation-1 "
                >
                    <template v-slot:item.actions="{ item }">
                    <v-icon  
                    medium
                    class="mr-2 py-2"
                    @click="editarEscuela(item)"
                    
                    >
                    fas fa-edit
                    </v-icon>
                    <v-icon
                    medium
                    @click="borrarEscuela (item)"
                    class="px-2 py-2"
                    >
                    fas fa-trash-alt
                    </v-icon>
                    </template>
                    
                </v-data-table>
              </v-card>
          </v-col>
          <v-col cols="12" md="3">
          </v-col>
          
      </v-row>
  </v-container>
</template>

<script>
import { mapState, mapMutations } from 'vuex'

  export default {
    data: () => ({
      dialog: false,
      headers: [
        { text: 'ID',align: 'start',value: 'id',sortable: false},
        { text: 'Nombre', value: 'nombre',sortable: false, },
        { text: 'Codigo carrera', value: 'cod_car',sortable: false, },
        { text: 'Opciones', value: 'actions', sortable: false },
      ],

    }),

    computed: {
      ...mapState(['dessertsEscuelas'])
    },

    watch: {
 
    },

    created () {
      this.obtenerEscuelas()
    },
    
    methods: {
      ...mapMutations(['obtenerEscuelas']),
 
      updatearBD(){

      },

      editarEscuela(item) {

      },

      borrarEscuela (item) {

      },
    },
  }
</script>