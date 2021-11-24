// Add translation filter
import transFilter from 'vue-trans';
Vue.use(transFilter);

// Add date filter
import moment from 'moment';
Vue.filter('date', function(value, format = 'DD/MM/YYYY') {
    if (value) {
        return moment(String(value)).format(format);
    }
});

// Create view initializer
import Vue from 'vue';
import GenreShow from './component/page/GenreShow';
import Home from './component/page/Home';

window.vueApp = {};
window.startVueApp = function (template, containerId = 'application') {
    const app = new Vue({
        components: {GenreShow, Home},
        template: template,
    });

    app.$mount('#' + containerId);

    return app;
};
