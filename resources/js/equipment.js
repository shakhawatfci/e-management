require('./vue-assets');
Vue.component('create-equipment', require('./components/equipment/CreateEquipment.vue').default);
Vue.component('view-equipment', require('./components/equipment/ViewEquipment.vue').default);
// equipemnt type 
Vue.component('create-equipment-type', require('./components/equipment-type/CreateEquipmentType.vue').default);
Vue.component('view-equipment-type', require('./components/equipment-type/ViewEquipmentType.vue').default);

Vue.component('create-quotation', require('./components/quotation/CreateQuotation.vue').default);
Vue.component('view-quotation', require('./components/quotation/ViewQuotation.vue').default);


var app = new Vue({
    el: '#content'
});