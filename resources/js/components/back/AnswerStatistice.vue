<template>
  <div>
    <div class="col-md-4 col-sm-4 p-0">
      <h4>Answer Statistics Chart</h4>
      <input type="date" v-model="dateRange.fromDate" @change="dateFilter" />
      To
      <input type="date" v-model="dateRange.toDate" @change="dateFilter" />
      <canvas id="barChart"  height="250"></canvas>
    </div>
  </div>
</template>

<script>
import Chart from "chart.js";
import client from "@/client";
export default {
  name: "answer-statistics",
  components: {},
  mounted() {
    this.setFromDate();
    this.getData();
  },
  data() {
    return {
      dateRange: {
        fromDate: "",
        toDate: new Date().toISOString().substr(0, 10)
      },
      barChartApiData: "",
      levels: [],
      myChart: "",
      data: []
    };
  },
  methods: {
    dateFilter() {
      if (typeof this.myChart != "undefined") {
        this.myChart.destroy();
      }
      this.getData();
    },
    setFromDate() {
      let currentDate = new Date();
      currentDate.setMonth(currentDate.getMonth() - 1);
      this.dateRange.fromDate = currentDate.toISOString().substr(0, 10);
    },
    getData() {
      client
        .get(
          window.location.origin +
            "/admin/api/get-by-answer-stat" +
            "?fromDate=" +
            this.dateRange.fromDate +
            "&toDate=" +
            this.dateRange.toDate
        )
        .then(response => {
          this.barChartApiData = response.data;
          console.log(response.data)
          this.levels = [];
          this.data = [];
          this.barChartApiData.forEach(el => {
            this.levels.push(el.status);
            this.data.push(el.count);
          });
          this.barChart();
        });
    },
    barChart() {
      console.log(this.levels);
      var ctx = document.getElementById("barChart").getContext("2d");
      this.myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: this.levels,
          datasets: [
            {
              data: this.data,
              backgroundColor: ["#25b4f7", "#f7f067", "#68f29d", "#68f2ef", "#a2dcf9"],
              borderColor: ["#25b4f7", "#f7f067", "#68f29d", "#68f2ef", "#a2dcf9"],
              borderWidth: 1
            }
          ]
        },
        options: {
          responsive: true
        }
      });
    }
  }
};
</script>

