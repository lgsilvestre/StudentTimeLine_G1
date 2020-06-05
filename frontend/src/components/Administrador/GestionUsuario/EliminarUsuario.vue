<template>
    <v-container>
        <v-row>
            <v-col cols="12" >
                    <button color="green darken-1" text @click="EliminarUsuario = true">
                        Eliminar Usuario
                    </button>

                    <v-dialog v-model="EliminarUsuario" max-width="500">
                        <v-card elevation="1" >
                            <v-card-title
                            class="headline primary text--center"
                            primary-title
                            >
                            <h5 class="white--text ">Eliminar perfil</h5>
                            </v-card-title>
                                <v-form>
                                <v-container class="px-10 pt-10">
                                  <div>
                                      Se Eliminara el perfil de usuario "algo", presione confirmar para seguir
                                        con la operacion
                                  </div>
                                </v-container>
                                <v-container class="px-10">
                                    <v-row>
                                        <v-col cols="6">
                                            <v-btn rounded large block color="primary" 
                                                :loading="verificandoLogin" >
                                                <h4 class="white--text">Cerrar</h4>
                                            </v-btn>
                                        </v-col>
                                        <v-col cols="6">
                                            <v-btn rounded large block color="primary" 
                                                :loading="verificandoLogin"
                                                @click="modificarUsuario = false" >
                                                <h4 class="white--text">Confirmar</h4>
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
export default {
    data() {
        return {
            EliminarUsuario: false,

        }
    },
    
}
</script>