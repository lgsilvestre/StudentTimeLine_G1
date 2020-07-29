<template>
    <v-container  fluid >

        <v-btn 
        block
        
        @click="volverEstudiantes"
        >
            <v-icon class="pr-2" color="primary"> fas fa-arrow-circle-left</v-icon> 
            volver
        </v-btn>
        <v-row >
            <v-col  cols="12" md="5" xl="4">
                <v-card elevation="1" > 
                    <v-img
                        class="mx-auto white--text align-end justify-center"
                        width="100%"
                        src="@/assets/Globales/fondo.jpg"
                    >
                    <v-card-title
                    class="headline  text--center"
                    primary-title>
                        <div class="difuminado">
                            <strong class="white--text letra">Estudiante</strong>
                        </div>
                        <v-spacer></v-spacer>
                        <v-avatar :size="$vuetify.breakpoint.smAndDown ? 100 : 120" class="borde mt">
                            <img
                                src="@/assets/Globales/estudiante4.png"
                            > 
                        </v-avatar>
                    </v-card-title>
                    </v-img>
                    <v-divider></v-divider>
                    <v-row class="px-5 mt-5">
                        <v-col cols="3">
                            <h5>Matricula</h5> 
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{perfilEstudiante.matricula}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Rut</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{perfilEstudiante.rut}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Nombre</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.nombre_completo}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Correo</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.correo}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Ingreso</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.anho_ingreso}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3">
                            <h5 >Situacion academica</h5>
                        </v-col>
                        <v-col cols="1">
                            <h5 >:</h5>
                        </v-col >
                        <v-col :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.situacion_academica}}</h5>
                        </v-col>
                    </v-row>
                    <v-row class="px-5">
                        <v-col cols="3" class="pb-5">
                            <h5 >Escuela</h5>
                        </v-col>
                        <v-col cols="1" class="pb-5">
                            <h5 >:</h5>
                        </v-col >
                        <v-col class="pb-5" :cols="$vuetify.breakpoint.smAndDown ? 7 : 8">
                            <h5 >{{ perfilEstudiante.escuela}}</h5>
                        </v-col>
                    </v-row>
                    <div class="pb-5"  style="text-align:center;">
                        <v-btn
                        color="secondary"
                        rounded
                        @click="editarEstudiante"
                        >Editar</v-btn>
                        <v-btn
                        color="secondary"
                        class="ml-2"
                        rounded
                        @click="dialogSolicitud = true"
                        >Solicitar Ayudante</v-btn>
                    </div>
                    
                </v-card>
            </v-col>
            <v-col cols="12" md="7" xl="8">
                <v-row>
                    <v-col cols="0" sm="0" md="1"> 

                    </v-col>
                    <v-col cols="12" sm="12" md="10" style="margin-top:0;padding-top:0;" >
                        <v-card > 
                                <v-row >
                                    <v-col cols="12" md="4" xl="3" style="padding-top:0; padding-bottom:0;">
                                        <v-card-title
                                        class="headline text--center primary"
                                        height="300px"
                                        primary-title>
                                            <v-row style="height:250px; "> 
                                                <v-col cols="12" class="align-self-end ">
                                                    <div >
                                                        <strong class=" white--text" :style="$vuetify.breakpoint.lgAndDown ? 'font-size: 70%':'font-size: 100%'" >Observaciones</strong>
                                                    </div>
                                                </v-col>
                                                <v-col cols="12" class="align-self-end ">
                                                    <v-dialog v-model="dialogAgregarObservacion" persistent max-width="500px" >
                                                        <template v-slot:activator="{ on }">
                                                            
                                                            <v-btn 
                                                            :large="$vuetify.breakpoint.lgAndDown ? false : true"
                                                            :small="$vuetify.breakpoint.lgAndDown ? true : false"
                                                            fab bottom left v-on="on" >
                                                                <v-icon  color="warning">fas fa-plus</v-icon>
                                                            </v-btn>
                                                            
                                                        </template>
                                                        <v-card class="mx-auto" max-width="500" >
                                                            <v-card-title class="headline primary text--center" primary-title >
                                                                <h5 class="white--text ">Agregar observacion</h5>
                                                            </v-card-title>
                                                                <v-container class="px-5 mt-5">
                                                                    <v-text-field  
                                                                    v-model="estudianteObservacion.titulo"
                                                                    label="Titulo" 
                                                                    outlined
                                                                    color="secondary"
                                                                    prepend-inner-icon="fas fa-check-circle"
                                                                    ></v-text-field>

                                                                    <v-select   
                                                                    v-model="estudianteObservacion.tipo"
                                                                    :items="tipos"
                                                                    item-text="nombre"
                                                                    label="Tipo" outlined
                                                                    color="secondary"
                                                                    prepend-inner-icon="fas fa-check-circle"
                                                                    ></v-select >

                                                                    <v-select 
                                                                    v-model="estudianteObservacion.categoria"
                                                                    :items="categorias"
                                                                    item-text="nombre"
                                                                    item-value="id"
                                                                    label="Categoria"
                                                                    color="secondary"
                                                                    outlined
                                                                    prepend-inner-icon="fas fa-check-circle"
                                                                    ></v-select>
                                                                    <v-textarea
                                                                    v-model="estudianteObservacion.descripcion"
                                                                    outlined
                                                                    color="secondary"
                                                                    label="Descripcion"
                                                                    ></v-textarea>
                                                                    <div class="pb-1" style="text-align:right;">  
                                                                        <v-btn 
                                                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                                        rounded color="warning" 
                                                                        @click="resetAgregarObservacion">
                                                                            <h4 class="white--text">Cancelar</h4>
                                                                        </v-btn>
                                                                        <v-btn 
                                                                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                                        rounded color="secondary" class="ml-2"
                                                                        :loading="cargando"  
                                                                        @click="agregarObservacion"
                                                                        >
                                                                            <h4 class="white--text">Agregar</h4>
                                                                        </v-btn>
                                                                    </div>  
                                                                </v-container>
                                                            
                                                        </v-card>
                                                    </v-dialog> 
                                                    
                                                    <v-btn
                                                    fab
                                                    :large="$vuetify.breakpoint.lgAndDown ? false : true"
                                                    :small="$vuetify.breakpoint.lgAndDown ? true : false"
                                                    bottom
                                                    left
                                                    class="ml-2"
                                                    @click="dialogExportar = true"
                                                    >
                                                        <v-icon class="mx-2" color="secondary">fas fa-file-download</v-icon>
                                                    </v-btn>
                                                </v-col>
                                            </v-row>
                                        </v-card-title>
                                    </v-col>
                                    <v-col cols="12" md="8" xl="9" class="align-self-center ">
                                        <v-overlay :absolute="true" :value="cargando">
                                            <v-progress-circular indeterminate size="64">
                                            </v-progress-circular>
                                        </v-overlay>  
                                        <v-row justify="center" v-if="validacionObservaciones">
                                            <div id="chart" >
                                                <apexchart ref="realtimeChart" type="donut" :options="chartOptions" :series="series" :width="$vuetify.breakpoint.lgAndDown ? 300 : 380" ></apexchart>
                                            </div>
                                        </v-row>
                                        <v-row justify="center" v-if="validacionObservacionesFalse == false">
                                            <h3>No existen observaciones</h3>
                                        </v-row>     
                                    </v-col>
                                </v-row>
                                
                            
                        </v-card>
                            <v-timeline  align-top dense v-show="validacionObservaciones">
                                
                                <v-timeline-item
                                v-for="(observacion, i) in observaciones"

                                :key="i"
                                :color="observacion.color"
                                :icon="observacion.icono"
                                fill-dot
                                dense
                                
                                >
                                <v-card
                                    :color="observacion.color"
                                    dark
                                >
                                    <v-card-title class="title">{{observacion.titulo}}</v-card-title>
                                    <v-card-text class="white text--primary">
                                    <h5 class="pt-2">TIPO: {{observacion.tipo}}</h5>
                                    <h5>CATEGORIA: {{observacion.categoria}}</h5>
                                    <h5>ESTUDIANTE: {{observacion.estudiante}}</h5>
                                    <h5>AYUDANTE: {{observacion.ayudante}}</h5>
                                    <h5>CURSO: {{observacion.curso}}</h5>
                                    
                                    <p class="pt-2"><strong>DESCRIPCION: </strong>{{observacion.descripcion}}</p>
                                    <div style="text-align:right;"> 
                                        <v-btn  color="white" fab small depressed class="mr-2 py-2" 
                                        @click="cargarDatosModificarObservacion(observacion)"
                                        >
                                            <v-icon color="primary"  >
                                                fas fa-edit
                                            </v-icon>
                                        </v-btn>
                                        <v-btn color="white" fab small depressed class="mr-2 py-2" 
                                        @click="cargarDatosEliminarObservacion(observacion)"
                                        >
                                            <v-icon color="warning"  >
                                                fas fa-trash-alt
                                            </v-icon>
                                        </v-btn>
                                    </div>
                                   
                                    </v-card-text>
                                    
                                </v-card>
                                </v-timeline-item>
                            </v-timeline>
                        
                    </v-col>
                    <v-col cols="0" sm="0" md="1">

                    </v-col>
                </v-row>
            </v-col>
        </v-row>
        <v-dialog v-model="dialogModificarObservacion" persistent max-width="500px" >
            <v-card class="mx-auto" max-width="500" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Modificar observacion</h5>
                </v-card-title>
                    <v-container class="px-5 mt-5">
                        <v-text-field  
                        v-model="estudianteModificarObservacion.titulo"
                        label="Titulo" 
                        outlined
                        color="secondary"
                        prepend-inner-icon="fas fa-check-circle"
                        ></v-text-field>

                        <v-select   
                        v-model="estudianteModificarObservacion.tipo"
                        :items="tipos"
                        item-text="nombre"
                        label="Tipo" outlined
                        color="secondary"
                        prepend-inner-icon="fas fa-check-circle"
                        ></v-select >

                        <v-select 
                        v-model="estudianteModificarObservacion.categoria"
                        :items="categorias"
                        item-text="nombre"
                        item-value="id"
                        label="Categoria"
                        color="secondary"
                        outlined
                        prepend-inner-icon="fas fa-check-circle"
                        ></v-select>
                        <v-textarea
                        v-model="estudianteModificarObservacion.descripcion"
                        outlined
                        color="secondary"
                        label="Descripcion"
                        ></v-textarea>
                        <div class="pb-1" style="text-align:right;">  
                            <v-btn 
                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                            rounded color="warning" 
                            @click="resetModificarObservacion">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn 
                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                            rounded color="secondary" class="ml-2"
                            :loading="cargando"  
                            @click="modificarObservacion"
                            >
                                <h4 class="white--text">Modificar</h4>
                            </v-btn>
                        </div>  
                    </v-container>
                
            </v-card>
        </v-dialog> 
        <v-dialog transition="scroll-y-reverse-transition" v-model="dialogEliminarObservacion" persistent max-width="500px">
            <v-card
            class="mx-auto"
            max-width="500px"
            >
            <v-card-title
            class="headline primary text--center"
            primary-title
            >
                <h5 class="white--text ">Eliminar Observacion</h5>
            </v-card-title>
            
            <v-card-title class="text-justify" :style="$vuetify.breakpoint.smAndDown ? 'font-size: 90%;' :'font-size: 110%;'">Esta seguro que desea eliminar la siguiente observacion?</v-card-title>
            
            <v-card-text class="pt-2">TITULO: {{ estudianteEliminarObservacion.titulo}}</v-card-text>
            <v-card-text>TIPO: {{estudianteEliminarObservacion.tipo  }}</v-card-text>   
            <v-card-text>CATEGORIA: {{estudianteEliminarObservacion.categoria  }}</v-card-text>   
            <v-card-text>ESTUDIANTE: {{estudianteEliminarObservacion.estudiante  }}</v-card-text>   
            <v-card-text>AYUDANTE: {{estudianteEliminarObservacion.ayudante  }}</v-card-text>   
            <v-card-text>CURSO: {{estudianteEliminarObservacion.curso  }}</v-card-text>   
            <p class="pt-2 pl-5"><strong>DESCRIPCION: </strong>{{estudianteEliminarObservacion.descripcion}}</p>

            <div class="px-5  pb-4" style="text-align:right;">
                <v-btn 
                :small="$vuetify.breakpoint.smAndDown ? true : false"
                rounded color="warning" @click="resetEliminarObservacion">
                <h4 class="white--text">Cancelar</h4>
                </v-btn>
                <v-btn 
                :small="$vuetify.breakpoint.smAndDown ? true : false"
                rounded color="secondary" class="ml-2" @click="EliminarObservacion">
                <h4 class="white--text">Eliminar</h4>
                </v-btn>
            </div>  
            
            </v-card>
        </v-dialog>
        <v-dialog v-model="dialogSolicitud" persistent max-width="500px" >
            <v-card class="mx-auto" max-width="500" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Crear Solicitud de Ayudante</h5>
                </v-card-title>
                <v-container class="px-5 mt-5">
                    <v-text-field
                        v-model="perfilEstudiante.nombre_completo"
                        label="Nombre Estudiante"             
                        :disabled="true"           
                        outlined
                        prepend-inner-icon="mdi-account"
                    ></v-text-field>
                    <v-select
                        v-model="datosSolicitud.curso"
                        label="Curso"
                        :items="listaCursos"
                        item-text="descripcion"
                        item-value="id"
                        :rules="[() => !!datosSolicitud.curso ||'Requerido']"
                        outlined
                        prepend-inner-icon="mdi-school"
                    >                                
                    </v-select>                    
                    <v-text-field
                        v-model="datosSolicitud.nota"
                        prepend-inner-icon="far fa-star"    
                        :rules="reglasNumeros"                    
                        label="Nota Aprobación del Módulo"
                        outlined                       
                    >
                    </v-text-field>
                    <v-text-field
                        v-model="datosSolicitud.meses"
                        prepend-inner-icon="far fa-clock"
                        :rules="reglasNumeros"                    
                        label="N° Meses de Trabajo"
                        outlined                           
                    >
                    </v-text-field> 
                    <v-text-field
                        v-model="datosSolicitud.horas"
                        prepend-inner-icon="far fa-clock"
                        :rules="reglasNumeros"                    
                        label="N° Horas Mensuales"
                        outlined                           
                    >
                    </v-text-field>                  
                    <div class="pb-1" style="text-align:right;">  
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="warning" @click="resetDialogSolicitud()">
                            <h4 class="white--text">Cancelar</h4>
                        </v-btn>
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="secondary" class="ml-2" @click="enviarSolicitud()" >
                            <h4 class="white--text">Registrar</h4>
                        </v-btn>
                    </div>  
                </v-container>
            </v-card>
        </v-dialog>

         <v-dialog v-model="dialogExportar" ref="form" persistent max-width="500px" transition="scroll-y-reverse-transition">
            <v-card class="mx-auto" max-width="500px"  >
                <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                    <h5 class="white--text ">Exportar  Usuario</h5>
                    </v-card-title> 
                    <!-- <v-container fluid class=" text-left"> -->
                    <v-card-title class="text-justify" :style="$vuetify.breakpoint.smAndDown ? 'font-size: 90%;' :'font-size: 110%;'">Exportar las observaciones del siguiente Usuario?</v-card-title>
                    <v-card-text>Nombre : {{ perfilEstudiante.nombre_completo }}</v-card-text>
                    
                    <!-- </v-container > -->
                    <div style="text-align:right;">
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="warning" class=" mb-4 "  @click="dialogExportar = false">
                            <h4 class="white--text">Cancelar</h4>
                        </v-btn>
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="exportarEstudiante">
                            <h4 class="white--text">Exportar</h4>
                        </v-btn>
                    </div> 
            </v-card>
        </v-dialog>
        <!-- Alertas -->
        <!-- alerta de exito de la modificacion -->
        <v-snackbar v-model="alertAcept" :timeout=delay
        bottom color="secondary" left class="mb-1 pb-12 pr-0 mr-0" >
            <div>
                <v-icon color="white" class="mr-2">
                    fas fa-check-circle
                </v-icon>
                <strong>{{textoAcept}}</strong>
            </div>
            <v-btn color="white" elevation="0" x-small
            fab @click="alertAcept = ! alertAcept" > 
                <v-icon color="secondary">fas fa-times</v-icon>
            </v-btn>
        </v-snackbar>
        <!-- alerta de error en la modificacion -->
        <v-snackbar v-model="alertError" :timeout=delay bottom
        color="warning" left class="mb-1 pb-12 pr-0 mr-0">
            <div>
                <v-icon color="white" class="mr-2">
                    fas fa-exclamation-triangle
                </v-icon>
                <strong>{{textoError}}</strong>
            </div>
            
            <v-btn color="white" elevation="0" x-small
            fab @click="alertError = ! alertError" > 
                <v-icon color="secondary">fas fa-times</v-icon>
            </v-btn>
        </v-snackbar>
    </v-container> 
