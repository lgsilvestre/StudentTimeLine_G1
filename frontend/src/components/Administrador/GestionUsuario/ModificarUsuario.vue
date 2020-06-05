<template>
   <v-container>
       <v-row>
           <v-col cols="12">
               <button color="info" text @click="modificarUsuario = true">
                        Modificar 
                </button>

                    <v-dialog v-model="modificarUsuario" max-width="500">
                        <v-card elevation="1" shaped>
                            <v-card-title
                            class="headline primary text--center"
                            primary-title
                            >
                            <h5 class="white--text">Editar perfil</h5>
                            </v-card-title>
                                <v-form>
                                <v-container class="px-10 pt-10">
                                    <v-text-field label="Nombre"  outlined color="secondary"
                                        prepend-inner-icon="mdi-account-circle">
                                   </v-text-field>

                                   <v-text-field label="Escuela"  outlined color="secondary"
                                        prepend-inner-icon="mdi-account-circle">
                                   </v-text-field>

                                   <v-text-field label="Rol"  outlined color="secondary"
                                        prepend-inner-icon="mdi-account-circle">
                                       
                                   </v-text-field>
                                   
                                   <v-file-input  accept="image/png, image/jpeg, image/bmp" 
                                    label="Seleccione una imagen"
                                    color="secondary"
                                    outlined
                                    prepend-icon=""
                                        
                                    prepend-inner-icon="mdi-camera"></v-file-input>

                                   <v-text-field label="Correo"  outlined color="secondary"
                                        prepend-inner-icon="mdi-account-circle">
                                   </v-text-field>

                                   <v-text-field label="Contraseña"  outlined color="secondary"
                                        prepend-inner-icon="mdi-account-circle">
                                   </v-text-field>
                                   
                                </v-container>
                                <v-container class="px-10">
                                    <v-row>
                                        <v-col cols="6">
                                            <v-btn rounded large block color="primary"  @click="modificarUsuario = false" >
                                                <h4 class="white--text">Cerrar</h4>
                                                </v-btn>
                                        </v-col>
                                        <v-col cols="6">
                                            <v-btn rounded large block color="primary" 
                                        @click="listarModificarUsuario"
                                        >
                                        <h4 class="white--text">Modificar</h4>
                                    </v-btn>
                                    
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-form> 
                        </v-card>
                    </v-dialog>

           </v-col>
       </v-row>
       
    </v-container>     

</template>
<script>
import {mapMutations} from 'vuex';
// import axios from 'axios'
export default {
    data() {
        return {
            modificarUsuario :false,
            usuarios: null
        }
    },
    computed:{
    
    },
    methods: {
        ...mapMutations(['listarUsuario','listarModificarUsuario']),
     

            
        
    },
}
</script>