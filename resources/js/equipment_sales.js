require('./vue-assets');
Vue.component('create-sales', require('./components/equipment-sales/CreateSales.vue').default);
Vue.component('view-sales', require('./components/equipment-sales/ViewSales.vue').default);



var app = new Vue({
    el: '#content'
});