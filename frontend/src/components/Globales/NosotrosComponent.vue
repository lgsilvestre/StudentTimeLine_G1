<template>
  <div class="NosotrosComponent">
        <v-bottom-sheet v-model=" sheet " inset  >  
            <template v-slot:activator="{ on }">
                
                <v-btn v-on="on" color="primary white--text" depressed   >Nosotros</v-btn>
            </template>

            <v-sheet class="text-center" height="800px" color="white">
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

