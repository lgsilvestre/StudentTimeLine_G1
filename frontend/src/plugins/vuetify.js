import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import es from 'vuetify/es5/locale/es';
import '@fortawesome/fontawesome-free/css/all.css'

Vue.use(Vuetify);

export default new Vuetify({
  theme: {
      options: {
        customProperties: true,
      },
    themes: {
      light: {
        primary: '#0F0223',
        secondary: '#301557',
        fondo: '#ffffff',
        accent: '#93A537',
        error: '#6C5192',
        info: '#1e1b18',
        success: '#4CAF50',
        warning: '#6C5192',
      },
    },
  },
    lang: {
      locales: { es },
      current: 'es',
    },
    icons: {
      iconfont: 'fa',
    },
});
