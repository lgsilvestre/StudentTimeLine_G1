<template>
    <div class="AppBarRC">
        <v-app-bar 
        color="primary"
        elevate-on-scroll 
        :collapse=false
        >
            <div class="d-flex align-center">
            <v-img 
                class="shrink mr-2 d-none d-sm-flex"
                src="@/assets/Inicio/utalca.png"
                width="300"
            />
            <v-img 
                class="shrink mr-2 d-flex d-sm-none"
                src="@/assets/Inicio/utalca2.png"
                width="45"
            />
            </div>
            <v-spacer></v-spacer>
            <v-btn
            color="primary"
            elevation="0"
            rounded
            @click="volverInicio"
            > 
                Volver <i class="fas fa-undo-alt pl-2"></i>
            </v-btn>
        </v-app-bar>
        
    </div>
</template>

<script>

export default {
    name: 'AppBarRC',

    components: {
       
    },
    
    methods:{
        volverInicio(){
           
            this.$router.push({path:'/'});
        }
    },
    computed:{

    },

}
</script>