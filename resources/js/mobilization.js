require('./vue-assets');
Vue.component('create-mobilization', require('./components/mobilization/CreateMobilization').default);
Vue.component('view-mobilization', require('./components/mobilization/ViewMobilization.vue').default);



var app = new Vue({
    el: '#content'
});