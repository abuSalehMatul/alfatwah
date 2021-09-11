<template>
  <div class="search_bar card active">
    <a :href="getQuestionLink(question)" v-for="question in questions">
      <div class="">
        <div class="card-body">
          <div class="left-text">
            <i class="far fa-bookmark"></i>
            <span>{{question.title}}</span>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
import client from "@/client";
export default {
  name: "show-search-question",
  components: {},
  props: ["questions"],
  data() {
    return {};
  },
  methods: {
    getQuestionLink(question) {
      return (
        window.location.origin +
        "/" +
        question.language +
        "/get-question-answer/" +
        question.id
      );
    }
  }
};
</script>
<style scoped>
    .search_bar{
        position: fixed;
        top: 15%;
        left: 5%;
        width: 90%;
        z-index: 111;
    }
</style>

