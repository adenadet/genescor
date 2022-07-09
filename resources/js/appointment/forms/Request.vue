<template>
<form role="form">
    <alert-error :form="RequestData"></alert-error> 
    <div class="card card-primary">
        <div class="card-body">
            <!--
            <div class="form-group">
                <label for="exampleInputEmail1">Preferred Date</label>
                <input type="date" required class="form-control" id="date" name="date" placeholder="First Name *" v-model="RequestData.date" :class="{'is-invalid' : RequestData.errors.has('date') }">
                <has-error :form="RequestData" field="date"></has-error> 
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Preferred Time</label>
                <select class="form-control" id="time" name="time" required v-model="RequestData.time" :class="{'is-invalid' : RequestData.errors.has('time') }">
                    <option value="">--Select Preferred Time--</option>
                    <option value="morning">Morning [6am - 12pm]</option>
                    <option value="afternoon">Afternoon [12pm - 4pm]</option>
                    <option value="evening">Evening [4pm - 10pm]</option>
                    <option value="night">Night [10pm - 6am]</option>
                </select>
                <has-error :form="RequestData" field="time"></has-error> 
            </div>
            -->
            <div class="form-group">
                <label for="exampleInputEmail1">Specialty</label>
                <select  class="form-control" id="specialty" name="specialty" required v-model="RequestData.specialty" :class="{'is-invalid' : RequestData.errors.has('specialty') }">
                    <option value="">--Select Speciality--</option>
                    <option v-for="specialty in specialities" :value="specialty.id" :key="specialty.id">{{specialty.name}}</option>
                </select>
                <has-error :form="RequestData" field="specialty"></has-error> 
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Complaint</label>
                <textarea  class="form-control" id="complaint" name="complaint" placeholder="Enter your complaints here *" required v-model="RequestData.complaint" :class="{'is-invalid' : RequestData.errors.has('complaint') }" rows=5></textarea>
                <has-error :form="RequestData" field="complaint"></has-error> 
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Upload File (jpg, png only) </label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="form-control" @change="updateProfilePic">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append"><span class="input-group-text" id="">Upload</span></div>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">I agree that a doctor would be provided to me based on my location in my profile.</label>
            </div>
        </div>
        <div class="card-footer">
            <button @submit.prevent="addRequest" type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
</template>
<script>
export default {
    data(){
        return  {
            areas:[],  
            branches:[],  
            nok:{},
            states:[], 
            RequestData: new Form({
                date: '', 
                middle_name:'', 
                last_name:'', 
                email:'',
                personal_email: '', 
                password:'', 
                street:'', 
                street2:'', 
                city:'', 
                area_id:'', 
                state_id:'', 
                phone:'', 
                alt_phone:'', 
                branch_id:'', 
                department_id:'', 
                sex:'', 
                image:'', 
                id:'', 
                dob:'', 
                roles:'',
            }), 
            user:{}, 
        }
    },
    mounted() {},
    created() {
        Fire.$on('Reload', response =>{
            console.log("Working");
            this.user = response.data.user[0];
            this.areas = response.data.areas;
            this.branches = response.data.branches;
            this.states = response.data.states;
            this.nok = response.data.nok[0];

            Fire.$emit('RequestDataFill', this.user);
            Fire.$emit('NextOfKinFill', this.nok);
        });
    },
    methods:{
        addRequest(){
            alert("Working");
            this.RequestData.post('/api/appointments/users/'+ this.BioData.id)
            .then(response =>{
                this.$Progress.finish();
                Fire.$emit('Reload', response);
                Swal.fire({
                    icon: 'success',
                    title: 'The User'+ response.data.user.first_name+' '+  response.data.user.last_name+' has been updated',
                    showConfirmButton: false,
                    timer: 1500
                });
            })
            .catch(()=>{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: 'Please try again later!'
                });
                this.$Progress.fail();
            });            
        },
        getInitials(){},
        updateProfilePic(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            if (file['size'] < 2000000){
                reader.onloadend = (e) => {
                    this.RequestData.image = reader.result
                    }
                reader.readAsDataURL(file)
            }
            else{
                Swal.fire({
                    type: 'error',
                    title: 'File is too large'
                })
            }
        },
    },
    props:{
        'specialities': Array,
    },
}
</script>
