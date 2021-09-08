<template>
  <div>
    <a :href="getQuestionLink(question)" v-for="question in selectedQuestion"  v-if="question.answers.length > 0">
      <div class="card active">
        <div class="card-body">
          <div class="left-text">
            <span class="short-query two-line" v-html="question.answers[0].question_title">
            </span>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
import client from "@/client";
export default {
  name: "selected-question",
  components: {},
  mounted(){
      this.getList();
  },
  data() {
    return {
        selectedQuestion: ""
    };
  },
  methods: {
      getList(){
          client.get(window.location.origin + "/api/selected-question")
          .then(response => {
              this.selectedQuestion = response.data;
              console.log("selected question", this.selectedQuestion);
          })
      },
      getQuestionLink(question){
          return window.location.origin +"/"+ question.language+ "/get-question-answer/"+question.id;
      },
      
  }
};
</script>

