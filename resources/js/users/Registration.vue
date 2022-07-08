<template>
<section class="content">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">New Registration</h3>
                        <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr><th>Username</th><th>Full Name</th><th>Joined Date</th><th>Confirmed By</th><th>Confirmed Date</th><th>Subscription</th><th>Status</th></tr>
                            </thead>
                            <tbody>
                                <tr v-for="doctor in doctors.data" :key="doctor.id">
                                    <td></td>
                                    <td>{{doctor.user != null ? doctor.user.first_name+' '+doctor.user.last_name : 'Deleted User'}}</td>
                                    <td>{{doctor.created_at | excelDate}}</td>
                                    <td>{{doctor.confirmer != null ? 'Dr. '+ doctor.confirmer.first_name+' '+doctor.confirmer.last_name: 'Not Yet Confirmed'}}</td>
                                    <td>{{doctor.confirmed_at }}</td>
                                    <td>{{doctor.subscription != null ? doctor.subscription.name : 'No active Subscription'}}</td>
                                    <td>{{doctor.status == 0 ? 'Unconfirmed': (doctor.status == 1 ? 'Active' : 'Deactivated')}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" @click="seeDoctor(doctor)"><i class="fas fa-folder"></i></button>
                                        <button class="btn btn-sm btn-primary" @click="editDoctor(doctor)"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn btn-sm btn-danger" @click="deleteDoctor(doctor.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
          </div>
    </div>
</div>
</section>
</template>
<script>
export default {
    data(){
        return {
            doctors: {},
            editMode: false,
            form: new Form({}),
        }
    },
    methods:{
        addDoctor(){
            this.editMode = false;
            this.doctor = {};
            Fire.$emit('BioDataFill', this.user);
            $('#userModal').modal('show');
            this.$Progress.finish();
        },
        deleteUser(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                //Send Delete request
                if(result.value){
                    this.form.delete('/api/ums/users/'+id)
                    .then(response=>{
                    Swal.fire('Deleted!', 'Category has been deleted.', 'success');
                    Fire.$emit('CatRefresh', response);   
                    })
                    .catch(()=>{
                    Swal.fire({icon: 'error', title: 'Oops...', text: 'Something went wrong!', footer: '<a href>Why do I have this issue?</a>'});
                    });
                }
            });  
        },
        editDoctor(doctor){
            this.$Progress.start();
            this.editMode = true;
            this.doctor = doctor;
            Fire.$emit('BioDataFill', doctor);
            $('#userModal').modal('show');

            this.$Progress.finish();
        },
        getAllInitials(){
            this.$Progress.start();
            axios.get('/api/ums/users/registration')
            .then(response =>{
                this.doctors = response.data.doctors;
                this.$Progress.finish();
                toast.fire({
                    icon: 'success',
                    title: 'Doctors loaded successfully',
                });
            })
            .catch(()=>{
                this.$Progress.fail();
                toast.fire({
                    icon: 'error',
                    title: 'Doctors not loaded successfully',
                })
            });
        },
        getUser(page=1){
            axios.get('/api/ums/users?page='+page)
            .then(response=>{
                this.doctors = response.data.doctors;   
            });
        },
        setUserRole(user){
            this.$Progress.start();
            this.doctor = doctor;
            Fire.$emit('userRoleUpdate', doctor);
            $('#roleModal').modal('show');
            this.$Progress.finish();
        },
    },
    mounted() {
        this.getAllInitials();
        Fire.$on('searchInstance', ()=>{
            let query = this.$parent.search;
            axios.get('/api/ums/users/search?q='+query)
            .then((response ) => {this.doctors = response.data.doctors;})
            .catch(()=>{});
        });
        Fire.$on('userRoleReload', response =>{});
        Fire.$on('Reload', response =>{
            $('#userModal').modal('hide'); 
            $('#roleModal').modal('hide');
            this.doctors = response.data.doctors;
        });
    },
}
</script>