import Axios from 'axios'
import {defineStore} from 'pinia'

export const useMainStore = defineStore('main', {
    state: () => ({
        metrics: {},
        metricTableHeadings : [],
        categories : [],
        roles: [],
        currentTeamRoleId : null,
        totals: {
            'experienced': 0,
            'basic': 0,
            'learning': 0,
            'not-done': 0,
            'out-of-scope': 0
        },
        user: {},
        users: [],
        chartData: {
            labels: [
                "1. Experienced",
                "2. Done (Basic)",
                "3. Learning",
                "4. Not Learnt",
                "5. Out of Scope"
            ],
            datasets: [{data: [], backgroundColor: ["#41B883", "#FFFF00", "#00D8FF", "#E46651", "grey"]}]
        },
        loaded: false
    }),
    getters: {},
    actions: {
        
        async getStartup() {
            if (this.user.roleId != 1){ // If not an admin run these
                this.metricTableHeadings = ['Theme', 'Functionality', 'Status (Score 1-5)', 'Description']
                await this.getUser();
                await this.getMetrics(this.user.roleId);
                await this.getChartData();
                await this.getCategories(this.user.roleId);
                await this.getScores(this.user.id, '');
                await this.getRoles();
            }
            if (this.user.roleId == 1){
                this.metricTableHeadings = ['Theme', 'Functionality', 'Team Status (Score 1-5)', 'Description']
                await this.getUsers();
            }
        },


        async getMetrics(roleID) {
            const response = await Axios.get('/api/metrics', {params: {roleID: roleID}});
            if (response) {
                this.metrics = response.data.metrics
            }
            console.log(response)
        },

        async getUser() {
            const response = await Axios.get('/user');
            if (response) {
                this.user = response.data.user
            }
            else {
                alert('User information not found')
            }
        },

        async getChartData() {
            this.loaded = false;
            const response = await Axios.get('/api/metrics/chart' , {params: {userID: this.user.id}});

            if (response) {
                this.chartData.datasets[0]["data"] = response.data.scoreTotals
                this.totals['experienced'] = this.chartData.datasets[0]["data"][0]
                this.totals['basic'] = this.chartData.datasets[0]["data"][1]
                this.totals['learning'] = this.chartData.datasets[0]["data"][2]
                this.totals['not-done'] = this.chartData.datasets[0]["data"][3]
                this.totals['out-of-scope'] = this.chartData.datasets[0]["data"][4]
                this.loaded = true
            }
        },

        async getAdminChartData(roleID) {
            this.loaded = false;
            this.currentTeamRoleId = roleID;
            const response = await Axios.get('/api/metrics/adminChart' , {params: {roleID: roleID}});
            if (response) {
                this.chartData.datasets[0]["data"] = response.data.scoreTotals
                this.totals['experienced'] = this.chartData.datasets[0]["data"][0]
                this.totals['basic'] = this.chartData.datasets[0]["data"][1]
                this.totals['learning'] = this.chartData.datasets[0]["data"][2]
                this.totals['not-done'] = this.chartData.datasets[0]["data"][3]
                this.totals['out-of-scope'] = this.chartData.datasets[0]["data"][4]
                this.loaded = true
            }
            var member;
            for (member in this.users) {
                if (this.users[member].roleId == this.currentTeamRoleId){
                    this.getScores(this.users[member].id, this.users[member].name)
                }
            }
        },

        async getCategories(roleID) {
            const response = await Axios.get('/api/categories', {params: {roleID: roleID}})
            if (response){
                this.categories = response.data.categories
                var metric;
                var cat;
                for (metric in this.metrics){
                    for (cat in this.categories){
                        if (this.metrics[metric].categoryId == this.categories[cat].id){
                            this.metrics[metric].category = this.categories[cat].name
                        }

                    }
                }
            }
        },

        async getScores(userID, userName) {
            const response = await Axios.get('/api/metrics/score', {params: {userID: userID}});
            if (response) {
                const scores = response.data.data
                var score;
                var metric;
                for (metric in this.metrics){
                    
                    for (score in scores) {
                        if (this.metrics[metric].id == scores[score].metricId){
                            this.metrics[metric].score = scores[score].score
                            if (this.user.roleId == 1) { //1 is the admin Role ID
                                if (this.metrics[metric].teamScores == undefined){
                                    this.metrics[metric].teamScores = []
                                }
                                this.metrics[metric].teamScores.push({score: scores[score].score, name: userName})
                                this.metrics[metric].score = this.calculateTeamAverageScorePerMetric(this.metrics[metric].teamScores)   
                            }
                        }
                       
                    }
                }
            }
        },

       

        async getRoles() {
            const response = await Axios.get('/api/roles')
            if (response){
                this.roles = response.data.roles
            }
        },

        async getUsers() {
            const response = await Axios.get('/api/users')
            if (response){
                this.users = response.data.users
            }

            
        },

        async setScore(data) {
            const response = await Axios.post('/api/metrics/score', data);
            if (response) {
               await this.getChartData();
               console.log(response)
            }
        },

        calculateTeamAverageScorePerMetric(teamScores){
            var score;
            console.log(teamScores)
            var totalScore = 0;
            for (score in teamScores) {
                totalScore += teamScores[score].score
            }
            return Math.round(totalScore/(teamScores.length))

        },

    },
})
