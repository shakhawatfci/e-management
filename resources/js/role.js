require('./vue-assets');
Vue.component('create-role', require('./components/role/CreateRole.vue').default);
Vue.component('view-role', require('./components/role/ViewRole.vue').default);


var app = new Vue({
    el: '#content'

});


