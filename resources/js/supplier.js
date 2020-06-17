require('./vue-assets');
Vue.component('create-supplier', require('./components/supplier/CreateSupplier.vue').default);
Vue.component('view-supplier', require('./components/supplier/ViewSupplier.vue').default);


var app = new Vue({

    el: '#content'
});