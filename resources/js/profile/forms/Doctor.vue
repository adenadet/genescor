<template>
<div class="">
    <form id="register_form" v-show="((doctor != null) && (editMode))">    
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                <label>Name *</label>
                <input type="text" class="form-control" id="nok_name" name="nok_name" placeholder="Full Name *" required  v-model="doctorForm.name" :class="{'is-invalid' : doctorForm.errors.has('name') }">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>License Number</label>
                    <input type="text" class="form-control" id="nok_address" name="address" placeholder="Enter Address *" required v-model="doctorForm.address" :class="{'is-invalid' : doctorForm.errors.has('address') }">
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>license Expiry Date</label>
                    <input type="number" class="form-control" id="nok_phone" name="phone" placeholder="Enter Phone Number *" value="" required v-model="doctorForm.phone" :class="{'is-invalid' : doctorForm.errors.has('phone') }">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Speciality</label>
                    <input type="email" class="form-control" id="nok_email" name="email" placeholder="Enter NOK Email Address *" required v-model="doctorForm.email" :class="{'is-invalid' : doctorForm.errors.has('email') }">
                </div>
            </div>
        </div>
        <button @click.prevent="updateNextofKin" type="submit" name="submit" class="submit btn btn-success">Submit </button>
    </form>
    <div class="row col-12">
        <div class="card col-md-6">
            <div class="card-body">
                <p>By Registering as a Doctor</p>
                <ul>
                    <li>Alert on patient request</li>
                    <li>Earn per consultation </li>
                </ul>
            </div>
            <div class="card-footer"><button class="btn btn-primary" type="button" @click="fillForm()"> Become A Doctor </button></div>
        </div>
        <div class="card col-md-6">
            <button class="btn btn-primary"> Register A Hospital/Clinic </button>
        </div>
    </div>
</div>
</template>
<script>
    export default {
        data(){
            return {
                doctorForm: new Form({
                    name: '',
                    hospital_id: '', 
                    annual_license_number: '', 
                    license_expiry: '',
                }),
                editMode:false,
            }
        },
        methods:{
            createDoctor(){
                this.$Progress.start();
                this.doctorForm.post('/api/emr/doctors')
                .then(response =>{
                    this.$Progress.finish();
                    Swal.fire({
                        icon: 'success',
                        title: 'The Next of Kin details has been updated',
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
            fillForm(){
                this.editMode = false;
                
            },
            updateDoctor(){
                this.$Progress.start();
                this.doctorForm.put('/api/emr/doctors/'+this.doctorForm.id)
                .then(response =>{
                    this.$Progress.finish();
                    Swal.fire({
                        icon: 'success',
                        title: 'Your Details have been received, awaiting confirmation from the Medical and Dental Council of Nigeria',
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
        },
        mounted() {
            this.doctorForm.fill(this.nok);
            Fire.$on('NextOfKinFill', update =>{
                this.editMode = true;
                this.doctorForm.fill(update);
            });
        },
        props:{
            'doctor': Object,
        },
    }
</script>