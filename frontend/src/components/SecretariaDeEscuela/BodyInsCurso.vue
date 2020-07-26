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
                                        <v-col cols="12" class=" pt-0 pl-0 pr-0 pb-0">
                                            <v-card-title class="mt-0 pt-0 pl-0 pr-0 " >
                                                <v-img class="mx-auto white--text align-end justify-center "
                                                        width="100%" height="30px"       
                                                        src="@/assets/Globales/background-panel-08.jpg" >
                                                </v-img>
                                            </v-card-title>
                                        </v-col>
                                        <v-col cols="12" class=" pt-0 pl-0 pr-0 pb-0  text-right" >
                                            <v-menu class="text-left " offset-y>
                                                <template   v-slot:activator="{ on, attrs }">
                                                    <v-btn tile  color="primary" x-small icon v-bind="attrs" v-on="on" >
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
                                        <v-col cols="12"  class=" pt-0 pl-1 pr-0 pb-0 "  >

                                            <v-card-text class=" pt-0 pl-2 pr-0 pb-0 ">
                                                <div class=" text-truncate"  >
                                                    <p class="font-weight-black mb-2 text-truncate"   >Nombre: {{ item.nomCurso }}</p>
                                                    <p class="font-weight-black"   > Seccion: {{ item.seccion}} </p>
                                                </div>
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
                                            @click="dialogCrearCurso = true"
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
                                :search="buscarCursos" :loading="cargando" :items-per-page="10"  >            
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
                            <v-text-field
                                v-model="datosCurso.descripcion"
                                label="Descripcion"
                                :rules="[() => !!datosCurso.descripcion ||'Requerido']"
                                outlined
                                prepend-inner-icon="mdi-account"
                            ></v-text-field>
                            
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
                        <v-text-field v-model="datosCurso.descripcion" label="Descripcion del Curso" outlined
                            color="secondary"
                            :rules="[() => !!datosCurso.descripcion ||'Requerido']"
                            prepend-inner-icon="mdi-account"
                        ></v-text-field>
                        
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

        

        <!------------------>
        <v-dialog v-model="dialogModificarInsCurso" persistent max-width="500px" transition="scroll-y-reverse-transition">
            <v-card elevation="1">
                <v-card-title  class="headline primary text--center" primary-title > 
                    <h5 class="white--text ">Modificar Curso</h5>
                </v-card-title>
                <v-container class="px-5 mt-5">
                    <v-select  v-model="datosInsCurso.curso"
                        :items="listaCursos"
                        item-text="nombre"
                        item-value="id"
                        label="Curso"
                        outlined
                        :small-chips="$vuetify.breakpoint.smAndDown ? true : false"
                        :rules="[() => !!datosInsCurso.curso ||'Requerido']"
                        prepend-inner-icon="mdi-school"
                    ></v-select>
                    <v-select  v-model="datosInsCurso.seccion"
                        :items="listaDeSeccionesDisponibles"
                        item-text="nombre"
                        item-value="id"
                        label="Seccion"
                        outlined
                        :small-chips="$vuetify.breakpoint.smAndDown ? true : false"
                        :rules="[() => !!datosInsCurso.seccion ||'Requerido']"
                        prepend-inner-icon="mdi-school"
                    ></v-select>
                    
                    
                    <div style="text-align:right;" class="mb-1 " >
                        <v-btn 
                        :small="$vuetify.breakpoint.smAndDown ? true : false"
                        rounded color="warning" @click="resetModificarInstanciaCurso">  
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
                        <v-btn rounded color="warning" class=" mb-4 "  @click="resetEliminarInstanciaCurso">
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
                            <v-card 
                                class="mx-auto"                                 
                            >
                                <v-img
                                    class="mx-auto white--text align-end justify-center"
                                    width="100%"
                                    height="180px"       
                                    src="@/assets/Globales/fondo3.jpg"        
                                >
                                <v-card-title class="white--text" style="padding:0;">
                                    <v-row class="px-5">  
                                        <v-col cols="12" class="pt-1">
                                            <strong :style=" $vuetify.breakpoint.smAndDown ? 'font-size: 140%;' : 'font-size: 180%;'" style="text-shadow: #000000 3px 3px 4px;" >Cursos</strong>
                                        </v-col> 
                                        <v-col cols="7" sm="9" md="9" class="align-self-end" >
                                        <v-text-field
                                        v-model="buscarAsignarCursos"
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
        <v-dialog v-model="dialogAsignarCurso" max-width="500">
            <v-card class="mx-auto" max-width="500" >
                <v-card-title primary-title class="headline primary text--center">
                    <h5 class="white--text">Asignar Cursos</h5>
                </v-card-title>
                <v-container class="px-5">
                    <v-form>
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
                        <strong ><h3 class="pt-5">Eliga el profesor: </h3></strong>
                        <v-select
                            class="pt-3"
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
                        <div style="text-align:right;"  class="mb-1">
                            <v-btn rounded color="warning" @click="resetAsignarCurso()">
                                <h4 class="white--text">Cancelar</h4>
                            </v-btn>
                            <v-btn rounded color="secondary" class="ml-2 " @click="asignarCursoASementre()" >
                                <h4 class="white--text">Asignar</h4>
                            </v-btn>
                        </div> 
                    </v-form> 
                </v-container>
                
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
            colInsCursos:[
                {text:'ID', value:'id'},
                // {text:'Semestre', value:'semestre'},
                {text:'Curso', value:'nomCurso'},   
                {text:'Opciones', value:'opciones'},                
            ],
            colCursos:[
                {text:'ID', value:'id'},
                {text:'Nombre', value:'nombre'},
                {text:'Plan', value:'plan'},   
                {text:'Escuela', value:'nomEscuela'},
                {text:'Descripcion', value:'descripcion'},
                {text:'Opciones', value:'opciones'},
            ],
            colCursos2:[
                {text:'ID', value:'id',align: 'start'},
                {text:'Nombre', value:'nombre',align: 'start'},
                {text:'Plan', value:'plan',align: 'start'},   
                {text:'Escuela', value:'nomEscuela',align: 'start'},
                {text:'Descripcion', value:'descripcion',align: 'start'},
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
            listaAccionesSobreInstaciaCurso: [ 'Modificar curso' , 'Cerrar curso'  ],
            listaDeSeccionesDisponibles:['A','B','C','D','E','F','G','H'],
            secionActual:'',
            semestre:null,
            KeyDialogCrearCurso: 0,
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
    },
    computed: {
        
    },
    methods: {
        ...mapMutations(['calcularRolVuelta']),
        
        obtenerProfesores(){
            this.listaProfesoresAux = [];
            var aux;
            var url = 'http://127.0.0.1:8000/api/v1/usuario';
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
            var listaBrayan=[];
            var aux;            
            var url = `http://127.0.0.1:8000/api/v1/instanciaCurso/${this.$store.infoSemestre.id}`;
            axios.get(url,this.$store.state.config)
            .then((result)=>{   
                for (let index = 0; index < result.data.data.insCursos.length; index++) {
                    const element = result.data.data.insCursos[index];  
                    let insCurso = {
                        id: element.id,
                        semestre: element.semestre,
                        nomCurso: element.curso,
                        seccion:element.seccion,
                    }; 
                    this.listaInsCursosAux[index]=insCurso;                                                         
                }
                this.listaInsCursos = this.listaInsCursosAux;  
                this.cargando = false;              
            }
            ).catch((error)=>{
                this.cargando = false;
                console.log(error.response)
            });
        },        
        
        crearCurso(){         
            let post = {
                "nombre": this.datosCurso.nombre,
                "plan": this.datosCurso.plan,
                "escuela": this.datosCurso.escuela,
                "descripcion": this.datosCurso.descripcion,
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
            this.datosCurso.descripcion = item.descripcion;
            this.dialogModificarCurso = true;
        },
        resetModificarCurso(){
            this.datosCurso.id= '';
            this.datosCurso.nombre = '';
            this.datosCurso.plan = '';
            this.datosCurso.escuela = '';
            this.datosCurso.descripcion = '';
            this.dialogModificarCurso = false;
        },
        modificarCurso(){
            console.log("inicio mod curso");

            var url =`http://127.0.0.1:8000/api/v1/curso/${this.datosCurso.id}`;
            let put ={                
                "nombre": this.datosCurso.nombre,
                "plan": this.datosCurso.plan,
                "escuela": this.datosCurso.escuela,
                "descripcion": this.datosCurso.descripcion,
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

        asignarCursos(){
            if(this.seleccionados.length != 0){
                this.profesorSeleccionado = '';
                this.dialogAsignarCurso = true;     
            }
            else{
                this.textoAlertas = "Debe seleccionar al menos un curso.";
                this.alertaError = true;
            }
        },

        resetAsignarCurso(){
            this.dialogAsignarCurso = false;
            this.profesorSeleccionado = '';
            this.seleccionados = [];
        },

        asignarCursoASementre(){
            /**variables para el correcto funcionamiento de la consulta. */
            let ins_curso=0;
            let profe_Selec="";
            if(this.profesorSeleccionado != ''){
                profe_Selec=this.profesorSeleccionado;
                this.dialogAsignarCurso = true;                                   
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
                        this.dialogAsignarCurso=false;
                        this.dialogAgregarCursoSemestre=false;
                        ins_curso= result.data.data.insCurso.id;
                        let post2 = {
                            "profesor" :  profe_Selec,
                            "curso":  ins_curso,
                            };
                        //SEGUNDA CONSULTA
                        if(ins_curso != 0 ){ 
                            this.agregarProfesorCurso(post2)
                        }     
                    }).catch((error)=>{
                        console.log( error.response.data);
                        if (error.message == 'Network Error') {
                            this.alertaError = true;
                            this.textoAlertas = "Error al asignar el curso, intente mas tarde."
                            this.resetAsignarCurso();
                            this.dialogAsignarCurso=false;
                            this.dialogAgregarCursoSemestre=false;
                        }
                        if(error.response.data.code == 301){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.alertaError = true;      
                            this.textoAlertas = error.response.data.message;
                            this.dialogAsignarCurso=false;
                            this.dialogAgregarCursoSemestre=false;
                        } 
                        if(error.response.data.code == 302){
                            console.log(error.response.data.code +' '+ error.response.data.message);
                            console.log(error.response.data);
                            this.textoAlertas = error.response.data.message;
                            this.alertaError = true;  
                            this.dialogAsignarCurso=false;    
                            this.dialogAgregarCursoSemestre=false;
                        }   
                    });                                                            
                
                }   
                this.seleccionados = []; 
                this.profesorSeleccionado = '';
                this.dialogAsignarCurso = false; 
                this.obtenerInstanciasCursos();     
            }
            else{
                this.textoAlertas = "Debe seleccionar al menos un profesor";
                this.alertaError = true;
            }
            

        },

        agregarProfesorCurso(post2){
            var url2 = 'http://127.0.0.1:8000/api/v1/profesorConCurso'; 
                    /* crear profesor con curso */
                    axios.post(url2, post2, this.$store.state.config)
                    .then((result) => {
                        console.log(result)
                        this.textoAlertas = "Se asignó el profesor correctamente"
                        this.alertaExito=true;
                        
                    }).catch((error)=>{
                        console.log(error.response);
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

        resetModificarInstanciaCurso(){
            this.datosInsCurso.semestre= '';
            this.datosInsCurso.curso = '';
            this.datosInsCurso.seccion = '';
            this.dialogModificarInsCurso = false;
            this.obtenerInstanciasCursos();
        },
        modificarInstanciaCurso(){
            var url =`http://127.0.0.1:8000/api/v1/instanciaCurso/${this.datosInsCurso.id}`;
            let put ={                
                "semestre": this.datosInsCurso.semestre,
                "curso": this.datosInsCurso.curso,
                "seccion": this.datosInsCurso.seccion,
            };
            axios.put(url,put,this.$store.state.config)
            .then((result)=>{
                if (result.statusText=='OK') {                
                    this.alertaExito = true;
                    this.textoAlertas = "Se modificó el curso con exito."
                    this.obtenerInstanciasCursos(); 
                    this.resetModificarInstanciaCurso();
                }
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
        resetEliminarInstanciaCurso(){
            this.datosInsCurso.id = '';
            this.datosInsCurso.semestre = '';
            this.datosInsCurso.curso = '';
            this.datosInsCurso.nomCurso = '';
            this.dialogEliminarInsCurso = false;
        },

        eliminarInstanciaCurso(){
            var url = 'http://127.0.0.1:8000/api/v1/instanciaCurso/'+this.datosInsCurso.id;
            axios.delete(url,this.$store.state.config)
            .then((result)=>{
            if (result.statusText=='OK') {
                this.obtenerInstanciasCursos();
                this.resetEliminarInstanciaCurso(); 
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
         * Procesa la lista de acciones que puede tener un semestre
         */
        acionesSobreInstanciaCurso(item,curso){
            if(item =='Modificar curso'){
                console.log("Modificar Ins Curso")
                console.log(curso)
                
                this.datosInsCurso = curso;
                this.dialogModificarInsCurso = true;
                  //this.dialogModificarSemestre=true;
                 //this.semestreActual_1=semestre;
            }
            if(item=='Cerrar curso'){
                this.datosInsCurso= curso;
                this.dialogEliminarInsCurso=true

            }
            
        },        
    }
    
    
}
</script>