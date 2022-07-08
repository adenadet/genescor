<template>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-lg-4 col-12">
            <div class="small-box bg-info">
                <div class="inner"><h3>{{balance.balance | currency}}</h3><p>Wallet Balance</p></div>
                <div class="icon"><i class="fa fa-wallet"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner"><h3>{{topup_cnt | currency}}</h3><p>Total TopUps</p></div>
                <div class="icon"><i class="fa fa-sign-in"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner"><h3>{{payment_cnt | currency}}</h3><p>Total Payments</p></div>
                <div class="icon"><i class="fa fa-sign-out"></i></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-12">
            <WalletTopUps />
        </div>
        <div class="col-lg-6 col-6">
            <WalletPayments />
        </div>
    </div>
</div>
        
</template>
<script>
export default {
    data(){
        return  {
            balance: {id: 0, balance:0},  
            topup_cnt:0,  
            payment_cnt:0,
        }
    },
    mounted() {},
    created() {
        this.getInitials();
        Fire.$on('Reload', response =>{
        });
    },
    methods:{
        getInitials(){
            axios.get('/api/finance/wallet').then(response =>{
                this.balance = response.data.balance;
                this.topup_cnt = response.data.topup_cnt;
                this.payment_cnt = response.data.payment_cnt;
            })
            .catch(()=>{
                toast.fire({icon: 'error', title: 'Wallet not loaded successfully',})
            });
        },
    }
}
</script>
