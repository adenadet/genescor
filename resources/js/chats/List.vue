<template>
<section>
<div class="row">
    <div class="modal fade" id="chatModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-show="editMode">Edit User: {{user.unique_id}}</h4>
                    <h4 class="modal-title" v-show="!editMode">New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <ChatFormRoom :editMode="editMode"/>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chat Rooms</h3>
                <div class="card-tools">
                    <button type="button" class="btn-sm btn-primary" @click="createRoom" >Create New Room</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Members</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(room, index) in rooms.data" :key="index">
                            <td>{{index}}</td>
                            <td>{{room.name}}</td>
                            <td>{{room.description}}</td>
                            <td>5</td>
                            <td><router-link :to="'/chats/'+room.id"><button class="btn-sm btn-success" >Join</button></router-link>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
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
            editMode: false,
            members: {},
            messages: {},
            rooms: {},
            room: {},
            user: {},
        }
    },
    methods:{
        createRoom(){
            this.editMode = false;
            this.room = {};
            Fire.$emit('RoomDataFill', this.room);
            $('#chatModal').modal('show');

            this.$Progress.finish();
        },
        getAllInitials(){
            axios.get('/api/chats/rooms').then(response =>{
                this.rooms = response.data.rooms;
                this.$Progress.finish();
                toast.fire({icon: 'success',title: 'Chat Rooms loaded successfully',});
            })
            .catch(()=>{
                this.$Progress.fail();
                toast.fire({
                    icon: 'error',
                    title: 'Chat Room not loaded successfully',
                })
            });
        },
    },
    mounted() {
        this.getAllInitials();
        Fire.$on('preliminaryAdd', message =>{
            this.messages.push(message);
        }); 
    },
}
</script>
