<template>
  <div>
    <div class="row">
      <div class="row mt-2 col-md-12">
        <div v-for="category in categories" class="col-md-3 col-sm-3 col-4 mt-2 cat-border-bottom">
          <a class="col-md-12 category" :href="getCategoryHref(category.id)">
            <span>{{category.name}}</span> <span :id="'cat'+category.id">{{getCount(category.id)}} </span>
          </a>
        </div>
      </div>
    </div>
    <!-- <category-questions :categories="categories" :app_local="app_local"></category-questions> -->
  </div>
</template>

<script>
import client from "@/client";
import CategoryQuestions from "./CategoryQuestions.vue";
export default {
  name: "category-with-short-list",
  components: {
    CategoryQuestions
  },
  props: ["app_local"],
  mounted() {
    if(this.app_local == "ar"){
        this.see = 'اظهار الكل';
    }
    else if(this.app_local == "bn"){
        this.see = 'সবগুলো দেখ'
    }
    this.getCategory();
    this.getMedia();
  },
  data() {
    return {
      categories: "",
      see: "See All",
      names: [],
      medias: "",
      parent_id: [],
      catCount: {}
    };
  },
  methods: {
    getMedia() {
      client
        .get(window.location.origin + "/api/get-media-show/"+this.app_local)
        .then(response => {
          this.medias = response.data.data;
        });
    },
    getCategory() {
      client
        .get(window.location.origin + "/api/get-category")
        .then(response => {
          this.categories = response.data;
          console.log(response);
        });
    },
    getCount(catId){
      client.get(window.location.origin + "/api/question-by-cat-id/"+ catId)
      .then(res => {
        console.log('count',res)
         $("#cat"+catId).html("("+res.data + ")");
      })
    },
    getCategoryHref(id) {
      return window.location.origin + "/" + this.app_local + "/category/" + id;
    },
    getAllMediaLink(){
        return window.location.origin + "/"+ this.app_local + "/all-media"
    }
  }
};
</script>

