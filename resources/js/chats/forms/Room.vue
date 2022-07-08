<template>
<div>
<form>
    <alert-error :form="RoomData"></alert-error> 
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Name *</label>
                <input type="text" required class="form-control" id="name" name="name" placeholder="Name *" v-model="RoomData.name" :class="{'is-invalid' : RoomData.errors.has('name') }">
                <has-error :form="RoomData" field="name"></has-error> 
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-12">Description</label>
        <div class="col-sm-3" v-for="permission in permissions" :key="permission.id">
            <div class="form-check">
                <textarea class="form-check-input" type="checkbox" name="" id="" v-model="RoomData.description" rows=6></textarea>
            </div>
        </div> 
        <input type="hidden" name="id" id="id" v-model="RoomData.id">
    </div>
    <button @click.prevent="editMode ? updateRoom() : addRoom() " type="submit" name="submit" class="submit btn btn-success">Submit</button>
</form>
</div>
</template>
<script>
export default {
    data(){
        return  {
            RoomData: new Form({
                id: {},
                name: '', 
                description:'', 
            }),
        }
    },
    mounted() {
        Fire.$on('RoomDataFill', role =>{
            this.RoomData.fill(role);
        });
        Fire.$on('AfterCreation', ()=>{
            //axios.get("api/profile").then(({ data }) => (this.RoomData.fill(data)));
        });
    },
    methods:{
        addRoom(){
            this.$Progress.start();
            this.RoomData.post('/api/chats/rooms')
            .then(response =>{
                this.$Progress.finish();
                Fire.$emit('Reload', response);
                Swal.fire({
                    icon: 'success',
                    title: 'The Room has been created',
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

        updateRoom(){
            this.$Progress.start();
            this.RoomData.put('/api/chats/rooms/'+this.RoomData.id)
            .then(response =>{
                this.$Progress.finish();
                Fire.$emit('Reload', response);
                Swal.fire({
                    icon: 'success',
                    title: 'The Room details has been updated',
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
        getProfilePic(){
            let photo = (this.RoomData.image.length >= 150) ? this.RoomData.image : "./"+this.RoomData.image;
            return photo;
            },
        updateProfilePic(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            if (file['size'] < 2000000){
                reader.onloadend = (e) => {
                    this.RoomData.image = reader.result
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
        editMode: Boolean,
    }
}
</script>

