<template>
  <v-container>
    <v-row justify="space-around">
      <v-card>
        <v-img
          height="200px"
          src="https://cdn.pixabay.com/photo/2020/07/12/07/47/bee-5396362_1280.jpg"
        >
          <v-card-title class="white--text mt-8">
            <v-avatar size="56">
              <img
                alt="user"
                src="https://cdn.pixabay.com/photo/2020/06/24/19/12/cabbage-5337431_1280.jpg"
              />
            </v-avatar>
            <p class="ml-3">John Doe</p>
          </v-card-title>
        </v-img>

        <v-card-text>
          <!-- <pre>{{comments}}</pre> -->
          <div class="font-weight-bold ml-8 mb-2">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip ex ea commodo consequat. Duis aute irure dolor in
            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
            culpa qui officia deserunt mollit anim id est laborum.
          </div>
          <div class="ml-8 mb-2">
            <!-- <div>depth: {{ parentId }}</div> -->
            <comment-form :comments="comments"></comment-form>
          </div>
          <comment-list :comments="comments" :parentId="null"></comment-list>
        </v-card-text>
      </v-card>
    </v-row>
  </v-container>
</template>

<script>
import commentList from "../../components/CommentList.vue";
import commentForm from "../../components/CommentForm.vue";
import { commentService } from "../../services/comment.service.js";

export default {
  components: {
    commentList,
    commentForm,
  },
  async mounted() {
    console.log("Blog index Component mounted.");
    // if (this.parentId) {
    //   this.comments = this.children;
    //   return;
    // }
    let comments = await commentService.list();

    this.comments = comments.data;
  },
  data: () => ({
    comments: [],
  }),
};
</script>
