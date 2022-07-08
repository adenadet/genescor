<template>
<div>
    <div class="direct-chat-msg" v-show="user.id !== message.user.id">
        <div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">{{message.user.first_name}} {{message.user.last_name}}</span>
                <span class="direct-chat-timestamp float-right">{{message.created_at | excelDate}}</span>
            </div>
            <img class="direct-chat-img" :src="message.user.image !== null ? '/img/profile/'+message.user.image : '/img/profile/default.png'" alt="message user image">
            <div class="direct-chat-text">{{message.content}}</div>
        </div>
    </div>
    <div class="direct-chat-msg right"  v-show="user.id == message.user.id">
        <div class="direct-chat-infos clearfix">
            <span class="direct-chat-name float-right">{{message.user.first_name}} {{message.user.last_name}}</span>
            <span class="direct-chat-timestamp float-left">{{message.date}}</span>
        </div>
        <img class="direct-chat-img" :src="'/img/profile/'+message.user.image" alt="message user image">
        <div class="direct-chat-text">{{message.content}}</div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return {}
    },
    methods:{
        
    },
    mounted() {
    },
    props:{
        'message': Object,
        'user': Object,
    },
}
</script>
<style>
</style>
