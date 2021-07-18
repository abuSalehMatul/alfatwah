<template>
  <div>
    <a v-for="(answer, index) in newAnswers" @click.prevent="getAnswer(answer)" v-if="index < 5">
      <div class="card">
        <div class="card-body">
          <div class="left-text">
            <!-- <i class="far fa-bookmark"></i> -->
            <span class="short-query two-line" v-html="answer.description"></span>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
import client from "@/client";
export default {
  name: "new-answer",
  components: {},
  data() {
    return {
      newAnswers: ""
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      client.get(window.location.origin + "/api/new-answers").then(response => {
        this.newAnswers = response.data;
      });
    },
    getAnswer(answer) {
      window.location.href =  window.location.origin +"/"+ answer.language +"/answer/" + answer.batch_id  ;
    }
  }
};
</script>

