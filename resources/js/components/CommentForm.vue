<template>
  <div>
      <div>{{depth}}</div>
    <v-btn
      class="ma-2"
      outlined
      small
      fab
      color="teal"
      @click="showCommentForm"
      v-if="isReply"
    >
      <v-icon>mdi-reply</v-icon>
    </v-btn>
    <div v-show="appear">
      <validation-observer ref="observer" v-slot="{ invalid }">
        <form @submit.prevent="submit">
          <validation-provider v-slot="{ errors }" name="Name" rules="required">
            <v-text-field
              v-model="name"
              :error-messages="errors"
              label="Name"
              required
            ></v-text-field>
          </validation-provider>
          <validation-provider
            v-slot="{ errors }"
            name="Comment"
            rules="required"
          >
            <v-text-field
              v-model="comment"
              :error-messages="errors"
              label="Comment"
              required
            ></v-text-field>
          </validation-provider>

          <v-btn class="mr-4" type="submit"> submit </v-btn>
          <!-- <v-btn @click="clear"> clear </v-btn> -->
        </form>
      </validation-observer>
    </div>
  </div>
</template>

<script>
import { required } from "vee-validate/dist/rules";
import {
  extend,
  ValidationObserver,
  ValidationProvider,
  setInteractionMode,
} from "vee-validate";
import { commentService } from "../services/comment.service.js";

setInteractionMode("passive");

extend("required", {
  ...required,
  message: "{_field_} can not be empty",
});

export default {
  props: ["depth", "parentId", "comments", "isReply", "commentIndex"],
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  mounted() {
    if (!this.isReply) this.appear = true;
  },
  data: () => ({
    name: "",
    comment: "",
    appear: false,
  }),

  methods: {
    async submit() {
      this.$refs.observer.validate();
      const data = {
        name: this.name,
        comment: this.comment,
        parent_id: this.parentId,
      };

      const new_comment = await commentService.store(data);
      if (this.parentId) {
          new_comment.data.children = [];
          new_comment.data.new = true;
          this.comments[this.commentIndex].children.unshift(new_comment.data);
      } else {
          new_comment.data.children = [];
          this.comments.unshift(new_comment.data);
      }

      this.clear();
    //   this.focus();
      this.showCommentForm = false;
    },
    clear() {
      this.name = "";
      this.comment = "";
      this.$refs.observer.reset();
    },
    showCommentForm() {
      this.appear ^= true;
    },
  },
};
</script>
