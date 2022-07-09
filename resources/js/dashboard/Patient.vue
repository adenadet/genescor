<template>  
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3><p>Account Balance</p>
                    </div>
                    <div class="icon"><i class="fa fa-wallet"></i></div>
                    <router-link to="/patient/wallet" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon"><i class="ion ion-stats-bars"></i></div>
                    <router-link href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner"><h3>44</h3><p>Pending Appointments</p></div>
                    <div class="icon"><i class="fa fa-calendar"></i></div>
                    <router-link to="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner"><h3>65</h3><p>Messages</p></div>
                    <div class="icon"><i class="fa fa-envelope"></i></div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return  {
            balance: {id: 0, balance:0},
            consultations: 0,  
            doc_reg: 0,
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
            axios.get('/api/dashboard/patient').then(response =>{
                this.balance = response.data.balance;
                this.consultation = response.data.consultation;
                this.doc_reg = response.data.doc_reg;
            })
            .catch(()=>{
                toast.fire({icon: 'error', title: 'Dashboard not loaded successfully',})
            });
        },
    }
}
</script>
