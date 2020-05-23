<template>
    <div class="general">
        <AppBarGlobal/>
        <FooterGeneral/>
    </div>
  
</template>

<script>
import FooterGeneral from '@/components/global/FooterGeneral.vue';



export default {
    name: 'general',
    components: {

        FooterGeneral,
    },
}
</script>