</template>

<script>
import { mapState,mapMutations } from 'vuex'
import axios from 'axios'

export default {
    data() {
        return {
            dialogAgregarObservacion: false,
            dialogModificarObservacion: false,
            dialogEliminarObservacion: false,
            dialogSolicitud: false,
            alertError: false,
            textoError: '',
            alertAcept: false,
            textoAcept: '',
            delay: 4000,
            mostrar: false, 
            cargando:false,
            validacionObservaciones: false,
            validacionObservacionesFalse: true,
            observaciones:[],
            auxObservaciones:[],
            listaCursos: [],
            listaCursosAux: [],
            items: [
            {
            color: 'red lighten-2',
            icon: 'mdi-star',
            },
            {
            color: 'purple darken-1',
            icon: 'mdi-book-variant',
            },
            {
            color: 'green lighten-1',
            icon: 'mdi-airballoon',
            },
            {
            color: 'indigo',
            icon: 'mdi-buffer',
            },
            
            ],
            series: [0, 0, 0, 0],
            seriesaux:[0,0,0,0],
            chartOptions: {
                chart: {
                    type: 'donut',
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        },
                        dynamicAnimation: {
                            enabled: true,
                            speed: 350
                        }
                    },
                },
                colors: ['#4ECDC4', '#FF6B6B', '#FFE66D', '#2196F3'],
                labels: ["Positiva", "Negativa", "Informativa", "Otro"],
                
                
            },
            estudianteObservacion: {
                estudiante:'',
                titulo:'',
                tipo:'',
                categoria:'',
                curso:'',
                ayudante:'',
                descripcion:'',
            },
            estudianteModificarObservacion: {
                estudiante:'',
                titulo:'',
                tipo:'',
                categoria:'',
                curso:'',
                ayudante:'',
                descripcion:'',
            },
            estudianteEliminarObservacion: {
                estudiante:'',
                titulo:'',
                tipo:'',
                categoria:'',
                curso:'',
                ayudante:'',
                descripcion:'',
            },

            reglasNumeros: [
                v => !!v || 'Requerido',                
                v => /^[0-9]+$/.test(v) || 'Solo numeros',
            ],
            datosSolicitud: { estudiante:'', curso:'', nota:'', horas:'',meses:''},
            tipos:['Positiva','Negativa','Informativa','Otro'],
            categorias:['Ayudantía','Práctica','Copia','Otro','En Observación - 1 por Tercera','En Observación - 1 por Segunda','Se Retira','Eliminado por Rendimiento','Titulado','Eliminado Art. 31 E','Eliminado Art. 31 B'],

            //variables para la exportacion de la informacion del estudiante
            dialogExportar:false,
        }
    },
    computed:{
        ...mapState(['perfilEstudiante','usuario']), 
        
    },
    beforeMount(){
        this.obtenerObservaciones();
        this.obtenerCursosUsuario();
    },
    methods:{
        exportarEstudiante(){
            console.log("exportar info del estudiante.")
            //console.log( this.$store.state.perfilEstudiante.id)
            
            //this.exportar(3,0,0,this.$store.state.perfilEstudiante.id,0);
            this.exportar(3,'2020-07-19','2020-07-21',1,1);
        },
        exportar(tipo, fechaIni,fechaTer,idEstudiante,escuela){
            //var fechaInicio=this.formatDate(fechaIni);
            //var fechaTermino =this.formatDate(fechaTer);
            //console.log("FECHA INI  "+ fechaInicio);
            //console.log("FECHA fin  "+ fechaTermino);

            // if(fechaInicio == 0 || fechaTermino== 0){
            //     fechaInicio = 0
            //     fechaTermino=0;;
            // }
            let post = {
                    "tipo": tipo,
                    "fechaInicio" : fechaIni,
                    "fechaFin": fechaTer ,
                    "id": idEstudiante,
                    "escuela": escuela
                };
                console.log(post)
            var url = 'http://127.0.0.1:8000/api/v1/estudiante/exportarPDF';
            console.log(post)
            axios.post(url,post,this.$store.state.config)
            .then((result)=>{
                console.log(result);
                //var fileDownload = require('js-file-download');
                //fileDownload(result.data, 'archivo.xlsx');
                

                // const url = URL.createObjectURL(new Blob([result.data], {
                //     type: 'application/pdf'
                // }))
                // const link = document.createElement('a');
                // link.href = url;
                // link.setAttribute('download', 'Estudiante.pdf');
                // document.body.appendChild(link);
                // link.click();
                // this.alertAcept = true;
                // this.textoAcept = 'Se realizó la operación correctamente'
                
                this.dialogExportar=false;
                
            })
            .catch((error) => {
                console.log(error);
                if (error.message == 'Network Error') {
                    console.log(error);
                    this.alertError = true;
                    this.textoError = 'Error, intente más tarde'
                } else {
                    console.log(error);
                    this.alertError = true;
                    this.textoError = 'Error, intente más tarde'
                } 
            });
        },


        /**
         * 
         * Convierte la imagen cargada a base 64.
         */
        convertirImagen(e){
            this.imagenMiniatura=null;
            if(e != null){
                let image =e;
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.imagenMiniatura=e.target.result;
                }
            }  
        },
        volverEstudiantes(){
            if (this.$store.state.usuario.usuario.rol == "admin") {
                this.$router.push({path:'/administrador/estudiantes'});
            } else {
                if (this.$store.state.usuario.usuario.rol == "secretaria de escuela") {
                    this.$router.push({path:'/secretariaEscuela/estudiantes'});
                } else {
                    if (this.$store.state.usuario.usuario.rol == "profesor") {
                        this.$router.push({path:'/profesor/estudiantes'});
                    }
                }
            }
        },
        editarEstudiante(){
            console.log(this.$vuetify.breakpoint);
        },
        obtenerObservaciones(){
            this.cargando =true;
            this.seriesaux =[0,0,0,0];
            this.observaciones =[];
            this.auxObservaciones =[];
            var url = 'http://127.0.0.1:8000/api/v1/estudiante/'+ this.$store.state.perfilEstudiante.id+'/edit';
            //var url = 'http://127.0.0.1:8000/api/v1/observacion';

            axios.get(url,this.$store.state.config)
            .then((result)=>{
                console.log(result.data.data.observaciones);
                //if (result.data.success == true) {
                var contador = 0;
                for (let index = result.data.data.observaciones.length-1; index >= 0; index--) {
                    const element = result.data.data.observaciones[contador];
                    contador ++;
                    var auxcolor = null;
                    var auxicono = null;
                    if (element.tipo == "Positiva") {
                        auxcolor="secondary";
                        auxicono="fas fa-check-circle";
                        this.seriesaux[0] = this.seriesaux[0]+1;
                    }
                    else{
                        if (element.tipo == "Negativa") {
                            auxcolor="warning";
                            auxicono="fas fa-exclamation-triangle";
                            this.seriesaux[1] = this.seriesaux[1]+1;
                        } else {
                            if (element.tipo == "Informativa") {
                                auxcolor="accent";
                                auxicono="fas fa-info";
                                this.seriesaux[2] = this.seriesaux[2]+1;
                            } else {
                                auxcolor="#2196F3";
                                auxicono="fas fa-clipboard";
                                this.seriesaux[3] = this.seriesaux[3]+1;
                            }
                        }
                    }
                    
                    this.series=this.seriesaux;
                    this.chartOptions = {
                        chart: {
                            type: 'donut',
                            
                        },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                            animateGradually: {
                                enabled: true,
                                delay: 150
                            },
                            dynamicAnimation: {
                                enabled: true,
                                speed: 350
                            }
                        },
                        colors: ['#4ECDC4', '#FF6B6B', '#FFE66D', '#2196F3'],
                        labels: ["Positiva", "Negativa", "Informativa", "Otro"],
                    };
                    //var chart = new ApexCharts(el, chartOptions);
                    //chart.render();
                    let observacion ={
                        titulo: element.titulo,
                        ayudante: element.ayudante,
                        categoria: element.categoria,
                        creador: element.creador,
                        curso: element.curso, 
                        descripcion: element.descripcion, 
                        estudiante: element.estudiante,
                        id: element.id,
                        tipo: element.tipo,
                        color: auxcolor,
                        icono: auxicono,
                    };

                    this.auxObservaciones[index]=observacion;
                }
                if (contador>0) {
                    this.validacionObservaciones=true;
                    this.validacionObservacionesFalse = true;
                }
                else{
                    this.validacionObservacionesFalse = false;
                    this.validacionObservaciones=false;
                }
                this.cargando =false;
                this.observaciones = this.auxObservaciones;
                console.log(this.observaciones);
                //}
            })
            .catch((error) => {
                console.log(error);
                if (error.message == 'Network Error') {
                console.log(error);
                this.alertError = true;
                this.cargando = false;
                this.textoError = 'Error al cargar los datos, intente más tarde'
                } else {
                if (error.response.data.success == false) {
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.alertError = true;
                    this.cargando = false;
                    this.textoError = error.response.data.message;
                    
                }
                } 
            });
        },

        obtenerCursosUsuario(){
            this.listaCursosAux = [];
            // var url =`http://127.0.0.1:8000/api/v1/instanciacurso/${this.$store.state.usuario.usuario.id}`;
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
                        descripcion: element.curso + " Seccion "+element.seccion,
                    }; 
                    console.log(insCurso);
                    this.listaCursosAux[index] = insCurso;                                                         
                }
                this.listaCursos = this.listaCursosAux;         
                console.log(this.listaCursos);
            }
            ).catch((error)=>{
                console.log("cago aqui?");
                if (error.message == 'Network Error') {
                    this.alertError = true;
                    this.cargando = false;
                    this.textoError = "Error al cargar los datos, intente mas tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 401){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoError = error.response.data.message;
                            this.alertError = true;                            
                        }  
                        if(error.response.data.code == 402){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoError = "Error al obtener los cursos del profesor";
                            this.alertError = true;                            
                        }                      
                    }
                }
            });
        },

        agregarObservacion(){
            this.dessertsAux = [];
            var url = 'http://127.0.0.1:8000/api/v1/observacion';
            var auxTipo=0;
            if (this.estudianteObservacion.tipo == "Positiva") {
                auxTipo=1;
            }
            else{
                if (this.estudianteObservacion.tipo == "Negativa") {
                    auxTipo=2;
                } else {
                    if (this.estudianteObservacion.tipo == "Informativa") {
                        auxTipo=3;
                    } else {
                        auxTipo=4;
                    }
                }
            }
            var auxcategoria=0;
            for (let index = 1; index <= this.categorias.length; index++) {
                const element = this.categorias[index];
                if (this.estudianteObservacion.categoria == element) {
                    auxcategoria=index;
                }
                
            }
            let post = {
                "titulo": this.estudianteObservacion.titulo,
                "descripcion": this.estudianteObservacion.descripcion,
                "ayudante": null, 
                "estudiante": this.$store.state.perfilEstudiante.id,
                "curso": null,
                "categoria": auxcategoria,
                "tipo": auxTipo,
            }
            console.log(post);
            axios.post(url, post, this.$store.state.config)
            .then((result) => {
                console.log(result);
                console.log(result.data);
                this.alertAcept = true;
                this.textoAcept = "Se agrego la observacion con exito."
                this.resetAgregarObservacion();
                this.obtenerObservaciones(); 
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertError = true;
                    this.textoError = "Error al modificar el usuario, intente mas tarde."
                    this.resetRegistrarUsuario();
                }
                else{
                    if (error.response.data.success == false) {
                        console.log(error.response.data.code +' '+ error.response.data.message);
                        console.log(error.response.data);
                        this.textoError = error.response.data.message;
                        this.alertError= true;      
                        this.resetAgregarObservacion();
                        
                    }
                    else{
                        console.log(error)
                        this.alertError = true;
                        this.textoError = "Error al modificar el usuario, intente mas tarde."
                        this.resetAgregarObservacion();
                    }
                }                
            });
        },
        cargarDatosModificarObservacion(observacion){
            this.dialogModificarObservacion = true;
            this.estudianteModificarObservacion= {
                estudiante:'',
                titulo:'',
                tipo:'',
                categoria:'',
                curso:'',
                ayudante:'',
                descripcion:'',
                id:''
            };
            if (observacion.tipo == 1) {
                this.estudianteModificarObservacion.tipo="Positiva";
            }
            else{
                if (observacion.tipo == 2) {
                    this.estudianteModificarObservacion.tipo="Negativa"
                } else {
                    if (observacion.tipo == 3) {
                        this.estudianteModificarObservacion.tipo="Positiva"
                    } else {
                        this.estudianteModificarObservacion.tipo="Otro"
                    }
                }
            }
            for (let index = 1; index <= this.categorias.length; index++) {
                const element = this.categorias[index];
                if (observacion.categoria == index) {
                    this.estudianteModificarObservacion.categoria = element;
                }
            }
            this.estudianteModificarObservacion.estudiante = observacion.estudiante;
            this.estudianteModificarObservacion.titulo = observacion.titulo;
            this.estudianteModificarObservacion.curso = observacion.curso;
            this.estudianteModificarObservacion.curso = observacion.ayudante;
            this.estudianteModificarObservacion.descripcion = observacion.descripcion;
            this.estudianteModificarObservacion.id = observacion.id;
        },
        modificarObservacion(observacion){
            
            //this.cargarDatosModificarObservacion(observacion);
            var auxTipo=0;
            if (this.estudianteModificarObservacion.tipo == "Positiva") {
                auxTipo=1;
            }
            else{
                if (this.estudianteModificarObservacion.tipo == "Negativa") {
                    auxTipo=2;
                } else {
                    if (this.estudianteModificarObservacion.tipo == "Informativa") {
                        auxTipo=3;
                    } else {
                        auxTipo=4;
                    }
                }
            }
            var auxcategoria=0;
            for (let index = 1; index <= this.categorias.length; index++) {
                const element = this.categorias[index];
                if (this.estudianteModificarObservacion.categoria == element) {
                    auxcategoria=index;
                }
                
            }
            let put = {
                "titulo": this.estudianteModificarObservacion.titulo,
                "descripcion": this.estudianteModificarObservacion.descripcion,
                "ayudante": null, 
                "estudiante": this.estudianteModificarObservacion.id,
                "curso": null,
                "categoria": auxcategoria,
                "tipo": auxTipo,
            }
            var url = 'http://127.0.0.1:8000/api/v1/observacion/'+this.estudianteModificarObservacion.id;
            axios.put(url, put, this.$store.state.config)
            .then((result) => {
                //console.log(result);
                //console.log(result.data);
                this.alertAcept = true;
                this.textoAcept = "Se modifico la observacion con exito."
                this.resetModificarObservacion();
                this.obtenerObservaciones(); 
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertError = true;
                    this.textoError = "Error al modificar la observacion, intente mas tarde."
                    this.resetModificarObservacion();
                }
                else{
                    if (error.response.data.success == false) {
                        console.log(error.response.data.code +' '+ error.response.data.message);
                        console.log(error.response.data);
                        this.textoError = error.response.data.message;
                        this.alertError= true;      
                        this.resetModificarObservacion();
                        
                    }
                    else{
                        console.log(error)
                        this.alertError = true;
                        this.textoError = "Error al modificar la observacion, intente mas tarde."
                        this.resetModificarObservacion();
                    }
                }                
            });
        },
        cargarDatosEliminarObservacion(observacion){
            this.dialogEliminarObservacion = true;
            this.estudianteEliminarObservacion= {
                estudiante:'',
                titulo:'',
                tipo:'',
                categoria:'',
                curso:'',
                ayudante:'',
                descripcion:'',
                id:''
            };
            if (observacion.tipo == 1) {
                this.estudianteEliminarObservacion.tipo="Positiva";
            }
            else{
                if (observacion.tipo == 2) {
                    this.estudianteEliminarObservacion.tipo="Negativa"
                } else {
                    if (observacion.tipo == 3) {
                        this.estudianteEliminarObservacion.tipo="Positiva"
                    } else {
                        this.estudianteEliminarObservacion.tipo="Otro"
                    }
                }
            }
            for (let index = 1; index <= this.categorias.length; index++) {
                const element = this.categorias[index];
                if (observacion.categoria == index) {
                    this.estudianteEliminarObservacion.categoria = element;
                }
            }
            this.estudianteEliminarObservacion.estudiante = observacion.estudiante;
            this.estudianteEliminarObservacion.titulo = observacion.titulo;
            this.estudianteEliminarObservacion.curso = observacion.curso;
            this.estudianteEliminarObservacion.curso = observacion.ayudante;
            this.estudianteEliminarObservacion.descripcion = observacion.descripcion;
            this.estudianteEliminarObservacion.id = observacion.id;
        },
        EliminarObservacion(){
            var url = 'http://127.0.0.1:8000/api/v1/observacion/'+this.estudianteEliminarObservacion.id;
            axios.delete(url, this.$store.state.config)
            .then((result) => {
                //console.log(result);
                //console.log(result.data);
                this.alertAcept = true;
                this.textoAcept = "Se elimino la observacion con exito."
                this.resetEliminarObservacion();
                this.obtenerObservaciones(); 
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertError = true;
                    this.textoError = "Error al eliminar la observacion, intente mas tarde."
                    this.resetEliminarObservacion();
                }
                else{
                    if (error.response.data.success == false) {
                        console.log(error.response.data.code +' '+ error.response.data.message);
                        console.log(error.response.data);
                        this.textoError = error.response.data.message;
                        this.alertError= true;      
                        this.resetEliminarObservacion();
                        
                    }
                    else{
                        console.log(error)
                        this.alertError = true;
                        this.textoError = "Error al eliminar la observacion, intente mas tarde."
                        this.resetEliminarObservacion();
                    }
                }                
            });
        

        },
        resetAgregarObservacion(){
            this.dialogAgregarObservacion= false;
            this.estudianteObservacion.titulo = '';
            this.estudianteObservacion.descripcion= '';
            this.estudianteObservacion.ayudante= '';
            this.estudianteObservacion.curso= '';
            this.estudianteObservacion.categoria= '';
            this.estudianteObservacion.tipo= '';
        },

        resetModificarObservacion(){
            this.dialogModificarObservacion = false;
            this.estudianteModificarObservacion= {
                estudiante:'',
                titulo:'',
                tipo:'',
                categoria:'',
                curso:'',
                ayudante:'',
                descripcion:'',
                id:''
            };
        },

        resetEliminarObservacion(){
            this.dialogEliminarObservacion = false;
            this.estudianteEliminarObservacion= {
                estudiante:'',
                titulo:'',
                tipo:'',
                categoria:'',
                curso:'',
                ayudante:'',
                descripcion:'',
                id:''
            };
        },

        resetDialogSolicitud(){
            this.dialogSolicitud = false;
            this.datosSolicitud.estudiante = '';
            this.datosSolicitud.curso = '';
            this.datosSolicitud.nota = '';
            this.datosSolicitud.meses = '';
            this.datosSolicitud.horas = '';
        },

        enviarSolicitud(){
            let post = {
                "estudiante": this.$store.state.perfilEstudiante.id,
                "curso": this.datosSolicitud.curso,
                "nota": this.datosSolicitud.nota,
                "horas": this.datosSolicitud.horas,
                "meses": this.datosSolicitud.meses,
            }

            // var url = `http://127.0.0.1:8000/api/v1/profesorConCurso/${this.$store.state.usuario.usuario.id}`;

            axios.post(url, post, this.$store.state.config)
            .then((result) => {
                console.log(result);
                console.log(result.data);
                this.alertAcept = true;
                this.textoAcept = "Se envió la solicitud con exito"
                this.resetDialogSolicitud();
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertError = true;
                    this.textoError = "Error al enviar la solicitud, intente mas tarde."
                    this.resetDialogSolicitud();
                }                            
            });
        },
    }
}
</script>
<style scoped>
    .difuminado{
        text-shadow: #555 2px 2px 3px;
    }
    .letra{
        font-size: 125%;
    }
    .borde {
        color:#fff;
        background-color: rgba(0,0,0,0.6);
        border-style: solid; 
        border-color: color;
    }
</style>