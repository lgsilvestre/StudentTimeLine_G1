<template>
    <v-navigation-drawer app right v-model="drawers.drawer" :mini-variant="drawers.miniVarianteAdm"  :permanent="$vuetify.breakpoint.mdAndUp" :temporary="$vuetify.breakpoint.smAndDown"
        src="@/assets/Globales/background-panel-02.jpg"
    >
    <!-- Mis recomendaciones de fondo (?)  1, 2, 4, 7, 9,  -->  

    <!-- Lista general del navigation drawer -->
        <!-- Seccion de Mi Perfil -->
        
            <v-list-item class="px-2 py-1  difuminado" active-class="activacion" to="/secretariaEscuela/perfil">
                <!-- Imagen o Avatar -->
                <v-list-item-avatar>
                    <v-img src="http://www.ingenieria.utalca.cl/Repositorio/PNsAYcfZiO2QfjGDQMIyjMOAomsLch/Ruth%20Garrido.jpg"></v-img>
                </v-list-item-avatar>    
                <!-- Nombre del Usuario -->
                <v-list-item-title class="white--text letra"><strong>Sria. de Escuela</strong></v-list-item-title>                       
            </v-list-item>
        
            <v-divider></v-divider>
            <v-list style=" margine-right: 0; margine-left:0;"  >
            
            <v-list-item class="difuminado" active-class="activacion" to="/secretariaEscuela/profesores">
                <v-list-item-icon>
                    <v-icon color="white">fas fa-chalkboard-teacher</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra"><strong>Profesores</strong></v-list-item-title>                            
            </v-list-item>

            <v-list-item class="difuminado" active-class="activacion" to="/secretariaEscuela/cursos">
                <v-list-item-icon >
                    <v-icon color="white">fab fa-accusoft</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra"><strong>Cursos</strong></v-list-item-title>                            
            </v-list-item>

            <v-list-item  class="difuminado" active-class="activacion" to="/secretariaEscuela/estudiantes">
                <v-list-item-icon >
                    <v-icon color="white">fas fa-user-graduate</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra"><strong>Estudiantes</strong></v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="observaciones" class="difuminado" active-class="activacion">
                <v-list-item-icon >
                    <v-icon color="white">fas fa-archway</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra"><strong>Observaciones</strong></v-list-item-title>                            
            </v-list-item>

            <v-list-item @click="contactar" class="difuminado" active-class="activacion">
                <v-list-item-icon>
                    <v-icon color="white">fas fa-envelope</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra" ><strong>Contactar</strong></v-list-item-title>                            
            </v-list-item>
        </v-list>
        <template v-slot:append >
        <v-list-item class=" difuminado" style="background-color: #FF6B6B" @click="unLogin">
            <v-list-item-icon >
                <v-icon color="white" style="font-size: 125%">fas fa-power-off</v-icon>
            </v-list-item-icon>
            <v-list-item-title class="white--text letra" ><strong>Cerrar sesion</strong></v-list-item-title>
        </v-list-item>
        </template>       
    </v-navigation-drawer>
</template>

<script>
import {mapState, mapMutations} from 'vuex';
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
        ...mapState(['drawers']),
    },
    methods: {
        ...mapMutations(['unLogin']),
        verPerfil(){

        },
        contactar(){
            
        },
    },
}
</script>

<style scoped>
    .difuminado{
        text-shadow: #555 2px 2px 3px;
    }
    .letra{
        font-size: 125%;
    }
    .activacion {
        color:#fff;
        background-color: rgba(0,0,0,0.6);
    }
</style>