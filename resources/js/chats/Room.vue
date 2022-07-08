<template>
<div class="row">
    <div class="col-md-8">
        <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
                <h3 class="card-title">Direct Chat</h3>
                <div class="card-tools">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fas fa-comments"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="direct-chat-messages" style="height:500px">
                    <ChatMessage v-for="message in messages.data" :key="message.id" :message="message" :user="user" />
                </div>
            </div>
            <div class="card-footer">
                <ChatFormNew :user="user" :room="room"/>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <ChatMembers :members="members"/>
    </div>
</div>

</template>
<script>
export default {
    data(){
        return {
            members: {},
            messages: {},
            room: {},
            user: {},
        }
    },
    methods:{
        getAllInitials(){
            axios.get('/api/chats/rooms/'+this.$route.params.id).then(response =>{
                this.messages = response.data.messages;
                this.members = response.data.members;
                this.room = response.data.room;
                this.user = response.data.user;
                this.$Progress.finish();
                toast.fire({icon: 'success',title: 'Closure loaded successfully',});
            })
            .catch(()=>{
                this.$Progress.fail();
                toast.fire({
                    icon: 'error',
                    title: 'Closure not loaded successfully',
                })
            });
        },
    },
    mounted() {
        this.getAllInitials();
        Fire.$on('preliminaryAdd', message =>{
            this.messages.push(message);
        }); 
        Echo.join('chatRoom-'+this.$route.params.id)
        .here()
        .joining()
        .leaving()
        .listen('MessagePosted', (e) => {
            console.log(e)
        });
    },
} 
</script>
<style>
</style>
