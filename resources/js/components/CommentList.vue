<template>
  <div>
    <v-timeline align-top dense v-if="comments.length">
      <v-timeline-item
        v-for="(comment, index) in comments"
        :key="comment.id"
        small
      >
        <div>
          <div class="font-weight-normal">
            <strong>{{ comment.name }}</strong> @{{
              comment.created_at | moment("MMMM Do YYYY, h:mm:ss a")
            }}
          </div>
          <div>{{ comment.comment }}</div>
        </div>
        <comment-form
          v-if="comment.depth !== 2"
          :isReply="true"
          :commentIndex="index"
          :parentId="comment.id"
          :comments="comments"
        ></comment-form>
        <comment-list
          v-if="comment.children"
          :parentId="comment.id"
          :comments="comment.children"
        ></comment-list>
      </v-timeline-item>
    </v-timeline>
    <!-- <comment-form is-reply="false"></comment-form> -->
  </div>
</template>

<script>
import commentForm from "./CommentForm.vue";
import commentList from "./CommentList.vue";

export default {
  name: "commentList",
  props: {
    parentId: { type: Number, default: null },
    parent: { type: Array },
    comments: { type: Array },
  },
  components: {
    commentForm,
    commentList,
  },
};
</script>
