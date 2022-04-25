<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app>
      <v-list dense>
        <router-link to="/" tag="v-list-item" link>
          <v-list-item-action>
            <v-icon>mdi-monitor-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </router-link>
        <router-link to="/" tag="v-list-item" link>
          <v-list-item-action>
            <v-icon>mdi-home-analytics</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Blog</v-list-item-title>
          </v-list-item-content>
        </router-link>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app color="indigo" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>Comment System</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-menu bottom left>
        <template v-slot:activator="{ on, attrs }">
          <v-btn dark icon v-bind="attrs" v-on="on">
            <v-icon>mdi-bell</v-icon>
          </v-btn>
        </template>
      </v-menu>
      <v-btn text> <v-icon>mdi-logout</v-icon>Logout </v-btn>
    </v-app-bar>

    <v-main>
      <v-container>
        <router-view :key="$route.path" />
      </v-container>
    </v-main>
    <v-footer color="indigo" app>
      <span class="white--text">&copy; 2019</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  mounted() {},
  props: {
    source: String,
  },
  data: () => ({
    drawer: null,
  }),

  methods: {},
  computed: {},
};
</script>