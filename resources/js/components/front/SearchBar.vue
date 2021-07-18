<template>
  <div>
    <div id="myOverlay" class="overlay">
      <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
      <div class="overlay-content">
        <form>
          <input
            type="text"
            placeholder="Type to Search.."
            @keyup="search()"
            v-model="key"
            name="search"
          />
          <button type="submit">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>
    </div>
    <button class="openBtn" onclick="openSearch()">
      <i class="fas fa-search"></i>
    </button>
    <show-search-question v-if="show" :questions="questions"> </show-search-question>
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
      show: false
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
            this.show = true;
          });
      }
      else{
          this.show = false;
      }
    }
  }
};
</script>

