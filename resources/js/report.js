require('./vue-assets');

import MonthlyReport from './components/report/MonthlyReport';
import EquipmentWiseReport from './components/report/EquipmentWiseReport';
import ProjectWiseReport from './components/report/ProjectWiseReport';


app = new Vue({
    el: '#content',
    components : {
        'monthly-report' : MonthlyReport,
        'equipment-wise-report' : EquipmentWiseReport,
        'project-wise-report' : ProjectWiseReport,
    }
})