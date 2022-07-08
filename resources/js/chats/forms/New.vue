<template>
<form action="#" method="post">
    <div class="input-group">
        <input type="text" name="message" placeholder="Type Message ..." class="form-control" @keydown.enter="sendMessage" v-model="MessageForm.content">
        <span class="input-group-append"><button type="button" class="btn btn-primary" @click="sendMessage">Send</button></span>
    </div>
</form>    
</template>
<script>
export default {
    data(){
        return {
            message: {},
            MessageForm: new Form({
                user_id: '',
                room_id: '',
                content:'',
            }),
        }
    },
    methods:{
        getAllInitials(){
            
        },
        sendMessage(){
            /*
            this.message = {
                user: this.user,
                content: this.MessageForm.message,
                date: '13/10/2021 16:22:23',
            },
            Fire.$emit('preliminaryAdd', this.message);
            */
            this.MessageForm.room_id = this.room.id;
            this.MessageForm.user_id = this.user.id;
            this.MessageForm.post('/api/chats/rooms').then(response=>{
                this.MessageForm.reset();
            })
            .catch(()=>{
                this.$Progress.fail();
            });
            console.log(this.MessageForm);
        },
    },
    mounted() {
        //this.getAllInitials();
    },
    props:{
        'room': Object,
        'user': Object,
    },
}
</script>
<style scoped>

</style>
