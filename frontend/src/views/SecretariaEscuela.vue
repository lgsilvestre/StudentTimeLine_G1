<template>
  <div class="SecretariaEscuela">
    <AppBarGlobal/>  
    <router-view></router-view>
    <FooterGlobal/>
    <Navegacion/>
    
  </div>
</template>

<script>
import AppBarGlobal from '@/components/Globales/AppBarGlobal.vue';
import FooterGlobal from '@/components/Globales/FooterGlobal.vue';
import Navegacion from '@/components/SecretariaDeEscuela/Navegacion.vue';

export default {
    components: {
      AppBarGlobal,
      FooterGlobal,
      Navegacion,

    },
}
</script>
