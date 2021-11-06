require('./bootstrap');

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import VueRecaptcha from 'vue3-recaptcha-v2';


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => require(`./Pages/${name}.vue`),
  setup({el, app, props, plugin}) {
    return createApp({render: () => h(app, props)})
      .use(plugin)
      .use(VueRecaptcha,{
        siteKey: "6LeDTdccAAAAAPjx1030ZlT5D3Mqbp5vTr5ZIt1Z",
      })
      .mixin({methods: {route}})
      .mount(el);
  },
});

InertiaProgress.init({color: '#01E08F', showSpinner: false});
