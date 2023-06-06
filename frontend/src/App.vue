<template>
  <div>
    <nav>
      <button class="uk-button uk-button-default" type="button" aria-label="Logout" uk-tooltip="Sign Out"
        @click="logout()">
        <span uk-icon="icon:  sign-out"></span>
      </button>    
    </nav>
    <router-view />
  </div>
</template>


<script>

import axios from "axios";
import { useMainStore } from "./stores/mainStore";

export default {
  methods: {
    logout() {
      axios.post("/logout").then(
        setTimeout(function () {
          {
            window.location.assign("/");
          }
        }, 2000)
      );
    },

  },
  computed: {
    
  },
  mounted() {
    const store = useMainStore()
    store.getEmployees()
    store.getClasses(1)

  }
};
</script>



<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: white;
  background-color: #ffeae3;
  min-height: 100vw;
}

nav {
  padding: 30px;
  color: white;
}

nav a {
  font-weight: bold;
  color: white;
}

nav a.router-link-exact-active {
  color: #42b983;
}

.uk-button {
  border: none;
}

.uk-icon{
  color: black;
}
</style>
