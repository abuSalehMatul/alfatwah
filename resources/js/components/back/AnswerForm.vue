<template>
  <div>
    <div class="row">
      <div class="card-title">
        <h3>
          <i class="badge badge-info">id: {{ questionAns.id }}</i>
          <b>{{ questionAns.title }}</b>
          <i class="">(Question Status:{{ questionAns.status }})</i>
        </h3>
      </div>
      <div class="card-body">{{ questionAns.description }}</div>
    </div>
    <hr />
    <br />
    <h3>Choose language to give answer</h3>
    <div class="row offset-1">
      <label style="margin: 10px; cursor: pointer">
        <input
          type="radio"
          value="en"
          v-model="lang"
          @change="getAnswer()"
        />English
      </label>
      <label style="margin: 10px; cursor: pointer">
        <input
          type="radio"
          value="bn"
          v-model="lang"
          @change="getAnswer()"
        />Bangla
      </label>
      <label style="margin: 10px; cursor: pointer">
        <input
          type="radio"
          value="ar"
          v-model="lang"
          @change="getAnswer()"
        />Arabic
      </label>
    </div>
    <div class="">
      <i>
        Answer Status: <b class="badge badge-info">{{ status }}</b></i
      >
      <br />
      <label>Add A tag for this Answer</label>
      <input type="text" v-model="tag" />
      <span v-if="role == 'admin'">
        <label> Change Answer Status</label>
        <select v-model="status" @change="changeStatus()">
          <option value="active">Active</option>
          <option value="pending">Pending</option>
          <option value="inactive">InActive</option>
          <option value="denied">Denied</option>
          <option value="in-revision">In Revision</option>
        </select>
      </span>
    </div>
    <hr />
    <div>
      <label>Question Title:</label>
      <editor
        v-model="langQuestionTitle"
        :init="{
          plugins: [
           'autolink lists link  preview anchor',
           'searchreplace visualblocks fullscreen',
           'insertdatetime paste'
         ],
          toolbar:
            'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        }"
      />
      <hr />
      <label>Question</label>
      <editor
        v-model="langQuestion"
        :init="{
          plugins: [
           'autolink lists link  preview anchor',
           'searchreplace visualblocks fullscreen',
           'insertdatetime paste'
         ],
          toolbar:
            'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        }"
      />
      <hr />
      <hr />
      <label>Answer Title:</label>
      <editor
        v-model="answerTitle"
        :init="{
          plugins: [
           'autolink lists link  preview anchor',
           'searchreplace visualblocks fullscreen',
           'insertdatetime paste'
         ],
          toolbar:
            'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        }"
      />
      <hr />
      <label>Answer</label>
      <editor
        v-model="answer"
        :init="{
          height: 500,
          plugins: [
           'autolink lists link  preview anchor',
           'searchreplace visualblocks fullscreen',
           'insertdatetime paste'
         ],
          toolbar:
            'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        }"
      />
    </div>
    <div>
      <button
        class="btn btn-primary"
        style="width: 100%"
        @click.prevent="save()"
      >
        Save
      </button>
    </div>
  </div>
</template>

<script>
import client from "@/client";
import Editor from "@tinymce/tinymce-vue";
export default {
  name: "answer-form",
  props: ["question_id", "role"],
  components: {
    editor: Editor,
  },
  mounted() {
    this.getAnswer();
  },
  data() {
    return {
      renderComponent: true,
      lang: "en",
      langQuestionTitle: "",
      langQuestion: "",
      questionAns: "",
      answerTitle: "",
      answer: "",
      status: "",
      tag: "",
      answerId: "",
    };
  },
  methods: {
    forceRerender() {
      // Remove my-component from the DOM
      this.renderComponent = false;

      this.$nextTick(() => {
        // Add the component back in
        this.renderComponent = true;
      });
    },
    getAnswer() {
      this.forceRerender();
      client
        .get(
          window.location.origin +
            "/admin/api/get-question/" +
            this.lang +
            "/" +
            this.question_id
        )
        .then((response) => {
          this.questionAns = response.data;
          let answer = "answer_" + this.lang;

          this.langQuestionTitle = this.questionAns[answer].question_title;
          this.langQuestion = this.questionAns[answer].question;

          this.answer = this.questionAns[answer].description;
          this.answerTitle = this.questionAns[answer].title;
          this.status = this.questionAns[answer].status;
          this.tag = this.questionAns[answer].tag;
          this.answerId = this.questionAns[answer].id;
        });
    },
    save() {
      let data = new FormData();
      data.append("answer_title", this.answerTitle);
      data.append("question_title", this.langQuestionTitle);
      data.append("question", this.langQuestion);
      data.append("answer", this.answer);
      data.append("question_id", this.question_id);
      data.append("lang", this.lang);
      data.append("tag", this.tag);
      client
        .post(window.location.origin + "/admin/api/save-answer", data)
        .then((response) => {
          console.log(response.data);
          if (response.data == 1) {
            alert("Update successful");
            this.getAnswer();
          } else {
            alert("Please try again later, something went wrong");
          }
        });
    },
    changeStatus() {
      client
        .get(
          window.location.origin +
            "/admin/api/change-answer-status/" +
            this.status +
            "/" +
            this.answerId
        )
        .then((response) => {
          if (response.data == 1) {
            alert("Status Changed");
          } else {
            alert("Something went wrong, please try again");
          }
        });
    },
  },
};
</script>

