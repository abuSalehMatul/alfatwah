<template>
  <div>
    <a :href="getQuestionLink(mostRead)"  v-for="(mostRead, index) in mostReads">
      <div class="card">
        <div class="card-body">
          <div class="left-text">
            <span class="short-query two-line" v-html="mostRead.description">
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
  name: "most-read",
  components: {},
  props: ['app_local'],
  data() {
    return {
        mostReads: ""
    };
  },
  mounted(){
      this.getMostRead();
  },
  methods:{
      getMostRead(){
          client.get(window.location.origin + "/api/get-most-read")
          .then(response =>{
              this.mostReads = response.data;
          })
      },
       getQuestionLink(question){
          return window.location.origin +"/"+ question.language+ "/get-question-answer/"+question.id;
      },
  }
};
</script>

