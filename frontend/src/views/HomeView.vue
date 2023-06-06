<template>
  <div>
    <button class="uk-button uk-button-default uk-button-secondary" type="button">Select a Teacher</button>
    <div uk-dropdown="mode: click">
      <ul class="uk-nav uk-dropdown-nav">
        <li class="uk-active" v-for="employee in this.employees" v-bind:key="employee.upi">
          <a @click="this.store.selectEmployee(employee.upi)">
            {{ employee.title }}  {{ employee.forename }} {{ employee.surname }}
          </a>
        </li>
      </ul>
    </div>
    <div v-if="this.schedule.monday!=[]">
      <div class="uk-card uk-card-default uk-card-body" >
        <h3 class="uk-card-title">Your Weekly Breakdown</h3>
        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div v-for="day in this.days" v-bind:key="day.id">
                <div class="day-card uk-card uk-card-default uk-card-body">
                  <h3>{{ day }}</h3>
                  <div v-for="group in this.schedule[day]" v-bind:key="group.className">
                    <div>
                    <small><bold>Starts:</bold> {{ group.start }}</small>

                    </div>
                    <small><bold>Ends:</bold> {{ group.end }}</small>
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
    schedule(){
      return this.store.currentSchedule
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
}


</style>
