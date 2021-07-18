<template>
  <div>
    <div class="col-md-12 p-0">
       <by-answer-report></by-answer-report>
       <answer-statistics> </answer-statistics>
    </div>
  </div>
</template>

<script>

import ByAnswerReport from "./ByAnswerReport.vue"
import AnswerStatistics from "./AnswerStatistice.vue"

export default {
  name: "admin-report",
  components: {ByAnswerReport, AnswerStatistics},
  data() {
    return {
     
    };
  }

};
</script>
