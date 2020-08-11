<template>
    <v-container>
        <v-row >
            <v-col cols="12" md="1">
            </v-col>
            <v-col cols="12" md="10">
                <v-card>
                    <v-img
                        class="mx-auto white--text align-end justify-center"
                        width="100%"
                        height="180px"
                        src="@/assets/Globales/fondo3.jpg"
                    >
                        <v-card-title class="white--text" style="padding:0;">
                            <v-row class="px-5">  
                            <v-col cols="12" class="pt-1" >
                                <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" > Registros</strong>
                            </v-col>
                            <v-col  cols="7" sm="9" md="9" class="align-self-end" >
                                <v-text-field
                                    v-model="buscar"
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
                            <v-col  cols="5" sm="3" md="3" class="align-self-end" style="text-align:right;">
                                <v-tooltip bottom color="primary">
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                    class="ml-2"
                                    fab
                                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                                    bottom
                                    left
                                    v-on="on"
                                    >
                                        <v-icon  color="secondary">fas fa-envelope</v-icon>
                                    </v-btn>
                                </template>
                                <span><strong>Contactar</strong></span>
                                </v-tooltip>
                            </v-col>
                            </v-row>
                            
                        </v-card-title>
                    </v-img>
                    <v-data-table
                        :headers="headers"
                        :items="listaRegistros"
                        :search="buscar"
                        :loading="cargando"
                        :single-expand="false"
                        :expanded.sync="expanded"
                        show-expand
                        style="font-size: 140%;"
                        class="elevation-1 "
                    >
                        <template v-slot:expanded-item="{ headers, item }">
                            <td :colspan="headers.length">{{ item.data }}</td>
                        </template>
                    </v-data-table>
                
                </v-card>
            </v-col>
            <v-col cols="12" md="1">
            </v-col>
        </v-row>
        
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
        data: () => ({
            
            listaRegistros: [],
            listaRegistrosAux: [],
            timeout: 4000,
            
            /* Variables Tabla */
            headers: [
            { text: 'Titulo',align: 'start',value: 'titulo',sortable: true, width:250},
            { text: 'Accion', value: 'accion',sortable: true, width:150 },
            { text: 'Tipo', value: 'tipo',sortable: true, width:150 },
            { text: 'Descripcion', value: 'descripcion',sortable: true, width:400 },
            { text: 'Usuario', value: 'usuario',sortable: true },            
            { text: 'Fecha', value: 'created_at',sortable: true },
            { text: '', value: 'data-table-expand'},            
            ],
            buscar: '',
            cargando: true,
            expanded: [],            
            /*  */

            /* Variables Alertas */
            alertaExito: false,
            alertaError: false,
            textoAlertas: '',
            /*  */
        }),
        created() {
            this.obtenerRegistros()
        },
        methods:{
            obtenerRegistros(){
                this.cargando = true;
                this.listaRegistrosAux= [];
                var url="http://127.0.0.1:8000/api/v1/log";
                axios.get(url,this.$store.state.config)
                .then((result)=>{
                    for (let index = 0; index < result.data.data.logs.length; index++) {
                        const element = result.data.data.logs[index];
                        let log = {
                            id: element.id,
                            titulo: element.titulo,
                            accion: element.accion,
                            tipo: element.tipo,
                            descripcion: element.descripcion,   
                            usuario: element.usuario,
                            data: element.data,
                            created_at: element.created_at.split("T")[0],
                            updated_at: element.updated_at,
                        };                                 
                        this.listaRegistrosAux[index]=log;
                    }
                    this.cargando = false;
                    this.listaRegistros = this.listaRegistrosAux;
                    this.listaRegistros.reverse();
                }
                ).catch((error)=>{
                    if (error.message == 'Network Error') {
                        this.alertaError = true;
                        this.cargando = false;
                        this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                    }
                })},
        },

}
</script>