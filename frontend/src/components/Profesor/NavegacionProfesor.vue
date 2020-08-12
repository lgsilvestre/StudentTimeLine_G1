<template>
<v-navigation-drawer app right v-model="drawers.drawer" :mini-variant="drawers.miniVarianteAdm"  :permanent="$vuetify.breakpoint.mdAndUp" :temporary="$vuetify.breakpoint.smAndDown"
    src="@/assets/Globales/background-panel-02.jpg"
>
        <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
            <template v-slot:activator="{ on }">
                <v-list-item class="px-2 py-1 difuminado" active-class="activacion" to="/profesor/perfil" v-on="on">
                    <v-list-item-avatar >
                        <v-img :src="usuario.usuario.foto"
                        ></v-img>
                    </v-list-item-avatar>
                    <v-list-item-title class="white--text letra pl-2"><strong>Perfil</strong></v-list-item-title>
                </v-list-item>
            </template>
            <span><strong>Perfil</strong></span>
        </v-tooltip>
        <v-divider></v-divider>
        <v-list> 

            <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
                <template v-slot:activator="{ on }">
                    <v-list-item  v-on="on" to="/profesor/estudiantes" class="difuminado" active-class="activacion"> 
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
                    <v-list-item  v-on="on"  class="difuminado" active-class="activacion" to="/profesor/observaciones" >
                        <v-list-item-icon>
                            <v-icon color="white">fas fa-book-open</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="white--text letra"><strong>Observaciones</strong></v-list-item-title>
                    </v-list-item>
                </template>
                <span><strong>Observaciones</strong></span>
            </v-tooltip>
            
            <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
                <template v-slot:activator="{ on }">
                    <v-list-item  v-on="on" to="/profesor/cursos"  class="difuminado" active-class="activacion">
                        <v-list-item-icon class="pl-1">
                            <v-icon color="white">fas fa-book</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title class="white--text letra"><strong>Cursos</strong></v-list-item-title>
                    </v-list-item>
                </template>
                <span><strong>Cursos</strong></span>
            </v-tooltip>
                
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
    name:'Navegacion',
    data() {
        return {
            drawer: true,
            on: '',
        }
    },
    computed: {
        ...mapState(['drawers', 'usuario']),
    },
    icons:{
        iconfont: (['mdiSvg', 'mdi','mdiSvg' , 'md' , 'fa' ,'fa4' ,'faSvg'])
    },
    methods: {
        ...mapMutations(['unLogin']),
        cerrarSesion(){
            console.log('cerrar sesion')
        },
        verPerfil(){
            console.log('ver perfil')
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