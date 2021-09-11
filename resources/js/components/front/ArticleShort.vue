<template>
  <div>
    <a :href="getArticleLink(article)" v-for="(article, index) in articles">
      <div class="card">
        <div class="card-body">
          <div class="left-text">
            <span class="short-query two-line" v-html="article.title"></span>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
import client from "@/client";
export default {
  name: "article-short",
  components: {},
  data() {
    return {
      articles: ""
    };
  },
  mounted() {
    this.getArticle();
  },
  methods: {
    getArticle() {
      client
        .get(window.location.origin + "/api/get-articles")
        .then(response => {
          this.articles = response.data;
        });
    },
    getArticleLink(article){
      return window.location.origin +"/"+ article.language+ "/article/"+article.id;
    }
  }
};
</script>

