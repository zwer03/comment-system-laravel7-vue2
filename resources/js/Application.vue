<template>
  <div id="app">
      <component :is="this.$route.meta.layout">
        <router-view :key="$route.path" />
      </component>
  </div>
</template>

<script>
export default {
  name: "Application",
};
</script>

<style>
</style>