<template>
    <div class="BodyRC " >        
        
        <v-container fluid >
            <v-row >
                <v-col cols="12">
                    <v-row align="center" justify="center" style="display: flex;flex-direction: column;height:75vh; ">
                        <v-container >
                             <v-row
                                class="mb-6"
                                justify="center"
                                no-gutters
                                >
                                <v-col lg="3" >
                                    <h3 class="primary--text pt-10 ">Recuperar su contraseña en SGDA</h3>
                                    <v-text-field 
                                    class="pt-5 "
                                        v-model="email"
                                        label="Correo"
                                        outlined
                                        prepend-inner-icon="mdi-account-circle"
                                    ></v-text-field>
                                   
                                    <v-btn rounded block color="primary " 
                                    @click="recuperarContrasena"
                                    >
                                    Recuperar contraseña
                                    </v-btn>
                                </v-col>
                                
                            </v-row>
                            
                        </v-container>

                    </v-row>
                    
                </v-col>
            </v-row>

        </v-container>
        
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'BodyRC',
    data () {
      return {
        email: '',
        RCstatus: '',
      }
    },
    methods:{
        recuperarContrasena(email){
        //funcion para recuperar contrasena
        alert = true;
        let post ={
            "email": email,
        };
        var url = 'http://127.0.0.1:8000/api/v1/auth/restartPassword';
        axios.post(url,post).then((result)=>{
            if (result.statusText =='OK') {
               //alerta del envio 
            } else {
                //alerta de que no se encuentran registros de su correo
            }
        });
        },
    },
    computed:{

    },

}
</script>