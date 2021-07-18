<template>
  <div class="book-list">
    <div  v-for="book in books">
      <h5 class="text-center">{{book.title.substring(0, 25)}}...</h5>
      <p>{{book.writer}}</p>
      <div class="btn-article text-center mb-3">
        <a :href="book.link" target="blank" class="btn btn-article">
          <i class="fas fa-download"></i> Download Book
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import client from "@/client";
export default {
  name: "book-list",
  components: {},
  mounted() {
    this.getBooks();
  },
  data() {
    return {
      books: ""
    };
  },
  methods: {
    getBooks() {
      client.get(window.location.origin + "/api/get-books").then(response => {
        this.books = response.data;
      });
    }
  }
};
</script>
<style scoped>
    .book-list{
        max-height: 600px;
        overflow-y: auto;
    }
</style>

