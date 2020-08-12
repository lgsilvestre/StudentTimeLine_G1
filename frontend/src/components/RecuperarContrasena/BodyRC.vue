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
                                <v-col cols="12" sm="12" md="4" lg="4" xl="3">
                                    <v-card elevation="1" shaped>
                                        <v-card-title
                                        class="headline primary text--center"
                                        primary-title
                                        >
                                        <h5 class="white--text ">Recuperar su contraseña </h5>
                                        </v-card-title>
                                        <v-container class="px-5">
                                          <v-form ref="RC"  v-model="formRecuperar" lazy-validation>
                                            <v-text-field 
                                            class="pt-5 "
                                                v-model="email"
                                                label="Correo"
                                                color="secondary"
                                                outlined
                                                :rules="reglasEmail"
                                                prepend-inner-icon="mdi-email"
                                            ></v-text-field>
                                            <v-btn rounded block color="primary " class=""
                                            :loading="RCstatus" 
                                            :disabled="!formRecuperar"
                                            @click="recuperarContrasena"
                                            >
                                            Recuperar contraseña
                                            </v-btn>  
                                          </v-form>
                                        </v-container>
                                    </v-card>
                                    
                                </v-col>
                                
                            </v-row>
                        </v-container>
                    </v-row>
                </v-col>
            </v-row>
        </v-container>
        <v-snackbar
        v-model="alertError"
        :timeout=delay
        bottom
        color="warning"
        left
        class="mb-1 pb-12 pr-0 mr-0"
      >
        <div>
          <v-icon color="white" class="mr-2">
            fas fa-exclamation-triangle
          </v-icon>
          <strong>{{textoError}} </strong>
        </div>
        <v-btn
            color="white"
            elevation="0"
            x-small
            fab
            @click="alertError = ! alertError"
        > 
            <v-icon color="warning">fas fa-times</v-icon>
        </v-btn>
      </v-snackbar>
      <v-snackbar
        v-model="alertAcept"
        :timeout=delay
        bottom
        color="secondary"
        left
        class="mb-1 pb-12 pr-0 mr-0"
      >
        <div>
          <v-icon color="white" class="mr-2">
            fas fa-check-circle
          </v-icon>
          <strong>{{textoAcept}}</strong>
        </div>
        <v-btn
          color="white"
          elevation="0"
          x-small
          fab
          @click="alertAcept = ! alertAcept"
        > 
            <v-icon color="secondary">fas fa-times</v-icon>
        </v-btn>
      </v-snackbar>
        
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'BodyRC',
    data () {
      return {
        email: '',
        RCstatus: false,
        alertError: false,
        textoError: '',
        alertAcept: false,
        textoAcept: '',
        delay: 4000,
        formRecuperar: true,

        reglasEmail: [
            v => /.+@utalca.cl/.test(v) || /.+@alumnos.utalca.cl/.test(v) || 'Correo no Válido', 
        ],
      }
    },
    methods:{
        recuperarContrasena(){
        //funcion para recuperar contrasena
        this.RCstatus = true;
        let post ={
            "email": this.email,
        };
        console.log(this.email);
        var url = 'http://127.0.0.1:8000/api/v1/auth/sendRestartPassword';
        axios.post(url,post)
        .then((result)=>{
          console.log(result.data);
          if (result.data.success == true) {
            this.RCstatus = false;
            this.alertAcept= true;
            this.textoAcept= result.data.message;
            this.email = '';
          } 
          this.$refs.RC.reset();
        })
        .catch((error)=>{
          this.$refs.RC.reset();
          if (error.message == 'Network Error') {
              console.log(error);
              this.RCstatus = false;
              this.alertError= true;
              this.textoError= "Error usted no esta registrado o existe un problema en red, intente mas tarde";
          } else {
              this.RCstatus = false;
              if (error.response.data.success == false) {
                  switch (error.response.data.code) {
                      case 2:
                          console.log(error.response.data.code +' '+ error.response.data.message);
                          console.log(error.response.data);
                          this.alertError= true;
                          this.textoError= error.response.data.message;
                          break;
                      case 3:
                          console.log(error.response.data.code +' '+ error.response.data.message);
                          console.log(error.response.data);
                          this.alertError= true;
                          this.textoError= error.response.data.message;
                          break;
                      case 4:
                          console.log(error.response.data.code +' '+ error.response.data.message);
                          console.log(error.response.data);
                          this.alertError= true;
                          this.textoError= error.response.data.message;
                          break;
                      default:
                          break;
                  }
              }
          } 
        });
        
        },
    },
    computed:{

    },

}
</script>