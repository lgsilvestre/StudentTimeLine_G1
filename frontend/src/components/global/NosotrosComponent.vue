<template>
  <div class="NosotrosComponent">
        <v-bottom-sheet v-model=" sheet " inset  >  
            <template v-slot:activator="{ on }">
                
                <v-btn v-on="on" color="primary white--text mt-3 mr-2 " depressed   >Nosotros</v-btn>
            </template>

            <v-sheet class="text-center" height="800px" color="white">
                <!-- <v-container fluid>
                    <v-row no-gutters>   
                        <template>
                            <div class="text-center">
                                <v-btn class="mt-6"  text color="error" @click="sheet = ! sheet"  >close</v-btn>
                            </div>
                        </template>
                        
                    </v-row>
                
                </v-container> -->
                <v-btn class="mt-6" text color="red" @click="sheet = !sheet" >cerrar</v-btn>
                <div class="py-3">Información</div>
            </v-sheet>
        </v-bottom-sheet>
  </div>
</template>

<script>
export default {
    name: 'NosotrosComponent',
    data() {
        return {
            sheet: false
        }
    },
    computed:{
    },
    methods: {
        // 
       
    },computed:{

    }
}
</script>

