<template>
    <table class="table table-striped">
        <thead><tr><th>Date</th><th>Preferred Time</th><th>Fixed Time</th><th>Patient</th><th>Doctor</th><th>Room </th><th>Status</th><th></th></tr></thead>
        <tbody v-show="appointments != null">
            <tr v-for="appointment in appointments.data" :key="appointment.id">
            <td>{{appointment.preferred_date | ExcelDate}}</td>
            <td>{{appointment.preferred_time }}</td>
            <td>{{appointment.fixed_time | ExcelDate}}</td>
            <td>{{appointment.patient}}</td>
            <td>{{appointment.doctor != null ? 'Dr.'+appointment.doctor.first_name+' '+appointment.doctor.last_name: 'No doctor has been assigned'}}</td>
            <td>{{appointment.room.channel}}</td>
            <td>{{appointment.status}}</td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary"><i class="fa fa-eye mr-3"></i>View</button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-times mr-3"></i>Cancel</button>
                </div>
            </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    data(){
        return  {
            editMode: true, 
            BioData: new Form({
                first_name: '', 
                middle_name:'', 
                last_name:'', 
                email:'', 
                password:'', 
                street:'', 
                street2:'', 
                city:'', 
                area_id:'', 
                state_id:'', 
                phone:'', 
                alt_phone:'', 
                sex:'', 
                image:'', 
                id:'', 
                dob:'', 
                roles:'',
            }),
        }
    },
    mounted() {
        console.log(this.appointments);
    },
    methods:{
        cancelRequest(){},
    },
    props:{
        appointments: Object,
        type: String,
    }
}