<template>
  <div class="Administrador">
    <AppBarGlobal/>  
    <BodyListaUsuarios/>
    <FooterGlobal/>
    <Navegacion/>
  </div>
</template>

<script>
import AppBarGlobal from '@/components/Globales/AppBarGlobal.vue';
import BodyListaUsuarios from '@/components/Globales/BodyListaUsuarios.vue';
import FooterGlobal from '@/components/Globales/FooterGlobal.vue';
import Navegacion from '@/components/Administrador/Navegacion.vue';


export default {
    components: {
      AppBarGlobal,
      BodyListaUsuarios,
      FooterGlobal,
      Navegacion,
    },
}
</script>
