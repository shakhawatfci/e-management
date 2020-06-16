require('./vue-assets');
Vue.component('create-equipment', require('./components/equipment/CreateEquipment.vue').default);
Vue.component('view-equipment', require('./components/equipment/ViewEquipment.vue').default);


var app = new Vue({

    el: '#content'
});