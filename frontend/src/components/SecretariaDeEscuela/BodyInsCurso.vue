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

            <v-data-iterator :items="listaInsCursos" :search="search" :sort-by="sortBy.toLowerCase()" class="px-2 py-2" :loading="cargando">
                <template v-slot:default="props">
                    <v-row>
                        <v-col v-for="item in props.items" :key="item.nomCurso" cols="12"  sm="6" md="4" lg="4">
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
                                                <v-list >
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
                                                <p class="mt-0 mb-0  text-truncate font-weight-black  "  style=" font-size: 115%;" > Sección: {{ item.seccion}} </p>
                                            </v-card-text>
                                        </v-col>
                                        <v-col cols="6"  class=" pt-0 pl-3  pr-1 pb-0 " >
                                            <div style="text-align:left;">
                                            <v-btn   outlined x-small  @click="mostrarProfesoresDeCurso(item)">
                                                    Profesor/es
                                                </v-btn>
                                            </div>
                                        </v-col>
                                        <v-col cols="6"  class=" pt-0 pl-3 pr-3 pb-0 " >
                                            <div style="text-align:right;">
                                            <v-btn   outlined x-small  @click="mostrarAyudantesDeCurso(item)">
                                                    Ayudante/s 
                                                </v-btn>
                                            </div>
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
                                :search="buscarCursos" :loading="cargando" :items-per-page="10"  class="ml-5">            
                                <template v-slot:item.opciones="{ item }">
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
                        <v-form  ref="form" >
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
                                v-model="datosCurso.escuela"
                                label="Escuela"
                                :items="listaEscuela"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!datosCurso.escuela ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                            ></v-select>
                            <!-- <v-text-field
                                v-model="datosCurso.descripcion"
                                label="Descripcion"
                                :rules="[() => !!datosCurso.descripcion ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-account"
                            ></v-text-field> -->
                            
                            <div class="pb-1" style="text-align:right;">
                                <v-btn rounded color="warning" @click="resetCrearCurso()">
                                    <h4 class="white--text">Cancelar</h4>
                                </v-btn>
                                <v-btn rounded color="secondary" class="ml-2" @click="crearCurso()" >
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
                        <v-select  v-model="datosCurso.escuela"
                            :items="listaEscuela"
                            item-text="nombre"
                            item-value="id"
                            label="Escuela"
                            outlined
                            :small-chips="$vuetify.breakpoint.smAndDown ? true : false"
                            :rules="[() => !!datosCurso.escuela ||'Requerido']"
                            prepend-inner-icon="mdi-school"
                        ></v-select>
                        <!-- <v-text-field v-model="datosCurso.descripcion" label="Descripcion del Curso" outlined
                            color="secondary"
                            :rules="[() => !!datosCurso.descripcion ||'Requerido']"
                            prepend-inner-icon="mdi-account"
                        ></v-text-field> -->
                        
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
                    
                    <v-select  v-model="InstanciaModificar.seccion"
                        :items="listaDeSeccionesDisponibles"
                        item-text="nombre"
                        item-value="id"
                        label="Seccion"
                        outlined
                        :small-chips="$vuetify.breakpoint.smAndDown ? true : false"
                        :rules="[() => !!InstanciaModificar.seccion ||'Requerido']"
                        prepend-inner-icon="mdi-school"
                    ></v-select>
                     <v-divider></v-divider>
                        <strong  v-if="numeroDeProfesoresModificar>0"><h3 class="pt-5">Eliga el profesor: </h3></strong>
                        <v-form ref="formProfesores">
                            <v-select
                                class="pt-3"
                                v-if="numeroDeProfesoresModificar>0"
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
                                v-if=" profesorSeleccionado!='' && contadorProfesores>1"
                                v-model="profesorSeleccionado2"
                                label="Profesor"
                                :items="listaProfesores"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!profesorSeleccionado2 ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                            >                               
                            </v-select>
                            <v-select
                                v-if="profesorSeleccionado2!='' && contadorProfesores>2"
                                v-model="profesorSeleccionado3"
                                label="Profesor"
                                :items="listaProfesores"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!profesorSeleccionado3 ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                            >                               
                            </v-select> 
                            <v-select
                                v-if="profesorSeleccionado3!='' && contadorProfesores>3"
                                v-model="profesorSeleccionado4"
                                label="Profesor"
                                :items="listaProfesores"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!profesorSeleccionado4 ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                            >                               
                            </v-select> 
                            <v-select
                                v-if="profesorSeleccionado4!='' && contadorProfesores>4"
                                v-model="profesorSeleccionado5"
                                label="Profesor"
                                :items="listaProfesores"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!profesorSeleccionado5 ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                            >                               
                            </v-select>  
                        </v-form>  
                         <div style="text-align:left;"   v-if="numeroDeProfesoresModificar>0">
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
                        rounded color="secondary" class=" ml-2"    @click="modificarInstanciaCurso">
                            <h4 class="white--text">Modificar</h4>
                        </v-btn>
                    </div>
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
                    <v-card-title class="text-justify" style="font-size: 100%;">Esta seguro que desea eliminar el siguiente Curso?</v-card-title>
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
                                class="ml-4 mr-0 "
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
        <v-dialog v-model="dialogAsignarCurso" max-width="500">
            <v-card class="mx-auto" max-width="500" >
                <v-card-title primary-title class="headline primary text--center">
                    <h5 class="white--text">Asignar Cursos</h5>
                </v-card-title>
                <v-container class="px-5">
                        <v-form  ref="formAsignarCurso" style="margin:0;padding:0;" v-model="form_AsignarCurso" lazy-validation>
                    <v-row v-for="(item, index) in seleccionados" :key="index">

                            <v-col cols="6" v-if="index==0">
                                <strong><h3>Curso</h3></strong>
                            </v-col>
                            <v-col cols="6" v-if="index==0">
                                <strong><h3>Sección</h3></strong>
                            </v-col>
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
                                    v-if="numeroDeCursosModificar>0"
                                    v-model="profesorSeleccionado"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    :rules="[() => !!profesorSeleccionado ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-school"> 
                                </v-select> 
                                <v-select
                                    v-if=" profesorSeleccionado!='' && contadorCursos>1"
                                    v-model="profesorSeleccionado2"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    :rules="[() => !!profesorSeleccionado2 ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                >                               
                                </v-select>
                                <v-select
                                    v-if="profesorSeleccionado2!='' && contadorCursos>2"
                                    v-model="profesorSeleccionado3"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    :rules="[() => !!profesorSeleccionado3 ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                >                               
                                </v-select> 
                                <v-select
                                    v-if="profesorSeleccionado3!='' && contadorCursos>3"
                                    v-model="profesorSeleccionado4"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    :rules="[() => !!profesorSeleccionado4 ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-school"
                                >                               
                                </v-select> 
                                <v-select
                                    v-if="profesorSeleccionado4!='' && contadorCursos>4"
                                    v-model="profesorSeleccionado5"
                                    label="Profesor"
                                    :items="listaProfesores"
                                    item-text="nombre"
                                    item-value="id"
                                    :rules="[() => !!profesorSeleccionado5 ||'Requerido']"
                                    outlined
                                    prepend-inner-icon="mdi-school" >  </v-select>   
                                                        
            
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
            <v-card class="mx-auto" max-width="450"  >
                <v-card-title
                    class="headline primary text--center"
                    primary-title
                    >
                    <h5 class="white--text ">Profesores de {{ profesoresDeInstanciaCurso.nomCurso  }} </h5>
                    </v-card-title> 
                     <v-data-table
                    :headers="headersProfesor"
                    :items="profesoresDeInstanciaCurso.listaProfesores"
                    hide-default-footer  >
                        <template v-slot:item.opciones="{ item }">
                        <!-- boton para eliminar usuario seleccionado -->
                            <v-tooltip bottom color="primary">
                                <template v-slot:activator="{ on }">
                                    <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on">
                                        <v-icon color="warning" @click="desvincularProfesorInstanciaCurso(item,profesoresDeInstanciaCurso.listaProfesores)" >
                                            fas fa-trash-alt
                                        </v-icon>
                                    </v-btn>
                                </template>
                                <span><strong>Desvincular profesor del curso</strong></span>
                            </v-tooltip>  
                        </template>
                    </v-data-table>
                    <div style="text-align:right;" class="mt-3 mr-3">
                        <v-btn rounded color="secondary" class=" mb-4 "  @click="resetProfesoresDeInstanciaCurso">
                            <h4 class="white--text">Cancelar</h4>
                        </v-btn>
                    </div> 
            </v-card>
        </v-dialog>
        <!-- gialog para asignar ayudantes a una instanciaCurso -->
        <v-dialog v-model="dialogAsignarAyudante" max-width="500">
            <v-card class="mx-auto" max-width="500" >
                <v-card-title primary-title class="headline primary text--center">
                    <h5 class="white--text">Asignar ayudante a {{ datosInsCurso.nomCurso }} - {{  datosInsCurso.seccion }} </h5>
                </v-card-title>
                <v-container class="px-5">
                    <v-form>
                        
                        <strong ><h3 class="pt-5">Eliga el profesor: </h3></strong>
                        <v-form ref="formAyudantes">
                            <v-autocomplete
                                class="pt-3"
                                v-model="ayudanteSeleccionado"
                                label="Ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!ayudanteSeleccionado ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                            > 
                            </v-autocomplete> 
                            <v-autocomplete
                                v-if="ayudanteSeleccionado!=''"
                                v-model="ayudanteSeleccionado2"
                                label="Ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!ayudanteSeleccionado2 ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                            >                               
                            </v-autocomplete>
                            <v-autocomplete
                                v-if="ayudanteSeleccionado2!=''"
                                v-model="ayudanteSeleccionado3"
                                label="Ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!ayudanteSeleccionado3 ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                            >                               
                            </v-autocomplete> 
                            <v-autocomplete
                                v-if="ayudanteSeleccionado3!=''"
                                v-model="ayudanteSeleccionado4"
                                label="Ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!ayudanteSeleccionado4 ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                            >                               
                            </v-autocomplete> 
                            <v-autocomplete
                                v-if="ayudanteSeleccionado4!=''"
                                v-model="ayudanteSeleccionado5"
                                label="Ayudante"
                                :items="listaProspectosAyudante"
                                item-text="nombre"
                                item-value="id"
                                :rules="[() => !!ayudanteSeleccionado5 ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-school"
                                solo
                            >                               
                            </v-autocomplete>  
                        </v-form> 
                                                
                        <div style="text-align:right;"  class="mb-1">
                            <v-btn rounded color="warning" @click="resetAsignarAyudante()">
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
        <v-dialog v-model="dialogAyudantesInsCurso" ref="form" persistent max-width="450px">
            <v-card class="mx-auto" max-width="450"  >
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
                    <template v-slot:item.opciones="{ item }">
                        <!-- boton para eliminar usuario seleccionado -->
                            <v-tooltip bottom color="primary">
                                <template v-slot:activator="{ on }">
                                    <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on">
                                        <v-icon color="warning" @click="desvincularAyudanteInstanciaCurso(item)" >
                                            fas fa-trash-alt
                                        </v-icon>
                                    </v-btn>
                                </template>
                                <span><strong>Desvincular ayudante del curso</strong></span>
                            </v-tooltip>
                            <v-tooltip bottom color="primary">
                            <template v-slot:activator="{ on }">
                                <v-btn color="white" fab small depressed class="mr-2 py-2" v-on="on"@click="EnrutarAsiPerfilDeUsuario(item)" >
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
                    <div style="text-align:right;" class="mt-3 mr-3" >
                        <v-btn rounded color="secondary" class=" mb-4 "  @click="resetAyudantesDeInstanciaCurso">
                            <h4 class="white--text">Volver</h4>
                        </v-btn>
                       
                    </div> 
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
            profesorSeleccionado: '',
            profesorSeleccionado2: '',
            profesorSeleccionado3: '',
            profesorSeleccionado4: '',
            profesorSeleccionado5: '',
      
            colInsCursos:[
                {text:'ID', value:'id'},
                // {text:'Semestre', value:'semestre'},
                {text:'Curso', value:'nomCurso'},   
                {text:'Opciones', value:'opciones'},                
            ],
            colCursos:[
                // {text:'ID', value:'id'},
                {text:'Nombre', value:'nombre',align: 'start',width:300},
                {text:'Plan', value:'plan',align:'center'},   
                {text:'Escuela', value:'nomEscuela',align:'center'},
                // {text:'Descripcion', value:'descripcion'},
                {text:'Opciones', value:'opciones',align: 'end',},
            ],
            colCursos2:[
                {text:'Nombre', value:'nombre',align: 'start',width:250},
                {text:'Plan', value:'plan',align: 'center',width:300},   
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
            listaAccionesSobreInstaciaCurso: [ 'Modificar curso' , 'Cerrar curso' ,'Añadir ayudante' ],
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
            ayudanteSeleccionado: '',
            ayudanteSeleccionado2: '',
            ayudanteSeleccionado3: '',
            ayudanteSeleccionado4: '',
            ayudanteSeleccionado5: '',
            dialogAyudantesInsCurso:false,
            AyudanteDeInstanciaCurso:'',
            headersAyudante:[
                { text: 'Matricula', value: 'matricula',align: 'start'},
                { text: 'Nombre Completo', value: 'nombre_completo' },
                {text:'Opciones', value:'opciones'},
            ],
            headersProfesor:[
                { text: 'Nombre Completo', value: 'nombre',align: 'start' },
                {text:'Opciones', value:'opciones'},
            ],
            numeroDeProfesoresModificar:0,
            contadorProfesores:1,
            InstanciaModificar:'',
            
            //varaibles para añadir instancias de cursos a un semestre
            numeroDeCursosModificar:5,
            contadorCursos:1,
            //Variables y reglas de formulario
            form_AsignarCurso:true,
            reglasSeccion: [
                value => !!value || 'Requerido'
                ],
            reglasProfesor: [
                value => !!value || 'Requerido'
                ],
            
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
    },
    computed: {
        
    },
    methods: {
        ...mapMutations(['calcularRolVuelta']),
        validate () {
            this.$refs.form_AsignarCurso.validate()
        },
        sumarProfesor(){
            if(this.contadorProfesores < this.numeroDeProfesoresModificar){
                this.contadorProfesores++;
                console.log("VALOR DEL CONTADORE DE PROFESORES: "+ this.contadorProfesores)
            }
        },
        restarProfesor(){
            if(this.contadorProfesores >1){
                this.contadorProfesores--;
            }
        },
        sumarCurso(){
            if(this.contadorCursos< this.numeroDeCursosModificar){
                this.contadorCursos++;
                console.log("VALOR DEL CONTADORE DE CURSOS: "+ this.contadorCursos)
            }
        },
        restarCurso(){
            if(this.contadorCursos >1){
                this.contadorCursos--;
            }
        },
 

        obtenerProfesores(){
            this.listaProfesoresAux = [];
            var aux;
            var url = 'http://127.0.0.1:8000/api/v1/usuario/indexProfesor';
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
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;                            
                        }                        
                    }
                }
            });
        },

        obtenerEscuelas(){
            this.listaEscuelaAux = [];
            var url = 'http://127.0.0.1:8000/api/v1/escuela';
            axios.get(url,this.$store.state.config)
            .then((result)=>{
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
            ).catch((error)=>{
                if (error.message == 'Network Error') {
                    this.alertaError = true;
                    this.textoAlertas = "Error al cargar los datos, intente mas tarde.";
                }
                else{
                    if (error.response.data.success == false) {
                        if(error.response.data.code == 101){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
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
            var url = `http://127.0.0.1:8000/api/v1/semestre/${this.$route.params.id}`;
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
            }
            ).catch((error)=>{
                console.log(error.response)
            });
        },

        //Metodo para obtener Todos los Cursos existentes.
        obtenerCursos(){
            this.listaCursosAux = [];
            var aux;
            var url = `http://127.0.0.1:8000/api/v1/curso`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{
                for( let index=0; index < result.data.data.cursos.length; index++){
                    const element = result.data.data.cursos[index];
                    let curso = {
                        id: element.id,
                        nombre: element.nombre,
                        plan: element.plan,
                        descripcion: element.descripcion,
                        nomEscuela: element.escuela,
                    };
                    this.listaCursosAux[index]=curso;
                }
                this.listaCursos = this.listaCursosAux;                    
            }
            ).catch((error)=>{ 
                console.log(error.response)
            });
        },


        //Metodo para obtener Todas las Instancias de Curso asociadas al Semestre actual.
        obtenerInstanciasCursos(){
            this.cargando=true;
            this.listaInsCursosAux = [];
            // this.listaInsCursos=[];
            var listaBrayan=[];
            var aux;            
            var url = `http://127.0.0.1:8000/api/v1/instanciaCurso/${this.$store.infoSemestre.id}`;
            console.log(url)
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
                // console.log('INSTANCIAS DE CURSOS')
                //  console.log(this.listaInsCursos);
                this.cargando = false;              
            }
            ).catch((error)=>{
                this.cargando = false;
                console.log(error.response)
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
            var url = `http://127.0.0.1:8000/api/v1/estudiante/estudiantesAyudantes `;
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
                console.log(error.response)
            });
        },
        //agregaremos al ayudante a la instancia del curso
        asignarAyudanteInstanciaCurso(){
             console.log('INSTANCIA DE CURSO SELECCIONADA.')
             console.log(this.datosInsCurso);
            // console.log('AYUDANTE SELECCIONADO')
            // console.log(this.ayudanteSeleccionado);
            var idInstancia= this.datosInsCurso.id;
            if(idInstancia !=null && this.ayudanteSeleccionado!='' ){
                let post = {
                    "estudiante" :  this.ayudanteSeleccionado,
                    "curso":  idInstancia,
                };
                console.log('ESTUDIANTE 1')
                this.asignartAyudante(post);
            }
            if(idInstancia !=null && this.ayudanteSeleccionado2!='' ){
                let post = {
                    "estudiante" :  this.ayudanteSeleccionado2,
                    "curso":  idInstancia,
                };
                console.log('ESTUDIANTE 2')
                this.asignartAyudante(post);
            }
            if(idInstancia !=null && this.ayudanteSeleccionado3!='' ){
                let post = {
                    "estudiante" :  this.ayudanteSeleccionado3,
                    "curso":  idInstancia,
                };
                console.log('ESTUDIANTE 3')
                this.asignartAyudante(post);
            }
            if(idInstancia !=null && this.ayudanteSeleccionado4!='' ){
                let post = {
                    "estudiante" :  this.ayudanteSeleccionado4,
                    "curso":  idInstancia,
                };
                console.log('ESTUDIANTE 4')
                this.asignartAyudante(post);
            }
            if(idInstancia !=null && this.ayudanteSeleccionado5!='' ){
                let post = {
                    "estudiante" :  this.ayudanteSeleccionado5,
                    "curso":  idInstancia,
                };
                console.log('ESTUDIANTE 5')
                this.asignartAyudante(post);
            }
            this.resetAsignarAyudante();
            


        },
        asignartAyudante(post){
            var url ='http://127.0.0.1:8000/api/v1/ayudanteCurso'; 
            /* crear profesor con curso */
            console.log(post)
            axios.post(url, post, this.$store.state.config)
            .then((result) => {
                // console.log(result)
                this.textoAlertas = "Se asignó el ayudante correctamente"
                this.alertaExito=true;
                this.obtenerInstanciasCursos();
                
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)  
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
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.alertaError = true;      
                    this.textoAlertas = error.response.data.message;
                }                    
            });
            
        },
        resetAsignarAyudante(){
            this.dialogAsignarAyudante=false;
            this.datosInsCurso='';
             // Reseteamos las variables.
            this.ayudanteSeleccionado = '';
            this.ayudanteSeleccionado2='';
            this.ayudanteSeleccionado3='';
            this.ayudanteSeleccionado4='';
            this.ayudanteSeleccionado5='';
            
        },
        mostrarProfesoresDeCurso(item){
            this.dialogProfesoresInsCurso = true;
            this.profesoresDeInstanciaCurso=item
            // console.log(item);
        },  
        /**
         * Desvincula un profesor de una instancia de curso
         */
        desvincularProfesorInstanciaCurso(item, listaDeProfesores){
            if(listaDeProfesores.length>1){
                var url = 'http://127.0.0.1:8000/api/v1/profesorConCurso/'+item.idProfesorConCurso;
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
                        console.log(error)
                        this.alertaError = true;
                        this.textoAlertas = "Error al eliminar el usuario, intente mas tarde."
                    }
                    if(error.response.data.code == 701){
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
                                this.textoAlertas = 'No existe la relacion entre el profesor y el curso';
                                this.alertaError = true;
                    }
                    if(error.response.data.code == 702){
                                console.log(error.response.data.code +' '+ error.response.data.message);
                                console.log(error.response.data);
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
            var nombre=this.datosCurso.nombre; 
            var plan = this.datosCurso.plan;
            var escuela = this.datosCurso.escuela      
            if(nombre!='' && plan!='' && escuela!=''){
                let post = {
                "nombre": nombre,
                "plan": plan,
                "escuela": escuela,
                "descripcion": '',
                }
                var url = 'http://127.0.0.1:8000/api/v1/curso';
                
                axios.post(url, post, this.$store.state.config)
                .then((result) => {
                    this.alertaExito = true;
                    this.textoAlertas = "Se creó el curso con exito."
                    this.resetCrearCurso();
                    this.obtenerCursos(); 
                    this.KeyDialogCrearCurso ++; 
                }).catch((error)=>{
                    console.log(error);
                    if (error.message == 'Network Error') {
                        console.log(error)
                        this.alertaError = true;
                        this.textoAlertas = "Error al crear el curso, intente mas tarde."
                        this.resetCrearCurso();
                        this.KeyDialogCrearCurso ++;
                    };                        
                });
            }else{
                console.log("ERROR EN LOS DATOS INGRESADOS")
                this.alertaError = true;
                this.textoAlertas = "Es necesario rellenar todos los campos."

            }
        },

        resetCrearCurso(){
            this.datosCurso.nombre ="";
            this.datosCurso.plan ="";
            this.datosCurso.escuela ="";
            this.datosCurso.descripcion ="";
            this.dialogCrearCurso = false;
            this.KeyDialogCrearCurso ++;
        },

        setModificarCurso(item){
            this.datosCurso.id= item.id;
            this.datosCurso.nombre = item.nombre;
            this.datosCurso.plan = item.plan;
            this.datosCurso.escuela = item.escuela;
            // this.datosCurso.descripcion = item.descripcion;
            this.dialogModificarCurso = true;
        },
        resetModificarCurso(){
            this.datosCurso= '';
            this.dialogModificarCurso = false;
        },
        modificarCurso(){
            console.log("inicio mod curso");

            var url =`http://127.0.0.1:8000/api/v1/curso/${this.datosCurso.id}`;
            let put ={                
                "nombre": this.datosCurso.nombre,
                "plan": this.datosCurso.plan,
                "escuela": this.datosCurso.escuela,
                "descripcion": ''
            };
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
                if (result.statusText=='OK') {                
                    this.alertaExito = true;
                    this.textoAlertas = "Se modificó el curso con exito."
                    this.obtenerCursos(); 
                    this.resetModificarCurso();
                }
            }).catch((error)=>{                
                if (error.message == 'Network Error') {
                    console.log(error)
                    this.alertaError = true;
                    this.textoAlertas = "Error al modificar el curso, intente mas tarde."
                }
                else{
                    console.log(error.response);
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
            console.log("seteando curso")
            this.datosCurso.id= item.id;
            this.datosCurso.nombre = item.nombre;
            this.datosCurso.plan = item.plan;
            this.datosCurso.escuela = item.escuela;
            this.datosCurso.descripcion = item.descripcion;
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
            var url = 'http://127.0.0.1:8000/api/v1/curso/'+this.datosCurso.id;
            axios.delete(url,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.obtenerCursos();
                this.resetEliminarCurso(); 
                this.alertaExito = true;
                this.textoAlertas = "Se elimino el curso con exito "
            }
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
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
                this.profesorSeleccionado = '';
                this.profesorSeleccionado2='';
                this.profesorSeleccionado3='';
                this.profesorSeleccionado4='';
                this.profesorSeleccionado5='';
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
        desvincularAyudanteInstanciaCurso(item){
            var url = 'http://127.0.0.1:8000/api/v1/ayudanteCurso/'+item.idAyudanteConCurso;
            axios.delete(url,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.alertaExito = true;
                this.textoAlertas = "Se desvinculo el ayudantecon exito "
                this.obtenerInstanciasCursos();
                this.dialogAyudantesInsCurso=false;
            }
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
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
            this.dialogAsignarCurso = false;
            this. resetAsignarCurso();
        },
        /**
         * Restablece a los valores originales las varaibles usadas para
         * La asignacion de cursos a una instancia de curso.
         */
        resetAsignarCurso(){
            this.profesorSeleccionado = '';
            this.profesorSeleccionado2='';
            this.profesorSeleccionado3='';
            this.profesorSeleccionado4='';
            this.profesorSeleccionado5='';
            this.seleccionados = [];
            this.dialogAgregarCursoSemestre=false;
        },
        /**
         * Crea la instancia de un curso y lo asocia a lo 
         * mas con 5 profesores previamente registrados.
         */
        crearInstanciaCurso(){
            /**variables para el correcto funcionamiento de la consulta. */
            let ins_curso=0;
            let profe_Selec="";
            this.dialogAsignarCurso = true
            if( this.profesorSeleccionado!='' ){
                for(let i = 0; i < this.seleccionados.length ; i++){
                    /* datos instancia curso */
                    let post = {
                        "semestre":this.$store.infoSemestre.id,
                        "curso": this.seleccionados[i].id,
                        "seccion":  this.seleccionados[i].seccion,
                    }
                    var url = 'http://127.0.0.1:8000/api/v1/instanciaCurso';   
                    axios.post(url, post, this.$store.state.config)
                    .then((result) => {
                        ins_curso= result.data.data.insCurso.id;
                            if(ins_curso != 0){
                            if(this.profesorSeleccionado != ''){
                                let post2 = {
                                    "profesor" :  this.profesorSeleccionado,
                                    "curso":  ins_curso,
                                    };
                                this.agregarProfesorCurso(post2)
                            }
                            if(this.profesorSeleccionado2 != ''){
                                let post2 = {
                                    "profesor" :  this.profesorSeleccionado2,
                                    "curso":  ins_curso,
                                    };
                                this.agregarProfesorCurso(post2)
                                }
                            if(this.profesorSeleccionado3 != ''){
                                let post2 = {
                                    "profesor" :  this.profesorSeleccionado3,
                                    "curso":  ins_curso,
                                    };
                                
                                this.agregarProfesorCurso(post2)
                            }
                            if(this.profesorSeleccionado4 != ''){
                                let post2 = {
                                    "profesor" :  this.profesorSeleccionado4,
                                    "curso":  ins_curso,
                                    };
                                this.agregarProfesorCurso(post2)
                            }
                            if(this.profesorSeleccionado5 != ''){
                                let post2 = {
                                    "profesor" :  this.profesorSeleccionado5,
                                    "curso":  ins_curso,
                                    };
                                
                                this.agregarProfesorCurso(post2)
                            }
                            // Reseteamos las variables.
                            this.cerrarDialogAsignarCurso();
                            // obtenemos la lista de instancias de cursos con sus modificaciones
                            this.obtenerInstanciasCursos();   
                        }
                        else{
                            // console.log('NO FUNCIONO')
                            this.alertaError = true;
                            this.textoAlertas = "Error al asignar profesores al curso."
                            this.cerrarDialogAsignarCurso();                            
                            this.obtenerInstanciasCursos();
                        }
    
                        }).catch((error)=>{
                            console.log( error.response.data);
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
            }
        },
        /**
         * Abre el dialog para la la creación de una una instancia de curso.
         */
        asignarCursoASementre(){
            this.dialogAsignarCurso=true;
            // Primero creamos la instancia donde asociaremos los profesores
            //guardamos el id de la nueva instancia del curso creada
            this.crearInstanciaCurso();
        },
        /**
         * Se asocia un profesor a un profesor con una instancia previamente
         * creada
         */
        agregarProfesorCurso(post2){
            var url2 = 'http://127.0.0.1:8000/api/v1/profesorConCurso'; 
            /* crear profesor con curso */
            axios.post(url2, post2, this.$store.state.config)
            .then((result) => {
                // console.log(result)
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
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.alertaError = true;      
                    this.textoAlertas = error.response.data.message;
                }    
                if(error.response.data.code == 302){
                    console.log(error.response.data.code +' '+ error.response.data.message);
                    console.log(error.response.data);
                    this.alertaError = true;      
                    this.textoAlertas = error.response.data.message;
                }                    
            });
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
            this.profesorSeleccionado = '';
            this.profesorSeleccionado2='';
            this.profesorSeleccionado3='';
            this.profesorSeleccionado4='';
            this.profesorSeleccionado5='';
            this.contadorProfesores=1;
            this.numeroDeProfesoresModificar=0;

            
            // this.obtenerInstanciasCursos();
        },
        modificarInstanciaCurso(){
            var url =`http://127.0.0.1:8000/api/v1/instanciaCurso/${this.InstanciaModificar.id}`;
            console.log('MODIFICAR LA INFO DE CURSO')
            console.log(this.InstanciaModificar);
            let put ={                
                "seccion": this.InstanciaModificar.seccion,
            };
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
                console.log("EL NUMEOR DE PROFESORES QUE PUEDO AÑADIR A LA INS ES : "+ this.numeroDeProfesoresModificar) 
                var contProfesores=0;  
                var ins_curso=this.InstanciaModificar.id;
                 if(this.profesorSeleccionado != '' && contProfesores<this.numeroDeProfesoresModificar){
                     console.log('añadimos al profesor n 1')
                    let post2 = {
                        "profesor" :  this.profesorSeleccionado,
                        "curso":  ins_curso,
                        };
                    
                    this.agregarProfesorCurso(post2)
                    contProfesores++;
                }
                if(this.profesorSeleccionado2 != ''  && contProfesores<this.numeroDeProfesoresModificar){
                    console.log('añadimos al profesor n 2')
                    let post2 = {
                        "profesor" :  this.profesorSeleccionado2,
                        "curso":  ins_curso,
                        };
                    this.agregarProfesorCurso(post2)
                    contProfesores++;
                }
                if(this.profesorSeleccionado3 != '' && contProfesores<this.numeroDeProfesoresModificar){
                    console.log('añadimos al profesor n 3')
                    let post2 = {
                        "profesor" :  this.profesorSeleccionado3,
                        "curso":  ins_curso,
                        };
                    
                    this.agregarProfesorCurso(post2);
                    contProfesores++;
                }
                if(this.profesorSeleccionado4 != '' && contProfesores<this.numeroDeProfesoresModificar){
                    console.log('añadimos al profesor n 4')
                    let post2 = {
                        "profesor" :  this.profesorSeleccionado4,
                        "curso":  ins_curso,
                        };
                    
                    this.agregarProfesorCurso(post2)
                    contProfesores++;
                }
                if(this.profesorSeleccionado5 != '' && contProfesores<this.numeroDeProfesoresModificar){
                    console.log('añadimos al profesor n 5')
                    let post2 = {
                        "profesor" :  this.profesorSeleccionado5,
                        "curso":  ins_curso,
                        };
                    
                    this.agregarProfesorCurso(post2)
                    contProfesores++;
                }
              
              
                this.cerrarDialogModificarInstanciaCurso();
                this.alertaExito = true;
                this.textoAlertas = "Se modificó el curso con exito."
                this.obtenerInstanciasCursos(); 
                this.resetModificarInstanciaCurso();
                
           }).catch((error)=>{                
                if (error.message == 'Network Error') {
                    console.log(error);
                    this.resetModificarInstanciaCurso();
                    this.alertaError = true;
                    this.textoAlertas = "Error al modificar el curso, intente mas tarde."
                }
                else{
                    console.log(error.response);
                    if(error.response.data.success == false){
                        if(error.response.data.code == 301){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.resetModificarInstanciaCurso();
                        }
                        if(error.response.data.code == 602){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.resetModificarInstanciaCurso();
                        }
                        if(error.response.data.code == 603){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;
                            this.resetModificarInstanciaCurso();
                        }
                    }           
                }                  
            });
        },

        setEliminarInstanciaCurso(item){
            console.log("seteando curso")
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
            var url = 'http://127.0.0.1:8000/api/v1/instanciaCurso/'+this.datosInsCurso.id;
            axios.delete(url,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.obtenerInstanciasCursos();
                this.cerrarDialogCerrarInstanciaCurso(); 
                this.alertaExito = true;
                this.textoAlertas = "Se elimino el curso con exito "
            }
            }).catch((error)=>{
                if (error.message == 'Network Error') {
                    console.log(error)
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
                // console.log("Modificar Ins Curso")
                // console.log(curso)
                
                // this.datosInsCurso = curso;
                this.InstanciaModificar = curso;
                var numeroMaxProfesores=5;
                numeroMaxProfesores= numeroMaxProfesores - curso.listaProfesores.length
                this.numeroDeProfesoresModificar=numeroMaxProfesores;
                // console.log("numero de profesores que puedo añadir es: " +  numeroMaxProfesores)
                this.dialogModificarInsCurso = true;

            }
            if(item=='Cerrar curso'){
                this.datosInsCurso= curso;
                this.dialogEliminarInsCurso=true

            }
            if(item=='Añadir ayudante'){
                this.datosInsCurso= curso;
                console.log(curso)
                this.dialogAsignarAyudante=true;

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