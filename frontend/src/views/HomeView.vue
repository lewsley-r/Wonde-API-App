<template>
  <div v-if="!this.classLoading">
    <button class="uk-button uk-button-default uk-button-secondary" type="button" data-cy="select-teacher-btn">Select a Teacher</button>
    <div uk-dropdown="mode: click">
      <ul class="uk-nav uk-dropdown-nav">
        <li class="uk-active" v-for="employee in this.employees" v-bind:key="employee.upi">
          <a @click="this.store.selectEmployee(employee)" data-cy="listed-teacher">
            {{ employee.title }} {{ employee.forename }} {{ employee.surname }}
          </a>
          <hr class="uk-divider-icon">
        </li>
      </ul>
    </div>
    <div v-if="this.schedule.monday.length > 0">
      <div class="uk-card uk-card-default uk-card-body" >
        <h3 class="uk-card-title">Your Weekly Breakdown</h3>
        <h4 data-cy="select-teacher-card-name">{{ this.currentEmployee.title }} {{ this.currentEmployee.forename }} {{ this.currentEmployee.surname }}</h4>
        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div v-for="day in this.days" v-bind:key="day.id">
                <div class="day-card uk-card uk-card-default uk-card-body">
                  <h3>{{ day }}</h3>
                  <div v-for="group in this.schedule[day]" v-bind:key="group.className">
                    <div>
                      <small>Starts: {{ group.start }}</small>
                    </div>
                    <small>Ends: {{ group.end }}</small>
                    <h4>{{ group.className }}</h4>
                    <div v-for="student in group.students.data" v-bind:key="student.id">
                      {{ student.forename }} {{ student.surname }}
                    </div>
                    <hr class="uk-divider-icon">
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div v-else class="center">
      <h1>Please select a teacher to view their weekly schedule</h1>
    </div>
  </div>
  <div v-else-if="this.classLoading" class="center">
    <span uk-spinner="ratio: 4.5"></span>
    <h3>Fetching classes.....</h3>
  </div>
</template>

<script>
import { useMainStore } from "../stores/mainStore";



export default {
  name: "HomeView",
  components: {},

  data() {
    return {
      store: useMainStore(),
      days: ['monday', 'tuesday', 'wednesday', 'thursday', 'friday']

    };
  },

  created() {

  },

  methods: {
  

  },

  computed: {
    employees() {
      return this.store.employees
    },
    currentEmployee(){
      return this.store.currentEmployee
    },
    schedule(){
      return this.store.currentSchedule
    },
    classLoading(){
      return this.store.classLoading
    }

  },
};
</script>

<style scoped>
.uk-dropdown{
  height: 15vh;
  overflow-y: scroll;
}

.uk-card{
  margin: 5vh ;
  border-radius: 5px;
}

.day-card{
  background-color: #4368fa;
  color: white;
  height: 50vh;
  overflow-y: scroll;
}

.uk-nav > li > a {
  padding: 10px;
}

.uk-nav > li > a:hover {
  color: lightgray
}

.center {
  margin-top: 25vh;
}



</style>
