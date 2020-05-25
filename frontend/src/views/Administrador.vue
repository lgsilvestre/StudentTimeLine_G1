<template>
  <div class="Administrador">
    <AppBarGlobal/>      
    <BodyRegistroUsuarios/>
    <FooterGeneral/>
  </div>
</template>

<script>
import AppBarGlobal from '@/components/Globales/AppBarGlobal.vue';
import BodyRegistroUsuarios from '@/components/Administrador/RegistroUsuarios/BodyRegistroUsuarios.vue';
import FooterGeneral from '@/components/Globales/FooterGeneral.vue';

export default {
    components: {
      AppBarGlobal,
      BodyRegistroUsuarios,
      FooterGeneral,
    },
}
</script>
