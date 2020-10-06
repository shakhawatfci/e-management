<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import { Line } from 'vue-chartjs'

export default {
props : ['chart_data'],
 extends: Line,
    data(){
        return {
           
           month : [],
           project_claim      : [],
           vendor_claim       : [],
           bill_profit        : [],
           project_payment    : [],
           vendor_payment     : [],
           total_expense      : [],
           net_profit         : [],
           gradient1 : null,
           gradient2 : null,
           gradient3 : null,
           gradient4 : null,
           gradient5 : null,
           gradient6 : null,
           gradient7 : null,

        }
    },

    mounted(){
     
     this.setupStyle();
     this.buildChartData();

    },

    methods : {

    setupStyle(){

    this.gradient1 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 450);
    this.gradient1.addColorStop(0, "rgba(5, 203, 225, 0.7)");
    this.gradient1.addColorStop(0.5, "rgba(130,229, 240, 0.25)");
    this.gradient1.addColorStop(1, "rgba(130, 229, 	240, 0)");

    this.gradient2 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 250);
    this.gradient2.addColorStop(0, "rgba(255, 23, 127, 0.7)");
    this.gradient2.addColorStop(0.5, "rgba(229, 39, 124, 0.25)");
    this.gradient2.addColorStop(1, "rgba(234, 82, 150, 0)");


    this.gradient3 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 350);
    this.gradient3.addColorStop(0, "rgba(241, 84, 4, 0.7)");
    this.gradient3.addColorStop(0.5, "rgba(255, 114, 42, 0.25)");
    this.gradient3.addColorStop(1, "rgba(255, 142, 84, 0)");


    this.gradient4 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 340);
    this.gradient4.addColorStop(0, "rgba(255, 255, 0, 0.7)");
    this.gradient4.addColorStop(0.5, "rgba(255, 255, 25, 0.25)");
    this.gradient4.addColorStop(1, "rgba(255, 255, 117, 0)");


    this.gradient5 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 350);
    this.gradient5.addColorStop(0, "rgba(255,0, 0, 0.7)");
    this.gradient5.addColorStop(0.5, "rgba(255, 0, 0, 0.25)");
    this.gradient5.addColorStop(1, "rgba(255, 0, 0, 0)");


    this.gradient6 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 350);
    this.gradient6.addColorStop(0, "rgba(0, 255, 0, 0.7)");
    this.gradient6.addColorStop(0.5, "rgba(0, 255, 0, 0.25)");
    this.gradient6.addColorStop(1, "rgba(0, 255, 0, 0)");


    this.gradient7 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 350);
    this.gradient7.addColorStop(0, "rgba(217, 215, 250, 0.7)");
    this.gradient7.addColorStop(0.5, "rgba(217, 215, 250, 0.25)");
    this.gradient7.addColorStop(1, "rgba(217, 215 , 250, 0)");

  	},   
      
    generateChart(){
  	 this.renderChart(
      {
        labels: this.month,
        datasets: [
          {
            label: "Project Bill",
            borderColor: "#E3106E",
            pointBackgroundColor: "white",
            pointBorderColor: "#E3106E",
            pointBorderWidth:5,
            borderWidth: 2,
            backgroundColor: this.gradient2,
            data: this.project_claim,
          },
         {
            label: "Vendor Bill",
            borderColor: "#05CBE1",
            pointBackgroundColor: "white",
            pointBorderColor: "#05CBE1",
            pointBorderWidth:5,
            borderWidth: 2,
            backgroundColor: this.gradient1,
            data: this.vendor_claim,
          },
         {
            label: "Bil Profit",
            borderColor: "#F15404",
            pointBackgroundColor: "white",
            pointBorderColor: "#F15404",
            pointBorderWidth:5,
            borderWidth: 2,
            backgroundColor: this.gradient3,
            data: this.bill_profit,
          },
         {
            label: "Project Payment",
            borderColor: "#FFFF00",
            pointBackgroundColor: "#FFFF00",
            pointBorderColor: "#FFFF00",
            pointBorderWidth:5,
            borderWidth: 2,
            backgroundColor: this.gradient4,
            data: this.project_payment,
          },

          {
            label: "Vendor Payment",
            borderColor: "#D9D7FA",
            pointBackgroundColor: "#D9D7FA",
            pointBorderColor: "#D9D7FA",
            pointBorderWidth:5,
            borderWidth: 2,
            backgroundColor: this.gradient7,
            data: this.vendor_payment,
          },

         {
            label: "Total Expense",
            borderColor: "red",
            pointBackgroundColor: "red",
            pointBorderColor: "red",
            pointBorderWidth:5,
            borderWidth: 2,
            backgroundColor: this.gradient5,
            data: this.total_expense,
          },
         {
            label: "Net Profit",
            borderColor: "#00CD00",
            pointBackgroundColor: "#00CD00",
            pointBorderColor: "#00CD00",
            borderWidth: 2,
            backgroundColor: this.gradient6,
            data: this.net_profit,
          }
        ],
      },
      { responsive: true, maintainAspectRatio: false }
    );
      },
      
     buildChartData()
     {

         let month_level       =    this.chart_data.map(m => m.month);
         let project_bill      =    this.chart_data.map(p_claim => p_claim.project_bill_amount);
         let vendor_bill       =    this.chart_data.map(v_claim => v_claim.vendor_bill_amount);
         let bill_profit       =    this.chart_data.map(data=> data.bill_profit);
         let project_payment   =    this.chart_data.map(data=> data.project_payment);
         let vendor_payment   =    this.chart_data.map(data=> data.vendor_payment);
         let total_expense     =    this.chart_data.map(data=> data.total_expense);
         let net_profit        =    this.chart_data.map(data=> data.bill_profit);

         this.month = month_level;
         this.project_claim = project_bill;
         this.vendor_claim = vendor_bill;
         this.bill_profit = bill_profit;
         this.project_payment = project_payment;
         this.vendor_payment = vendor_payment;
         this.total_expense = total_expense;
         this.net_profit = net_profit;

         this.generateChart();
         
     } 

    }
}
</script>