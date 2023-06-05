<template>
  <div>
    <nav>
     

     
      <button class="uk-button uk-button-default" type="button" aria-label="Logout" uk-tooltip="Admin Panel"
        @click="goToAdmin()" v-if="isAdmin">
        <span uk-icon="icon:  lock"></span>
      </button>
      <button class="uk-button uk-button-default" type="button" aria-label="Logout" uk-tooltip="Sign Out"
        @click="logout()">
        <span uk-icon="icon:  sign-out"></span>
      </button>
      <button class="uk-button uk-button-default" type="button" aria-label="test" uk-tooltip="test"
        @click="test()">
        <span uk-icon="icon:  lock"></span>
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
            window.location.assign("/home");
          }
        }, 2000)
      );
     
    },
    async test(){

      const response = await axios.get('/api/class', {params: {class_id: 'A1884218389'}});
      if (response) {
        console.log(response)
      }
      
       
    },
    goToAdmin(){
        window.location.assign('/admin')
    }
  },
  computed: {
    isAdmin() {
      const store = useMainStore()
      return store.user.roleId == 1
    }
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
  background-color: #A9CEF4;
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
