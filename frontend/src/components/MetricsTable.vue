<template>
  <div class="uk-card uk-card-default">
    <div class="uk-card-header">
      <div class="uk-grid" uk-grid>
        <div class="uk-width-expand">
          <div class="uk-grid">
            <div>
              <div uk-form-custom="target: > * > span:first-child">
                <select v-model="this.selectedCatFilter" aria-label="Custom controls">
                  <option :value=null>All Themes</option>
                  <option v-for="category in this.categories" v-bind:key="category.id" :value="category.id">
                    {{ category.name }}
                  </option>
                </select>
                <button class="uk-button uk-button-default" type="button" tabindex="-1">
                  <span></span>
                  <span uk-icon="icon: chevron-down"></span>
                </button>
              </div>
            </div>
          </div>


        </div>
        <div class="uk-width-auto" v-if="!isAdmin">
          <div v-if="isEditable == false">
            <button class="uk-button uk-button-text" uk-icon="pencil" @click="isEditable = !isEditable">
              Edit
            </button>
          </div>
          <div v-if="isEditable == true">
            <button class="uk-button uk-button-text" uk-icon="check" @click="isEditable = !isEditable">
              Done
            </button>
          </div>
        </div>
      </div>


    </div>
    <div class=" uk-card-body">
      <div class="uk-overflow-auto">
        <table class="uk-table uk-table-small uk-table-divider">
          <thead>
            <tr>
              <th v-for="heading in this.headings" v-bind:key="heading">{{ heading }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="metric in metrics" v-bind:key="metric.id" :class="{
              experienced: metric.score == 1,
              basic: metric.score == 2,
              learning: metric.score == 3,
              'not-done': metric.score == 4,
              'out-of-scope': metric.score == 5,
            }">
              <td>{{ metric.category }}</td>
              <td>{{ metric.name }}</td>
              <td v-if="isEditable == true">
                <select class="uk-select" :id="metric.name" v-on:change="setScore(metric.id, metric.score)"
                  v-model="metric.score">
                  <option value="1" class="experienced">1. Experienced</option>
                  <option value="2" class="basic">2. Done (Basic)</option>
                  <option value="3" class="learning">3. Learning</option>
                  <option value="4" class="not-done">4. Not learnt</option>
                  <option value="5" class="out-of-scope">5. Not in scope</option>
                </select>
              </td>
              <td v-else-if="isEditable == false && isAdmin == false">
                {{ metric.score }}
              </td>
              <td v-else-if="isAdmin == true">
                <p v-for="dev in metric.teamScores" v-bind:key="dev">
                  <b>Name: </b> {{ dev.name }}
                  <b>Score: </b> {{ dev.score }}
                </p>
                <p v-if="metric.score">
                  <b>Average Score: </b> {{ metric.score }}
                </p>
              </td>

              <td>{{ metric.description }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { useMainStore } from "@/stores/mainStore";

export default {
  data() {
    return {
      store: useMainStore(),
      isEditable: false,
      selectedCatFilter: null,
    };
  },

  computed: {
    metrics() {
      const metrics = this.store.metrics
      if (this.selectedCatFilter == null) {
        return metrics;
      }
      else {
        var metric;
        var finalMetrics = [];
        for (metric in metrics) {
          console.log(metrics[metric].categoryId, " != ", this.selectedCatFilter)

          if (metrics[metric].categoryId == this.selectedCatFilter) {
            finalMetrics.push(metrics[metric])
          }
        }
        console.log(finalMetrics)
        return finalMetrics;
      }
    },
    isAdmin() {
      return this.store.user.roleId == 1
    },
    categories() {
      return this.store.categories;
    },
    headings() {
      console.log(this.store.metricTableHeadings)
      return this.store.metricTableHeadings
    }
  },

  methods: {
    setScore(id, score) {

      const data = {
        id: id,
        score: score,
        userID: this.store.user.id
      };
      this.store.setScore(data)
      this.store.getChartData()
    },
  },
};
</script>

<style scoped>
th {
  font-weight: 900;
  font-size: larger;
  text-align: center;
}

.experienced {
  background-color: #41b883;
  color: black;
}

.basic {
  background-color: #ffff00;
  color: black;
}

.learning {
  background-color: #00d8ff;
  color: black;
}

.not-done {
  background-color: #e46651;
  color: black;
}

.out-of-scope {
  background-color: grey;
  color: black;
}

.uk-table {
  background-color: #1E2022;
  color: white;
  border-radius: 5px;

}
</style>
