require('./vue-assets');
Vue.component('create-supplier', require('./components/supplier/CreateSupplier.vue').default);
Vue.component('view-supplier', require('./components/supplier/ViewSupplier.vue').default);

Vue.component('create-project-concern', require('./components/concern/project/CreateProjectConcern.vue').default);
Vue.component('view-project-concern', require('./components/concern/project/ViewProjectConcern.vue').default);

Vue.component('create-vendor-concern', require('./components/concern/vendor/CreateVendorConcern.vue').default);
Vue.component('view-vendor-concern', require('./components/concern/vendor/ViewVendorConcern.vue').default);


var app = new Vue({

    el: '#content'
});