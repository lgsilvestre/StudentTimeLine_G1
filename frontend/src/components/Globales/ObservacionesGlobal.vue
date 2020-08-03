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
                    <v-card-title class="white--text" style="padding:0;" > 
                        <v-row class="px-5"> 
                            <v-col cols="12" class="pt-1">
                                <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Mis observaciones</strong>
                            </v-col>
                            <v-col cols="7" sm="9" md="9" class="align-self-end" >
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
                :items="listaObservaciones"
                :search="buscar"
                :loading="cargando"
                style="font-size: 140%;"
                class="elevation-1 "
                >
                    <template v-slot:item.actions="{ item }">
                        <v-tooltip bottom color="primary">
                            <template v-slot:activator="{ on }">
                                <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="perfilEstudiante(item)">
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
            </v-col>
            <v-col cols="12" md="1">
            </v-col>          
        </v-row>
        
        <!--<v-snackbar
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
        </v-snackbar>!-->
    </v-container>

</template>

<script>
    import axios from 'axios'
    export default {
        data: () => ({
            buscar: '',
            alertError: false,
            textoError: '',
            alertAcept: false,
            textoAcept: '',
            delay: 4000,
            headers: [
                { text: 'Titulo',align: 'start',value: 'titulo',sortable: true},
                { text: 'Categoria', value: 'categoria',sortable: true, },
                { text: 'Tipo', value: 'tipo',sortable: true, },
                { text: 'Estudiante', value: 'estudiante',sortable: true, },
                { text: 'Fecha', value: 'fecha',sortable: true, },
                { text: 'Ir',align: 'center', value: 'actions', sortable: false },
            ],
            cargando: true,
            listaObservaciones:[],
            listaObservacionesAux:[],
        }),
        beforeMount(){
            this.obtenerObservaciones();
        },
        methods:{
            perfilEstudiante(item){
                var observaciones = "observaciones";
                if (this.$store.state.usuario.usuario.rol == "admin") {
                    this.$router.push({path:'/administrador/'+observaciones+'/id='+item.id});
                } else {
                    if (this.$store.state.usuario.usuario.rol == "secretaria de escuela") {
                        this.$router.push({path:'/secretariaEscuela/'+observaciones+'/id='+item.id});
                    } else {
                        if (this.$store.state.usuario.usuario.rol == "profesor") {
                            this.$router.push({path:'/profesor/'+observaciones+'/id='+item.id});
                        }
                    }
                }
            },
            obtenerObservaciones(){
                this.listaObservaciones= [];
                this.listaObservacionesAux = [];
                var url = 'http://127.0.0.1:8000/api/v1/observacion';
                axios.get(url,this.$store.state.config)
                .then((result)=>{
                    if (result.data.success == true) {
                        var contador = 0;
                        for (let index = result.data.data.observaciones.length-1; index >=0; index--) {
                            const element = result.data.data.observaciones[index];
                            var fechaaux =  element.created_at;
                            var fechaaux2 = fechaaux.split("T");
                            let observacion = {
                                titulo:element.titulo,
                                categoria:element.categoria,
                                tipo:element.tipo,
                                estudiante:element.estudiante,
                                fecha:fechaaux2[0],
                                idobservacion:element.id,
                                id:element.get_estudiante.id,
                            };
                            // console.log(escuela);
                            this.listaObservacionesAux[contador]=observacion;
                            contador ++;
                        }
                        this.cargando = false;
                        this.listaObservaciones= this.listaObservacionesAux;
                        
                    }
                })
                .catch((error) => {
                    if (error.message == 'Network Error') {
                        console.log(error);
                        this.alertError = true;
                        this.cargando = false;
                        this.textoError = 'Error al cargar los datos, intente más tarde'
                    } else {
                        if (error.response.data.success == false) {
                            switch (error.response.data.code) {
                            case 101:
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
                                this.alertError = true;
                                this.cargando = false;
                                this.textoError = error.response.data.message;
                                break;
                            default:
                                break;
                            }
                        }
                    } 
                });
            }
        },
    }
</script>

<style>

</style>