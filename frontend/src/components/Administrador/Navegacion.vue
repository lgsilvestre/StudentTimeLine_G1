<template>
    <v-navigation-drawer app right v-model="drawers.drawer" :mini-variant="drawers.miniVarianteAdm"  :permanent="$vuetify.breakpoint.mdAndUp" :temporary="$vuetify.breakpoint.smAndDown"
        color="secondary"
    >
    <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
        <template v-slot:activator="{ on }">
            <v-list-item class="px-2 py-1 difuminado" active-class="activacion" to="/administrador/perfil" v-on="on">
                <v-list-item-avatar >
                    <v-img :src="usuario.usuario.foto"
                    ></v-img>
                </v-list-item-avatar>
                <v-list-item-title class="white--text letra pl-2" ><strong>Perfil</strong></v-list-item-title>
            </v-list-item>    
        </template>
        <span><strong>Perfil</strong></span>
    </v-tooltip>
    <v-divider></v-divider>
    <v-list style=" margine-right: 0; margine-left:0;"  >  
        <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" class="difuminado" active-class="activacion" to="/administrador/registros">
                    <v-list-item-icon class="pl-1">
                        <v-icon color="white">fas fa-clipboard-list</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title class="white--text letra" ><strong>Registros</strong></v-list-item-title>
                </v-list-item>
            </template>
            <span><strong>Registros</strong></span>
        </v-tooltip>

        <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" to="/administrador/escuela" class="difuminado" active-class="activacion">
                    <v-list-item-icon>
                        <v-icon color="white">fas fa-school</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title class="white--text letra" ><strong>Escuela</strong></v-list-item-title>
                </v-list-item>
            </template>
            <span><strong>Escuela</strong></span>
        </v-tooltip>

        <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" to="/administrador/usuarios" class="difuminado" active-class="activacion">
                    <v-list-item-icon>
                        <v-icon color="white">fas fa-users</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title class="white--text letra" > <strong>Usuario</strong></v-list-item-title>
                </v-list-item>
            </template>
            <span><strong>Usuario</strong></span>
        </v-tooltip>

        <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
            <template v-slot:activator="{ on }">
                <v-list-item  class="difuminado" active-class="activacion" to="/administrador/semestres" v-on="on">
                    <v-list-item-icon class="pl-1">
                        <v-icon color="white">fas fa-book</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title class="white--text letra" ><strong>Semestres</strong></v-list-item-title>
                </v-list-item>
            </template>
            <span><strong>Cursos</strong></span>
        </v-tooltip>

        <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on" class="difuminado" active-class="activacion" to="/administrador/estudiantes">
                    <v-list-item-icon class="pl-1">
                        <v-icon color="white">fas fa-user-graduate</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title class="white--text letra" ><strong>Estudiantes</strong></v-list-item-title>
                </v-list-item>
            </template>
            <span><strong>Estudiantes</strong></span>
        </v-tooltip>
        
        <v-tooltip left color="primary" :disabled="!drawers.miniVarianteAdm">
            <template v-slot:activator="{ on }">
                <v-list-item  v-on="on"  class="difuminado" active-class="activacion" to="/administrador/observaciones">
                    <v-list-item-icon>
                        <v-icon color="white">fas fa-book-open</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title class="white--text letra" > <strong>Observaciones</strong></v-list-item-title>
                </v-list-item>
            </template>
            <span><strong>Observaciones</strong></span>
        </v-tooltip>
        <v-list-item v-if="$vuetify.breakpoint.smAndDown ? true:false" class=" difuminado align-self-end" style="background-color: #E63946" @click="unLogin">
            <v-list-item-icon >
                <v-icon color="white" style="font-size: 125%">fas fa-power-off</v-icon>
            </v-list-item-icon>
            <v-list-item-title class="white--text letra" ><strong>Cerrar sesion</strong></v-list-item-title>
        </v-list-item>
    </v-list>
    <template v-slot:append >
        <v-list-item v-if="$vuetify.breakpoint.smAndDown ? false:true" class=" difuminado" style="background-color: #E63946" @click="unLogin">
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
            itemsUsuario: [
            { title: 'Crear usuario', icon: 'fas fa-plus-circle' },
            { title: 'Listar Usuario', icon: 'fas fa-list' },
            { title: 'Modificar usuario', icon: 'fas fa-users' },
            { title: 'Eliminar usuario', icon: 'fas fa-users' }

        ],
        itemsEscuela:[
            {title:'Crear escuela', icon:'fas fa-plus-circle'},
            {title:'Listar escuela', icon:'fas fa-list'},
            { title:'habilitar escuela', icon:'fas fa-school'},
            {title:'Deshabilitar escuela', icon:'fas fa-school'}
            ],
        itemsCurso: [
            {title:'Crear curso', icon:'fas fa-plus-circle'},
            {title:'Listar curso', icon:'fas fa-list'},
            {title:'Modificar curso', icon:'fas fa-chalkboard-teacher'},
            {title:'Eliminar curso', icon:'fas fa-chalkboard-teacher'},
        ],
        itemsProfesor:[
            {title:'Vincular profesor', icon:'fas fa-chalkboard-teacher'},
            {title:'Desvincular profesor', icon:'fas fa-chalkboard-teacher'},
        ],
        itemsEstudiantes:[
            {title:'Listar estudiante', icon:'fas fa-list'},
            
        ],
        itemsObservaciones: [
            {title:'Crear observación', icon:'fas fa-plus-circle'},
            {title:'Listar observación', icon:'fas fa-list'},
            {title:'Modificar observación', icon:'fas fa-archway'},
            {title:'Eliminar observación', icon:'fas fa-archway'},
        ],
        itemsContactar:[
            {title:'Contactar administrador', icon:'fas fa-envelope'},
            {title:'contactar secretaria de escuela', icon:'fas fa-envelope'},
        ],
        admins: [
        ['Management', 'people_outline'],
        ['Settings', 'settings'],
      ],
      cruds: [
        ['Create', 'add'],
        ['Read', 'insert_drive_file'],
        ['Update', 'update'],
        ['Delete', 'delete'],
      ],
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