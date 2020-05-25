<template>
  <div class="Administrador">
    <AppBarGlobal/>  
    <BodyRegistroUsuarios/>
    <FooterGlobal/>
    <Navegacion/> 
    
  </div>
</template>

<script>
import AppBarGlobal from '@/components/Globales/AppBarGlobal.vue';
import BodyRegistroUsuarios from '@/components/Administrador/RegistroUsuarios/BodyRegistroUsuarios.vue';
import FooterGlobal from '@/components/Globales/FooterGlobal.vue';
import Navegacion from '@/components/Administrador/Navegacion.vue';
export default {
    components: {
      AppBarGlobal,
      BodyRegistroUsuarios,
      FooterGlobal,
      Navegacion,
      
    },
}
</script>
