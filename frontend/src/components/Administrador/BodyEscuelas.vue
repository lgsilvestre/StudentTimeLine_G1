<template>
  <v-container>
      <v-row >
          <v-col cols="12" md="3"  
          align-self="end">
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
                                  <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
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
                                          v-model="escuela.nombre"
                                          label="Nombre de la escuela"
                                          outlined
                                          color="secondary"
                                          prepend-inner-icon="fas fa-scroll"
                                          
                                      ></v-text-field>
                                      <v-text-field 
                                          v-model="escuela.cod"
                                          label="Codigo de carrera"
                                          outlined
                                          color="secondary"
                                          prepend-inner-icon="fas fa-hashtag"
                                      ></v-text-field>
                                  </v-container>
                                  <v-container class="px-10 pb-5" style="text-align:right;">
                                    <v-btn rounded color="warning" @click="resetCreacionEscuela">
                                      <h4 class="white--text">Cancelar</h4>
                                    </v-btn>
                                    <v-btn rounded color="secondary" class="ml-2" @click="crearEscuela" >
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
                :items="desserts"
                class="elevation-1 "
                >
                  <template v-slot:item.actions="{ item }">
                    <v-btn color="white" fab small depressed class="mr-2 py-2">
                      <v-icon  
                      color="primary"
                      @click="ModificarEscuela(item)"
                      >
                      fas fa-edit
                      </v-icon>
                    </v-btn>
                    <v-btn color="white" fab small depressed class="mr-2 py-2">
                      <v-icon
                      color="warning"
                      @click="EliminarEscuela(item)"
                      >
                      fas fa-trash-alt
                      </v-icon>
                    </v-btn>
                  </template>                                                         
                </v-data-table>
                <v-dialog v-model="dialogModificar" persistent max-width="500px">
                  <v-card
                  class="mx-auto"
                  shaped
                  >
                    <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                      <h5 class="white--text ">Modificar Escuela</h5>
                    </v-card-title>
                          <v-form 
                          ref="form"
                          >
                          <v-container class="px-10 pt-10">
                            <v-text-field
                                v-model="escuelaEditar.nombre"
                                label="Nombre de Escuela"
                                outlined
                                prepend-inner-icon="fas fa-scroll"
                            >
                            </v-text-field>                                  
                            <v-text-field
                              v-model="escuelaEditar.cod_car"
                              label="Codigo Carrera"                                      
                              outlined
                              prepend-inner-icon="fas fa-hashtag"
                            >
                            </v-text-field>   
                          </v-container>         

                            <v-container class="px-10 pb-5" style="text-align:right;">
                                <v-btn rounded color="warning" @click="dialogModificar = false">
                                  <h4 class="white--text">Cancelar</h4>
                                </v-btn>
                                <v-btn rounded color="secondary" class="ml-2" @click="editarEscuela(escuelaEditar)">
                                  <h4 class="white--text">Modificar</h4>
                                </v-btn>
                            </v-container>  
                          </v-form>
                  </v-card>
                  </v-dialog>
                  <v-dialog v-model="dialogEliminar" persistent max-width="500px">
                      <v-card
                      class="mx-auto"
                      max-width="800"
                      >
                        <v-card-title
                        class="headline primary text--center"
                        primary-title
                        >
                          <h5 class="white--text ">Eliminar Escuela</h5>
                        </v-card-title>
                        <v-card-title class="text-justify" style="font-size: 110%;">Esta seguro que desea eliminar la siguiente Escuela?</v-card-title>
                        <v-card-text>Nombre Escuela: {{ escuelaEliminar.nombre }}</v-card-text>
                        <v-card-text>Codigo Carrera: {{ escuelaEliminar.cod }}</v-card-text>
                        <v-card-text class="px-12 mt-3" >     

                        <v-container class="px-10" style="text-align:right;">
                              <v-btn rounded color="warning" @click="dialogEliminar = false">
                                <h4 class="white--text">Cancelar</h4>
                              </v-btn>
                              <v-btn rounded color="secondary" class="ml-2 mr-n12" @click="borrarEscuela(escuelaEliminar)">
                                <h4 class="white--text">Eliminar</h4>
                              </v-btn>
                            </v-container>  
                        </v-card-text>
                      </v-card>
                  </v-dialog> 
              </v-card>
          </v-col>
          <v-col cols="12" md="3">
            
          </v-col>          
      </v-row>
      <v-snackbar
        v-model="alertError"
        :timeout=delay
        bottom
        color="warning"
        left
        class="mb-1 pb-12 pr-0 mr-0"
      >
        <div>
          <v-icon color="white" class="mr-2">
            fas fa-exclamation-triangle
          </v-icon>
          <strong>{{textoError}} </strong>
        </div>
        <v-btn
            color="white"
            elevation="0"
            x-small
            fab
            @click="alertError = ! alertError"
        > 
            <v-icon color="warning">fas fa-times</v-icon>
        </v-btn>
      </v-snackbar>
      <v-snackbar
        v-model="alertAcept"
        :timeout=delay
        bottom
        color="secondary"
        left
        class="mb-1 pb-12 pr-0 mr-0"
      >
        <div>
          <v-icon color="white" class="mr-2">
            fas fa-check-circle
          </v-icon>
          <strong>{{textoAcept}}</strong>
        </div>
        <v-btn
          color="white"
          elevation="0"
          x-small
          fab
          @click="alertAcept = ! alertAcept"
        > 
            <v-icon color="secondary">fas fa-times</v-icon>
        </v-btn>
      </v-snackbar>
  </v-container>
