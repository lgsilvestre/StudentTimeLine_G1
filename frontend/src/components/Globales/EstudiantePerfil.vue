<template>
    <v-container  fluid >

        <v-btn 
        block
        
        @click="volver"
        >
            <v-icon class="pr-2" color="primary"> fas fa-arrow-circle-left</v-icon> 
            volver
        </v-btn>
        <!--<v-btn
        ref="button"
        block
        color="primary"
        @click="$vuetify.goTo(target, options)"
        >
          scroll
        </v-btn>!-->
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
                                :src="estudiante.foto"
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
                            <h5 >{{estudiante.matricula}}</h5>
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
                            <h5 >{{estudiante.rut}}</h5>
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
                            <h5 >{{ estudiante.nombre_completo}}</h5>
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
                            <h5 >{{ estudiante.correo}}</h5>
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
                            <h5 >{{ estudiante.anho_ingreso}}</h5>
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
                            <h5 >{{ estudiante.situacion_academica}}</h5>
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
                            <h5 >{{ estudiante.escuela}}</h5>
                        </v-col>
                    </v-row>
                    <div class="pb-5"  style="text-align:center;">
                        <v-btn
                        v-if="admin==true || secretariaEscuela==true"
                        color="secondary"
                        rounded
                        @click="editarEstudiante"
                        >Editar</v-btn>
                        <v-btn
                         v-if="profesor==true"
                        color="secondary"
                        class="ml-2"
                        rounded
                        @click="dialogSolicitud = true"
                        >Solicitar Ayudante</v-btn>
                    </div>
                    
                </v-card>
                <!--<section id="up" class="mb-12">!-->
                    <!--<div id="up">!-->
                        <!--<div id="up" class="base-title">
                            <a id="up" href="#up" class="mr-2 d-inline-flex core-goto text--primary">
                                
                                <h2>wena</h2>
                                
                            </a>
                        </div>!-->
                    <!--</div>!-->
                <!--</section>!-->
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
                                            <v-row :style="$vuetify.breakpoint.smAndDown ? '' : 'height:250px;'"> 
                                                <v-col cols="6" sm="6"  md="12" class="align-self-end ">
                                                    <div >
                                                        <strong class=" white--text" :style="$vuetify.breakpoint.lgAndDown ? 'font-size: 70%':'font-size: 100%'" >Observaciones</strong>
                                                    </div>
                                                </v-col>
                                                <v-col cols="6" sm="6" md="12" class="align-self-end ">
                                                    <div  style="text-align:right;"> 
                                                        <v-btn 
                                                        :small="$vuetify.breakpoint.lgAndDown ? true : false"
                                                        fab bottom left  @click="dialogAgregarObservacion = true" >
                                                            <v-icon  color="warning">fas fa-plus</v-icon>
                                                        </v-btn>
                                                        <v-btn
                                                        fab
                                                        :small="$vuetify.breakpoint.lgAndDown ? true : false"
                                                        bottom
                                                        left
                                                        class="ml-2"
                                                        @click="dialogExportar = true"
                                                        >
                                                            <v-icon class="mx-2" color="secondary">fas fa-file-download</v-icon>
                                                    </v-btn>
                                                    </div>
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
                                >
                                    <v-card-title class="headline  text--center"   primary-title >
                                        <div class="v-markdown" id="hola" href="#hola">
                                            <h5 class="white--text " >{{observacion.titulo}}</h5>
                                        </div>
                                        
                                    </v-card-title>
                                    <v-container style="background-color:white;">
                                        <v-row style="margin: 0; padding: 0;">
                                            <v-col cols="4" lg="3" xl="2" style="margin: 0; padding: 0;">
                                                <h5>Tipo</h5> 
                                            </v-col>
                                            <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;">
                                                <h5 >: {{observacion.tipo}}</h5>
                                            </v-col>
                                        </v-row>
                                        <v-row style="margin: 0; padding: 0;">
                                            <v-col cols="4"  lg="3" xl="2" style="margin: 0; padding: 0;">
                                                <h5 >Autor</h5>
                                            </v-col>
                                            <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;">
                                                <h5 >: {{observacion.creador}}</h5>
                                            </v-col>
                                        </v-row>
                                        <v-row style="margin: 0; padding: 0;">
                                            <v-col cols="4" lg="3"  xl="2" style="margin: 0; padding: 0;">
                                                <h5 >Categoria</h5>
                                            </v-col>

                                            <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;">
                                                <h5 >:  {{observacion.categoria}}</h5>
                                            </v-col>
                                        </v-row>
                                        <v-row style="margin: 0; padding: 0;">
                                            <v-col cols="4" lg="3"  xl="2" style="margin: 0; padding: 0;">
                                                <h5 >Fecha</h5>
                                            </v-col>

                                            <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;">
                                                <h5 >:  {{observacion.fecha}}</h5>
                                            </v-col>
                                        </v-row>
                                        <v-row style="margin: 0; padding: 0;">
                                            <v-col cols="4" lg="3"  xl="2" style="margin: 0; padding: 0;">
                                                <h5 >Curso</h5>
                                            </v-col>

                                            <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;" v-if="observacion.curso!=null">
                                                <h5 >:  {{observacion.curso}}</h5>
                                            </v-col>
                                            <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;" v-if="observacion.curso==null">
                                                <h5 >:  ninguno</h5>
                                            </v-col>
                                        </v-row>
                                    
                                        <h5 class="mt-4"> Descripcion</h5 >  
                                    <div  class="DIV  mb-2" style=" height:150px; overflow: auto; font-size: 90%"> 
                                        {{observacion.descripcion}}  
                                    </div>


                                    <div style="text-align:right;"> 
                                        <v-tooltip bottom color="primary">
                                            <template v-slot:activator="{ on }">
                                        <v-btn v-on="on" color="white" fab small depressed class="mr-2 py-2" 
                                        @click="verficarModificarObservacion(observacion)"
                                        >
                                            <v-icon color="primary"  >
                                                fas fa-edit
                                            </v-icon>
                                        </v-btn>
                                        </template>
                                            <span><strong>Editar</strong></span>
                                        </v-tooltip>
                                        <v-tooltip bottom color="primary">
                                            <template v-slot:activator="{ on }">
                                        <v-btn v-on="on" color="white" fab small depressed class="mr-2 py-2" 
                                        @click="verficarEliminarObservacion(observacion)"
                                        >
                                            <v-icon color="warning"  >
                                                fas fa-trash-alt
                                            </v-icon>
                                        </v-btn>
                                        </template>
                                            <span><strong>Eliminar</strong></span>
                                        </v-tooltip>
                                        
                                    </div>
                                    </v-container>
                                   
                                    
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
                        :disabled="profesor == true"
                        prepend-inner-icon="fas fa-check-circle"
                        ></v-select>

                        <v-select 
                        v-if="profesor == true"
                        v-model="estudianteModificarObservacion.curso"
                        :items="cursosAyudante"
                        item-text="curso"
                        item-value="id"
                        label="Cursos"
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
            
            <v-card-title class="text-justify" :style="$vuetify.breakpoint.smAndDown ? 'font-size: 90%;' :'font-size: 100%;'">Esta seguro que desea eliminar la siguiente observacion?</v-card-title>
            <v-container  class="px-5" style="background-color:white;">
            <v-row style="margin: 0; padding: 0;">
                <v-col cols="4" lg="3" xl="2" style="margin: 0; padding: 0;">
                    <h5>Titulo</h5> 
                </v-col>
                <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;">
                    <h5 >: {{estudianteEliminarObservacion.titulo}}</h5>
                </v-col>
            </v-row>
            <v-row style="margin: 0; padding: 0;">
                <v-col cols="4" lg="3" xl="2" style="margin: 0; padding: 0;">
                    <h5>Tipo</h5> 
                </v-col>
                <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;">
                    <h5 >: {{estudianteEliminarObservacion.tipo}}</h5>
                </v-col>
            </v-row>
            <v-row style="margin: 0; padding: 0;">
                <v-col cols="4"  lg="3" xl="2" style="margin: 0; padding: 0;">
                    <h5 >Autor</h5>
                </v-col>
                <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;">
                    <h5 >: {{estudianteEliminarObservacion.creador}}</h5>
                </v-col>
            </v-row>
            <v-row style="margin: 0; padding: 0;">
                <v-col cols="4" lg="3"  xl="2" style="margin: 0; padding: 0;">
                    <h5 >Categoria</h5>
                </v-col>

                <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;">
                    <h5 >:  {{estudianteEliminarObservacion.categoria}}</h5>
                </v-col>
            </v-row>
            <v-row style="margin: 0; padding: 0;">
                <v-col cols="4" lg="3"  xl="2" style="margin: 0; padding: 0;">
                    <h5 >Fecha</h5>
                </v-col>

                <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;">
                    <h5 >:  {{estudianteEliminarObservacion.fecha}}</h5>
                </v-col>
            </v-row>
            <v-row style="margin: 0; padding: 0;">
                <v-col cols="4" lg="3"  xl="2" style="margin: 0; padding: 0;">
                    <h5 >Curso</h5>
                </v-col>

                <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;" v-if="estudianteEliminarObservacion.curso!=null">
                    <h5 >:  {{estudianteEliminarObservacion.curso}}</h5>
                </v-col>
                <v-col cols="8" lg="9"  xl="10" style="margin: 0; padding: 0;" v-if="estudianteEliminarObservacion.curso==null">
                    <h5 >:  ninguno</h5>
                </v-col>
            </v-row>
            <h5 class="mt-4"> Descripcion</h5 >
            <div  class="DIV  mb-2" style=" height:150px; overflow: auto; font-size: 90%"> 
                {{estudianteEliminarObservacion.descripcion}}  
            </div>
            </v-container>

            
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
        <v-dialog v-model="dialogAgregarObservacion" persistent max-width="500px" >
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
                        :disabled="profesor == true"
                        prepend-inner-icon="fas fa-check-circle"
                        ></v-select>
                        <v-select 
                        v-if="profesor == true"
                        v-model="estudianteObservacion.curso"
                        :items="cursosAyudante"
                        item-text="curso"
                        item-value="id"
                        label="Cursos"
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
        <v-dialog v-model="dialogAEditarEstudiante" persistent max-width="500px" >
            <v-card class="mx-auto" max-width="500" >
                <v-card-title class="headline primary text--center" primary-title >
                    <h5 class="white--text ">Editar estudiante</h5>
                </v-card-title>
                    <v-container class="px-5 mt-5">     
                        <v-text-field 
                        v-model="estudianteEditar.matricula"
                        label="Matricula" outlined
                        color="secondary"
                        prepend-inner-icon="fas fa-graduation-cap"
                        ></v-text-field>

                        <v-text-field  
                        v-model="estudianteEditar.rut"
                        label="Rut" outlined
                        color="secondary"
                        prepend-inner-icon="fas fa-address-card"
                        ></v-text-field>

                        <v-text-field  
                        v-model="estudianteEditar.nombre_completo"
                        label="Nombre completo" outlined
                        color="secondary"
                        prepend-inner-icon="mdi-account"
                        ></v-text-field>

                        <v-text-field 
                        v-model="estudianteEditar.correo"
                        label="Correo Electronico"
                        outlined
                        color="secondary"
                        prepend-inner-icon="mdi-email"
                        ></v-text-field>

                        <v-text-field  
                        v-model="estudianteEditar.anho_ingreso"
                        label="Año ingreso" outlined
                        color="secondary"
                        prepend-inner-icon="fas fa-hashtag"
                        ></v-text-field>

                        <v-select   
                        v-model="estudianteEditar.situacion_academica"
                        :items="listaSituacionAcademica"
                        item-text="nombre"
                        label="Situacion academica" outlined
                        color="secondary"
                        prepend-inner-icon="fas fa-address-book"
                        ></v-select >

                        <v-select 
                        v-model="estudianteEditar.escuelaid" 
                        :items="listaEscuela"
                        item-text="nombre"
                        item-value="id"
                        label="Escuela"
                        outlined
                        prepend-inner-icon="fas fa-book"
                        ></v-select>
                        <v-file-input  accept="image/png, image/jpeg, image/bmp" 
                        label="Seleccione una imagen"
                        color="secondary"
                        outlined
                        prepend-icon=""   
                        prepend-inner-icon="mdi-camera"
                        @change="convertirImagen"
                        v-model="estudianteEditar.foto">
                        </v-file-input>
                        <div style="text-align:right;" class="mb-1">
                            <v-btn rounded color="warning" 
                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                            @click="dialogAEditarEstudiante = !dialogAEditarEstudiante"
                            >
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn 
                            @click="modificarEstudiante"
                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                            rounded color="secondary" class="ml-2"   >
                                <h4 class="white--text">Aceptar</h4>
                            </v-btn>
                        </div>
                        </v-container>
                
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
                <v-icon color="warning">fas fa-times</v-icon>
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
            estudiante:{
                anho_ingreso: '',
                correo: '',
                escuela: '',
                foto: '',
                id: '',
                matricula: '',
                nombre_completo: '',
                porcentaje_avance: '',
                rut: '',
                situacion_academica: '',
                escuelaid:'',
            },
            estudianteEditar:{
                anho_ingreso: '',
                correo: '',
                escuela: '',
                foto: '',
                id: '',
                matricula: '',
                nombre_completo: '',
                porcentaje_avance: '',
                rut: '',
                situacion_academica: '',
                escuelaid:'',
            },
            estudianteAUX:{
                anho_ingreso: '',
                correo: '',
                escuela: '',
                foto: '',
                id: '',
                matricula: '',
                nombre_completo: '',
                porcentaje_avance: '',
                rut: '',
                situacion_academica: '',
                escuelaid:'',
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
                fecha:'',
                autor:'',
            },

            dialogAEditarEstudiante:false,
            estudianteImportar: {
                matricula:'',
                rut:'',
                nombre_completo:'',
                correo:'',
                anho_ingreso:'',
                situacion_academica:'',
                escuela:'',
            },
            
            listaSituacionAcademica:[
                {
                    id:1,
                    nombre:"Regular",
                },
                {
                    id:2,
                    nombre:"Egresado",
                },
                {
                    id:3,
                    nombre:"Eliminado",
                },
                {
                    id:4,
                    nombre:"Titulado",
                },
                {
                    id:5,
                    nombre:"Intercambio",
                },
                {
                    id:6,
                    nombre:"Postergación",
                },
                {
                    id:7,
                    nombre:"Retiro",
                },
                {
                    id:8,
                    nombre:"Temporal",
                },
            ],
            listaEscuelaAux:[],
            listaEscuela:[],

            reglasNumeros: [
                v => !!v || 'Requerido',                
                v => /^[0-9]+$/.test(v) || 'Solo numeros',
            ],
            datosSolicitud: { estudiante:'', curso:'', nota:'', horas:'',meses:''},
            
            tipos:['Positiva','Negativa','Informativa','Otro'],
            categorias:['Ayudantía','Práctica','Copia','Otro','En Observación - 1 por Tercera','En Observación - 1 por Segunda','Se Retira','Eliminado por Rendimiento','Titulado','Eliminado Art. 31 E','Eliminado Art. 31 B'],
            id : null,
            enrutamiento: null,
            dialogExportar:false,
            counter: 0,
            //prueba de imagen
            imagenMiniatura:null,

            cursosAyudante:[],
            cursosAyudanteAux:[],
        }
    },
    computed:{
        ...mapState(['perfilEstudiante','usuario','admin','secretariaEscuela','profesor']), 
        
        target () {
            return '#hola';
        },
        options () {
            return {
            duration: 300,
            offset: 23,
            easing: 'linear',
            }
        },
    },

    beforeMount(){
        this.id =  this.$route.params.id;
        this.enrutamiento = this.$route.params.enrutamiento;
        this.obtenerEstudiante(1);
        this.obtenerCursosUsuario();
    },

    methods:{
        obtenerEscuelas(estudiante){
            if (this.admin == true) {
                this.listaEscuelaAux = [];
                var url = 'http://127.0.0.1:8000/api/v1/escuela';
                axios.get(url,this.$store.state.config)
                .then((result)=>{
                    if (result.data.success == true) {
                        for (let index = 0; index < result.data.data.escuelas.length; index++) {
                            const element = result.data.data.escuelas[index];
                            let escuela = {
                                id: element.id,
                                nombre: element.nombre,
                            };
                            // console.log(escuela);
                            this.listaEscuelaAux[index]=escuela;
                        }
                        this.listaEscuela = this.listaEscuelaAux;
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
            } else {
                this.listaEscuelaAux = [];
                let escuela = {
                    id: estudiante.escuelaid,
                    nombre: estudiante.escuela,
                };
                console.log(escuela);
                this.listaEscuelaAux[0]=escuela;
                console.log(escuela);
                this.listaEscuela = this.listaEscuelaAux;
            }
            
        },
        exportarEstudiante(){
            console.log("exportar info del estudiante.")
            //console.log( this.$store.state.perfilEstudiante.id)
            
            this.exportar(3,0,0,this.$store.state.perfilEstudiante.id,0);
            // this.exportar(3,'2020-07-19','2020-07-21',1,1);
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
                    "fechaInicio" : 0,
                    "fechaFin": 0 ,
                    "id": idEstudiante,
                    "escuela": 0
                };
                console.log(post)
            var url = 'http://127.0.0.1:8000/api/v1/estudiante/exportarPDF';
            //console.log(post)
            axios.post(url,post,this.$store.state.config2)
            .then((result)=>{
                 console.log(result);
                //var fileDownload = require('js-file-download');
                //fileDownload(result.data, 'archivo.xlsx');
                

                const url = URL.createObjectURL(new Blob([result.data], {
                     type: 'application/x-pdf'
                 }))
                 const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'Estudiante.pdf');
                document.body.appendChild(link);
                link.click();
                this.alertAcept = true;
                this.textoAcept = 'Se realizó la operación correctamente'
                
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
        volver(){
            if (this.$store.state.usuario.usuario.rol == "admin") {
                this.$router.push({path:'/administrador/'+this.enrutamiento});
            } else {
                if (this.$store.state.usuario.usuario.rol == "secretaria de escuela") {
                    this.$router.push({path:'/secretariaEscuela/'+this.enrutamiento});
                } else {
                    if (this.$store.state.usuario.usuario.rol == "profesor") {
                        this.$router.push({path:'/profesor/'+this.enrutamiento});
                    }
                }
            }
        },

        modificarEstudiante() {
            var url = 'http://127.0.0.1:8000/api/v1/estudiante/'+this.id;
            if (this.imagenMiniatura == null) {
                this.imagenMiniatura = null;
            }
            let put = {
                "matricula": this.estudianteEditar.matricula,
                "rut": this.estudianteEditar.rut,
                "nombre_completo": this.estudianteEditar.nombre_completo,
                "correo": this.estudianteEditar.correo,
                "anho_ingreso": this.estudianteEditar.anho_ingreso,
                "situacion_academica": this.estudianteEditar.situacion_academica,
                "porcentaje_avance":0,
                "creditos_aprobados":0,
                "escuela": this.estudianteEditar.escuela.id,
                "foto":this.imagenMiniatura,
            };
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
                //if (result.data.success == true)  {
                    console.log('se cargo el estudiante');
                    this.alertAcept = true;
                    this.textoAcept = 'Se agregó el estudiante correctamente ';
                    this.obtenerEstudiante(1);
                //}
            })
            .catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error);
                    this.alertError = true;
                    this.textoError = 'Error al cargar los datos, intente más tarde'
                } else {
                    if (error.response.data.success == false) {
                        console.log(error.response.data.code +' '+ error.response.data.message);
                        console.log(error.response.data);
                        this.alertError = true;
                        this.textoError = error.response.data.message;
                        
                    }
                } 
            });
        },

        cargarInfoEditarEstudiante(){
            this.estudianteEditar.anho_ingreso=this.estudiante.anho_ingreso;
            this.estudianteEditar.correo=this.estudiante.correo;
            this.estudianteEditar.escuela=this.estudiante.escuela;
            this.estudianteEditar.foto=this.estudiante.foto;
            this.estudianteEditar.id=this.estudiante.id;
            this.estudianteEditar.matricula=this.estudiante.matricula;
            this.estudianteEditar.nombre_completo=this.estudiante.nombre_completo;
            this.estudianteEditar.rut=this.estudiante.rut;
            for (let index = 0; index <  this.listaSituacionAcademica.length; index++) {
                const element =  this.listaSituacionAcademica[index];
                console.log(element);
                if (this.estudiante.situacion_academica == element.nombre) {
                    this.estudianteEditar.situacion_academica= element.nombre ;
                }
            }
            this.estudianteEditar.foto =this.estudiante.foto;
            this.estudianteEditar.escuelaid = this.estudiante.escuelaid;
            
        },
        editarEstudiante(){
            this.dialogAEditarEstudiante = true;
            this.cargarInfoEditarEstudiante();

        },

        obtenerEstudiante(opcion){
            if (opcion == 1 || opcion==2) {
                this.estudianteAUX={
                    anho_ingreso: '',
                    correo: '',
                    escuela: '',
                    foto: '',
                    id: '',
                    matricula: '',
                    nombre_completo: '',
                    porcentaje_avance: '',
                    rut: '',
                    situacion_academica: '',
                    foto:'',
                };
                this.estudiante={
                    anho_ingreso: '',
                    correo: '',
                    escuela: '',
                    foto: '',
                    id: '',
                    matricula: '',
                    nombre_completo: '',
                    porcentaje_avance: '',
                    rut: '',
                    situacion_academica: '',
                    foto:'',
                };     
            }
            
            if (opcion == 1 || opcion == 3) {
                this.cargando = true;
                this.seriesaux = [0,0,0,0];
                this.observaciones = [];
                this.auxObservaciones = [];
                this.cursosAyudanteAux= [];
            }
            
            
            var url = 'http://127.0.0.1:8000/api/v1/estudiante/'+ this.id+'/edit';

            axios.get(url,this.$store.state.config)
            .then((result)=>{
                console.log(result.data.data);
                if (opcion == 1 || opcion==2) {
                    this.estudianteAUX.anho_ingreso=result.data.data.estudiante.anho_ingreso;
                    this.estudianteAUX.correo=result.data.data.estudiante.correo;
                    this.estudianteAUX.escuela=result.data.data.estudiante.escuela;
                    this.estudianteAUX.foto=result.data.data.estudiante.foto;
                    this.estudianteAUX.id=result.data.data.estudiante.id;
                    this.estudianteAUX.matricula=result.data.data.estudiante.matricula;
                    this.estudianteAUX.nombre_completo=result.data.data.estudiante.nombre_completo;
                    this.estudianteAUX.rut=result.data.data.estudiante.rut;
                    this.estudianteAUX.situacion_academica=result.data.data.estudiante.situacion_academica;
                    this.estudianteAUX.foto =result.data.data.estudiante.foto;
                    this.estudianteAUX.escuelaid = result.data.data.estudiante.get_escuela.id;
                    this.estudiante=this.estudianteAUX;
                    this.obtenerEscuelas(this.estudiante);
                }
                if (opcion == 1 && this.profesor ==true) {
                    var contador = 0;
                    for (let index = 0; index < result.data.data.cursos.length; index++) {
                        const element = result.data.data.cursos[index];
                        contador ++;
                        let cursos ={
                            id: element.curso,
                            curso: element.nombreCurso,
                        };
                        console.log("cursos");
                        console.log(cursos);
                        this.cursosAyudanteAux[index]= cursos;
                    }
                    if (contador>0) {
                        this.cursosAyudante = this.cursosAyudanteAux;
                        //this.validacionObservaciones=true;
                        //this.validacionObservacionesFalse = true;
                    }
                    else{
                        let curso ={
                            id: 1,
                            curso: "No existen cursos asociados",
                        }
                        this.cursosAyudanteAux[0]= curso;
                        this.cursosAyudante = this.cursosAyudanteAux;
                        //this.validacionObservacionesFalse = false;
                        //this.validacionObservaciones=false;
                    }
                    this.estudianteObservacion.categoria = 'Ayudantía';
                }
                if (opcion == 1 || opcion == 3) {
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
                        var fechaaux =  element.created_at;
                        var fechaaux2 = fechaaux.split("T");
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
                            creador: element.creador,
                            creadorid: element.get_creador.id,
                            fecha:fechaaux2[0],
                            selector:'#'+element.id+element.titulo,
                            idselector: element.id+element.titulo,
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
                }
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
                        id: element.idInstanciaCurso,
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
            if (this.profesor == true) {
                auxcategoria = auxcategoria+1;
            }
            else{
                for (let index = 0; index < this.categorias.length; index++) {
                    const element = this.categorias[index];
                    if (this.estudianteObservacion.categoria == element) {
                        auxcategoria=index+1;
                    }
                }
            }
            var auxcurso = 0;
            for (let index = 0; index < this.cursosAyudante.length; index++) {
                const element = this.cursosAyudante[index];
                if (this.estudianteObservacion.curso == element.id) {
                    auxcurso= element.id;
                }
            }
            let post = {
                "titulo": this.estudianteObservacion.titulo,
                "descripcion": this.estudianteObservacion.descripcion,
                "ayudante": null, 
                "estudiante": this.id,
                "curso": auxcurso,
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
                this.obtenerEstudiante(3);
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertError = true;
                    this.textoError = "Error al crear una observacion, intente mas tarde."
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
                        this.textoError = "Error, intente mas tarde."
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
            if (observacion.tipo == "Positiva") {
                this.estudianteModificarObservacion.tipo="Positiva";
            }
            else{
                if (observacion.tipo == "Negativa") {
                    this.estudianteModificarObservacion.tipo="Negativa";
                } else {
                    if (observacion.tipo == "Informativa") {
                        this.estudianteModificarObservacion.tipo="Informativa";
                    } else {
                        this.estudianteModificarObservacion.tipo="Otro";
                    }
                }
            
            }
            var categoriaAux = 0
            for (let index = 0; index < this.categorias.length; index++) {
                const element = this.categorias[index];
                if (observacion.categoria == element) {
                    this.estudianteModificarObservacion.categoria = element;
                }
            }
            var auxcurso = null;
            for (let index = 0; index < this.cursosAyudante.length; index++) {
                const element = this.cursosAyudante[index];
                if (observacion.curso == element.curso) {
                    auxcurso= element;
                }
            }

            console.log("cursoooooooooooooooooooooooooo"+ auxcurso);
            this.estudianteModificarObservacion.estudiante = this.id;
            this.estudianteModificarObservacion.titulo = observacion.titulo;
            this.estudianteModificarObservacion.curso =  auxcurso;
            this.estudianteModificarObservacion.descripcion = observacion.descripcion;
            this.estudianteModificarObservacion.id = observacion.id;
        },
        verficarModificarObservacion(observacion){
            if (observacion.creadorid== this.$store.state.usuario.usuario.id) {
                this.cargarDatosModificarObservacion(observacion);
            } else {
                this.alertError = true;
                this.textoError = "Solo el creador de la observacion puede modificarla"
            }
        },
        modificarObservacion(){
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
                "estudiante": this.estudianteModificarObservacion.estudiante,
                "curso": null,
                "categoria": auxcategoria,
                "tipo": auxTipo,
            }
            console.log(put);
            var url = 'http://127.0.0.1:8000/api/v1/observacion/'+ this.estudianteModificarObservacion.id;
            console.log(url);
            axios.put(url, put, this.$store.state.config)
            .then((result) => {
                //console.log(result);
                //console.log(result.data);
                this.alertAcept = true;
                this.textoAcept = "Se modifico la observacion con exito."
                this.resetModificarObservacion();
                this.obtenerEstudiante(3);
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
                titulo: '',
                ayudante: '',
                categoria: '',
                creador: '',
                curso: '', 
                descripcion: '', 
                estudiante: '',
                id: '',
                tipo: '',
                creador: '',
                creadorid: '',
                fecha: '',
            };
            this.estudianteEliminarObservacion.titulo = observacion.titulo;
            if (observacion.tipo == "Positiva") {
                this.estudianteEliminarObservacion.tipo="Positiva";
            }
            else{
                if (observacion.tipo == "Negativa") {
                    this.estudianteEliminarObservacion.tipo="Negativa";
                } else {
                    if (observacion.tipo == "Informativa") {
                        this.estudianteEliminarObservacion.tipo="Informativa";
                    } else {
                        this.estudianteEliminarObservacion.tipo="Otro";
                    }
                }
            }
            this.estudianteEliminarObservacion.creador = observacion.creador;
            this.estudianteEliminarObservacion.categoria = observacion.categoria;
            this.estudianteEliminarObservacion.fecha = observacion.fecha;
            this.estudianteEliminarObservacion.curso = observacion.curso;
            this.estudianteEliminarObservacion.id = observacion.id;
            this.estudianteEliminarObservacion.descripcion = observacion.descripcion;
        },
        verficarEliminarObservacion(observacion){
            if (observacion.creadorid== this.$store.state.usuario.usuario.id) {
                this.cargarDatosEliminarObservacion(observacion);
            } else {
                this.alertError = true;
                this.textoError = "Solo el creador de la observacion puede eliminarla";
            }
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
                this.obtenerEstudiante(3);
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
            if (this.profesor != true) {
                this.estudianteObservacion.categoria= '';
            }
            this.estudianteObservacion.curso= '';
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
                "estudiante": this.id,
                "curso": this.datosSolicitud.curso,
                "nota": this.datosSolicitud.nota,
                "horas": this.datosSolicitud.horas,
                "meses": this.datosSolicitud.meses,
            }
            var url = `http://127.0.0.1:8000/api/v1/solicitudDeAyudante/enviar`;

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
    .DIV {
    border: 1px solid rgba(0,0,0,0.4);
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    padding: 10px;
    }
</style>