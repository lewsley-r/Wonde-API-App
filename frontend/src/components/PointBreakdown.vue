<template>
  <div class="uk-card uk-card-default uk-margin-top">
    <div class="uk-card-header">
      <h3>Points Breakdown</h3>
    </div>
    <div class="uk-card-body">
      <table class="uk-table uk-table-divider">
        <thead>
        <tr>
          <th>Row Labels</th>
          <th>Count of Selected</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1. Experienced</td>
          <td>{{ chartData['experienced'] }}</td>
        </tr>
        <tr>
          <td>2. Done(Basic)</td>
          <td>{{ chartData['basic'] }}</td>
        </tr>
        <tr>
          <td>3. Learning</td>
          <td>{{ chartData['learning'] }}</td>
        </tr>
        <tr>
          <td>4. Not Learnt</td>
          <td>{{ chartData['not-done'] }}</td>
        </tr>
        <tr>
          <td>5. Not in scope</td>
          <td>{{ chartData['out-of-scope'] }}</td>
        </tr>
        </tbody>
      </table>
    </div>

  </div>
</template>

<script>
import {useMainStore} from '@/stores/mainStore';

export default {
  data() {
    return {
      store: useMainStore()
    }
  },
  computed: {
    chartData() {
      return this.store.totals
    }
  }

};
</script>

<style scoped>

th {
  font-weight: 900;
  font-size: larger;
  text-align: center;
}
.uk-table{
  background-color: #1E2022;
  color: white;
  border-radius: 5px;
}

.uk-card-header{
  font-weight: 900;
}
</style>
