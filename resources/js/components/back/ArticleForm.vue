<template>
  <div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-12">
        <div class="white-box">
            <div class="form-group col-md-12 col-sm-12">
              <label>Title </label>
              <input
                type="text"
                v-model="title"
                placeholder="Title of Article"
                class="form-control col-12 col-md-12"
                required
              />
            </div>
            <div class="col-md-12 col-sm-6 form-group d-flex">
              <div
                class="
                  col-md-8 col-sm-8 col-12
                  pl-0
                  pr-md-2 pr-0 pr-sm-2 pr-xl-2
                "
              >
                <label>Category</label>
                <select class="form-control" v-model="category" required>
                  <option
                    v-for="category in allCategories"
                    :value="category.id"
                  >
                    {{ category.name_en }}/{{ category.name_bn }}/{{
                      category.name_ar
                    }}
                  </option>
                </select>
              </div>
              <div class="col-md-4 col-sm-4 col-12 p-0">
                <label>Language</label>
                <select class="form-control" v-model="lang" required>
                  <option v-for="(value, index) in allLangs" :value="index">
                    {{ value }}
                  </option>
                </select>
              </div>
            </div>
            <br />
            <hr />
            <div class="form-group col-md-12">
              <label>Aritcle </label>
              <editor
                v-model="body"
                :init="{
                  plugins: ['link image paste wordcount'],
                  toolbar:
                    'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | help',
                }"
              />
            </div>
            <div class="form-group col-md-12 col-sm-12">
              <button @click="saveArticle()" class="btn btn-primary w-100">
                Save Article
              </button>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Editor from "@tinymce/tinymce-vue";
export default {
  name: "article-form",
  props: ["categories", "langs", "save_article", 'article_title', 'article_cat',
        "article_id", 'article_body', 'article_edit', 'article_lang'],
  components: {
    editor: Editor,
  },
  data() {
    return {
      allCategories: JSON.parse(this.categories),
      allLangs: JSON.parse(this.langs),
      body: this.article_body ?? "",
      category: this.article_cat ?? JSON.parse(this.categories)[0].id ?? "",
      lang: this.article_lang ?? "en",
      title: this.article_title ?? "",
    };
  },
  methods: {
    saveArticle() {
      let ifEdit = 0;
      let data = new FormData();
      data.append("category", this.category);
      data.append("lang", this.lang);
      data.append("body", this.body);
      data.append("title", this.title);
      data.append("csrf_token", window.csrf_token);
      if(typeof this.article_edit !="undefined" && this.article_edit == "yes"){
          data.append("article_id", this.article_id);
          ifEdit = 1;
      }
      axios.post(this.save_article, data)
      .then((res) => {
          if(ifEdit == 0)
          window.location.href = res.data;
          else window.location.reload();
      })
      .catch(e=>{
          alert(e)
      });
    },
  },
};
</script>

