<template>
<div class="small-box bg-info">
    <div class="inner"><h3>{{balance.balance | currency}}</h3><p>Account Balance</p></div>
    <div class="icon"><i class="fa fa-wallet"></i></div>
    <router-link to="/wallet" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
</div>    
</template>
<script>
export default {
    data(){return  {}},
    mounted() {},
    methods:{},
    props:{ balance: Object,}
}
</script>