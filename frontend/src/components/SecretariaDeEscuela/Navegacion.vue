<template>
    <v-navigation-drawer
    app
    v-model="drawer"
    right
    premanent    
    :mini-variant.sync=drawelAdmin  
    src="@/assets/Globales/background-panel-04.jpg"
    >
    <!-- Mis recomendaciones de fondo (?)  1, 2, 4, 7, 9,  -->  


    <!-- Lista general del navigation drawer -->
        <!-- Seccion de Mi Perfil -->
        <v-list >
            <v-list-item @click="verPerfil">
                <!-- Imagen o Avatar -->
                <v-list-item-avatar>
                    <v-img src="http://www.ingenieria.utalca.cl/Repositorio/PNsAYcfZiO2QfjGDQMIyjMOAomsLch/Ruth%20Garrido.jpg"></v-img>
                </v-list-item-avatar>    
                <!-- Nombre del Usuario -->
                <v-list-item-title> Secretaria de Escuela</v-list-item-title>                       
            </v-list-item>

            <v-divider class="my-1"></v-divider>

            <!-- Menus del Navigation Drawer -->

            <!-- Menu de Operaciones Profesor -->
           <!--  <v-menu            
            offset-y
            >
                <template v-slot:activator="{ on }">
                    <v-list-item v-on="on" >
                        <v-list-item-icon>
                            <v-icon color="red">fas fa-chalkboard-teacher</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="subtitle">Profesores</v-list-item-title>                            
                    </v-list-item>
                </template> -->

                <!-- Lista que se despliega del menu (opciones relacionadas con profesor) -->
               <!--  <v-list>
                    <v-list-item
                        v-for="opcion in profesores"
                        :key=opcion
                        @click="opcion"
                    >
                        <v-list-item-title> {{opcion}} </v-list-item-title>
                    </v-list-item>                                        
                </v-list>
            </v-menu>  -->

            <!-- Menu de Operaciones Cursos -->
            <!-- <v-menu
            absolute
            offset-y
            >    
                <template v-slot:activator="{ on }" >
                    <v-list-item v-on="on">
                        <v-list-item-icon>
                            <v-icon color="white">fab fa-accusoft</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title >Cursos</v-list-item-title>                            
                    </v-list-item>
                </template> -->
                <!-- Lista que se despliega del menu (opciones relacionadas con cursos) -->
                <!-- <v-list>
                    <v-list-item
                        v-for="opcion in cursos"
                        :key=opcion
                        @click="opcion"
                    >
                        <v-list-item-title> {{opcion}} </v-list-item-title>
                    </v-list-item>                                        
                </v-list>
            </v-menu> -->

            <!-- Menu de Operaciones Estudiantes -->
            <!-- <v-menu
            absolute
            offset-y
            >    
                <template v-slot:activator="{ on }">
                    <v-list-item v-on="on">
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-user-graduate</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Estudiantes</v-list-item-title>                            
                    </v-list-item>
                </template> -->
                <!-- Lista que se despliega del menu (opciones relacionadas con estudiantes) -->
                <!-- <v-list>
                    <v-list-item
                        v-for="opcion in estudiantes"
                        :key=opcion
                        @click="opcion"
                    >
                        <v-list-item-title> {{opcion}} </v-list-item-title>
                    </v-list-item>                                        
                </v-list>
            </v-menu> -->

            <!-- Menu de Operaciones Observaciones -->
            <!-- <v-menu
            offset-y
            >    
                <template v-slot:activator="{ on }">
                    <v-list-item v-on="on">
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-archway</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Observaciones</v-list-item-title>                            
                    </v-list-item>
                </template> -->
                <!-- Lista que se despliega del menu (opciones relacionadas con observaciones) -->
                <!-- <v-list>
                    <v-list-item
                        v-for="opcion in observaciones"
                        :key=opcion
                        @click="opcion"
                    >
                        <v-list-item-title > {{opcion}} </v-list-item-title>
                    </v-list-item>                                        
                </v-list>
            </v-menu>        -->
            <v-list-item @click="profesores" >
                <v-list-item-icon>
                    <v-icon color="black">fas fa-chalkboard-teacher</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Profesores</v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="cursos" >
                <v-list-item-icon>
                    <v-icon color="black">fab fa-accusoft</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Cursos</v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="estudiantes" >
                <v-list-item-icon>
                    <v-icon color="black">fas fa-user-graduate</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Estudiantes</v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="observaciones" >
                <v-list-item-icon>
                    <v-icon color="black">fas fa-archway</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Observaciones</v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="contactar" >
                <v-list-item-icon>
                    <v-icon color="black">fas fa-envelope</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Contactar</v-list-item-title>                            
            </v-list-item>
                     
        </v-list>

        <template v-slot:append >
        <div >
          <v-btn block color="primary   " @click="cerrarSesion">Cerrar sesión</v-btn>
        </div>
      </template>        

    </v-navigation-drawer>
</template>

<script>
import {mapState} from 'vuex';
export default {
    data(){
        return{
            drawer: true,
            profesores: ['Habilitar Cuenta Profesor','Deshabilitar Cuenta Profesor'],
            cursos:['Crear Curso','Modificar Curso','Habilitar Curso', 'Deshabilitar Curso'],
            estudiantes:['Ver Lista Estudiantes'],
            observaciones:['Crear Observacion','Modificar Observacion','Eliminar Observacion'],
        }
    },
    computed: {
        ...mapState(['drawelAdmin']),
    },
    methods: {
        verPerfil(){

        },
        contactar(){
            
        },
    },
}
</script>