</template>

<script>
  import { mapState, mapMutations } from 'vuex'
  import axios from 'axios'
  export default {
    data: () => ({
      dialog: false,
      dialogModificar: false,
      dialogEliminar: false,
      alertError: false,
      textoError: '',
      alertAcept: false,
      textoAcept: '',
      delay: 2000,
      cargar: null,
      headers: [
        { text: 'ID',align: 'start',value: 'id',sortable: false},
        { text: 'Nombre', value: 'nombre',sortable: false, },
        { text: 'Codigo carrera', value: 'cod_car',sortable: false, },
        { text: 'Opciones', value: 'actions', sortable: false },
      ],
      desserts:[],
      dessertsAux:[],
      escuela:[{nombre:''},{cod:''}],
      escuelaEditar:[{id:''},{nombre:''},{cod:''}],
      escuelaEliminar:[{nombre:''},{cod:''}],
      reglasCrearEscuela: [],
      
    }),
    computed: {
    },
    watch: {
    },
    created () {
      this.obtenerEscuelas();
    },

    methods: {
      ModificarEscuela(item){
        console.log(item.id);
        this.escuelaEditar.id = item.id;
        this.escuelaEditar.nombre = item.nombre;
        this.escuelaEditar.cod = item.cod_car;
        this.dialogModificar = true;
        console.log("chao");
      },
      EliminarEscuela(item){
        console.log(item.id);
        this.escuelaEliminar.id = item.id;
        this.escuelaEliminar.nombre = item.nombre;
        this.escuelaEliminar.cod = item.cod_car;
        this.dialogEliminar = true;
      },
      obtenerEscuelas(){
        this.dessertsAux = [];
        var url = 'http://127.0.0.1:8000/api/v1/escuela';
        axios.get(url,this.$store.state.config)
          .then((result)=>{
            for (let index = 0; index < result.data.length; index++) {
              const element = result.data[index];
              let escuela = {
                id: element.id,
                nombre: element.nombre,
                cod_car: '',
              };
              this.dessertsAux[index]=escuela;
            }
            this.desserts = this.dessertsAux;
          }
        )
        .catch((error) => {
          console.log(error);
          this.alertError = true;
          this.textoError = 'Error al cargar los datos, intentelo más tarde'
        })
      },
      crearEscuela(){
        this.dessertsAux = [];
        var url = 'http://127.0.0.1:8000/api/v1/escuela';
        let post ={
          "nombre": this.escuela.nombre,
        }
        axios.post(url,post,this.$store.state.config)
        .then((result)=>{
          console.log(result.statusText);
          if (result.statusText=='OK') {
            this.obtenerEscuelas(); 
            this.resetCreacionEscuela();
            this.alertAcept = true;
            this.textoAcept = 'La escuela se creó correctamente'
          }
        })
        .catch((error) => {
          console.log(error);
          this.resetCreacionEscuela();
          this.alertError = true;
          this.textoError = 'Error al crear escuela, intentelo más tarde'
        })

      },
      editarEscuela(item) {
        var url = 'http://127.0.0.1:8000/api/v1/escuela/'+item.id;
        let put ={
          "nombre": this.escuelaEditar.nombre,
        }
        axios.put(url,put,this.$store.state.config)
        .then((result)=>{
          if (result.statusText=='OK') {
            this.obtenerEscuelas(); 
            this.resetEditarEscuela();
            this.dialogModificar=false;
            this.alertAcept = true;
            this.textoAcept = 'La escuela se modificó correctamente'
          }
        })
        .catch((error) => {
          console.log(error);
          this.resetEditarEscuela();
          this.dialogModificar=false;
          this.alertError = true;
          this.textoError = 'Error al modificar escuela, intentelo más tarde'
        })
      },
      borrarEscuela (item) {
        var url = 'http://127.0.0.1:8000/api/v1/escuela/'+item.id;
        axios.delete(url,this.$store.state.config)
        .then((result)=>{
          if (result.statusText=='OK') {
            this.obtenerEscuelas(); 
            this.dialogEliminar=false;
            this.alertAcept = true;
            this.textoAcept = 'La escuela se borró correctamente'
          }
        })
        .catch((error) => {
          this.dialogEliminar=false;
          this.alertError = true;
          this.textoError = 'Error al borrar escuela, intentelo más tarde'
        })
      },
      resetCreacionEscuela(){
        this.dialog = false;
        this.escuela.nombre='';
        this.escuela.cod='';
        //this.alert = false;
      },
      resetEditarEscuela(){
      },
      
    },
    watch:{

    },
  }

  
</script>