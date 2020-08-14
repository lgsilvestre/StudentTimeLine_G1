<template>
    <v-navigation-drawer app right v-model="drawers.drawer" :mini-variant="drawers.miniVarianteAdm"  :permanent="$vuetify.breakpoint.mdAndUp" :temporary="$vuetify.breakpoint.smAndDown"
        src="@/assets/Globales/background-panel-02.jpg"
    >
    <!-- Lista general del navigation drawer -->
        <!-- Seccion de Mi Perfil -->
        <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
            <template v-slot:activator="{ on }">
                <v-list-item class="px-2 py-1  difuminado" active-class="activacion" to="/secretariaEscuela/perfil" v-on="on">
                    <!-- Imagen o Avatar -->
                    <v-list-item-avatar>
                        <v-img :src="usuario.usuario.foto"
                        ></v-img>
                    </v-list-item-avatar>    
                    <!-- Nombre del Usuario -->
                    <v-list-item-title class="white--text letra pl-2"><strong>Perfil</strong></v-list-item-title>                       
                </v-list-item>
            </template>
            <span><strong>Perfil</strong></span>
        </v-tooltip>
        
            <v-divider></v-divider>
            <v-list style=" margine-right: 0; margine-left:0;"  >
            
            <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
                <template v-slot:activator="{ on }">
                    <v-list-item class="difuminado" active-class="activacion" to="/secretariaEscuela/semestres" v-on="on">
                        <v-list-item-icon class="pl-1">
                            <v-icon color="white">fas fa-book</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="white--text letra"><strong>Semestres</strong></v-list-item-title>                            
                    </v-list-item>
                </template>
                <span><strong>Cursos</strong></span>
            </v-tooltip>

            <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
                <template v-slot:activator="{ on }">
                    <v-list-item class="difuminado" active-class="activacion" to="/secretariaEscuela/profesores" v-on="on">
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-chalkboard-teacher</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="white--text letra"><strong>Profesores</strong></v-list-item-title>                            
                    </v-list-item>
                </template>
                <span><strong>Profesores</strong></span>
            </v-tooltip>

            <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
                <template v-slot:activator="{ on }">
                    <v-list-item  class="difuminado" active-class="activacion" to="/secretariaEscuela/estudiantes" v-on="on">
                        <v-list-item-icon class="pl-1">
                            <v-icon color="white">fas fa-user-graduate</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="white--text letra"><strong>Estudiantes</strong></v-list-item-title>                            
                    </v-list-item>
                </template>
                <span><strong>Estudiantes</strong></span>
            </v-tooltip>

            <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
                <template v-slot:activator="{ on }">
                    <v-list-item @click="observaciones" class="difuminado" active-class="activacion" to="/secretariaEscuela/observaciones" v-on="on">
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-book-open</v-icon>
                        </v-list-item-icon> 
                        <v-list-item-title class="white--text letra"><strong>Observaciones</strong></v-list-item-title>                            
                    </v-list-item>
                </template>
                <span><strong>Observaciones</strong></span>
            </v-tooltip>
            <v-list-item v-if="$vuetify.breakpoint.smAndDown ? true:false" class=" difuminado align-self-end" style="background-color: #FF6B6B" @click="unLogin">
                <v-list-item-icon >
                    <v-icon color="white" style="font-size: 125%">fas fa-power-off</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="white--text letra" ><strong>Cerrar sesion</strong></v-list-item-title>
            </v-list-item>
        </v-list>
        <template v-slot:append >
        <v-list-item v-if="$vuetify.breakpoint.smAndDown ? false:true" class=" difuminado" style="background-color: #FF6B6B" @click="unLogin">
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
        ...mapState(['drawers', 'usuario']),
    },
    methods: {
        ...mapMutations(['unLogin']),
        contactar(){
            
        },
    },
}
</script>

<style scoped>
    .difuminado{
        text-shadow: #000000 2px 2px 3px;
    }
    .letra{
        font-size: 125%;
    }
    .activacion {
        color:#fff;
        background-color: rgba(0,0,0,0.6);
    }
</style>