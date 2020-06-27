require('./vue-assets');

Vue.component('view-assigned-equipment', require('./components/bill/AssignedEquipmentList.vue').default);
Vue.component('bill-list', require('./components/bill/BillList.vue').default);


var app = new Vue({

    el: '#content'
     
});