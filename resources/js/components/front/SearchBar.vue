<template>
  <div >
    <div id="myOverlay" class="overlay" v-if="showSearchBar">
      <span class="closebtn" @click="closeSearch()" title="Close Overlay">×</span>
      <div class="overlay-content">
        <form>
          <input
            type="text"
            placeholder="Type to Search.."
            @keyup="search()"
            v-model="key"
            name="search"
            class="form-control"
          />

        </form>
      </div>
    </div>
    <button class="openBtn" @click="showSearchBardiv()">
      <i class="fas fa-search"></i>
    </button>
    <show-search-question v-if="showSearchAns" :questions="questions"> </show-search-question>
  </div>
</template>

<script>
import client from "@/client";
import ShowSearchQuestion from "./ShowSearchQuestion.vue";
export default {
  name: "search-bar",
  components: {ShowSearchQuestion},
  data() {
    return {
      key: "",
      questions: "",
      showSearchAns: false,
      showSearchBar: true
    };
  },
  methods: {
    search() {
      if (this.key.length > 0) {
        client
          .get(window.location.origin + "/api/get-search?key=" + this.key)
          .then(response => {
            console.log(response);
            this.questions = response.data;
            this.showSearchAns = true;
          });
      }
      else{
          this.showSearchAns = false;
      }
    },
    closeSearch(){
      console.log("clonw")
      this.showSearchAns = false;
      this.showSearchBar = false;
      this.questions = "";
      $("#myOverlay").hide();
    },
    showSearchBardiv(){
      $("#myOverlay").show();
      this.showSearchBar = true
    }
  }
};
</script>

