require('./vue-assets');
Vue.component('create-equipmentexpenseheads', require('./components/expense_heads/equipment/CreateEquipment.vue').default);
Vue.component('view-equipmentexpenseheads', require('./components/expense_heads/equipment/ViewEquipment.vue').default);


var app = new Vue({

    el: '#content'
});