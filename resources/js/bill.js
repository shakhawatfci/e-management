require('./vue-assets');

Vue.component('view-assigned-equipment', require('./components/bill/AssignedEquipmentList.vue').default);


var app = new Vue({

    el: '#content'
});