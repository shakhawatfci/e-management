require('./vue-assets');

import MonthlyReport from './components/report/MonthlyReport';


app = new Vue({
    el: '#content',
    components : {
        'monthly-report' : MonthlyReport,
    }
})