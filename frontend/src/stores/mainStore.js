import Axios from 'axios'
import { defineStore } from 'pinia'
import moment from 'moment';

export const useMainStore = defineStore('main', {
    state: () => ({
        employees: [],
        classes: [],
        currentEmployee: {},
        currentSchedule: { monday: [], tuesday: [], wednesday: [], thursday: [], friday: [] },
        classLoading: true
    }),
    getters: {},
    actions: {

        async getStartup() {
            this.getEmployees()
            this.getClasses(1)
        },


        async getEmployees() {
            const response = await Axios.get('/api/employees');
            if (response) {
                this.employees = response.data.array
            }
        },

        async getClass(class_id) {
            const response = await Axios.get('/api/class', { params: { class_id: class_id } });
            if (response) {
                console.log(response)
            }
        },

        async getClasses(page_no) {
            const response = await Axios.get('/api/classes', { params: { page_no: page_no } });
            if (response.data.array.length > 0) {
                if (this.classes.length == 0) {
                    this.classes = response.data.array
                } else if (this.classes.length > 0) {
                    this.classes = this.classes.concat(response.data.array)
                }
                this.getClasses(page_no + 1)
            }else if(response.data.array.length == 0){
                this.classLoading = false
            }
        },

        selectEmployee(upi) {
            var employee
            var employeeClass
            this.currentSchedule = { monday: [], tuesday: [], wednesday: [], thursday: [], friday: [] }
            for (employee in this.employees) {
                if (this.employees[employee].upi == upi) {
                    this.currentEmployee = this.employees[employee]
                }
            }
            this.currentEmployee.classes = {data: []}
            for (employeeClass in this.classes) {
                if (this.classes[employeeClass].employees.data[0]){
                    if (this.classes[employeeClass].employees.data[0].upi == this.currentEmployee.upi){
                        this.currentEmployee.classes.data.push(this.classes[employeeClass])
                    }
                }
                
            }
            this.sortLessons()
        },

        sortLessons() {
            var lesson
            var classGroup
            for (classGroup in this.currentEmployee.classes.data) {
                for (lesson in this.currentEmployee.classes.data[classGroup].lessons.data) {
                    var item = { 
                        className: this.currentEmployee.classes.data[classGroup].name, 
                        students: this.currentEmployee.classes.data[classGroup].students, 
                        start: moment(this.currentEmployee.classes.data[classGroup].lessons.data[lesson].start_at.date).format("hh:mm a"), 
                        end: moment(this.currentEmployee.classes.data[classGroup].lessons.data[lesson].end_at.date).format("hh:mm a") 
                    }
                    this.currentSchedule[this.currentEmployee.classes.data[classGroup].lessons.data[lesson].period.data.day].push(item)
                }
            }
        }

    },
})
