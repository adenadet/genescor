<template>
<div class="row clearfix mt-3">
    <div class="modal fade" id="appointmentModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-show="editMode">Edit Appointment: {{appointment.unique_id}}</h4>
                    <h4 class="modal-title" v-show="!editMode">New Appointment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <AppointmentFormRequest :appointment="appointment" :specialities="specialties"/>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Appointments</h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item"><button class="btn btn-sm btn-primary" type="button" @click="addNew"><i class="fa fa-calendar"></i><i class="fa fa-plus"></i></button></li>
                        <!--<li class="nav-item"><a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a></li>-->
                    </ul>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#all" data-toggle="tab">All</a></li>
                    <li class="nav-item"><a class="nav-link" href="#active" data-toggle="tab">Active</a></li>
                    <li class="nav-item"><a class="nav-link" href="#planned" data-toggle="tab">Planned</a></li>
                </ul>
                </div>
                        
                <div class="tab-content">
                    <div class="tab-pane active" id="all">
                        <table class="table table-striped">
                            <thead><tr><th>Date</th><th>Preferred Time</th><th>Fixed Time</th><th>Doctor</th><th>Room </th><th>Status</th><th></th></tr></thead>
                            <tbody v-show="appointments != null">
                                <tr v-for="appointment in all.data" :key="appointment.id">
                                <td>{{appointment.preferred_date | ExcelDate}}</td>
                                <td>{{appointment.preferred_time | firstUp}}</td>
                                <td>{{appointment.fixed_time | ExcelDate}}</td>
                                <td>{{appointment.doctor != null ? 'Dr. '+appointment.doctor.first_name+' '+appointment.doctor.last_name: 'No doctor has been assigned'}}</td>
                                <td>{{appointment.room != null ? appointment.room.channel: 'None Fixed'}}</td>
                                <td>{{appointment.status == 0 ? 'Not Taken' : (appointmnet.status == 1 ? 'Taken': (appointment.status == 2 ? 'In Progress' : (appointment.status == 3 ? 'Completed' : appointment.status == 4 ? 'Rejected': 'Undefined')))}}</td>
                                <td>
                                    <div class="btn-group">
                                        <router-link :to="'/app/admin/appointments/'+appointment.id" class="btn btn-sm btn-primary"><i class="fa fa-eye mr-1"></i></router-link>
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-times mr-1"></i></button>
                                    </div>
                                </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <ul class="pagination pagination-sm">
                                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                                </ul>
                            </tfoot>
                        </table>
                        <!--<AppointmentList :appointments="all" type="all" /> -->
                    </div>
                    <div class="tab-pane" id="active">
                        2<!--<AppointmentList :appointments="active" type="active" /> -->
                    </div>
                    <div class="tab-pane" id="pending">
                        3<!--<AppointmentList :appointments="pending" type="pending" /> -->
                    </div>
                    <div class="tab-pane" id="planned">
                        4<!--<AppointmentList :appointments="planned" type="planned" />-->
                    </div>
                    <div class="tab-pane" id="cancelled">
                        5<!--<AppointmentList :appointments="cancelled" type="cancelled"/>-->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return  {
            active: {},
            all: {},
            appointment: {},
            appointments:{},
            cancelled: {},
            pending: {},
            planned: {},
            editMode: true, 
            specialties: [],
            user_type: 'patient'
        }
    },
    mounted() {
        this.getAllInitials();
    },
    methods:{
        addNew(){
            this.editMode = false;
            this.user = {};
            Fire.$emit('RequestDataFill', this.user);
            $('#appointmentModal').modal('show');
        },
        cancelRequest(){},
        getAllInitials(){
            this.$Progress.start();
            axios.get('/api/emr/appointments?t='+this.user_type).then(response =>{
                this.active         = response.data.active;
                this.all            = response.data.all;
                this.cancelled      = response.data.cancelled;
                this.planned        = response.data.planned;
                this.pending        = response.data.pending;
                this.specialties    = response.data.specialties;
                this.$Progress.finish();
            })
            .catch(()=>{
                this.$Progress.fail();
                toast.fire({ icon: 'error', title: 'Appointments not loaded successfully'});
            });
        },
        
    },
}
</script>
