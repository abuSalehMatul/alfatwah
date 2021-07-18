<template>
  <div>
    <div class="search-admin">
      <a :href="getQuestionLink(question)" class="per-question" v-for="question in questions">
        <div class="card active">
          <div class="card-body">
            <div class="left-text">
              <i class="far fa-bookmark"></i>
              <span>{{question.title}}</span>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</template>

<script>
import client from "@/client";
export default {
  name: "search-questions",
  components: {},
  props: ["questions"],
  data() {
    return {};
  },
  methods:{
      getQuestionLink(question){
          return window.location.origin + "/admin/question/"+question.id;
      }
  }
};
</script>
<style scoped>
.per-question{
    margin:5px;
    box-shadow: 2px 2px gainsboro;
    font-weight: 700;
    font-size: 19px;
}
.search-admin{
    background: rgb(240, 52, 52);
    color: black;
    position: fixed;
    left: 15%;
    top: 10%;
    width: 85%;
    border-radius: 15px;

}
</style>

