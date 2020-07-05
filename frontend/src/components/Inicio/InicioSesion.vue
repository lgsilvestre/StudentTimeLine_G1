<template>
    <div class="InicioSesion">
        <v-dialog
        :width="$vuetify.breakpoint.smAndDown ? '100%' : '70%'"
        transition="scroll-y-reverse-transition" origin="bottom "
        >
        <template v-slot:activator="{ on }">
            <v-btn text rounded v-on="on" color="white" >
                <h4 class="white--text pr-2">Inicio Sesión</h4>
                <v-icon large >mdi-account-circle</v-icon>
            </v-btn>
        </template>
        <v-card color="fondo">
            <v-container fluid>
                <v-row no-gutters class="align-center justify-center" >
                    <v-col class="d-none d-sm-none d-md-none d-lg-flex" lg="6" >
                        <v-container>
                            <v-card
                                width="100%"
                                height="100%"
                                outlined
                                >
                                <v-img
                                    width="100%"
                                    height="100%"
                                    src="@/assets/Inicio/acreditacion.png"
                                >
                                </v-img>
                            </v-card>
                        </v-container>
                        
                    </v-col>
                    <v-col class="d-none d-sm-none d-md-block " md="1"> 
                    </v-col>
                    <v-col  sm="12" md="6" lg="4" >
                        <v-card elevation="1" shaped>
                            <v-card-title
                            class="headline primary text--center"
                            primary-title
                            >
                            <h5 class="white--text ">Iniciar Sesión en SGDA</h5>
                            </v-card-title>
                                <v-form>
                                    
                                <v-container class="pt-10 px-5">
                                    <v-text-field v-model="lista.email"
                                        label="Correo"
                                        outlined
                                        color="secondary"
                                        prepend-inner-icon="mdi-email"
                                    ></v-text-field>
                                    <v-text-field v-model="lista.pass"
                                        :prepend-inner-icon="mostrar ? 'mdi-eye' : 'mdi-eye-off'"
                                        :type="mostrar ? 'text' : 'password'"
                                        label="Contraseña"
                                        color="secondary"
                                        outlined
                                        @click:prepend-inner= "mostrar = !mostrar"
                                    ></v-text-field>
                                    <v-breadcrumbs class="px-0 py-0 pb-8"  >
                                        <v-breadcrumbs-item to='/recuperacionContrasena'
                                        background-color="primary"
                                        color="secondary"
                                        >
                                            ¿Olvidaste tu contraseña?
                                        </v-breadcrumbs-item>
                                    </v-breadcrumbs>
                                    <v-alert 
                                    v-model="verificacionLogin"
                                    dismissible
                                    type="error">
                                        {{mensajeErrorLogin}}
                                    </v-alert>
                                    <v-btn rounded large block color="primary" 
                                        :loading="cargaLogin"
                                        @click="login(lista)"
                                        >
                                        <!--@click="cargar = 'verificandoLogin'"-->
                                        <h4 class="white--text">Iniciar Sesión</h4>
                                    </v-btn>
                                </v-container>
                                
                            </v-form> 
                        </v-card>
                        
                    </v-col>
                    <v-col class="d-none d-sm-none d-md-block " md="1">
                            
                    </v-col>
                    
                </v-row>
            </v-container>
        </v-card>
        </v-dialog>
    </div>
</template>

<script>
import {mapMutations, mapState} from 'vuex';
export default {
    name: 'InicioSesion',
    data () {
        return {
            sheet: false,
            mostrar: false,
            cargar: null,
            verificandoLogin: false,
            items: [
                {
                text: '¿Olvidaste tu contraseña?',
                disabled: false,
                to: '/recuperacionContrasena',
                },
            ],
            lista: [{email:''},{pass:''}], 
        }
    },
    computed:{
        ...mapState(['cargaLogin','verificacionLogin','mensajeErrorLogin']),
    },
    methods:{
        ...mapMutations(['login']),
    },
}
</script>

