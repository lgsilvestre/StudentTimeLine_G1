<template>
    <v-container >
        <v-row >

        <v-col cols="0" sm="1">

        </v-col>
        <v-col  cols="12" sm="10" >
        <v-btn 
        block
        
        @click="calcularRolVuelta"
        >
            <v-icon class="pr-2" color="primary"> fas fa-arrow-circle-left</v-icon> 
            volver
        </v-btn>
        <!-- aca ira la lista de las instancias de curso -->
        <v-card class="justify-center mt-2" >
            <v-img class="mx-auto white--text align-end justify-center"
                width="100%" height="180px"  src="@/assets/Globales/fondo3.jpg" >
                <v-card-title class="white--text" style="padding:0;">
                    <v-row class="px-5">
                        <v-col cols="12" class="pt-1">
                            <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Cursos {{semestre}}</strong>
                        </v-col>
                        <v-col cols="7" sm="9" md="9" class="align-self-end" >
                            <v-text-field
                            v-model="search"
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
                                    :disabled="!semestreValido"
                                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                                    @click="dialogAgregarCursoSemestre = true"
                                    fab bottom left v-on="on">
                                        <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                                    </v-btn>
                                </template>
                                <span><strong>Asignar Curso</strong></span>
                            </v-tooltip>
                            <v-tooltip bottom color="primary">
                                <template v-slot:activator="{ on }">                                    
                                    <v-btn
                                    :disabled="!semestreValido"
                                    class="ml-2"
                                    fab
                                    @click="dialogListaCursos = true"
                                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                                    bottom
                                    left
                                    v-on="on"
                                    >
                                        <v-icon  color="secondary">fas fa-book</v-icon>
                                    </v-btn>
                                </template>
                                <span><strong>Lista de Cursos</strong></span>
                            </v-tooltip>
                        </v-col>
                    </v-row>
                </v-card-title> 
            </v-img>

            <v-data-iterator :items="listaInsCursos" :search="search" :sort-by="sortBy.toLowerCase()" class="px-2 py-2" :loading="cargando" ref="tablaCursos">
                <template v-slot:default="props">
                    <v-row>
                        <v-col v-for="item in props.items" :key="item.id" cols="12"  sm="6" md="4" lg="4">
                            <v-card  class="mx-1" style="background-color:#F7FFF7; border-style:solid; border-color:rgba(0,0,0,0.5);" >
                                <v-container class="pt-0 mt-0 pb-0 ">
                                    <v-row >
                                        <v-col cols="12"  class=" pt-0 pl-0 pr-0 pb-0">
                                            <v-card-title style="padding:0;"  >
                                                <v-img class="mx-auto white--text align-end justify-center "
                                                        width="100%" height="30px"       
                                                        src="@/assets/Globales/background-panel-08.jpg" >
                                                </v-img>
                                            </v-card-title>
                                        </v-col>
                                        <v-col cols="12" class=" pt-1 pl-0 pr-0 pb-0  text-right" >
                                            <v-menu class="text-left " offset-y>
                                                <template   v-slot:activator="{ on, attrs }">
                                                    <v-btn icon fab color="primary" x-small v-bind="attrs" v-on="on" >
                                                        <v-icon>fas fa-ellipsis-v</v-icon>
                                                    </v-btn>
                                                </template>
                                                <v-list :disabled="!semestreValido">
                                                    <v-list-item  v-for="(acciones, index) in listaAccionesSobreInstaciaCurso" :key="index"
                                                    @click="acionesSobreInstanciaCurso(acciones,item)" >
                                                        <v-list-item-title>{{ acciones }}</v-list-item-title>
                                                    </v-list-item>
                                                </v-list>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="12" class=" pt-0 pl-1 pr-0 pb-0" >
                                            <v-card-text class="pt-0 pl-2 pr-0 pb-0 ">
                                                <p class=" mt-0 mb-1   font-weight-black  text-truncate" style=" font-size: 115%;"   >Nombre: {{ item.nomCurso }}</p>
                                                <p class="mt-0 mb-1  text-truncate font-weight-black  "  style=" font-size: 115%;" > Sección: {{ item.seccion}} </p>
                                            </v-card-text>
                                        </v-col>

                                        <v-col cols="12" class=" pt-1 pl-1 pr-0 pb-0" >
                                            <v-card-text class="pt-0 pl-2 pr-0 pr-0 pb-0 font-weight-black text-truncate" style=" font-size: 100%;">
                                                Profesor/es: 
                                                <v-btn class="pt-0  pb-0 "  outlined x-small  @click="mostrarProfesoresDeCurso(item)">
                                                    Ver
                                                </v-btn>
                                            </v-card-text>
                                        </v-col>
                                    
                                        <v-col cols="12" class=" pt-1 pl-1 pr-0 pb-2" >
                                            <v-card-text class="pt-0 pl-2 pr-0 pr-0 pb-0 font-weight-black text-truncate" style=" font-size: 100%;">
                                                Ayudante/s :
                                                <v-btn  outlined x-small  @click="mostrarAyudantesDeCurso(item)">
                                                    Ver
                                                </v-btn>
                                            </v-card-text>
                                            
                                        </v-col>
                                        
                                    </v-row>
                                </v-container>
                            </v-card>
                        </v-col>
                    </v-row>
                </template>
            
            </v-data-iterator>
        </v-card>
        </v-col>
        <v-col cols="0" sm="1">

        </v-col>
        </v-row>
            
            
        

    <!------------------>
        <!-- Dialog para mostrar la lista de los Cursos Existentes -->
        <v-dialog v-model="dialogListaCursos" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card class="mx-auto my-10 " max-width="100%" style="display: block; background-color:#F7FFF7;">
                <v-toolbar dark color="primary">
                    <v-spacer></v-spacer>
                    <v-btn 
                    rounded depressed color="primary" @click="dialogListaCursos = false">
                        <strong> Cerrar </strong>
                        <v-icon class="ml-1">mdi-close</v-icon>
                    </v-btn>
                    
                </v-toolbar>
                <v-container style="background-color: #F7FFF7;">
                    <v-row>
                        <v-col cols="12" md="1"></v-col>
                        <v-col cols="12" md="10">
                            <v-card elevation="1 " >
                            <v-img class="mx-auto white--text align-end justify-center"
                                width="100%" height="180px"       
                                src="@/assets/Globales/fondo3.jpg" >                    
                                <v-card-title class="white--text" style="padding:0;">     
                                    <v-row class="px-5">
                                        <v-col cols="12"  >
                                            <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Cursos Existentes</strong>
                                        </v-col>
                                        <v-col  cols="7" sm="9" md="9" class="align-self-end" >
                                            <v-text-field
                                            v-model="buscarCursos"
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
                                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                                            @click="crearNuevoCurso"
                                            fab bottom left 
                                            v-on="on"
                                            >
                                                <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                                            </v-btn>
                                            </template>
                                            <span><strong>Crear nuevo curso</strong></span>
                                            </v-tooltip>
                                        </v-col>
                                    </v-row>
                                </v-card-title>
                            </v-img>
                            <v-data-table  :headers="colCursos" :items="listaCursos"
                                :search="buscarCursos" :loading="cargando" :items-per-page="10" >            
                                <template v-slot:[`item.opciones`]="{ item }">
                                <!-- boton para modificar usuario seleccionado -->
                                    <v-tooltip bottom color="primary">
                                        <template v-slot:activator="{ on }">
                                            <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on">
                                                <v-icon color="primary" @click="setModificarCurso(item)" >
                                                    fas fa-edit
                                                </v-icon>
                                            </v-btn>
                                        </template>
                                        <span><strong>Modificar Curso</strong></span>
                                    </v-tooltip>
                                <!-- boton para eliminar usuario seleccionado -->
                                    <v-tooltip bottom color="primary">
                                        <template v-slot:activator="{ on }">
                                            <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on">
                                                <v-icon color="warning" @click="setEliminarCurso(item)" >
                                                    fas fa-trash-alt
                                                </v-icon>
                                            </v-btn>
                                        </template>
                                        <span><strong>Eliminar Curso</strong></span>
                                    </v-tooltip>
                                </template>
                            </v-data-table>
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="1"></v-col>
                    </v-row>                    
                </v-container>                            
            </v-card>
            <!-- Dialog para crear un Curso -->
            <v-dialog v-model="dialogCrearCurso" persistent max-width="500px" :key="KeyDialogCrearCurso">            
                <v-card class="mx-auto" max-width="500" >
                    <v-card-title class="headline primary text--center" primary-title >
                        <h5 class="white--text ">Crear Curso</h5>
                    </v-card-title>
                    <v-container class="px-5 mt-5" >
                        <v-form  ref="formCrearCurso"  style="margin:0;padding:0;" v-model="formularioCrearCursoValido" lazy-validation>
                            <v-text-field
                                v-model="datosCurso.nombre"
                                label="Nombre del Curso"
                                :rules="[() => !!datosCurso.nombre ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-account"
                            ></v-text-field>
                            <v-text-field
                                v-model="datosCurso.plan"
                                label="Plan al que Pertenece el Curso"
                                :rules="[() => !!datosCurso.plan ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-account"
                            ></v-text-field>
                            <v-select
                                v-model="datosCurso.idEscuela"
                                label="Escuela"
                                :items="listaEscuela"
                                item-text="nomEscuela"
                                item-value="idEscuela"
                                :rules="[() => !!datosCurso.idEscuela ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                            ></v-select>   
                            <div class="pb-1" style="text-align:right;">
                                <v-btn rounded color="warning" @click="resetCrearCurso()">
                                    <h4 class="white--text">Cancelar</h4>
                                </v-btn>
                                <v-btn rounded color="secondary" class="ml-2" @click="crearCurso()" 
                                :disabled="!formularioCrearCursoValido">
                                    <h4 class="white--text">Aceptar</h4>
                                </v-btn>
                            </div>  
                        </v-form>
                    </v-container>
                </v-card>
            </v-dialog> 

            <!-- Dialog para modificar un curso -->
            <v-dialog v-model="dialogModificarCurso" persistent max-width="500px" transition="scroll-y-reverse-transition">
                <v-card elevation="1">
                    <v-card-title  class="headline primary text--center" primary-title > 
                        <h5 class="white--text ">Modificar Curso</h5>
                    </v-card-title>
                    <v-container class="px-5 mt-5">
                        <v-text-field v-model="datosCurso.nombre" label="Nombre del Curso" outlined
                            color="secondary"
                            :rules="[() => !!datosCurso.nombre ||'Requerido']"
                            prepend-inner-icon="mdi-account"
                        ></v-text-field>
                        <v-text-field v-model="datosCurso.plan" label="Plan" outlined
                            color="secondary"
                            :rules="[() => !!datosCurso.plan ||'Requerido']"
                            prepend-inner-icon="mdi-account"
                        ></v-text-field>
                        <v-select  v-model="datosCurso.nomEscuela"
                            :items="listaEscuela"
                            item-text="nomEscuela"
                            item-value="id"
                            label="Escuela"
                            outlined
                            :small-chips="$vuetify.breakpoint.smAndDown ? true : false"
                            :rules="[() => !!datosCurso.nomEscuela ||'Requerido']"
                            prepend-inner-icon="mdi-school"
                        ></v-select>
                        <div style="text-align:right;" class="mb-1 " >
                            <v-btn 
                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                            rounded color="warning"    @click="resetModificarCurso">  
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn 
                            :small="$vuetify.breakpoint.smAndDown ? true : false"
                            rounded color="secondary" class=" ml-2"    @click="modificarCurso">
                                <h4 class="white--text">Modificar</h4>
                            </v-btn>
                        </div>
                    </v-container> 
                </v-card>                        
            </v-dialog>

            <!-- Dialog para Eliminar un Curso -->
            <v-dialog v-model="dialogEliminarCurso" ref="form" persistent max-width="450px">
                <v-card class="mx-auto" max-width="450"  >
                    <v-card-title
                        class="headline primary text--center"
                        primary-title
                        >
                        <h5 class="white--text ">Eliminar Curso</h5>
                        </v-card-title> 
                        <!-- <v-container fluid class=" text-left"> -->
                        <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea eliminar el siguiente Curso?</v-card-title>
                        <v-card-text>Nombre : {{ this.datosCurso.nombre }}</v-card-text>
                        <v-card-text>Plan : {{ this.datosCurso.plan }}</v-card-text>
                        <v-card-text>Escuela : {{ this.datosCurso.escuela }}</v-card-text>
                        <v-card-text>Descripcion : {{ this.datosCurso.descripcion }}</v-card-text>
                        <!-- </v-container > -->
                        <div style="text-align:right;">
                            <v-btn rounded color="warning" class=" mb-4 "  @click="dialogEliminarCurso = false">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="eliminarCurso()">
                                <h4 class="white--text">Eliminar</h4>
                            </v-btn>
                        </div> 
                </v-card>
            </v-dialog>
        </v-dialog>

        

        <!-- Modifica la informacion que contiene una instancia de curso -->
        <v-dialog v-model="dialogModificarInsCurso" persistent max-width="500px" transition="scroll-y-reverse-transition">
            <v-card elevation="1">
                <v-card-title  class="headline primary text--center" primary-title > 
                    <h5 class="white--text ">Modificar Curso</h5>
                </v-card-title>
                <v-container class="px-5 mt-5">
                    <v-row>
                        <v-col cols="6" >
                            <strong><h3>Curso</h3></strong>
                        </v-col>
                        <v-col cols="6" >
                            <strong><h3>Sección</h3></strong>
                        </v-col>
                        <v-col cols="6" >
                            <v-list-item-title> {{ InstanciaModificar.nomCurso }} </v-list-item-title>
                        </v-col>
                        <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0">
                            <v-select  v-model="InstanciaModificar.seccion"
                                :items="listaDeSeccionesDisponibles"
                                item-text="nombre"
                                item-value="id"
                                outlined
                                :small-chips="$vuetify.breakpoint.smAndDown ? true : false"
                                :rules="[() => !!InstanciaModificar.seccion ||'Requerido']"
                                prepend-inner-icon="mdi-school"
                                dense
                            ></v-select>
                        </v-col>
                    </v-row>
                    <v-divider></v-divider>
                        <strong ><h3 class="pt-5">Eliga el profesor: </h3></strong>
                        <v-form ref="forModificarInsCurso" style="margin:0;padding:0;" v-model="form_modificarInsCurso" lazy-validation>
                            <v-select
                                    class="pt-3"
                                    v-if=" contadorProfesores>=1"
                                    v-model="profesorSeleccionado"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    outlined
                                    prepend-inner-icon="mdi-school"> 
                                </v-select> 
                                <v-select
                                    v-if=" profesorSeleccionado!='' && contadorProfesores>=2"
                                    v-model="profesorSeleccionado2"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                    clearable
                                >                               
                                </v-select>
                                <v-select
                                    v-if="profesorSeleccionado2!='' && contadorProfesores>=3"
                                    v-model="profesorSeleccionado3"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                    clearable
                                >                               
                                </v-select> 
                                <v-select
                                    v-if="profesorSeleccionado3!='' && contadorProfesores>=4"
                                    v-model="profesorSeleccionado4"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                    clearable
                                >                               
                                </v-select> 
                                <v-select
                                    v-if="profesorSeleccionado4!='' && contadorProfesores>=5"
                                    v-model="profesorSeleccionado5"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                    clearable >  </v-select>   
                                                        
            
                        <div style="text-align:left;"   >
                            <v-btn 
                            x-small
                            fab color="primary" 
                            @click="sumarProfesor"
                            >
                                <h4 class="white--text">+</h4>
                            </v-btn>
                            <v-btn 
                            @click="restarProfesor"
                            x-small
                            fab color="primary" class="ml-1" >
                                <h4 class="white--text">-</h4>
                            </v-btn>
                        </div>        
                    
                    
                    <div style="text-align:right;" class="mb-1 " >
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="warning" @click="cerrarDialogModificarInstanciaCurso">  
                            <h4 class="white--text">Cancelar</h4>
                        </v-btn>
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="secondary" class=" ml-2"    @click="modificarInstanciaCurso"
                        :disabled="!form_modificarInsCurso">
                            <h4 class="white--text">Modificar</h4>
                        </v-btn>
                    </div>
                    </v-form>
                </v-container> 
            </v-card>                        
        </v-dialog>

        <!-- Dialog para Eliminar una Instancia de Curso -->
        <v-dialog v-model="dialogEliminarInsCurso" ref="form" persistent max-width="450px">
            <v-card class="mx-auto" max-width="450"  >
                <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                    <h5 class="white--text ">Eliminar Curso</h5>
                    </v-card-title> 
                    <!-- <v-container fluid class=" text-left"> -->
                    <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea cerrar  Curso?</v-card-title>
                    <v-card-text>Curso : {{ this.datosInsCurso.nomCurso }}</v-card-text>
                    <!-- </v-container > -->
                    <div style="text-align:right;">
                        <v-btn rounded color="warning" class=" mb-4 "  @click="cerrarDialogCerrarInstanciaCurso">
                            <h4 class="white--text">Cancelar</h4>
                        </v-btn>
                        <v-btn rounded color="secondary"   class=" mb-4 ml-2 mr-5" @click="eliminarInstanciaCurso()">
                            <h4 class="white--text">Eliminar</h4>
                        </v-btn>
                    </div> 
            </v-card>
        </v-dialog>

        <!-- Dialog para mostrar la lista de los Cursos Existentes -->
        <v-dialog v-model="dialogAgregarCursoSemestre" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card class="mx-auto my-10 " max-width="100%" style="display: block; background-color:#F7FFF7;">
                <v-toolbar dark color="primary">
                <v-spacer></v-spacer>
                <v-btn  
                rounded depressed color="primary" @click="dialogAgregarCursoSemestre = false">
                    <strong> Cerrar </strong>
                    <v-icon class="ml-1">mdi-close</v-icon>
                </v-btn>
                </v-toolbar>
                <v-container style="background-color: #F7FFF7;">
                    <v-row>
                        <v-col cols="12" md="1">
                        </v-col>
                        <v-col cols="12" md="10">
                            <v-card class="mx-auto" >
                                <v-img class="mx-auto white--text align-end justify-center"
                                    width="100%" height="180px"       
                                    src="@/assets/Globales/fondo3.jpg"    >
                                <v-card-title class="white--text" style="padding:0;">
                                    <v-row class="px-5">  
                                        <v-col cols="12" class="pt-1">
                                            <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Cursos</strong>
                                        </v-col> 
                                        <v-col cols="7" sm="9" md="9" class="align-self-end" >
                                        <v-text-field v-model="buscarAsignarCursos"
                                        append-icon="mdi-magnify"  label="Buscar"  hide-details
                                        outlined clearable  dense solo
                                        rounded color="secondary"  background-color="white"
                                        ></v-text-field>
                                        </v-col> 
                                        <v-col  cols="5" sm="3" md="3" class="align-self-end" style="text-align:right;"> 
                                            <v-tooltip bottom color="primary">
                                                <template v-slot:activator="{ on }">
                                                    <v-btn 
                                                    :small="$vuetify.breakpoint.smAndDown ? true : false"
                                                    class="mr-2" fab 
                                                    bottom left v-on="on" @click="asignarCursos" >
                                                        <v-icon class="mx-2" color="warning">fas fa-plus</v-icon>
                                                    </v-btn>
                                                </template>
                                                <span><strong>Asignar Cursos</strong></span>
                                            </v-tooltip>
                                        </v-col>
                                    </v-row>

                                </v-card-title>
                                </v-img>  
                                <v-data-table
                                    v-model="seleccionados"
                                    :headers="colCursos2"
                                    :items="listaCursos"
                                    :loading="cargando"
                                    :search="buscarAsignarCursos"
                                    :items-per-page="10"
                                    show-select
                                    item-key="id"  
                                >                               
                                </v-data-table>
                                
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="1">
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>
        </v-dialog>

        <!-- Dialog para asignar cursos a un semestre -->
        <v-dialog v-model="dialogAsignarCurso" persistent max-width="500">
            <v-card class="mx-auto" max-width="500" >
                <v-card-title primary-title class="headline primary text--center">
                    <h5 class="white--text">Asignar Cursos</h5>
                </v-card-title>
                <v-container class="px-5">
                    <v-row>
                        <v-col cols="6" >
                            <strong><h3>Curso</h3></strong>
                        </v-col>
                        <v-col cols="6">
                            <strong><h3>Sección</h3></strong>
                        </v-col>
                    </v-row>
                        <v-form  ref="formAsignarCurso" style="margin:0;padding:0;" v-model="form_AsignarCurso" lazy-validation>
                    <v-row v-for="(item, index) in seleccionados" :key="index">

                            <v-col cols="6" >
                                <v-list-item-title> {{item.nombre}}</v-list-item-title>
                            </v-col>
                            <v-col cols="6" class="mt-0 pt-0 mb-0 pb-0"> 
                                    <v-select
                                        v-model="item.seccion"
                                        :items="listaDeSeccionesDisponibles"
                                        item-text="sec"
                                        label="Sección"
                                        dense
                                        :rules="[() => !!item.seccion ||'Requerido']"
                                        outlined
                                        color="secondary"
                                    ></v-select>
                            </v-col>
        
                            </v-row>
                            <v-divider></v-divider>
                                <v-select
                                    class="pt-3"
                                    v-if="contadorCursos>0"
                                    v-model="profesorSeleccionado"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    :rules="[() => !!profesorSeleccionado ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                    
                                    >
                                </v-select> 
                                <v-select
                                    v-if=" profesorSeleccionado!='' && contadorCursos>1"
                                    v-model="profesorSeleccionado2"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                    clearable
                                    
                                >                               
                                </v-select>
                                <v-select
                                    v-if="profesorSeleccionado2!='' && contadorCursos>2"
                                    v-model="profesorSeleccionado3"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                    clearable
                                >                               
                                </v-select> 
                                <v-select
                                    v-if="profesorSeleccionado3!='' && contadorCursos>3"
                                    v-model="profesorSeleccionado4"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                    clearable
                                >                               
                                </v-select> 
                                <v-select
                                    v-if="profesorSeleccionado4!='' && contadorCursos>4"
                                    v-model="profesorSeleccionado5"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    outlined
                                    prepend-inner-icon="mdi-school" 
                                    clearable>  </v-select>   
                                                        
            
                         <div style="text-align:left;"   >
                            <v-btn 
                            x-small
                            fab color="primary" 
                            @click="sumarCurso"
                            >
                                <h4 class="white--text">+</h4>
                            </v-btn>
                            <v-btn 
                            @click="restarCurso"
                            x-small
                            fab color="primary" class="ml-1" >
                                <h4 class="white--text">-</h4>
                            </v-btn>
                        </div>        
                                       
                        <div style="text-align:right;"  class="mb-1">
                            <v-btn rounded color="warning" @click="cerrarDialogAsignarCurso()">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn rounded color="secondary" class="ml-2 " @click="asignarCursoASementre()" 
                            :disabled="!form_AsignarCurso">
                                <h4 class="white--text">Asignar</h4>
                            </v-btn>
                        </div> 
                    </v-form>
                </v-container>
                
            </v-card>
        </v-dialog>

        <!-- dialog para mostrar con los profesores asociados a una instancia curso -->
        <v-dialog v-model="dialogProfesoresInsCurso" ref="form"  max-width="450px">
            <v-card class="mx-auto pb-5" max-width="450"  >
                <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                    <h5 class="white--text text-truncate">Profesores de {{ profesoresDeInstanciaCurso.nomCurso  }} </h5>
                    </v-card-title> 
                     <v-data-table
                    :headers="headersProfesor"
                    :items="profesoresDeInstanciaCurso.listaProfesores"
                    hide-default-footer  >
                       
                    </v-data-table>
                    
            </v-card>
        </v-dialog>
        <!-- gialog para asignar ayudantes a una instanciaCurso -->
        <v-dialog v-model="dialogAsignarAyudante" max-width="500">
            <v-card class="mx-auto" max-width="500" >
                <v-card-title primary-title class="headline primary text--center">
                    <h5 class="white--text text-truncate">Asignar ayudante a {{ datosInsCurso.nomCurso }} - {{  datosInsCurso.seccion }} </h5>
                </v-card-title>
                <v-container class="px-5">
                    <v-form ref="formAsignarAyudante">
                        
                        <strong ><h3 class="pt-5">Seleccione el o los ayudantes: </h3></strong>
                            <v-autocomplete
                                class="pt-3"
                                v-if="contadorAyudante>=1"
                                v-model="ayudanteSeleccionado"
                                label="Buscar ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!ayudanteSeleccionado ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                                clearable
                                
                            > 
                            </v-autocomplete> 
                            <v-autocomplete
                                v-if="ayudanteSeleccionado!=''&& contadorAyudante>=2"
                                v-model="ayudanteSeleccionado2"
                                label="Buscar ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                                clearable
                            >                               
                            </v-autocomplete>
                            <v-autocomplete
                                v-if="ayudanteSeleccionado2!=''&& contadorAyudante>=3"
                                v-model="ayudanteSeleccionado3"
                                label="Buscar ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                                clearable
                            >                               
                            </v-autocomplete> 
                            <v-autocomplete
                                v-if="ayudanteSeleccionado3!=''&& contadorAyudante>=4"
                                v-model="ayudanteSeleccionado4"
                                label="Buscar ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                                clearable
                            >                               
                            </v-autocomplete> 
                            <v-autocomplete
                                v-if="ayudanteSeleccionado4!=''&& contadorAyudante>=5"
                                v-model="ayudanteSeleccionado5"
                                label="Buscar ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                                clearable
                            >                               
                            </v-autocomplete>  
                        <div style="text-align:left;"   >
                            <v-btn 
                            x-small
                            fab color="primary" 
                            @click="sumarAyudante"
                            >
                                <h4 class="white--text">+</h4>
                            </v-btn>
                            <v-btn 
                            @click="restarAyudante"
                            x-small
                            fab color="primary" class="ml-1" >
                                <h4 class="white--text">-</h4>
                            </v-btn>
                        </div>  
                                                
                        <div style="text-align:right;"  class="mb-1">
                            <v-btn rounded color="warning" @click="CerrarDialogAsignarAyudante()">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn rounded color="secondary" class="ml-2 " @click="asignarAyudanteInstanciaCurso()" >
                                <h4 class="white--text">Asignar</h4>
                            </v-btn>
                        </div> 
                    </v-form> 
                </v-container>
                
            </v-card>
        </v-dialog>

        <!-- Muestra una lista con los ayudantes de uns  instancia curso -->
        <v-dialog v-model="dialogAyudantesInsCurso" ref="form" 
         max-width="450px">
            <v-card class="mx-auto  pb-5" max-width="450"  >
                <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                    <h5 class="white--text text-truncate">Ayudantes del curso {{ profesoresDeInstanciaCurso.nomCurso  }} </h5>
                    </v-card-title> 
                    <v-data-table
                    :headers="headersAyudante"
                    :items="AyudanteDeInstanciaCurso.listaAyudantes"
                    
                    hide-default-footer  >
                    <template v-slot:[`item.opciones`]="{ item }">
                            <v-tooltip bottom color="primary">
                            <template v-slot:activator="{ on }">
                                <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on" @click="EnrutarAsiPerfilDeUsuario(item)" >
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
        </v-dialog>

        <!-- Alertas -->
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
    data(){
        return{
            /* Variables Alertas */
            dialogAgregarCursoSemestre:false,
            dialogAsignarCurso: false,
            alertaExito: false,
            alertaError: false,
            textoAlertas: '',
            timeout: 6000,
            /* --------------- */
            datosCurso: [{id:''},{nombre:''},{plan:''},{escuela:''},{descripcion:''}],
            datosInsCurso: [{id:''},{semestre:''},{curso:''},{nomCurso:''}],
            listaDeSeccionesDisponibles:['A','B','C','D','E','F','G','H'],
            cargando: false,
            seleccionados: [],
            profesorSeleccionado: null,
            profesorSeleccionado2: null,
            profesorSeleccionado3: null,
            profesorSeleccionado4: null,
            profesorSeleccionado5: null,
            profesorSeleccionadoAux: null,
            profesorSeleccionadoAux2: null,
            profesorSeleccionadoAux3: null,
            profesorSeleccionadoAux4: null,
            profesorSeleccionadoAux5: null,
            profesorConCurso: null,
            profesorConCurso2: null,
            profesorConCurso3: null,
            profesorConCurs4: null,
            profesorConCurso5: null,
            colInsCursos:[
                {text:'ID', value:'id'},
                // {text:'Semestre', value:'semestre'},
                {text:'Curso', value:'nomCurso'},   
                {text:'Opciones', value:'opciones', sortable:false},                
            ],
            colCursos:[
                // {text:'ID', value:'id'},
                {text:'Nombre', value:'nombre',align: 'start'},
                {text:'Plan', value:'plan',align:'center'},   
                {text:'Escuela', value:'nomEscuela',align:'center'},
                // {text:'Descripcion', value:'descripcion'},
                {text:'Opciones', value:'opciones',align: 'center', sortable:false},
            ],
            colCursos2:[
                {text:'Nombre', value:'nombre',align: 'start'},
                {text:'Plan', value:'plan'},   
                {text:'Escuela', value:'nomEscuela',align: 'center'},
                // {text:'Descripcion', value:'descripcion',align: 'start'},
            ],
            
            listaEscuela: [],
            listaEscuelaAux: [],
            listaProfesores: [],
            listaProfesoresAux: [],

            listaCursos: [],
            listaCursosAux: [],
            dialogListaCursos: false,
            dialogCrearCurso: false,
            dialogModificarCurso: false,
            dialogEliminarCurso: false,


            listaInsCursos: [],
            listaInsCursosAux: [],
            dialogCrearInsCurso: false,
            dialogModificarInsCurso: false,
            dialogEliminarInsCurso: false,

            // listaOpcionesDeCursos:[],
            search: '',
            buscarAsignarCursos:'',
            buscarCursos:'',
            sortBy:'nomCurso',
            headers: [
                { text: 'id', value: 'id' },
                { text: 'semestre', value: 'semestre' },
                { text: 'Curso ', value: 'curso' },
                { text: 'Nombre curso', value: 'nomCurso' },
            ],
            listaAccionesSobreInstaciaCurso: [ 'Modificar curso' , 'Eliminar curso' ,'Modificar ayudante' ],
            listaDeSeccionesDisponibles:['A','B','C','D','E','F','G','H'],
            secionActual:'',
            semestre:null,
            KeyDialogCrearCurso: 0,
            calcularCol:true,

            dialogProfesoresInsCurso:false,
            profesoresDeInstanciaCurso:'',
            dialogAsignarAyudante:false,
            listaProspectosAyudante:[],
            listaProspectosAyudanteAux:[],
            //Se usan para capturar la seleccion del usuario.
            ayudanteSeleccionado: null,
            ayudanteSeleccionado2: null,
            ayudanteSeleccionado3: null,
            ayudanteSeleccionado4: null,
            ayudanteSeleccionado5: null,
            //Sirve para guardar la info de ayudantes ya asignados al curso. 
            //Aca se se guarda la info pero como usuario
            ayudanteSeleccionadoAux:null,
            ayudanteSeleccionadoAux2: null,
            ayudanteSeleccionadoAux3: null,
            ayudanteSeleccionadoAux4: null,
            ayudanteSeleccionadoAux5: null,
            //Guarda el identificador de ayudantes que esten asociados con un curso
            ayudanteConCurso:null,
            ayudanteConCurso2:null,
            ayudanteConCurso3:null,
            ayudanteConCurso4:null,
            ayudanteConCurso5:null,

            dialogAyudantesInsCurso:false,
            AyudanteDeInstanciaCurso:'',
            headersAyudante:[
                { text: 'Matricula', value: 'matricula',align: 'center'},
                { text: 'Nombre Completo', value: 'nombre_completo'},
                {text:'Ir', value:'opciones',align: 'center',sortable:false},
            ],
            headersProfesor:[
                { text: 'Nombre Completo', value: 'nombre',align: 'start' },
                { text: 'Correo', value: 'email' }
                // {with:10},           
                ],
            numeroDeProfesoresModificar:0,
            numeroDeAyudantesModificar:0,
            contadorProfesores:1,
            InstanciaModificar:'',
            
            //varaibles para añadir instancias de cursos a un semestre
            numeroDeCursosModificar:0,
            numProfesor:0,
            contadorCursos:1,
            contadorAyudante:1,
            //Variables y reglas de formulario
            form_AsignarCurso:true,
            form_modificarInsCurso:true,
            formularioCrearCursoValido:true,
            reglasSeccion: [
                value => !!value || 'Requerido'
                ],
            reglasProfesor: [
                value => !!value || 'Requerido'
                ],
            //Texto
            ModificacionExitosa:'Las Modificaciones se realizaron correctamente.',
            ModificacionError:'Las Modificaciones No realizaron correctamente.',
            //
            semestreValido:true,
        }
    },
    _props: {
    item: {
        id: '',semestre: '',curso: '',nomCurso: '',seccion:'', anio:''
    }
    },
    get props() {
        return this._props
    },
    set props(value) {
        this._props=value
    },
    beforeMount(){
        this.cargando=true;
        this.obtenerProfesores();
        this.obtenerEscuelas();
        this.obtenerCursos();        
        this.obtenerInstanciasCursos();  
        this.semestre =  this.$route.params.id;
        this.obtenerProspectosAyudante();
        this.validarSemestre();
    },
    computed: {
        
    },
    methods: {
        ...mapMutations(['calcularRolVuelta']),
        validate () {
            this.$refs.form_AsignarCurso.validate()
        },
        validarSemestre(){
            if(this.$store.state.infoSemestre.deleted_at!= null){
                this.semestreValido=false;
            }else{
                 this.semestreValido=true;
            }
        },
        sumarProfesor(){
             console.log("Contador de profesores: "+this.contadorProfesores);
            console.log("Numero de profesores que puedo agregar: "+this.numeroDeProfesoresModificar);
            if(this.contadorProfesores ==1 &&  this.profesorSeleccionado!=null){
                this.contadorProfesores++;
                // console.log("Nuevo valor del contador: "+ this.contadorProfesores)
            }
            //se asigno el segundo profesor y quiere añadir otro
            if(this.contadorProfesores == 2 && this.profesorSeleccionado2!=null ){
                this.contadorProfesores++;
                // console.log("Nuevo valor del contador: "+ this.contadorProfesores)
            }
            //se asigno el tercer profesor y quiere añadir otro
            if(this.contadorProfesores == 3 && this.profesorSeleccionado3!=null){
                this.contadorProfesores++;
                // console.log("Nuevo valor del contador: "+ this.contadorProfesores)
            }
            //se asigno el cuarto profesor y quiere añadir otro
            if(this.contadorProfesores == 4 && this.profesorSeleccionado4!=null ){
                
                this.contadorProfesores++;
                // console.log("Nuevo valor del contador: "+ this.contadorProfesores)
            }
            
        },
        restarProfesor(){

            if(this.contadorProfesores== 2 ){
                this.contadorProfesores--;
                this.profesorSeleccionado2=null;
                this.profesorSeleccionado3=null;
                this.profesorSeleccionado4=null;
                this.profesorSeleccionado5=null;
          
            }
            //se asigno el tercer profesor y quiere añadir otro
            if(this.contadorProfesores == 3 ){
                this.contadorProfesores--;
                this.profesorSeleccionado3=null;
                this.profesorSeleccionado4=null;
                this.profesorSeleccionado5=null;
            }
            //se asigno el cuarto profesor y quiere añadir otro
            if(this.contadorProfesores == 4 ){
                this.contadorProfesores--;
                this.profesorSeleccionado4=null;
                this.profesorSeleccionado5=null;
            }
            if(this.contadorProfesores == 5 ){
                this.contadorProfesores--;
                this.profesorSeleccionado5=''
            }
        },
        /**
         * Permite vincular un ayudante a una instancia de curso
         */
        sumarAyudante(){
            // console.log("Contador de ayudante: "+this.contadorAyudante);
            // console.log("Numero de profesores que puedo agregar: "+this.numeroDeAyudantesModificar);
             if(this.contadorAyudante ==1 &&  this.ayudanteSeleccionado!=null){
                this.contadorAyudante++;
            }
            if(this.contadorAyudante == 2 && this.ayudanteSeleccionado2!=null){
                this.contadorAyudante++;
            }
            if(this.contadorAyudante == 3 && this.ayudanteSeleccionado3!=null){
                this.contadorAyudante++;
            }
            if(this.contadorAyudante == 4 && this.ayudanteSeleccionado4!=null){
                this.contadorAyudante++;
            }
        },
        /**
         * Permite desvincular Ayudantes de una instancia de curso.
         */
        restarAyudante(){

            if(this.contadorAyudante== 2 ){
                this.contadorAyudante--;
                this.ayudanteSeleccionado2=null;  
                this.ayudanteSeleccionado3=null;
                this.ayudanteSeleccionado4=null;
                this.ayudanteSeleccionado5=null;   
            }
            //se asigno el tercer profesor y quiere añadir otro
            if(this.contadorAyudante == 3 ){
                this.contadorAyudante--;
                this.ayudanteSeleccionado3=null;
                this.ayudanteSeleccionado4=null;
                this.ayudanteSeleccionado5=null;
            }
            //se asigno el cuarto profesor y quiere añadir otro
            if(this.contadorAyudante == 4 ){
                this.contadorAyudante--;
                this.ayudanteSeleccionado4=null;
                this.ayudanteSeleccionado5=null;
            }
            if(this.contadorAyudante == 5 ){
                this.contadorAyudante--;
                this.ayudanteSeleccionado5=null;
            }
        },
        /**
         * Permite añadir un nuevo profesor al momento de 
         * asignar cursos a una instancia de semestre.
         */
        sumarCurso(){
            // if(this.contadorCursos< this.numeroDeCursosModificar){
            //     this.contadorCursos++;
            //     console.log("VALOR DEL CONTADORE DE CURSOS: "+ this.contadorCursos)
            // }
            
           
             if(this.contadorCursos ==1 &&  this.profesorSeleccionado!=null){
                this.contadorCursos++;
                // console.log("Numero de profesores ++"+  this.profesorSeleccionado)
                // console.log("Valor del contador de cursos : "+ this.contadorCursos)
            }
            //se asigno el segundo profesor y quiere añadir otro
            if(this.contadorCursos == 2 && this.profesorSeleccionado2!=null){
                this.contadorCursos++;
                // console.log("==============================")
                // console.log("Numero de profesores ++"+  this.profesorSeleccionado2)
                // console.log("Valor del contador de cursos : "+ this.contadorCursos)
            }
            //se asigno el tercer profesor y quiere añadir otro
            if(this.contadorCursos == 3 && this.profesorSeleccionado3!=null){
                this.contadorCursos++;
                //  console.log("==============================")
                // console.log("Numero de profesores ++"+  this.profesorSeleccionado3)
                // console.log("Valor del contador de cursos : "+ this.contadorCursos)
            }
            //se asigno el cuarto profesor y quiere añadir otro
            if(this.contadorCursos == 4 && this.profesorSeleccionado4!=null){
                this.contadorCursos++;
                //  console.log("==============================")
                // console.log("Numero de profesores ++"+  this.profesorSeleccionado4)
                // console.log("Valor del contador de cursos : "+ this.contadorCursos)
            }
        },
        /**
         * Permite quitar profesores al momento de 
         * asignar cursos a una instancia de semestre.
         */
        restarCurso(){

            if(this.contadorCursos== 2 ){
                this.contadorCursos--;
                this.profesorSeleccionado2=''
                //  console.log("++++++++++++++++++++++++++++++++++++++++")
                // console.log("Numero de profesores --"+  this.profesorSeleccionado2)
                // console.log("Valor del contador de cursos : "+ this.contadorCursos)
                
            }
            //se asigno el tercer profesor y quiere añadir otro
            if(this.contadorCursos == 3 ){
                this.contadorCursos--;
                this.profesorSeleccionado3=''
            }
            //se asigno el cuarto profesor y quiere añadir otro
            if(this.contadorCursos == 4 ){
                this.contadorCursos--;
                this.profesorSeleccionado4=''
            }
            if(this.contadorCursos == 5 ){
                this.contadorCursos--;
                this.profesorSeleccionado5=''
            }
        },
 

        obtenerProfesores(){
            this.listaProfesoresAux = [];
            var aux;
            var url = this.$store.state.rutaDinamica+'api/v1/usuario/indexProfesor';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.data.usuarios.length; index++) {
                    const element = result.data.data.usuarios[index];
                    let usuario = {
                        id: element.id,
                        nombre: element.nombre,
                        correo: element.email,   
                        escuela: element.nombre_escuela,
                    };                         
                    this.listaProfesoresAux[index]=usuario;
                }
                this.listaProfesores = this.listaProfesoresAux;
            }
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 101){
                            // console.log(error.response.data.code +' '+ error.response.data.message);
                            // console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }                        
                    }
                }
            });
        },

        obtenerEscuelas(){
            this.listaEscuelaAux = [];
            var url = this.$store.state.rutaDinamica+'api/v1/escuela';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for (let index = 0; index < result.data.data.escuelas.length; index++) {
                const element = result.data.data.escuelas[index];
                let escuela = {
                    idEscuela: element.id,
                    nomEscuela: element.nombre,
                };
                // console.log(escuela);
                this.listaEscuelaAux[index]=escuela;
                }
                this.listaEscuela = this.listaEscuelaAux;
            }
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 101){
                            // console.log(error.response.data.code +' '+ error.response.data.message);
                            // console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }                        
                    }
                }
            });
        },

        //Metodo para obtener los datos del semestre al cual ingresamos.
        obtenerDatosSemestre(){
            var aux;
            var url = this.$store.state.rutaDinamica+`api/v1/semestre/${this.$route.params.id}`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                // console.log("obtener semestres")        
                // console.log(result.data.data);
                for (let index = 0; index < result.data.data.semestres.length; index++) {
                    const element = result.data.data.semestres[index];
                    let semestre = {
                        id: element.id,
                        semestre: element.semestre,
                        anio: element.anio,
                    };                    
                    
                    this.listaSemestresAux[index]=semestre;
                }
                this.listaSemestres = this.listaSemestresAux;
                // console.log(this.listaSemestres)
            }
            ).catch((error)=>{
                // console.log(error.response)
            });
        },

        //Metodo para obtener Todos los Cursos existentes.
        obtenerCursos(){
            this.listaCursosAux = [];
            var aux;
            var url = this.$store.state.rutaDinamica+`api/v1/curso`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for( let index=0; index < result.data.data.cursos.length; index++){
                    const element = result.data.data.cursos[index];
                    // console.log(element.get_escuela.id)
                    let curso = {
                        id: element.id,
                        nombre: element.nombre,
                        plan: element.plan,
                        descripcion: element.descripcion,
                        nomEscuela: element.escuela,
                        idEscuela :element.get_escuela.id
                    };
                    this.listaCursosAux[index]=curso;
                }
                this.listaCursos = this.listaCursosAux;                    
            }
            ).catch((error)=>{ 
                // console.log(error.response)
            });
        },


        //Metodo para obtener Todas las Instancias de Curso asociadas al Semestre actual.
        obtenerInstanciasCursos(){
            this.cargando=true;
            this.listaInsCursosAux = [];
            this.listaInsCursos=[];
            var aux;            
            var url = this.$store.state.rutaDinamica+`api/v1/instanciaCurso/${this.$store.infoSemestre.id}`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{   
                // console.log(result)
                for (let index = 0; index < result.data.data.insCursos.length; index++) {
                    const element = result.data.data.insCursos[index];  
                    //  console.log(result.data.data.insCursos[index])
                    let insCurso = {
                        id: element.id,
                        semestre: element.semestre,
                        nomCurso: element.curso,
                        seccion:element.seccion,
                        listaProfesores:element.listaProfesores,
                        listaAyudantes:element.listaAyudantes,
                    }; 
                    this.listaInsCursosAux[index]=insCurso;                                                         
                }
                this.listaInsCursos = this.listaInsCursosAux; 
                this.cargando = false;              
            }
            ).catch((error)=>{
                this.cargando = false;
                // console.log(error.response)
            });
        },
        mostrarAyudantesDeCurso(item){
             this.AyudanteDeInstanciaCurso=item
            this.dialogAyudantesInsCurso=true;
        },
        resetAyudantesDeInstanciaCurso(){
             this.dialogAyudantesInsCurso=false;
        },
        /**
         * Obtiene una lista con todos los posibles ayudantes registrados en el sistemas, 
         * con el filtro que el posoble ayudante tiene que pertenecer a la misma escuela que
         * el del curso.
         */
        obtenerProspectosAyudante(){
             this.listaProspectosAyudante = [];
             this.listaProspectosAyudanteAux = [];
            var aux;
            var url = this.$store.state.rutaDinamica+`api/v1/estudiante/estudiantesAyudantes `;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                
                for( let index=0; index < result.data.data.estudiantes.length; index++){
                    const element = result.data.data.estudiantes[index];
                    let ayudante = {
                        id: element.id,
                        nombre: element.nombre_completo,
                        matricula: element.matricula,
                    };
                    this.listaProspectosAyudanteAux[index]=ayudante;
                }
                this.listaProspectosAyudante = this.listaProspectosAyudanteAux;   
              
            }
            ).catch((error)=>{ 
                // console.log(error.response)
            });
        },

        opcionesAlAsignarAyudante(ayudantePrincipal,ayudanteAux,idAyudanteConCurso,idInstaciaCurso,num){
            //   console.log("==================="+num+"==================")
            //     console.log(ayudantePrincipal)
            //     console.log(ayudanteAux)
            //     console.log(idInstaciaCurso)
            //     console.log(idAyudanteConCurso)
            //     console.log("===========================================")
            //     console.log()
            if( ayudanteAux!= null && idAyudanteConCurso!= null && ayudantePrincipal!=null &&ayudanteAux!=ayudantePrincipal){
                if(idAyudanteConCurso!=''){
                    // console.log("Cambiamos al profesor principal por uno nuevo.")
                    this.desvincularAyudanteInstanciaCurso(idAyudanteConCurso);
                }
                if(ayudantePrincipal!='' && idInstaciaCurso!=''){
                    let post = {
                    "estudiante" :  ayudantePrincipal,
                    "curso":  idInstaciaCurso,
                };
                this.asignartAyudante(post);
                }
            }
            // Eliminar profesor de una instancia de curso
            if(ayudanteAux!= null && idAyudanteConCurso!=null && ayudantePrincipal==null ){
                if(idAyudanteConCurso!=''){
                    this.desvincularAyudanteInstanciaCurso(idAyudanteConCurso);
                }
            }
            // Agregar profesor a instancia de curso
            if(ayudanteAux==null && idAyudanteConCurso==null && ayudantePrincipal!=null ){
                if(ayudantePrincipal!=''){
                   let post = {
                    "estudiante" : ayudantePrincipal,
                    "curso":  idInstaciaCurso,
                };
                this.asignartAyudante(post);
                }
            }
        },
        //agregaremos al ayudante a la instancia del curso
        asignarAyudanteInstanciaCurso(){
            var idInstancia= this.datosInsCurso.id;
            this.opcionesAlAsignarAyudante(this.ayudanteSeleccionado,this.ayudanteSeleccionadoAux,this.idAyudanteConCurso,idInstancia,1)
            this.opcionesAlAsignarAyudante(this.ayudanteSeleccionado2,this.ayudanteSeleccionadoAux2,this.idAyudanteConCurso2,idInstancia,2)
            this.opcionesAlAsignarAyudante(this.ayudanteSeleccionado3,this.ayudanteSeleccionadoAux3,this.idAyudanteConCurso3,idInstancia,3)
            this.opcionesAlAsignarAyudante(this.ayudanteSeleccionado4,this.ayudanteSeleccionadoAux4,this.idAyudanteConCurso4,idInstancia,4)
            this.opcionesAlAsignarAyudante(this.ayudanteSeleccionado5,this.ayudanteSeleccionadoAux5,this.idAyudanteConCurso5,idInstancia,5)
            this.obtenerInstanciasCursos();
            this.CerrarDialogAsignarAyudante();
            
        },
        asignartAyudante(post){
            var url = this.$store.state.rutaDinamica+'api/v1/ayudanteCurso'; 
            /* crear profesor con curso */
            // console.log(post)
            if(post.estudiante!='' && post.curso!=''){
                axios.post(url, post, this.$store.state.config)
            .then((result) => {
                // console.log(result)
                this.textoAlertas = "Se asignó el ayudante correctamente"
                this.alertaExito=true;
                this.obtenerInstanciasCursos();
                
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    // console.log(error)  
                    this.alertaError = true;
                    this.textoAlertas = "Error al asignar el profesor intente mas tarde."
                    this.resetAsignarCurso();
                }
                // if(error.response.data.code == 301){
                //     console.log(error.response.data.code +' '+ error.response.data.message);
                //     console.log(error.response.data);
                //     this.alertaError = true;      
                //     this.textoAlertas = error.response.data.message;
                // }    
                if(error.response.data.code == 302){
                    // console.log(error.response.data.code +' '+ error.response.data.message);
                    // console.log(error.response.data);
                    this.alertaError = true;      
                    this.textoAlertas = error.response.data.message;
                }                    
            });
            }
            
        },
        CerrarDialogAsignarAyudante(){
            this.dialogAsignarAyudante=false;
            this.resetAsignarAyudante()
            
        },
        resetAsignarAyudante(){
            this.datosInsCurso='';
             // Reseteamos las variables.
            this.ayudanteSeleccionado = null;
            this.ayudanteSeleccionado2=null;
            this.ayudanteSeleccionado3=null;
            this.ayudanteSeleccionado4=null;
            this.ayudanteSeleccionado5=null;

            this.ayudanteSeleccionadoAux=null;
            this.ayudanteSeleccionadoAux2=null;
            this.ayudanteSeleccionadoAux3=null;
            this.ayudanteSeleccionadoAux4=null;
            this.ayudanteSeleccionadoAux5=null;
            this.idAyudanteConCurso = null;
            this.idAyudanteConCurso2 = null;
            this.idAyudanteConCurso3= null;
            this.idAyudanteConCurso4 = null;
            this.idAyudanteConCurso5 = null;

            this.contadorAyudante=0;
            this.$refs.formAsignarAyudante.reset()
            
        },
        mostrarProfesoresDeCurso(item){
            this.dialogProfesoresInsCurso = true;
            this.profesoresDeInstanciaCurso=item
        },  
        /**
         * Desvincula un profesor de una instancia de curso
         */
        desvincularProfesorInstanciaCurso(item, listaDeProfesores){
            if(listaDeProfesores.length>1){
                var url = this.$store.state.rutaDinamica+ 'api/v1/profesorConCurso/'+item.idProfesorConCurso;
                axios.delete(url,this.$store.state.config)
                .then((result)=>{
                if (result.statusText=='OK') {
                    this.alertaExito = true;
                    this.textoAlertas = "Se desvinculo el el profesor con exito "
                    this.obtenerInstanciasCursos();
                    this.dialogProfesoresInsCurso=false;
                }
                }).catch((error)=>{
                    if (error.message == 'Network Error') {
                        this.alertaError = true;
                        this.textoAlertas = "Error al eliminar el usuario, intente mas tarde."
                    }
                    if(error.response.data.code == 701){
                                this.textoAlertas = 'No existe la relacion entre el profesor y el curso';
                                this.alertaError = true;
                    }
                    if(error.response.data.code == 702){
                                this.textoAlertas = 'Error en la base de datos.';
                                this.alertaError = true;
                    }               
                });
            }else{
                this.textoAlertas = 'El curso debe tener a lo menos un curso.';
                this.alertaError = true;
            }
        }, 
        resetProfesoresDeInstanciaCurso(){
            this.dialogProfesoresInsCurso = false;
        },     
        
        crearCurso(){ 
            var valido=this.$refs.formCrearCurso.validate();
            console.log("llege aca : "+valido )
            if(valido == true){
                var nombre=this.datosCurso.nombre; 
                var plan = this.datosCurso.plan;
                var escuela = this.datosCurso.idEscuela

                if(nombre!='' && plan!='' && escuela!=''){
                    let post = {
                    "nombre": nombre,
                    "plan": plan,
                    "escuela": escuela,
                    "descripcion": 'sin descripcion',
                    }
                    var url = this.$store.state.rutaDinamica+'api/v1/curso';
                    axios.post(url, post, this.$store.state.config)
                    .then((result) => {
                        // console.log(result)
                        this.alertaExito = true;
                        this.textoAlertas = "Se creó el curso con exito."
                        this.resetCrearCurso();
                        this.obtenerCursos(); 
                        this.KeyDialogCrearCurso ++; 
                    }).catch((error)=>{
                        // console.log(error);
                        if (error.message == 'Network Error') {
                            // console.log(error)
                            this.alertaError = true;
                            this.textoAlertas = "Error al crear el curso, intente mas tarde."
                            this.resetCrearCurso();
                            this.KeyDialogCrearCurso ++;
                        };                        
                    });
                }else{
                    // console.log("ERROR EN LOS DATOS INGRESADOS")
                    this.alertaError = true;
                    this.textoAlertas = "Es necesario rellenar todos los campos."
                }
            }
        },

        resetCrearCurso(){
            this.datosCurso.nombre ='';
            this.dialogCrearCurso = false;
            this.$refs.formCrearCurso.reset()
            this.KeyDialogCrearCurso ++;
        },

        setModificarCurso(item){

             this.datosCurso=item;
            this.dialogModificarCurso = true;
        },
        resetModificarCurso(){
            this.datosCurso= '';
            this.dialogModificarCurso = false;
        },
        modificarCurso(){
            var url = this.$store.state.rutaDinamica+`api/v1/curso/${this.datosCurso.id}`;
            let put ={                
                "nombre": this.datosCurso.nombre,
                "plan": this.datosCurso.plan,
                "escuela": this.datosCurso.idEscuela,
                "descripcion": ''
            };
            console.log(put)
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
                this.alertaExito = true;
                this.textoAlertas = "Se modificó el curso con exito."
                this.obtenerCursos(); 
                this.resetModificarCurso();
              
                
            }).catch((error)=>{                
                if (error.message == 'Network Error') {
                    // console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al modificar el curso, intente mas tarde."
                }
                else{
                    // console.log(error.response);
                    // if(error.response.data.success == false){
                    //     if(error.response.data.code == 601){
                    //         console.log(error.response.data.code +' '+ error.response.data.message);
                    //         console.log(error.response.data);
                    //         this.textoAlertas = error.response.data.message;
                    //         this.alertaError = true;
                    //         this.resetModificarCurso();
                    //     }
                    //     if(error.response.data.code == 602){
                    //         console.log(error.response.data.code +' '+ error.response.data.message);
                    //         console.log(error.response.data);
                    //         this.textoAlertas = error.response.data.message;
                    //         this.alertaError = true;
                    //         this.resetModificarCurso();
                    //     }
                    //     if(error.response.data.code == 603){
                    //         console.log(error.response.data.code +' '+ error.response.data.message);
                    //         console.log(error.response.data);
                    //         this.textoAlertas = error.response.data.message;
                    //         this.alertaError = true;
                    //         this.resetModificarCurso();
                    //     } 
                    // }                
                }                  
            });
        },
        
        setEliminarCurso(item){
             this.datosCurso= item
             this.dialogEliminarCurso = true;
        },
        resetEliminarCurso(){
            this.datosCurso.id= '';
            this.datosCurso.nombre = '';
            this.datosCurso.plan = '';
            this.datosCurso.escuela = '';
            this.datosCurso.descripcion = '';
            this.dialogEliminarCurso = false;
        },
        eliminarCurso(){
           var url = this.$store.state.rutaDinamica+'api/v1/curso/'+this.datosCurso.id;
            axios.delete(url,this.$store.state.config)
            .then((result)=>{
                this.obtenerCursos();
                this.resetEliminarCurso(); 
                this.alertaExito = true;
                this.textoAlertas = "Se elimino el curso con exito "
            
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    // console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al eliminar el usuario, intente mas tarde."
                }
                //Mensajes de error proximamente                
            });

        },
        /**
         * Obtiene la informacion de los cursos seleccionados 
         * Y la prepara para el la asignacion de profesores a los
         * cursos seleccionados.
         * Restablecemos los valores de los profesores seleccionados.
         */
        asignarCursos(){
            if(this.seleccionados.length != 0){
                //profesores seleccionados.
                this.profesorSeleccionado = null;
                this.profesorSeleccionado2=null;
                this.profesorSeleccionado3=null;
                this.profesorSeleccionado4=null;
                this.profesorSeleccionado5=null;
                this.dialogAsignarCurso = true; 
                //this.resetSeccion();
                //this.resetProfesores();    
            }
            else{
                this.textoAlertas = "Debe seleccionar al menos un curso.";
                this.alertaError = true;
            }
        },
        /**
         * Desvincula un ayudante de una instancia curso.
         */
        desvincularAyudanteInstanciaCurso(idAyudanteConCurso){
            var url = this.$store.state.rutaDinamica+'api/v1/ayudanteCurso/'+idAyudanteConCurso;
            axios.delete(url,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.alertaExito = true;
                this.textoAlertas = "Se desvinculo el ayudante con exito "
                this.obtenerInstanciasCursos();
                this.dialogAyudantesInsCurso=false;
            }
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    // console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al eliminar el usuario, intente mas tarde."
                }
                //Mensajes de error proximamente                
            });
        },
        /**
         * Enruta hacia las observaciones de los estudiantes.
         */
        EnrutarAsiPerfilDeUsuario(item){
            // console.log("ENRURA HACIA EL USUARIO");
            // console.log(item);
             var enrutamiento = this.semestre;
            if (this.$store.state.usuario.usuario.rol == "admin") {
                this.$router.push({path:'/administrador/cursos/'+enrutamiento+'/id='+item.id});
            } else {
                if (this.$store.state.usuario.usuario.rol == "secretaria de escuela") {
                    this.$router.push({path:'/secretariaEscuela/cursos/'+enrutamiento+'/id='+item.id});
                } else {
                    // if (this.$store.state.usuario.usuario.rol == "profesor") {
                    //     this.$router.push({path:'/profesor/'+estudiantes+'/id='+item.id});
                    // }
                }
            }
        },
        /**
         * Cierra el dialog de adignar cursos a una instancia de curso.
         */
        cerrarDialogAsignarCurso(){
            this.resetFormAsignarCurso()
            this.dialogAsignarCurso = false;
            this. resetAsignarCurso();
        },
        /**
         * Restablece a los valores por defecto al formulario 
         * Asignar curso
         */
        resetFormAsignarCurso(){
            this.$refs.formAsignarCurso.reset()
        },
        /**
         * Restablece a los valores originales las varaibles usadas para
         * La asignacion de cursos a una instancia de curso.
         */
        resetAsignarCurso(){
            this.profesorSeleccionado = null;
            this.profesorSeleccionado2=null;
            this.profesorSeleccionado3=null;
            this.profesorSeleccionado4=null;
            this.profesorSeleccionado5=null;
            this.seleccionados = [];

        },
        /**
         * Crea la instancia de un curso y lo asocia a lo 
         * mas con 5 profesores previamente registrados.
         */
        crearInstanciaCurso(){
            /**variables para el correcto funcionamiento de la consulta. */
            let ins_curso=0;
            let profe_Selec="";
            var profesor1=this.profesorSeleccionado;
            var profesor2=this.profesorSeleccionado2;
            var profesor3=this.profesorSeleccionado3;
            var profesor4=this.profesorSeleccionado4;
            var profesor5=this.profesorSeleccionado5;

            this.dialogAsignarCurso = true
            if( this.seleccionados!=null ){
                for(let i = 0; i < this.seleccionados.length ; i++){
                    /* datos instancia curso */
                    let post = {
                        "semestre":this.$store.infoSemestre.id,
                        "curso": this.seleccionados[i].id,
                        "seccion":  this.seleccionados[i].seccion,
                    }
                    var url = this.$store.state.rutaDinamica+'api/v1/instanciaCurso';   
                    axios.post(url, post, this.$store.state.config)
                    .then((result) => {
                        ins_curso= result.data.data.insCurso.id;
                            if(ins_curso != 0){
                            if(profesor1 != null){
                                let post2 = {
                                    "profesor" : profesor1,
                                    "curso":  ins_curso,
                                    };
                                this.agregarProfesorCurso(post2)
                            }
                            if(profesor2 != null){
                                let post2 = {
                                    "profesor" :  profesor2,
                                    "curso":  ins_curso,
                                    };
                                this.agregarProfesorCurso(post2)
                                }
                            if(profesor3 != null){
                                let post2 = {
                                    "profesor" :  profesor3,
                                    "curso":  ins_curso,
                                    };
                                
                                this.agregarProfesorCurso(post2)
                            }
                            if(profesor4 != null){
                                let post2 = {
                                    "profesor" :  profesor4,
                                    "curso":  ins_curso,
                                    };
                                this.agregarProfesorCurso(post2)
                            }
                            if(profesor5 != null){
                                let post2 = {
                                    "profesor" :  profesor5,
                                    "curso":  ins_curso,
                                    };
                                
                                this.agregarProfesorCurso(post2)
                            }
                        }
    
                        }).catch((error)=>{
                            // console.log( error.response.data);
                            if (error.message == 'Network Error') {
                                this.alertaError = true;
                                this.textoAlertas = "Error al asignar el curso, intente mas tarde."
                                this.cerrarDialogAsignarCurso(); 
                            }
                            if(error.response.data.code == 301){
                                this.alertaError = true;      
                                this.textoAlertas = error.response.data.message;
                                this.cerrarDialogAsignarCurso(); 
                            } 
                            if(error.response.data.code == 302){
                                this.textoAlertas = error.response.data.message;
                                this.alertaError = true;  
                                 this.cerrarDialogAsignarCurso(); 
                            }   
                        });                                                            
                    } 
                    // Reseteamos las variables.
                    this.cerrarDialogAsignarCurso();
                    // obtenemos la lista de instancias de cursos con sus modificaciones
            }
            
        },
        /**
         * Abre el dialog para la la creación de una una instancia de curso.
         */
        asignarCursoASementre(){
            var esValido = this.$refs.formAsignarCurso.validate()
            if(esValido == true){
                // Primero creamos la instancia donde asociaremos los profesores
                //guardamos el id de la nueva instancia del curso creada
                this.crearInstanciaCurso();
            }
        },
        /**
         * Se asocia un profesor a un profesor con una instancia previamente
         * creada
         */
        agregarProfesorCurso(post2){
            var url2 = this.$store.state.rutaDinamica+'api/v1/profesorConCurso'; 
            /* crear profesor con curso */
            if(post2.curso!='' && post2.profesor!=''){
                axios.post(url2, post2, this.$store.state.config)
            .then((result) => {
                this.textoAlertas = "Se asignó el profesor correctamente"
                this.alertaExito=true;
                
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)  
                    this.alertaError = true;
                    this.textoAlertas = "Error al asignar el profesor intente mas tarde."
                    this.resetAsignarCurso();
                }
                if(error.response.data.code == 301){

                    this.alertaError = true;      
                    this.textoAlertas = error.response.data.message;
                }    
                if(error.response.data.code == 302){
                    this.alertaError = true;      
                    this.textoAlertas = error.response.data.message;
                }                    
            });
            }
            // console.log("OBTENIENDO LAS NUEVAS INSTANCIAS")
            this.obtenerInstanciasCursos(); 
        },
        /**
         * Cierra el dialog de modificar instancia curso.
         */
        cerrarDialogModificarInstanciaCurso(){
            this.dialogModificarInsCurso = false;
            this.resetModificarInstanciaCurso();

        },
        /**
         * Restablece las variables que se usan para modificar a
         * una instancia de curso a sus valores originales.
         */
        resetModificarInstanciaCurso(){
            this.InstanciaModificar= '';
            this.profesorSeleccionado = null;
            this.profesorSeleccionado2=null;
            this.profesorSeleccionado3=null;
            this.profesorSeleccionado4=null;
            this.profesorSeleccionado5=null;
            this.ayudanteSeleccionadoAux=null;
            this.ayudanteSeleccionadoAux2=null;
            this.ayudanteSeleccionadoAux3=null;
            this.ayudanteSeleccionadoAux4=null;
            this.ayudanteSeleccionadoAux5=null;
            this.profesorConCurso=null;
            this.profesorConCurso1=null;
            this.profesorConCurso2=null;
            this.profesorConCurso3=null;
            this.profesorConCurso4=null;
            this.profesorConCurso5=null;
            this.contadorProfesores=1;
            this.numeroDeProfesoresModificar=0;

            
            // this.obtenerInstanciasCursos();
        },
        DesvincularUnProfesorInsCurso(id){
            var url = this.$store.state.rutaDinamica+'api/v1/profesorConCurso/'+id;
             console.log(url)
                axios.delete(url,this.$store.state.config)
                .then((result)=>{
                if (result.statusText=='OK') {
                    this.alertaExito = true;
                    this.textoAlertas = "Se desvinculo el el profesor con exito "
                    
                    this.obtenerInstanciasCursos();
                    this.dialogProfesoresInsCurso=false;
                }
                }).catch((error)=>{
                    if (error.message == 'Network Error') {
                        this.alertaError = true;
                        this.textoAlertas = "Error al eliminar el usuario, intente mas tarde."
                    }
                    if(error.response.data.code == 701){
                                this.textoAlertas = 'No existe la relacion entre el profesor y el curso';
                                this.alertaError = true;
                    }
                    if(error.response.data.code == 702){
                                this.textoAlertas = 'Error en la base de datos.';
                                this.alertaError = true;
                    }               
                });
        },
        modificarProfesores(profesorPrincipal, ProfesorAux,idProfesorConCurso,insCurso,num){
            // console.log("==================="+num+"==================")
            // console.log(profesorPrincipal)
            // console.log(ProfesorAux)
            // console.log(insCurso)
            // console.log(idProfesorConCurso)
            // console.log("===========================================")
            // console.log()
            if( ProfesorAux!= null && idProfesorConCurso!= null && profesorPrincipal!=null &&ProfesorAux!=profesorPrincipal){
                if(idProfesorConCurso!=''){
                    // console.log("Cambiamos al profesor principal por uno nuevo.")
                    this.DesvincularUnProfesorInsCurso(idProfesorConCurso);
                }
                if(profesorPrincipal!='' && insCurso!=''){
                    let post2 = {
                        "profesor" :  profesorPrincipal,
                        "curso":  insCurso,
                    };
                    // console.log(post2)
                    this.agregarProfesorCurso(post2)
                }
            }
            // Eliminar profesor de una instancia de curso
            if(ProfesorAux!= null && idProfesorConCurso!=null && profesorPrincipal==null ){
                if(idProfesorConCurso!=''){
                    // console.log("Eliminar profesor pricipal")
                    // console.log(profesorPrincipal)
                    this.DesvincularUnProfesorInsCurso( idProfesorConCurso);
                }
            }
            // Agregar profesor a instancia de curso
            if(ProfesorAux==null && idProfesorConCurso==null && profesorPrincipal!=null ){
                if(profesorPrincipal!=''){
                    // console.log("añadimos un nuevo profesor")
                    let post2 = {
                    "profesor" :  profesorPrincipal,
                    "curso":  insCurso,
                    };
                    // console.log(post2)
                    this.agregarProfesorCurso(post2)
                }
            }
            // if(this.profesorSeleccionadoAux == this.profesorSeleccionado ){
            //     console.log("SON IGUALES, por tanto no se hace nada")
            // }
        },
        modificarInstanciaCurso(){
            var url =this.$store.state.rutaDinamica+`api/v1/instanciaCurso/${this.InstanciaModificar.id}`;
            let put ={                
                "seccion": this.InstanciaModificar.seccion,
            };
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
                var ins_curso=this.InstanciaModificar.id;
                this.modificarProfesores(this.profesorSeleccionado,this.profesorSeleccionadoAux,this.profesorConCurso,ins_curso,1)
                this.modificarProfesores(this.profesorSeleccionado2,this.profesorSeleccionadoAux2,this.profesorConCurso2,ins_curso,2)
                this.modificarProfesores(this.profesorSeleccionado3,this.profesorSeleccionadoAux3,this.profesorConCurso3,ins_curso,3)
                this.modificarProfesores(this.profesorSeleccionado4,this.profesorSeleccionadoAux4,this.profesorConCurso4,ins_curso,4)
                this.modificarProfesores(this.profesorSeleccionado5,this.profesorSeleccionadoAux5,this.profesorConCurso5,ins_curso,5)

                this.cerrarDialogModificarInstanciaCurso();
                this.alertaExito = true;
                this.textoAlertas = this.ModificacionExitosa;
                this.obtenerInstanciasCursos(); 
                this.resetModificarInstanciaCurso();
                
           }).catch((error)=>{                
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.textoAlertas = "Error al modificar el curso, intente mas tarde."
                    this.obtenerInstanciasCursos(); 
                    this.cerrarDialogModificarInstanciaCurso();
                }
                else{
                    if(error.response.data.success == false){
                        if(error.response.data.code == 301){
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.obtenerInstanciasCursos(); 
                            this.cerrarDialogModificarInstanciaCurso();
                        }
                        if(error.response.data.code == 602){
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.obtenerInstanciasCursos(); 
                            this.cerrarDialogModificarInstanciaCurso();
                        }
                        if(error.response.data.code == 603){
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                           this.obtenerInstanciasCursos(); 
                            this.cerrarDialogModificarInstanciaCurso();
                        }
                        if(error.response.data.code == 409){
                            console.log("hola")
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.obtenerInstanciasCursos(); 
                            this.cerrarDialogModificarInstanciaCurso();
                        }
                    }
                    // else{
                    //         this.textoAlertas = "Error en los datos ingresados";
                    //         this.alertaError = true;
                    //         this.obtenerInstanciasCursos(); 
                    //         this.cerrarDialogModificarInstanciaCurso();
                    //     }          
                }                  
            });
        },

        setEliminarInstanciaCurso(item){
            this.datosInsCurso.id = item.id;
            this.datosInsCurso.semestre = item.semestre;
            this.datosInsCurso.curso = item.curso;
            this.datosInsCurso.nomCurso = item.nomCurso;            
            this.dialogEliminarInsCurso = true;
        },
        cerrarDialogCerrarInstanciaCurso(){
            this.dialogEliminarInsCurso = false;
            this.resetEliminarInstanciaCurso();
        },
        /**
         * Resetea las vartiables usadas para la eliminacion de un curso.
         */
        resetEliminarInstanciaCurso(){
            this.datosInsCurso = '';
        },
        /**
         * Deshabilita una instancia de curso en la base de datos.
         */
        eliminarInstanciaCurso(){
            var url = this.$store.state.rutaDinamica+'api/v1/instanciaCurso/'+this.datosInsCurso.id;
            axios.delete(url,this.$store.state.config)
            .then((result)=>{
                this.obtenerInstanciasCursos();
                this.cerrarDialogCerrarInstanciaCurso(); 
                this.alertaExito = true;
                this.textoAlertas = "Se elimino el curso con exito "
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.textoAlertas = "Error al eliminar el usuario, intente mas tarde."
                    this.cerrarDialogCerrarInstanciaCurso(); 
                }
                if(error.response.data.code == 701){
                    this.alertaError = true;      
                    this.textoAlertas = 'El curso que desea cerrar no esta registrado en la base de datos';
                }                
            });
        },
        /**
         * Procesa la lista de acciones que puede tener un semestre
         */
        acionesSobreInstanciaCurso(item,curso){
            if(item =='Modificar curso'){
                this.InstanciaModificar = curso;
                var numeroMaxProfesores=5;
                numeroMaxProfesores= numeroMaxProfesores - curso.listaProfesores.length
                this.numeroDeProfesoresModificar=numeroMaxProfesores;
                this.contadorProfesores =curso.listaProfesores.length ;
                this.dialogModificarInsCurso = true;
                var listaProfesores=curso.listaProfesores

                 for( let index=0; index < curso.listaProfesores.length; index++){
                     if(index == 0){
                         this.profesorSeleccionado= curso.listaProfesores[0].id;
                         this.profesorSeleccionadoAux=curso.listaProfesores[0].id;
                         this.profesorConCurso =curso.listaProfesores[0].idProfesorConCurso                       
                     }
                     if(index == 1){
                         this.profesorSeleccionado2= curso.listaProfesores[1].id;
                         this.profesorSeleccionadoAux2=curso.listaProfesores[1].id;
                         this.profesorConCurso2 =curso.listaProfesores[1].idProfesorConCurso                       
                     }
                     if(index == 2){
                        this.profesorSeleccionado3= curso.listaProfesores[2].id;
                        this.profesorSeleccionadoAux3 =curso.listaProfesores[2].id;
                        this.profesorConCurso3 =curso.listaProfesores[2].idProfesorConCurso
                     }
                     if(index == 3){
                         this.profesorSeleccionado4= curso.listaProfesores[3].id;
                         this.profesorSeleccionadoAux4 = curso.listaProfesores[3].id;
                         this.profesorConCurso4 =curso.listaProfesores[3].idProfesorConCurso
                     }
                     if(index == 4){
                         this.profesorSeleccionado5= curso.listaProfesores[4].id;
                         this.profesorSeleccionadoAux5=curso.listaProfesores[4].id;
                         this.profesorConCurso5 =curso.listaProfesores[4].idProfesorConCurso
                     }
                 }
            }
            if(item=='Eliminar curso'){
                this.datosInsCurso= curso;
                this.dialogEliminarInsCurso=true
                // console.log("INFO SEMESTRE")
                // console.log(this.$store.state.infoSemestre.deleted_at)
            }
            if(item=='Modificar ayudante'){
                this.datosInsCurso= curso;
                this.dialogAsignarAyudante=true;
                var numeroMaxAyudantes=5;
                numeroMaxAyudantes= numeroMaxAyudantes - curso.listaAyudantes.length
                this.numeroDeAyudantesModificar=numeroMaxAyudantes;
                this.contadorAyudante = curso.listaAyudantes.length
                //Para el caso en que la instancia de curso no tenga ayudantes asignados.
                if(this.contadorAyudante ==0){
                    this.contadorAyudante=1;
                }
                // console.log( this.datosInsCurso)
                var listaAyudantes=curso.listaAyudantes
                 for( let index=0; index < curso.listaAyudantes.length; index++){
                     if(index == 0){
                         this.ayudanteSeleccionado= curso.listaAyudantes[0].id;
                         this.ayudanteSeleccionadoAux=curso.listaAyudantes[0].id;
                         this.idAyudanteConCurso=curso.listaAyudantes[0].idAyudanteConCurso;
                     }
                     if(index == 1){
                         this.ayudanteSeleccionado2= curso.listaAyudantes[1].id;
                         this.ayudanteSeleccionadoAux2=curso.listaAyudantes[1].id;
                         this.idAyudanteConCurso2=curso.listaAyudantes[1].idAyudanteConCurso;
                     }
                     if(index == 2){
                         this.ayudanteSeleccionado3= curso.listaAyudantes[2].id;
                         this.ayudanteSeleccionadoAux3 =curso.listaAyudantes[2].id;
                         this.idAyudanteConCurso3=curso.listaAyudantes[2].idAyudanteConCurso;
                     }
                     if(index == 3){
                         this.ayudanteSeleccionado4= curso.listaAyudantes[3].id;
                         this. ayudanteSeleccionadoAux4 = curso.listaAyudantes[3].id;
                         this.idAyudanteConCurso4=curso.listaAyudantes[3].idAyudanteConCurso;
                     }
                     if(index == 4){
                         this.ayudanteSeleccionado5= curso.listaAyudantes[4].id;
                         this.ayudanteSeleccionadoAux5=curso.listaAyudantes[4].id;
                         this.idAyudanteConCurso5=curso.listaAyudantes[4].idAyudanteConCurso;
                     }
                 }

            }

            
        },  
        /**
         * Abre el dialog para crear un nuevo curso,
         *  sin antes resetear las variables que usara para esta tarea.
         *  */ 
        crearNuevoCurso(){
            this.resetEliminarCurso();
            this.dialogCrearCurso=true;
        }     
    }
}
</script>

<style scoped>
    a {       
        text-decoration-line: none;
        color: black;
}

a:hover {
  text-decoration: underline  ;
}
</style>