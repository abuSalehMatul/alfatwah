<template>
  <div>
    <div class="row">
      <div class="col-md-4 col-sm-4 p-0">
        <h4 class="text-center">Questions By Answered</h4>
        <canvas id="question_report_by_answered" height="250"></canvas>
      </div>

      <div class="col-md-4 col-sm-4 p-0">
        <h4 class="text-center">Questions By Status</h4>
        <canvas id="question_report_status" height="250"></canvas>
      </div>
    </div>
  </div>
</template>

<script>
import Chart from "chart.js";
import client from "@/client";

export default {
  name: "by-answer-report",
  data() {
    return {
      donutChartData: "",
      data: [],
      status: [],
      myChart: "",
      myChartByStatus: ""
    };
  },
  mounted() {
    this.getByasnwered();
    this.getByStatus();
  },
  methods: {
    getByStatus() {
      client
        .get(window.location.origin + "/admin/api/question-doughnut-by-status")
        .then(response => {
          this.status = response.data;
          this.showDoughnutChartByStatus();
        });
    },
     showDoughnutChartByStatus() {
      var ctx2 = document
        .getElementById("question_report_status")
        .getContext("2d");
      this.myChartByStatus = new Chart(ctx2, {
        type: "doughnut",
        data: {
          labels: ["Active", "InActive", "Pending", "Denied", "InRevision"],
          datasets: [
            {
              data: [
                this.status.active,
                this.status.inactive,
                this.status.pending,
                this.status.denied,
                this.status.in_revision
              ],
              backgroundColor: [
                "#49f45d",
                "#f44949",
                "#25b4f7",
                "#26030e",
                "#f7f067"
              ],
              borderColor: ["#25b4f7"],
              borderWidth: 1
            }
          ]
        },
        options: {
          responsive: true
        }
      });
    },



    getByasnwered() {
      client
        .get(
          window.location.origin + "/admin/api/question-doughnut-by-answered"
        )
        .then(response => {
          this.data = response.data;
          this.showDoughnutChartByAnswered();
        });
    },
    showDoughnutChartByAnswered() {
      var ctx = document
        .getElementById("question_report_by_answered")
        .getContext("2d");
      this.myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: ["Answered", "Unanswered"],
          datasets: [
            {
              data: [this.data.answered, this.data.unanswered],
              backgroundColor: ["#25b4f7", "#f7f067"],
              borderColor: ["#25b4f7", "#f7f067"],
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

<style  scoped>
.color-box {
  width: 10px;
  height: 10px;
  display: block;
  margin: 6px;
}
.align-center {
  display: table;
  margin: 10px auto -35px auto;
}
</style>