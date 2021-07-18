<template>
  <div>
    <ul class="nav nav-tabs">
      <li class="nav-item " v-for="(category, index) in categories">
        <a
          nowrap
          class="nav-link"
          :class="{ 'active': index === 0 }"
          data-toggle="tab"
          @click.prevent = "loadForCategory(category.id)"
        >{{category.name}}</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div id="home" class="container tab-pane active">
        <br />
        <div class="container">
          <div class="row">
            <div class="col-md-4" v-for="(question, index) in questions" v-if="index < 3">
              <a @click.prevent="getToQuestionsAnswerLink(question.id)">
                <div class="card">
                  <div class="card-body">
                    <div class="left-text">
                      <i class="far fa-bookmark"></i>
                      <span>{{question.description.substring(0, 100)}}...</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="row">
            <div
              class="col-md-4"
              v-for="(question, index) in questions"
              v-if="index > 2 && index < 6"
            >
              <a @click.prevent="getToQuestionsAnswerLink(question.id)">
                <div class="card">
                  <div class="card-body">
                    <div class="left-text">
                      <i class="far fa-bookmark"></i>
                      <span>{{question.description}}</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <a :href="getCategoryHref()" style="float: right;color: #ed174b;">See more...</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import client from "@/client";
export default {
  name: "category-questions",
  components: {},
  props: ["categories", "app_local"],
  mounted() {
    console.log(this.categories);
   
  },
  watch: {
    categories: function(newVal) {
      this.selectedCategoryId = newVal[0].id;
       this.getQuestions();
    }
  },
  data() {
    return {
      selectedCategoryId: "",
      questions: ""
    };
  },
  methods: {
    getQuestions() {
      client
        .get(
          window.location.origin +
            "/api/get-category-based-question/" +
            this.selectedCategoryId
        )
        .then(response => {
          this.questions = response.data.data;
        });
    },
    loadForCategory(categoryId){
        this.selectedCategoryId = categoryId;
        this.getQuestions();
    },
    getCategoryHref(){
         return window.location.origin + "/"+this.app_local + "/category/" + this.selectedCategoryId;
    },
    getToQuestionsAnswerLink(id){
        window.location.href =  window.location.origin +"/"+ this.app_local+ "/get-question-answer/"+id;
    }
  }
};
</script>

