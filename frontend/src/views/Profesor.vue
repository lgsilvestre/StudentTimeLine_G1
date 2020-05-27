<template>
  <div class="Profesor">
    <AppBarGlobal/>  
    <NavegacionProfesor/> 
    <v-content>
      <router-view></router-view>
    </v-content>
    <FooterGlobal/>
  </div>
</template>

<script>
import AppBarGlobal from '@/components/Globales/AppBarGlobal.vue';
import FooterGlobal from '@/components/Globales/FooterGlobal.vue';
import NavegacionProfesor from '@/components/Profesor/NavegacionProfesor.vue';
export default {
    name: 'Profesor',
    components: {
      AppBarGlobal,
      FooterGlobal,
      NavegacionProfesor,
    },
}
</script>
